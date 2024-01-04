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
 * @package
 * @Date        : 23/3/2021
 * @copyright   Copyright (c) A & A Creation (https://anacreation.com/)
 */

namespace Modules\UploadDocument\Contracts;


use Illuminate\Database\Eloquent\Relations\MorphMany;
use Modules\UploadDocument\Entities\Document;

trait HasUploadDocuments
{
    public function uploadDocuments(): MorphMany {
        return $this->morphMany(Document::class,
                                'owner');
    }
}
