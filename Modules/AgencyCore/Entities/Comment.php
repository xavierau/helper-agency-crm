<?php

namespace Modules\AgencyCore\Entities;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

/**
 * Modules\AgencyCore\Entities\Comment
 *
 * @property int                             $id
 * @property int                             $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Comment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Comment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Comment query()
 * @method static \Illuminate\Database\Eloquent\Builder|Comment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Comment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Comment whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Comment whereUserId($value)
 * @mixin \Eloquent
 * @property string $has_comment_type
 * @property int $has_comment_id
 * @property string $content
 * @property-read User $author
 * @property-read Model|\Eloquent $hasComment
 * @method static \Illuminate\Database\Eloquent\Builder|Comment whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Comment whereHasCommentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Comment whereHasCommentType($value)
 */
class Comment extends Model
{
    protected $fillable = [
        'user_id',
        'content',
    ];

    public function author(): BelongsTo {
        return $this->belongsTo(User::class,
                                'user_id');
    }

    public function hasComment(): MorphTo {
        return $this->morphTo();
    }
}
