<?php

namespace Modules\AgencyCore\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * Modules\AgencyCore\Entities\Country
 *
 * @property int $id
 * @property string $code
 * @property string $label
 * @property string $label_zh
 * @property string $label_cn
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Country newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Country newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Country query()
 * @method static \Illuminate\Database\Eloquent\Builder|Country whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Country whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Country whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Country whereLabel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Country whereLabelCn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Country whereLabelZh($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Country whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Country extends Model
{
    protected $fillable = [];
}
