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
            'verified'       => true,
        ]);
        // A known vendor user
        App\User::create([
            'name'           => 'Rick Astley',
            'email'          => 'vendor@example.com',
            'password'       => bcrypt('password'),
            'remember_token' => str_random(10),
            'vendor'         => true,
            'verified'       => true,
        ]);
        // A known admin user
        $admin = App\User::create([
            'name'           => 'Leslie Knope',
            'email'          => 'admin@example.com',
            'password'       => bcrypt('password'),
            'remember_token' => str_random(10),
            'vendor'         => false,
            'verified'       => true,
        ]);
        //set admin attribute, not mass assignable for security
        $admin->admin = true;
        $admin->save();

        factory(App\User::class, 'consumer', 20)->create();
        factory(App\User::class, 'vendor', 5)->create();
    }
}
