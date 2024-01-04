<?php

namespace Modules\AgencyContract\Http\Controllers;

use Anacreation\Workflow\Entities\Transition;
use App\Http\Controllers\Controller;
use App\Services\FilterEntity;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Modules\AgencyContract\Actions\AddResidents;
use Modules\AgencyContract\Actions\ContractStateTransit\ContractStateTransit;
use Modules\AgencyContract\Actions\UpdateContract;
use Modules\AgencyContract\DataTransferObjects\ContractData;
use Modules\AgencyContract\Entities\Contract;
use Modules\AgencyContract\Transformers\ContractListResource;
use Modules\AgencyContract\Transformers\ContractResource;
use Modules\AgencyCore\Actions\Address\AddAddress;
use Modules\AgencyCore\Actions\Client\AddRelative;
use Modules\AgencyCore\DataTransferObject\Address\AddressData;
use Modules\AgencyCore\DataTransferObject\ClientData;
use Modules\AgencyCore\DataTransferObject\Contract\ResidentsData;
use Modules\AgencyCore\Entities\Client;

class ContractController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Modules\AgencyContract\Transformers\ContractListResource
     */
    public function index(Request $request) {

        $query = FilterEntity::model(Contract::class)
                             ->addFilter('contract_number')
                             ->addScopeFilter('status')
                             ->addScopeFilter('clientName')
                             ->addScopeFilter('contractTypeLabel')
                             ->getQuery();

        $sort = $request->get('sort',
                              'contract_number');
        $order = 'asc';

        if(Str::startsWith($sort,
                           '-')) {
            $order = 'desc';
            $sort = substr($sort,
                           1);
        }

        $query = $query->orderBy($sort,
                                 $order);

        $contracts = $query->paginate($request->query('pageSize',
                                                      15));

        return new ContractListResource($contracts);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request) {
        //
    }

    /**
     * Show the specified resource.
     * @param \Modules\AgencyContract\Entities\Contract $contract
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Contract $contract): JsonResponse {
        $contract->load([
                            'client.relatives',
                            'applicant',
                            'residents',
                            'invoice',
                            'type.contractDates',
                            'type.contractDocuments',
                            'type.templates',
                            'currentState.state',
                            'dates',
                            'documents',
                        ]);

        $resource = (new ContractResource($contract))
            ->showDetail();


        return response()->json($resource);
    }

    /**
     * Update the specified resource in storage.
     * @param Request                                        $request
     * @param \Modules\AgencyContract\Entities\Contract      $contract
     * @param \Modules\AgencyContract\Actions\UpdateContract $action
     * @return void
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, Contract $contract, UpdateContract $action) {
        $validatedData = $this->validate($request,
                                         [
                                             "applicant_id"        => "required|exists:applicants,id",
                                             "client_id"           => "required|exists:clients,id",
                                             "address_id"          => "required|exists:addresses,id",
                                             "residence_area"      => "nullable|numeric|min:1",
                                             "status"              => "required",
                                             "contract_number"     => "required",
                                             "number_of_adult"     => "nullable|numeric",
                                             "number_of_elderly"   => "nullable|numeric",
                                             "number_of_children"  => "nullable|numeric",
                                             "accommodation_type"  => "nullable|string",
                                             "accommodation_value" => "nullable|numeric",
                                             "dayoff_arrangement"  => "nullable",
                                             "number_of_bedrooms"  => "nullable|numeric",
                                         ]);
        $action->execute($contract,
                         ContractData::fromFormData($validatedData));
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return void
     */
    public function destroy(int $id) {
        //
    }

    public function addResidents(
        Contract $contract, Request $request, AddResidents $action): JsonResponse {
        $validatedData = $this->validate($request,
                                         [
                                             'id'       => [
                                                 'required',
                                                 Rule::exists('clients',
                                                              'id')->where(fn(
                                                     $q) => $q->where('account_id',
                                                                      $contract->client->account_id)),
                                             ],
                                             'relation' => 'required',
                                         ]);

        $residents = $action->execute($contract,
                                      ResidentsData::fromFormData($validatedData));

        $residents = $residents->map(fn($r) => $contract->client->relatives()
                                                                ->where('id',
                                                                        $r['id'])
                                                                ->first());

        return response()->json($residents);
    }

    public function removeResident(Contract $contract, Client $client): JsonResponse {
        if($contract->residents()->where('id',
                                         $client->id)->first()) {
            $contract->residents()->detach($client->id);
        }

        return response()->json('completed');
    }

    public function addAddress(
        Request $request, Contract $contract, AddAddress $action): JsonResponse {
        $validatedData = $this->validate($request,
                                         [
                                             'address_1' => 'required',
                                             'address_2' => 'nullable',
                                             'address_3' => 'nullable',
                                             'country'   => 'required',
                                         ]);
        $address = $action->execute($contract->client,
                                    AddressData::fromFormData($validatedData));

        $contract->addresses()->attach($address->id);

        return response()->json($address);
    }

    public function addNewResident(
        Request $request,
        Contract $contract,
        AddRelative $addRelative,
        AddResidents $action): JsonResponse {

        $validatedData = $this->validate($request,
                                         [
                                             'first_name'    => 'required',
                                             'last_name'     => 'required',
                                             'mobile'        => 'nullable',
                                             'hk_id'         => 'required',
                                             'relation'      => 'required',
                                             'is_male'       => 'required|boolean',
                                             'date_of_birth' => 'nullable|date',
                                         ]);

        $relative = $addRelative->execute($contract->client,
                                          ClientData::fromFormData($validatedData),
                                          $validatedData['relation']);

        $action->execute($contract,
                         ResidentsData::fromFormData([
                                                         'id'       => $relative->id,
                                                         'relation' => $validatedData['relation'],
                                                     ]));
        $data = [
            "client_number" => $relative->customer_number,
            "first_name"    => $relative->first_name,
            "full_name"     => $relative->full_name,
            "hk_id"         => $relative->hk_id,
            "id"            => $relative->id,
            "last_name"     => $relative->last_name,
            "mobile"        => $relative->mobile,
            "relation"      => $contract->client->relatives()->where('id',
                                                                     $relative->id)
                                                ->first()->pivot->relation,
        ];


        return response()->json($data);
    }

    public function transit(
        Contract $contract, Transition $transition, ContractStateTransit $action): JsonResponse {

        if( !$contract->canApplyTransition($transition)) {
            abort('401',
                  'Cannot apply transition');
        }

        $contract = $action->execute($contract,
                                     $transition);


        $contract->load([
                            'client.account.clients',
                            'currentState.state',
                            'applicant',
                            'addresses',
                            'residents',
                        ]);

        $contract->append('transitions');

        return response()->json($contract);
    }
}
