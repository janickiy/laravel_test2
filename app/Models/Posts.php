<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\HasComments;
use App\Models\Traits\HasLikes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Posts extends Model
{
    use HasComments;
    use HasLikes;

    protected $table = 'posts';

    protected $fillable = [
        'title',
        'content',
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
     * @param $rows
     * @return array
     */
    public static function map($rows): array
    {
        $items = [];

        foreach ($rows as $row) {
            $items[] = [
                'title' => $row->title,
                'content' => $row->content,
                'total_comments' => $row->comments()->count() ?? 0,
                'total_likes' => $row->likes()->count() ?? 0,
                'user' => $row->user->name,
            ];
        }

        return $items;
    }

    public function scopeRemove(): void
    {
        $this->likes()->delete();
        $this->comments()->delete();
        $this->delete();
    }
}
