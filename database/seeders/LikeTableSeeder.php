<?php

namespace Database\Seeders;

use App\Models\Comments;
use App\Models\Likes;
use Illuminate\Database\Seeder;

class LikeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       // Likes::truncate();
      //  Likes::unguard();
        Comments::all()->each(function ($comment) {
            for ($i = 0; $i < 200; $i++)  {
                Likes::create([
                    'user_id' => $comment->user_id,
                    'likeable_id' => $comment->id,
                    'likeable_type' => 'comments',
                ]);
            }
        });
    }
}
