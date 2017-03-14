<?php

use App\Note;
use App\Place;
use App\User;
use App\Visit;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class VisitsTest extends TestCase
{
    use DatabaseTransactions;

    private $user;
    private $visit1;
    private $visit2;
    private $note;
    private $place;

    public function setUp(){
        parent::setUp();

        $this->user = factory(User::class)->create();

        $this->place = factory(Place::class)->create();

        $this->visit1 = factory(Visit::class)->create([
            'user_id' => $this->user->id,
            'place_id' => $this->place->id,
            'date' => date('2010-11-12'),
            'noted' => true
        ]);

        $this->visit2 = factory(Visit::class)->create([
            'user_id' => $this->user->id,
            'place_id' => $this->place->id,
            'date' => date('2012-11-10')
        ]);

        $this->note = factory(Note::class)->create([
            'visit_id' => $this->visit1->id
        ]);

    }

    public function testNoteOneVisitFromUser(){
        $this->actingAs($this->user)
             ->visit('/')
             ->see('Vous avez 1 visite pas encore notée')
             ->click('Noter')
             ->seePageIs('/visits')
             ->see('Visite le 12-11-2010')
             ->see('<b>'.$this->place->name.'</b>')
             ->see('Qualité: '.$this->note->n_quality)
             ->see('Quantité: '.$this->note->n_quantity)
             ->see('Prix: '.$this->note->n_price)
             ->see('Ambiance: '.$this->note->n_ambiance)
             ->see('Moyenne totale: '.$this->note->average)
             ->see('Visite le 10-11-2012')
             ->see('<b>'.$this->place->name.'</b>')
             ->type(12, 'n_price-'.$this->visit2->id)
             ->type(12, 'n_quality-'.$this->visit2->id)
             ->type(12, 'n_quantity-'.$this->visit2->id)
             ->type(12, 'n_ambiance-'.$this->visit2->id)
             ->press('submit-'.$this->visit2->id)
             ->seeInDatabase('notes', ['visit_id' => $this->visit2->id])
             ->seePageIs('visits')
             ->see('Qualité: 12')
             ->see('Quantité: 12')
             ->see('Prix: 12')
             ->see('Ambiance: 12')
             ->see('Moyenne totale: 12');
    }
}
