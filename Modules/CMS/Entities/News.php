<?php

namespace Modules\CMS\Entities;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class News extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $fillable = [
        'title',
        'title_chi',
        'summary',
        'summary_chi',
        'content',
        'content_chi',
        'is_active',
    ];

    protected $casts = [
        'is_active' => "boolean",
    ];

    protected $appends = [
        'thumbnail',
        'thumbnail_chi',
    ];

    public function registerMediaCollections(): void {
        $this->addMediaCollection('thumbnail')
             ->singleFile();

        $this->addMediaCollection('thumbnail_chi')
             ->singleFile();
    }

    // region Scope

    public function scopeActive(Builder $query): Builder {
        return $query->where('is_active',
                             true);
    }

    // endregion

    // region Helpers

    public function getTitle(): ?string {
        if(app()->getLocale() === 'zh') {
            return $this->title_chi ?? $this->title;
        }

        return $this->title;
    }

    public function getContent(): ?string {
        if(app()->getLocale() === 'zh') {
            return $this->content_chi ?? $this->content;
        }

        return $this->content;
    }

    public function getSummary(): ?string {
        if(app()->getLocale() === 'zh') {
            return $this->summary_chi ?? $this->summary;
        }

        return $this->summary;
    }

    public function getThumbnail(): ?string {
        if(app()->getLocale() === 'zh') {
            return $this->thumbnail_chi ?? $this->thumbnail;
        }

        return $this->thumbnail;
    }


    // endregion

    // region Accessor

    public function getThumbnailAttribute(): ?string {
        return $this->getFirstMediaUrl('thumbnail');
    }

    public function getThumbnailChiAttribute(): ?string {
        return $this->getFirstMediaUrl('thumbnail_chi');
    }

    // endregion
}
