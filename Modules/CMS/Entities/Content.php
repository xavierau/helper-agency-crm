<?php

namespace Modules\CMS\Entities;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Content extends Model
{
    protected $fillable = [
        'content',
    ];

    // region Relation

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function page(): BelongsTo {
        return $this->belongsTo(Page::class);
    }
    // endregion

    // region Scopes

    public function scopeKey(Builder $query, string $key): Builder {
        return $query->where('key',
                             $key);
    }

    public function scopeLanguage(Builder $query, string $language): Builder {
        return $query->where('language',
                             $language);
    }

    public function scopeCommon(Builder $query): Builder {
        return $query->whereNull('page_id');
    }


    // endregion


}
