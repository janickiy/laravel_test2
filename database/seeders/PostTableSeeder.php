<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Posts;
use App\Models\User;

class PostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        //Posts::truncate();
       // Posts::unguard();
        $faker = \Faker\Factory::create();
        User::all()->each(function ($user) use ($faker) {
            for ($i = 0; $i < 1000; $i++)  {
                Posts::create([
                    'user_id' => $user->id,
                    'title'   => $faker->sentence,
                    'content' => $faker->paragraphs(3, true),
                ]);
            }
        });
    }
}
