<?php

namespace Modules\CMS\Entities;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Page extends Model
{
    protected $fillable = [
        'url',
        'view',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    // region Relation


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function contents(): HasMany {
        return $this->hasMany(Content::class);
    }

    // endregion

    // region Scopes

    public function scopeActive(Builder $query): Builder {
        return $query->where('is_active',
                             true);
    }

    // endregion

    // region Helpers

    public static function getPageByPath(string $path): ?Page {
        return Page::where('url',
                           $path)
                   ->with('contents')
                   ->active()
                   ->first();
    }


    public function getContent(string $key, $default = null, string $language = null): ?string {
        $language = $language ?? (app()->getLocale() ?? 'eng');

        $content = $this->contents()
                        ->where('key',
                                $key)
                        ->language($language)
                        ->first();

        return optional($content)->content ?? $default;
    }

    // endregion
}
