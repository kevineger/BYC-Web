<?php

use Faker\Factory as Faker;

class ApiTester extends TestCase {

    protected $fake;

    function __construct()
    {
        $this->fake = Faker::create();
    }

}