<?php

use App\User;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class DataBaseTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * Fake data and test relationship.
     *
     * @return void
     */
    public function testExample()
    {
        $this->artisan("db:seed");

        $michel = \App\User::first();
        $this->assertEquals('Michel', $michel->name);
    }

}
