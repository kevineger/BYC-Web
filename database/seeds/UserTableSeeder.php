<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // A known consumer user
        App\User::create([
            'name'           => 'Joe Doe',
            'email'          => 'consumer@example.com',
            'password'       => bcrypt('password'),
            'remember_token' => str_random(10),
            'vendor'         => false,
        ]);
        // A known vendor user
        App\User::create([
            'name'           => 'Rick Astley',
            'email'          => 'vendor@example.com',
            'password'       => bcrypt('password'),
            'remember_token' => str_random(10),
            'vendor'         => true,
        ]);

        factory(App\User::class, 'consumer', 20)->create();
        factory(App\User::class, 'vendor', 5)->create();
    }
}
