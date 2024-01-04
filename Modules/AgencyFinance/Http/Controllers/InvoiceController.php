<?php

namespace Modules\AgencyFinance\Http\Controllers;

use App\Filters\SearchFilter;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Modules\AgencyContract\Actions\CreateContract;
use Modules\AgencyContract\DataTransferObjects\ContractData;
use Modules\AgencyContract\Entities\Contract;
use Modules\AgencyCore\Entities\Requirement;
use Modules\AgencyCore\Filters\ClientNameFilter;
use Modules\AgencyFinance\Actions\Invoice\CreateInvoice;
use Modules\AgencyFinance\Actions\Invoice\FetchInvoiceTrail;
use Modules\AgencyFinance\Actions\Invoice\SupersedeInvoice;
use Modules\AgencyFinance\Actions\Invoice\UpdateInvoice;
use Modules\AgencyFinance\Actions\ServiceAgreement\MergePdfs;
use Modules\AgencyFinance\DataTransferObject\InvoiceData;
use Modules\AgencyFinance\Entities\Invoice;
use Modules\AgencyFinance\Http\Requests\InvoiceStoreRequest;
use Modules\AgencyFinance\Http\Requests\InvoiceUpdateRequest;
use Modules\AgencyFinance\Http\Resources\TrailResource;
use Modules\AgencyFinance\Transformers\InvoiceResource;
use Modules\AgencyTemplate\Actions\GenerateTemplatePdf;
use Modules\AgencyTemplate\Contracts\HasTemplateInterface;
use Modules\AgencyTemplate\Entities\Template;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request): JsonResponse {
        $columnFilters = [
            'invoice_number',
            'contract.contract_number',
        ];

        $searchColumns = [
            'invoice_number',
            'clients.first_name',
            'clients.last_name',
        ];
        $query = QueryBuilder::for(Invoice::class)
                             ->with(['client', 'items.sellable', 'payments', 'contract'])
                             ->where('status',
                                     'active')
                             ->latest()
                             ->allowedFields(['contract.contract_number'])
                             ->allowedIncludes(['contract'])
                             ->allowedSorts([
                                                ...$columnFilters,
                                            ])
                             ->allowedFilters([
                                                  AllowedFilter::custom('search',
                                                                        new SearchFilter($searchColumns)),
                                                  AllowedFilter::custom('client.name',
                                                                        new ClientNameFilter),
                                                  ...$columnFilters,
                                              ]);


        return response()->json($query->paginate($request->query('pageSize',
                                                                 15)));
    }

    /**
     * Store a newly created resource in storage.
     * @param \Modules\AgencyFinance\Http\Requests\InvoiceStoreRequest $request
     * @param \Modules\AgencyFinance\Actions\Invoice\CreateInvoice     $action
     * @param \Modules\AgencyContract\Actions\CreateContract           $createContractAction
     * @return \Illuminate\Http\JsonResponse
     * @throws \Throwable
     */
    public function store(
        InvoiceStoreRequest $request, CreateInvoice $action, CreateContract $createContractAction) {

        $data = $request->validated();

        DB::beginTransaction();

        try {

            $newInvoice = $action->execute(InvoiceData::fromFormData($data));

            if($data['contract']['id'] === 'new') {
                $contractData = $data['contract'];
                $contractData['client_id'] = $data['client']['id'];
                $contract = $createContractAction->execute(ContractData::fromFormData($contractData));
            } else {
                $contract = Contract::findOrFail($data['contract']['id']);
            }

            $contract->invoice()->save($newInvoice);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }

        return response()->json(['contract_id' => $contract->id]);
    }

    /**
     * Show the specified resource.
     * @param \Modules\AgencyFinance\Entities\Invoice $invoice
     * @return \Modules\AgencyFinance\Transformers\InvoiceResource
     */
    public function show(Invoice $invoice) {

        $invoice->load([
                           'client',
                           'payments',
                           'previousInvoice',
                           'contract.applicant',
                       ]);

        return new InvoiceResource($invoice);
    }

    public function create(): JsonResponse {
        return response()->json([]);
    }

    /**
     * Update the specified resource in storage.
     * @param \Modules\AgencyFinance\Http\Requests\InvoiceUpdateRequest $request
     * @param \Modules\AgencyFinance\Entities\Invoice                   $invoice
     * @param \Modules\AgencyFinance\Actions\Invoice\UpdateInvoice      $action
     */
    public function update(InvoiceUpdateRequest $request, Invoice $invoice, UpdateInvoice $action) {
        $invoice = $action->execute($invoice,
                                    InvoiceData::fromFormData($request->validated()));

        return response()->json($invoice);
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     */
    public function destroy($id) {
        //
    }

    public function supersede(
        InvoiceStoreRequest $request, Invoice $invoice,
        SupersedeInvoice $action,
        CreateContract $createContract
    ): JsonResponse {
        DB::beginTransaction();

        try {
            $data = $request->validated();
            $data['invoice_id'] = $invoice->id;
            $newInvoice = $action->execute($invoice,
                                           InvoiceData::fromFormData($data));
            $contractdata = $data['contract'];
            $contractdata['client_id'] = $data['client']['id'];
            if($requirement = $invoice->contract->requirement) {
                $newRequirement = $requirement->replicate();
                $newRequirement->save();
            } else {
                $newRequirement = Requirement::create();
            }

            $contractdata['requirement_id'] = $newRequirement->id;
            $contract = $createContract->execute(ContractData::fromFormData($contractdata));

            $contract->invoice()->save($newInvoice);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }

        return response()->json($newInvoice);
    }

    public function trail(Invoice $invoice, FetchInvoiceTrail $action): JsonResponse {
        $trail = $action->execute($invoice);

        return response()->json(new TrailResource($trail));

    }

    public function printAgreement(
        Invoice $invoice, MergePdfs $action, GenerateTemplatePdf $generator) {
        // get all invoice item
        // get all invoice item template
        $templates = $invoice->items()->with(['sellable'])
                             ->get()->map->getHasPrintTemplateItem()
                                         ->map(fn(HasTemplateInterface $m) => $m->template)
                                         ->filter(fn($i) => is_null($i) === false);


        $paths = $templates->reduce(function($carry, Template $template) use ($invoice, $generator
        ) {

            $carry[] = $generator->execute($template,
                                           ['invoice' => $invoice]);

            return $carry;
        },
            []);


        // generate each template pdf


        // combine pdf as a single file
        $merger = $action->execute($paths);

        try {
            return $merger->download('merge_file.pdf');
        } catch (\Exception $e) {
            return response("No template");
        }

        // download


    }
}
