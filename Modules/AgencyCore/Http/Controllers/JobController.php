<?php

namespace Modules\AgencyCore\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\AgencyCore\Actions\AssignApplicantToJob;
use Modules\AgencyCore\Actions\CreateClientJob;
use Modules\AgencyCore\Actions\EmailApplicantsToClient;
use Modules\AgencyCore\DataTransferObject\JobApplicantData;
use Modules\AgencyCore\DataTransferObject\JobData;
use Modules\AgencyCore\Entities\Applicant;
use Modules\AgencyCore\Entities\Client;
use Modules\AgencyCore\Entities\Job;
use Modules\AgencyCore\Http\Requests\AssignApplicantToJobRequest;
use Modules\AgencyCore\Transformers\JobResource;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class JobController extends Controller
{
    public function index(Request $request)
    {

        $query = QueryBuilder::for(Job::class)
            ->allowedSorts([
                'created_at',
            ])
            ->allowedFilters([
                'service_type',
                AllowedFilter::scope('search'),
                AllowedFilter::scope('client_name'),
                AllowedFilter::exact('status'),
            ])
            ->with('client');

        $paginator = $query->paginate($request->query('pageSize',
            15));

        return $paginator;
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request, CreateClientJob $action)
    {

        $client = Client::firstOrCreate(
            ['mobile' => $request->get('mobile')],
            [
                'prefix'     => $request->get('prefix'),
                'first_name' => $request->get('first_name'),
                'last_name'  => $request->get('last_name'),
            ]
        )->first();

        $data = JobData::fromFormData($request->all());

        $job = $action->execute($client, $data);

        return response()->json($job);
    }


    /**
     * @param \Modules\AgencyCore\Entities\Job $job
     * @return \Modules\AgencyCore\Transformers\JobResource
     */
    public function show(Job $job): JobResource
    {
        $job->load(['client', 'requirement']);

        return new JobResource($job);

    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
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

    public function getAllAssignedApplicants(Job $job): JsonResponse
    {
        return response()->json($job->applicants()->with('duties','experiences','contracts')->get());
    }

    public function assignedApplicant(
        Job                         $job,
        AssignApplicantToJobRequest $request,
        AssignApplicantToJob        $action
    ): JsonResponse
    {

        $job = $action->execute($job,
            JobApplicantData::fromFormData($request->validated()));

        return response()->json($job);
    }

    public function removeApplicant(
        Job       $job,
        Applicant $applicant): JsonResponse
    {

        $job->applicants()->detach($applicant->id);

        return response()->json($job);
    }

    public function emailApplicantToClient(
        Job $job, Request $request, EmailApplicantsToClient $action): JsonResponse
    {

        $validatedData = $this->validate($request,
            [
                'id.*'    => 'required|exists:applicants,id',
                'channel' => 'required',
            ]);

        $action->execute($job,
            JobApplicantData::fromMassFormData($validatedData));


        return response()->json();
    }
}
