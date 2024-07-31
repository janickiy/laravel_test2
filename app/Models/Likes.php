<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Likes extends Model
{
    protected $table = 'likes';

    protected $fillable = [
        'likeable_id',
        'likeable_type',
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
    public function likeable(): MorphTo
    {
        return $this->morphTo();
    }

}
