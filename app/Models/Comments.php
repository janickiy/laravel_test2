<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\HasComments;
use App\Models\Traits\HasLikes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Comments extends Model
{
    use HasComments;
    use HasLikes;

    protected $table = 'comments';

    protected $fillable = [
        'commentable_id',
        'commentable_type',
        'comment',
        'user_id'
    ];

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return MorphTo
     */
    public function commentable(): MorphTo
    {
        return $this->morphTo();
    }

    public function scopeRemove(): void
    {
        $this->likes()->delete();
        $this->comments()->delete();
        $this->delete();
    }
}
