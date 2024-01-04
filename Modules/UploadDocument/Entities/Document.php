<?php

namespace Modules\UploadDocument\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Document extends Model
{
    protected $fillable = [
        'link',
        'label',
        'type',
    ];

    // region Relation

    public function owner(): MorphTo {
        return $this->morphTo();
    }

    // endregion
}
