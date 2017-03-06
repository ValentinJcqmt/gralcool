<?php

use App\User;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PlaceTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * Fake data and test the average note of a place.
     *
     * @return void
     */
    public function testAverageNote()
    {
        $place = new \App\Place();

        $v1 = new \App\Visit();
        $v1->place_id = $place->id;

        $n1 = new \App\Note();
        $n1->visit_id =$v1->id;
        $n1->n_price = 9;
        $n1->n_quality = 9;
        $n1->n_ambiant = 9;
        $n1->n_quantity = 9;


        $v2 = new \App\Visit();
        $v2->place_id = $place->id;

        $n2 = new \App\Note();
        $n2->visit_id =$v2->id;
        $n2->n_price = 10;
        $n2->n_quality = 12;
        $n2->n_ambiant = 10;
        $n2->n_quantity = 12;

        $this->assertEquals(10, $place->getAverageNote());

    }

}
