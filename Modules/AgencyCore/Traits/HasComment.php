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
 * @Date        : 26/1/2021
 * @copyright   Copyright (c) A & A Creation (https://anacreation.com/)
 */

namespace Modules\AgencyCore\Traits;


use Illuminate\Database\Eloquent\Relations\MorphMany;
use Modules\AgencyCore\Entities\Comment;

trait HasComment
{
    public function comments(): MorphMany {
        return $this->morphMany(Comment::class,
                                'has_comment');
    }
}
