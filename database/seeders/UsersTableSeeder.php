<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
       // User::truncate();

        User::create([
            'name' => 'admin',
            'login' => 'admin',
            'password' => '1234567',
            'role' => 'admin',
        ]);

        for ($i = 0; $i < 5000; ++$i) {
            $faker = \Faker\Factory::create();
            $password = bcrypt('secret');
            User::create([
                'name'     => $faker->name,
                'login'    => str()->random(),
                'password' => $password,
            ]);
        }
    }
}
