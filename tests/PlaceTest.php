<?php

use App\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class PlaceTest extends TestCase
{
    use DatabaseTransactions;
    use WithoutMiddleware;

    /**
     *
     */
    public function setUp(){
        parent::setUp();

        $this->place = factory(App\Place::class)->create();

        $this->v1 = factory(App\Visit::class)->create([
            'place_id' => $this->place->id
        ]);

        $this->n1 = factory(App\Note::class)->create([
            'visit_id' => $this->v1->id,
            'n_price' => 5.8,
            'n_quality' => 13.6,
            'n_quantity' => 18.4,
            'n_ambiance' => 13.5,
            'average' => 9.7
        ]);


        $this->v2 = factory(App\Visit::class)->create([
            'place_id' => $this->place->id
        ]);


        $this->n2 = factory(App\Note::class)->create([
            'visit_id' => $this->v2->id,
            'n_price' => 6.2,
            'n_quality' => 13.8,
            'n_quantity' => 16.4,
            'n_ambiance' => 13.7,
            'average' => 10.3
        ]);
    }

    /**
     * Test the average notes of a place from all his visits.
     */
    public function testAverageNotes()
    {

        $this->assertEquals(6.0, $this->place->getAverageNotes()['n_price']);
        $this->assertEquals(13.7, $this->place->getAverageNotes()['n_quality']);
        $this->assertEquals(17.4, $this->place->getAverageNotes()['n_quantity']);
        $this->assertEquals(13.6, $this->place->getAverageNotes()['n_ambiance']);
        $this->assertEquals(10.0, $this->place->getAverageNotes()['average']);

    }

    /**
     * Test adding a new place and the redirection that follows
     *
     * @return Int
     */
    public function testAddNewPlace(){

        $this->visit('/places/add')
             ->assertResponseOk()
             ->type('Machin', 'name')
             ->press('Enregistrer');

        $this->seeInDatabase('places', ['name' => 'Machin']);

        $newPlaceId = \App\Place::where('name', '=', 'Machin')->get()->first()->attributesToArray()['id'];

        $this->seePageIs('/places/'.$newPlaceId);

        return $newPlaceId;
    }

    /**
     * Test edition of a place previously added
     *
     * @depends testAddNewPlace
     */
    public function testEditPlace($id){
        $this->visit('/places/'.$id)
             ->see('Machin')
             ->press('Modifier')
             ->seePageIs('/places/'.$id.'/edit')
             ->type('Machin2', 'name')
             ->type(6.333, 'lng')
             ->type(3.333, 'lat')
             ->press('Enregistrer')
             ->assertResponseOk()
             ->seePageIs('/places/'.$id)
             ->see('Machin2')
             ->see(6.333)
             ->see(3.333);
    }

}
