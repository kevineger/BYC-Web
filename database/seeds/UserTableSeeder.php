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
        factory(App\User::class, 'consumer', 20)->create();
        factory(App\User::class, 'school', 5)->create();
    }
}
