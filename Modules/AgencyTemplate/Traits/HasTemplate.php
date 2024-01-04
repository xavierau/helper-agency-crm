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
 * @package     anacreation/agency-template
 * @Date        : 4/11/2020
 * @copyright   Copyright (c) A & A Creation (https://anacreation.com/)
 */

namespace Modules\AgencyTemplate\Traits;


use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Modules\AgencyTemplate\Entities\Template;

trait HasTemplate
{
    public function template(): MorphToMany
    {
        return $this->MorphToMany(Template::class,
            'entity',
            'entity_template')
            ->limit(1)
            ->latest();
    }

    public function getTemplateAttribute(): ?Template
    {
        return $this->template()->first();
    }

    public function templates(): MorphToMany
    {
        return $this->morphToMany(Template::class,
            'entity',
            'entity_template');
    }
}
