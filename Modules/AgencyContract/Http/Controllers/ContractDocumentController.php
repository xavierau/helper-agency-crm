<?php

namespace Modules\AgencyContract\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\DocumentStorageManager;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Modules\AgencyContract\Actions\RemoveContractDocumentContent;
use Modules\AgencyContract\Entities\Contract;
use Modules\AgencyContractDoc\Entities\ContractDoc;

class ContractDocumentController extends Controller
{


    /**
     * @param \Modules\AgencyContract\Entities\Contract $contract
     * @param \Illuminate\Http\Request                  $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Contract $contract, Request $request): JsonResponse {
        $validatedData = $this->validate($request,
                                         [
                                             'contract_document_id' => 'required|exists:contract_docs,id',
                                         ]);

        $contract->storedDocuments()->firstOrCreate([
                                                        'contract_doc_id' => $validatedData['contract_document_id'],
                                                    ]);

        return response()->json('completed');

    }


    /**
     * @param \Modules\AgencyContract\Entities\Contract       $contract
     * @param \Modules\AgencyContractDoc\Entities\ContractDoc $document
     * @param \App\Services\DocumentStorageManager            $manager
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function show(
        Contract $contract, ContractDoc $document, DocumentStorageManager $manager) {

        $record = $contract->storedDocuments()
                           ->where('contract_doc_id',
                                   $document->id)
                           ->firstOrFail();

        return response($manager->get($record->value),
                        200,
                        [
                            'Content-Type' => $record->mime_type,
                        ]);
    }


    /**
     * @param \Modules\AgencyContract\Entities\Contract $contract
     * @param \Illuminate\Http\Request                  $request
     * @param \App\Services\DocumentStorageManager      $manager
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(
        Contract $contract, Request $request, DocumentStorageManager $manager): JsonResponse {
        $validatedData = $this->validate($request,
                                         [
                                             'file'        => 'required|file',
                                             'document_id' => 'required|exists:contract_docs,id',
                                         ]);

        $storageResponse = $manager->store($request->file('file'));

        $contract->storedDocuments()->updateOrCreate([
                                                         'contract_doc_id' => $validatedData['document_id'],
                                                     ],
                                                     [
                                                         'value'     => $storageResponse->getPath(),
                                                         'mime_type' => $storageResponse->getMimeType(),
                                                     ]);

        return response()->json('completed');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return void
     */
    public function destroy($id) {
        //
    }

    /**
     * @param \Modules\AgencyContract\Entities\Contract                     $contract
     * @param \Modules\AgencyContractDoc\Entities\ContractDoc               $document
     * @param \Modules\AgencyContract\Actions\RemoveContractDocumentContent $action
     * @return \Illuminate\Http\JsonResponse
     */
    public function removeFile(
        Contract $contract, ContractDoc $document,
        RemoveContractDocumentContent $action): JsonResponse {

        $action->execute($contract,
                         $document);

        return response()->json('completed');
    }
}
