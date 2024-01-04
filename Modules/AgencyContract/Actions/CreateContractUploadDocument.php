<?php
/**
 * A & A Creation Co.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade this extension to newer
 * version in the future.
 *
 * @category    A & A Creation
 * @package     ${PACKAGE}
 * @Date        : 23/3/2021
 * @copyright   Copyright (c) A & A Creation (https://anacreation.com/)
 */

namespace Modules\AgencyContract\Actions;


use Illuminate\Support\Facades\Storage;
use Modules\AgencyContract\Entities\Contract;
use Modules\UploadDocument\Entities\Document;
use Modules\UploadDocument\Http\Requests\DocumentStoreRequest;

class CreateContractUploadDocument
{
    public function execute(Contract $contract, DocumentStoreRequest $request): Document {
        $data = $request->validated();

        $data['type'] = $request->file('file')->getClientMimeType();

        $data['link'] = $this->moveFile($request);
        /** @var Document $document */
        $document = $contract->uploadDocuments()
                             ->create($data);

        return $document;
    }

    private function moveFile(DocumentStoreRequest $request) {

        $path = Storage::putFile('files',
                                 $request->file('file'));

        return $path;

    }
}
