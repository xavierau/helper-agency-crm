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
 * @Date        : 24/3/2021
 * @copyright   Copyright (c) A & A Creation (https://anacreation.com/)
 */

namespace Modules\AgencyContract\Actions;


use Modules\UploadDocument\Entities\Document;
use Modules\UploadDocument\Http\Requests\DocumentUpdateRequest;

class UpdateContractUploadDocument
{
    public function execute(Document $document, DocumentUpdateRequest $request): Document {
        $document->update($request->validated());

        return $document;
    }

}
