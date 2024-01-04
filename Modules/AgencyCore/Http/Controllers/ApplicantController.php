<?php

namespace Modules\AgencyCore\Http\Controllers;

use App\Filters\SearchFilter;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Modules\AgencyCore\Actions\CreateNewApplicant;
use Modules\AgencyCore\Actions\CreateNewApplicantExperience;
use Modules\AgencyCore\DataTransferObject\ApplicantDTO;
use Modules\AgencyCore\DataTransferObject\ApplicantExperienceDTO;
use Modules\AgencyCore\Entities\Applicant;
use Modules\AgencyCore\Http\Requests\ApplicantStoreRequest;
use Modules\AgencyCore\Sorter\ApplicantAgeSorter;
use Modules\AgencyCore\Sorter\CurrentLocationSorter;
use Modules\AgencyCore\Sorter\GenderSorter;
use Modules\AgencyCore\Sorter\NameSorter;
use Modules\AgencyCore\Transformers\ApplicantIndexResource;
use Modules\AgencyCore\Transformers\ApplicantPaginatorResource;
use Modules\AgencyCore\Transformers\ApplicantResource;
use Modules\AgencyCore\Transformers\ApplicantShowResource;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\AllowedSort;
use Spatie\QueryBuilder\QueryBuilder;

class ApplicantController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param \Illuminate\Http\Request $request
     * @return \Modules\AgencyCore\Transformers\ApplicantPaginatorResource
     */
    public function index(Request $request): JsonResource
    {

        $columnFilters = [
            'nationality',
        ];

        $searchColumns = [
            'hk_code',
            'nationality',
        ];

        $query = $this->getQueryBuilder(
            $columnFilters,
            $searchColumns
        );

        $paginator = $query->paginate($request->query(
            'pageSize',
            15
        ));

        return ApplicantIndexResource::collection($paginator);
    }

    /**
     * Store a newly created resource in storage.
     * @param \Modules\AgencyCore\Http\Requests\ApplicantStoreRequest $request
     * @param \Modules\AgencyCore\Actions\CreateNewApplicant $action
     * @param \Modules\AgencyCore\Actions\CreateNewApplicantExperience $createExperience
     * @return \Illuminate\Http\JsonResponse
     * @throws \Throwable
     */
    public function store(
        ApplicantStoreRequest        $request,
        CreateNewApplicant           $action,
        CreateNewApplicantExperience $createExperience
    ): JsonResponse
    {

        $dto = ApplicantDTO::fromFormRequest($request);

        DB::beginTransaction();

        try {

            $newApplicant = $action->execute($dto);

            collect($dto->getExperienceDTOs())
                ->each(fn(ApplicantExperienceDTO $d) => $createExperience->execute($newApplicant, $d));

            DB::commit();

            $newApplicant->load('experiences');

            return response()->json($newApplicant);

        } catch (\Exception $e) {

            DB::rollBack();

            throw $e;
        }


    }


    /**
     * @param Applicant $applicant
     * @return ApplicantShowResource
     */
    public function show(Applicant $applicant): ApplicantShowResource
    {
        //TODO:: permission check

        $applicant->load(['experiences' => fn($q) => $q->with('duties')->orderBy('to', 'DESC'), 'contracts.client', 'duties', 'supplier']);

        return new ApplicantShowResource($applicant);
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
    public function destroy(Applicant $applicant)
    {
        $applicant->delete();
        return response('', 204);
    }

    public function registration(
        ApplicantStoreRequest        $request,
        CreateNewApplicant           $action,
        CreateNewApplicantExperience $createExperience
    ): JsonResponse
    {
        $newApplicant = $action->execute(ApplicantDTO::fromFormRequest($request));

        $createExperience->execute(
            $newApplicant,
            ApplicantExperienceDTO::fromFormRequest($request)
        );

        return response()->json('New applicant registered!');
    }

    public function approve(Applicant $applicant): JsonResponse
    {
        $applicant->update(['is_approved' => true]);
        $applicant->load(['experiences', 'contracts.client', 'duties', 'supplier']);

        return response()->json($applicant);
    }

    public function addFullBodyPhoto(Applicant $applicant, Request $request)
    {
        $this->validate(
            $request,
            [
                'file' => 'required|file|min:1',
            ]
        );
        $applicant->addMedia($request->file('file'))->toMediaCollection('full_body');

        return response()->json($applicant->full_body);
    }

    public function getAvailable(Request $request)
    {
        $columnFilters = [
            'name',
            'nationality',
            'current_country',
            'is_approved',
        ];

        $searchColumns = [
            'name',
            'nationality',
            'ref_number',
        ];
        $query = $this->getQueryBuilder(
            $columnFilters,
            $searchColumns
        )
        ->with('contracts');



        return new ApplicantPaginatorResource($query->paginate());
    }

    /**
     * @param array $columnFilters
     * @param array $searchColumns
     * @return \Spatie\QueryBuilder\QueryBuilder
     */
    private function getQueryBuilder(
        array $columnFilters,
        array $searchColumns
    ): \Spatie\QueryBuilder\QueryBuilder
    {

        $query = QueryBuilder::for(Applicant::class)
            ->allowedIncludes([
                'duties',
                'contracts',
                'experiences'
            ])
            ->allowedSorts([
                AllowedSort::custom('age', new ApplicantAgeSorter()),
                AllowedSort::custom('current_location', new CurrentLocationSorter()),
                'status',
                'is_approved',
                AllowedSort::custom('gender', new GenderSorter()),
                AllowedSort::custom('name', new NameSorter()),

                ...$columnFilters,
            ])
            ->allowedFilters([
                AllowedFilter::custom('search', new SearchFilter($searchColumns)),

                AllowedFilter::scope('available'),
                AllowedFilter::scope('age'),
                AllowedFilter::scope('duties'),
                AllowedFilter::scope('max_age'),
                AllowedFilter::scope('min_age'),
                AllowedFilter::scope('current_location'),
                AllowedFilter::scope('between_age'),
                AllowedFilter::scope('exclude_ids')->ignore(null),
                AllowedFilter::scope('status'),
                AllowedFilter::scope('name'),
                AllowedFilter::scope('is_approved'),

                AllowedFilter::exact('gender', 'sex'),

                ...$columnFilters,
            ]);

        return $query;
    }
}
