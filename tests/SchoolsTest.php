<?php

use App\School;
use App\User;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class SchoolsTest extends ApiTester {

    /** @test * */
    public function it_fetches_schools()
    {
        // arrange
        $this->makeSchool();

        // act
        $this->getJson('api/v1/schools');

        // assert
        $this->assertResponseOk();
    }

    private function makeSchool($schoolFields = [])
    {
        $user = $this->makeUser(['vendor' => true]);
        $school = array_merge([
            'name'        => $this->fake->company . " School",
            'description' => $this->fake->paragraph(8),
            'address'     => $this->fake->address,
        ], $schoolFields);

        print_r(School::create($school));
        $user->school()->save(School::create($school));
    }

    public function makeUser($userFields = [])
    {
        $user = array_merge([
            'name'           => 'Rick Astley',
            'email'          => 'testvendor@example.com',
            'password'       => bcrypt('password'),
            'remember_token' => str_random(10),
            'vendor'         => true,
        ], $userFields);

        return App\User::create($user);
    }

}
