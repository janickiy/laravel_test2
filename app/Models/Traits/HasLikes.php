<?php

namespace App\Models\Traits;

use App\Models\Likes;

trait HasLikes
{
    public function likes()
    {
        return $this->morphMany(Likes::class, 'likeable');
    }
}
