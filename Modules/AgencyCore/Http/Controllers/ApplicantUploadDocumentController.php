<?php

namespace Modules\AgencyCore\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Routing\Controller;
use Modules\AgencyCore\Actions\CreateApplicantUploadDocument;
use Modules\AgencyCore\Actions\UpdateApplicantUploadDocument;
use Modules\AgencyCore\Entities\Applicant;
use Modules\UploadDocument\Entities\Document;
use Modules\UploadDocument\Http\Requests\DocumentStoreRequest;
use Modules\UploadDocument\Http\Requests\DocumentUpdateRequest;
use Modules\UploadDocument\Transformers\DocumentCollection;
use Modules\UploadDocument\Transformers\DocumentResource;

class ApplicantUploadDocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param \Modules\AgencyCore\Entities\Applicant $applicant
     * @return \Modules\UploadDocument\Transformers\DocumentCollection
     */
    public function index(Applicant $applicant): DocumentCollection {

        $documents = $applicant->uploadDocuments()
                               ->latest('id')
                               ->get();

        return new DocumentCollection($documents);
    }

    /**
     * Store a newly created resource in storage.
     * @param \Modules\UploadDocument\Http\Requests\DocumentStoreRequest   $request
     * @param \Modules\AgencyCore\Entities\Applicant                       $applicant
     * @param \Modules\AgencyContract\Actions\CreateContractUploadDocument $action
     * @return \Modules\UploadDocument\Transformers\DocumentResource
     */
    public function store(
        DocumentStoreRequest $request,
        Applicant $applicant,
        CreateApplicantUploadDocument $action): DocumentResource {

        $document = $action->execute($applicant,
                                     $request);

        return new DocumentResource($document);
    }

    /**
     * Show the specified resource.
     * @param \Modules\AgencyCore\Entities\Applicant    $applicant
     * @param \Modules\UploadDocument\Entities\Document $document
     * @return \Modules\UploadDocument\Transformers\DocumentResource
     */
    public function show(
        Applicant $applicant,
        Document $document): DocumentResource {
        if($document->owner->isNot($applicant)) {
            abort(403,
                  'this document is not belongs to the owner!');
        }

        return new DocumentResource($document);
    }

    /**
     * Update the specified resource in storage.
     * @param \Modules\UploadDocument\Http\Requests\DocumentUpdateRequest  $request
     * @param \Modules\AgencyCore\Entities\Applicant                       $applicant
     * @param \Modules\UploadDocument\Entities\Document                    $document
     * @param \Modules\AgencyContract\Actions\UpdateContractUploadDocument $action
     * @return \Modules\UploadDocument\Transformers\DocumentResource
     */
    public function update(
        DocumentUpdateRequest $request,
        Applicant $applicant,
        Document $document,
        UpdateApplicantUploadDocument $action) {

        if($document->owner->isNot($applicant)) {
            abort(403,
                  'this document is not belongs to the owner!');
        }

        $document = $action->execute($document,
                                     $request);

        return new DocumentResource($document);
    }

    /**
     * Remove the specified resource from storage.
     * @param \Modules\AgencyCore\Entities\Applicant    $applicant
     * @param \Modules\UploadDocument\Entities\Document $document
     * @return \Illuminate\Contracts\Support\Renderable
     * @throws \Exception
     */
    public function destroy(
        Applicant $applicant,
        Document $document): Renderable {

        if($document->owner->isNot($applicant)) {
            abort(403,
                  'this document is not belongs to the owner!');
        }

        $document->delete();

        return response('',
                        204);
    }
}
