<?php

namespace Modules\AgencyContract\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Routing\Controller;
use Modules\AgencyContract\Actions\CreateContractUploadDocument;
use Modules\AgencyContract\Actions\UpdateContractUploadDocument;
use Modules\AgencyContract\Entities\Contract;
use Modules\UploadDocument\Entities\Document;
use Modules\UploadDocument\Http\Requests\DocumentStoreRequest;
use Modules\UploadDocument\Http\Requests\DocumentUpdateRequest;
use Modules\UploadDocument\Transformers\DocumentCollection;
use Modules\UploadDocument\Transformers\DocumentResource;

class ContractUploadDocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param \Modules\AgencyContract\Entities\Contract $contract
     * @return \Modules\UploadDocument\Transformers\DocumentCollection
     */
    public function index(Contract $contract) {

        $documents = $contract->uploadDocuments()
                              ->latest('id')
                              ->get();

        return new DocumentCollection($documents);
    }

    /**
     * Store a newly created resource in storage.
     * @param \Modules\UploadDocument\Http\Requests\DocumentStoreRequest   $request
     * @param \Modules\AgencyContract\Entities\Contract                    $contract
     * @param \Modules\AgencyContract\Actions\CreateContractUploadDocument $action
     * @return \Modules\UploadDocument\Transformers\DocumentResource
     */
    public function store(
        DocumentStoreRequest $request, Contract $contract, CreateContractUploadDocument $action) {

        $document = $action->execute($contract,
                                     $request);

        return new DocumentResource($document);
    }

    /**
     * Show the specified resource.
     * @param \Modules\AgencyContract\Entities\Contract $contract
     * @param \Modules\UploadDocument\Entities\Document $document
     * @return \Modules\UploadDocument\Transformers\DocumentResource
     */
    public function show(Contract $contract, Document $document) {
        if($document->owner->isNot($contract)) {
            abort(403,
                  'this document is not belongs to the owner!');
        }

        return new DocumentResource($document);
    }

    /**
     * Update the specified resource in storage.
     * @param \Modules\UploadDocument\Http\Requests\DocumentUpdateRequest  $request
     * @param \Modules\AgencyContract\Entities\Contract                    $contract
     * @param \Modules\UploadDocument\Entities\Document                    $document
     * @param \Modules\AgencyContract\Actions\UpdateContractUploadDocument $action
     * @return \Modules\UploadDocument\Transformers\DocumentResource
     */
    public function update(
        DocumentUpdateRequest $request,
        Contract $contract,
        Document $document,
        UpdateContractUploadDocument $action) {
        if($document->owner->isNot($contract)) {
            abort(403,
                  'this document is not belongs to the owner!');
        }

        $document = $action->execute($document,
                                     $request);

        return new DocumentResource($document);
    }

    /**
     * Remove the specified resource from storage.
     * @param \Modules\AgencyContract\Entities\Contract $contract
     * @param \Modules\UploadDocument\Entities\Document $document
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function destroy(
        Contract $contract,
        Document $document): Renderable {

        if($document->owner->isNot($contract)) {
            abort(403,
                  'this document is not belongs to the owner!');
        }

        $document->delete();

        return response('',
                        204);
    }
}
