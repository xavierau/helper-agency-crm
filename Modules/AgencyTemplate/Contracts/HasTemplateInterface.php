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

namespace Modules\AgencyTemplate\Contracts;


use Illuminate\Database\Eloquent\Relations\MorphToMany;

interface HasTemplateInterface
{
    public function template(): MorphToMany;

    public function templates(): MorphToMany;
}
