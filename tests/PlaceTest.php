<?php

use App\User;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\DB;

class PlaceTest extends TestCase
{
    use DatabaseMigrations;

//$place = \App\Place::first();
//
//$this->assertEquals(8.3, $place->getAverageNote());
    /**
     * Fake data and test the average note of a place.
     *
     * @return void
     */
    public function testAverageNote()
    {
        $place = factory(App\Place::class)->create();

        $v1 = factory(App\Visit::class)->create([
            'place_id' => $place->id
        ]);

        $n1 = factory(App\Note::class)->create([
            'visit_id' => $v1->id,
            'n_price' => 5.8,
            'n_quality' => 13.6,
            'n_quantity' => 18.4,
            'n_ambiance' => 13.5,
            'average' => 9.7
        ]);


        $v2 = factory(App\Visit::class)->create([
            'place_id' => $place->id
        ]);


        $n2 = factory(App\Note::class)->create([
            'visit_id' => $v2->id,
            'n_price' => 6.2,
            'n_quality' => 13.8,
            'n_quantity' => 16.4,
            'n_ambiance' => 13.7,
            'average' => 10.3
        ]);

        $this->assertEquals(6.0, $place->getAverageNotes()['n_price']);
        $this->assertEquals(13.7, $place->getAverageNotes()['n_quality']);
        $this->assertEquals(17.4, $place->getAverageNotes()['n_quantity']);
        $this->assertEquals(13.6, $place->getAverageNotes()['n_ambiance']);
        $this->assertEquals(10.0, $place->getAverageNotes()['average']);

    }

}
