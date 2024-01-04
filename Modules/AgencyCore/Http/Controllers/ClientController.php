<?php

namespace Modules\AgencyCore\Http\Controllers;

use App\Filters\SearchFilter;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\AgencyCore\Actions\Client\AddRelative;
use Modules\AgencyCore\Actions\Client\CreateClient;
use Modules\AgencyCore\Actions\Client\UpdateClient;
use Modules\AgencyCore\Actions\CreateClientJob;
use Modules\AgencyCore\DataTransferObject\ClientData;
use Modules\AgencyCore\DataTransferObject\JobData;
use Modules\AgencyCore\Entities\Client;
use Modules\AgencyCore\Http\Requests\ClientUpdateRequest;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        $columnFilters = [
            'first_name',
            'last_name',
            'mobile',
        ];

        $searchColumns = [
            'first_name',
            'last_name',
            'client_number',
            'mobile',
        ];
        $query = QueryBuilder::for(Client::class)
            ->allowedIncludes(['contracts.applicant'])
            ->allowedSorts($columnFilters)
            ->allowedFilters([
                AllowedFilter::custom('search',
                    new SearchFilter($searchColumns)),
                ...$searchColumns,
            ])
            ->with('contracts.applicant');

        return response()->json($query->paginate($request->query('pageSize',
            15)));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }


    /**
     * Show the specified resource.
     * @param \Modules\AgencyCore\Entities\Client $client
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Client $client): JsonResponse
    {
        $client->load([
            'contracts.applicant',
            'jobs.duties',
            'invoices.payments',
            'invoices.contract',
//            'account.clients.addresses',
        ]);

        return response()->json($client);
    }

    /**
     * Update the specified resource in storage.
     * @param \Modules\AgencyCore\Http\Requests\ClientUpdateRequest $request
     * @param \Modules\AgencyCore\Actions\Client\UpdateClient $action
     * @param \Modules\AgencyCore\Entities\Client $client
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(
        ClientUpdateRequest $request,
        UpdateClient        $action,
        Client              $client): JsonResponse
    {
        $client = $action->execute($client,
            ClientData::fromFormData($request->validated()));

        return response()->json($client);
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }

    public function newClientAndJob(
        Request         $request,
        CreateClient    $action,
        CreateClientJob $jobAction): JsonResponse
    {
        $validatedData = $this->validate($request,
            [
                'prefix' => 'required',
                'first_name' => 'nullable',
                'last_name' => 'required',
                'is_male' => 'required|boolean',
                'chinese_first_name' => 'nullable',
                'chinese_last_name' => 'nullable',
                'date_of_birth' => 'nullable|date',
                'place_of_birth' => 'nullable',
                'address_1' => 'nullable',
                'address_2' => 'nullable',
                'address_3' => 'nullable',
                'country' => 'required',
                'mobile' => 'required',
                'email' => 'nullable',
                'require_constant_care' => 'nullable|boolean',
                'service_type' => 'required|in:people,other',
                'services' => 'nullable',
                'people.type' => 'in:local,overseas,no_preference',
                'people.note' => 'nullable',
                'people.garden_size' => 'nullable|integer',
                'people.number_of_cars' => 'nullable|integer',
                'people.number_of_kids' => 'nullable|integer',
                'people.age_of_kids' => 'nullable',
                'people.disabled_personnel' => 'nullable|integer',
                'people.pets' => 'nullable',
            ]);

        $validatedData['is_primary'] = true;


        $client = $action->execute(ClientData::fromFormData($validatedData));

        $job = $jobAction->execute($client,
            JobData::fromFormData($validatedData));


        return response()->json($job);
    }

    public function postRelatives(
        Request     $request,
        Client      $client,
        AddRelative $action): JsonResponse
    {
        $validatedData = $this->validate($request,
            [
                'first_name' => 'required',
                'last_name' => 'required',
                'mobile' => 'required',
                'hk_id' => 'required',
                'relation' => 'required',
                'is_male' => 'required|boolean',
                'date_of_birth' => 'required|date',
            ]);

        $client = $action->execute($client->account,
            ClientData::fromFormData($validatedData));

        return response()->json($client);
    }

}
