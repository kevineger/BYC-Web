<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        // Create Users
        $this->call(UserTableSeeder::class);
        // Create Schools with Courses for Users who are of type 'school'
        $this->call(SchoolTableSeeder::class);
        // Create times for the courses
        $this->call(TimeTableSeeder::class);
        // Create categories for courses
        $this->call(CategoryTableSeeder::class);
        // Create comments for courses
        $this->call(CommentTableSeeder::class);
        // Create banner fields
        $this->call(BannerTableSeeder::class);

        Model::reguard();
    }
}
