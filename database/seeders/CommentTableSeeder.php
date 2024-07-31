<?php

namespace Database\Seeders;

use App\Models\Comments;
use App\Models\Posts;
use Illuminate\Database\Seeder;

class CommentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       // Posts::truncate();
       // Posts::unguard();
        $faker = \Faker\Factory::create();
        Posts::all()->each(function ($post) use ($faker) {
            for ($i = 0; $i < 500; $i++)  {
                Comments::create([
                    'user_id' => $post->user_id,
                    'comment'   => $faker->paragraphs(3, true),
                    'commentable_id' => $post->id,
                    'commentable_type' => 'posts',
                ]);
            }
        });
    }
}
