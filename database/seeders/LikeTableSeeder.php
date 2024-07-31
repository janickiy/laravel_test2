<?php

namespace Database\Seeders;

use App\Models\Comments;
use App\Models\Likes;
use App\Models\Posts;
use Illuminate\Database\Seeder;

class LikeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Likes::truncate();
        Likes::unguard();
        $faker = \Faker\Factory::create();
        Comments::all()->each(function ($comment) use ($faker) {
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
