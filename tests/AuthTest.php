<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class AuthTest extends TestCase {

    use DatabaseTransactions;

    /** @test */
    function a_user_may_register_for_an_account_but_must_confirm_their_email_address()
    {
        $this->visit('auth/register')
            ->type('John Doe', 'name')
            ->type('john@example.com', 'email')
            ->type('password', 'password')
            ->type('password', 'password_confirmation')
            ->select(1, 'type')
            ->press('Register');

        $this->seeInDatabase('users', ['name' => 'John Doe', 'verified' => 0]);
    }
}
