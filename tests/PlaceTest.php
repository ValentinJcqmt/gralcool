<?php

use App\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PlaceTest extends TestCase
{
    use DatabaseTransactions;

    private $user;
    private $place;
    private $v1;
    private $v2;
    private $n1;
    private $n2;

    public function setUp(){
        parent::setUp();

        //User for passing middlewares
        $this->user = User::where('name', '=', 'admin')->get()->first();

        if($this->user === null){
            $this->artisan("migrate:refresh");
            $this->artisan("db:seed");
        }

        //Place that will be tested
        $this->place = factory(App\Place::class)->create();

        //Multiple visits on the place, and notes from this visits to check average notes
        $this->v1 = factory(App\Visit::class)->create([
            'place_id' => $this->place->id,
            'noted' => true
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
            'place_id' => $this->place->id,
            'noted' => false
        ]);

        $this->place->updateAverageNotes();
    }

    /**
     * Test the average notes of a place from all his visits.
     */
    public function testAverageNotesAndAutomaticCalcul()
    {
        $this->assertEquals(5.8, $this->place->n_price);
        $this->assertEquals(13.6, $this->place->n_quality);
        $this->assertEquals(18.4, $this->place->n_quantity);
        $this->assertEquals(13.5, $this->place->n_ambiance);
        $this->assertEquals(9.7, $this->place->average);

        //Noting the visit "visit2" and re-calculate averages notes
        $this->n2 = factory(App\Note::class)->create([
            'visit_id' => $this->v2->id,
            'n_price' => 6.2,
            'n_quality' => 13.8,
            'n_quantity' => 16.4,
            'n_ambiance' => 13.7,
            'average' => 10.3
        ]);
        $this->v2->noted = true;
        $this->v2->save();

        $this->place->updateAverageNotes();

        $this->assertEquals(6.0, $this->place->n_price);
        $this->assertEquals(13.7, $this->place->n_quality);
        $this->assertEquals(17.4, $this->place->n_quantity);
        $this->assertEquals(13.6, $this->place->n_ambiance);
        $this->assertEquals(10.0, $this->place->average);

    }

    /**
     * Test adding and editing a new place and the redirection that follows
     */
    public function testAddAndEditNewPlace(){

        $this->actingAs($this->user)
             ->visit('/places/add')
             ->assertResponseOk()
             ->type('Machin', 'name')
             ->type(9.6, 'lat')
             ->type(8.3, 'lng')
             ->select(1, 'type')
             ->press('Enregistrer');

        $this->seeInDatabase('places', ['name' => 'Machin']);

        $newPlaceId = \App\Place::where('name', '=', 'Machin')->get()->first()->attributesToArray()['id'];

        $this->seePageIs('/places/'.$newPlaceId);

        $this->see('Machin')
             ->see(9.6)
             ->see(8.3)
             ->see('Restaurant')
             ->click('Modifier')
             ->seePageIs('/places/'.$newPlaceId.'/edit')
             ->type('Machin2', 'name')
             ->type(6.333, 'lng')
             ->type(3.333, 'lat')
             ->select(3, 'type')
             ->press('Enregistrer')
             ->assertResponseOk()
             ->seePageIs('/places/'.$newPlaceId)
             ->see('Machin2')
             ->see(6.333)
             ->see(3.333)
             ->see('Kebab');
    }

}
