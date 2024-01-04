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

namespace Modules\AgencyCore\Actions;


use Illuminate\Support\Facades\Storage;
use Modules\AgencyCore\Entities\Applicant;
use Modules\UploadDocument\Entities\Document;
use Modules\UploadDocument\Http\Requests\DocumentStoreRequest;

class CreateApplicantUploadDocument
{
    public function execute(Applicant $applicant, DocumentStoreRequest $request): Document {
        $data = $request->validated();

        $data['type'] = $request->file('file')->getClientMimeType();

        $data['link'] = $this->moveFile($request);
        /** @var Document $document */
        $document = $applicant->uploadDocuments()
                              ->create($data);

        return $document;
    }

    private function moveFile(DocumentStoreRequest $request) {

        $path = Storage::putFile('files',
                                 $request->file('file'));

        return $path;

    }
}
