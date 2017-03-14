<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\App;
use App\Note;
use App\Place;
use App\PlaceType;
use App\PlaceUserVirtue;
use App\User;
use App\Virtue;
use App\Visit;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        //Base data for application
        $restaurantType = factory(PlaceType::class)->create(['name' => 'Restaurant', 'id' => 1]);
        $fastfoodType = factory(PlaceType::class)->create(['name' => 'Fast Food', 'id' => 2]);
        $kebabType = factory(PlaceType::class)->create(['name' => 'Kebab', 'id' => 3]);
        $buffetType = factory(PlaceType::class)->create(['name' => 'Buffet à volonté', 'id' => 4]);
        $barType = factory(PlaceType::class)->create(['name' => 'Bar', 'id' => 5]);

        $admin = factory(User::class)->create(['name' => 'admin', 'password' => bcrypt('admin'), 'email' => 'admin@mail.fr']);


        //Dummy data for testing
        if( App::environment() === 'development' ){
            $michel = factory(User::class)->create(['name' => 'Michel', 'password' => bcrypt('azerty'), 'email' => 'michel@mail.fr']);
            $edouard = factory(User::class)->create(['name' => 'Edouard', 'password' => bcrypt('azerty'), 'email' => 'edouard@mail.fr']);

            $virtue1 = factory(Virtue::class)->create(['name' => 'Confortable', 'positive' => true]);
            $virtue2 = factory(Virtue::class)->create(['name' => 'Mal-odorant', 'positive' => false]);

            $place1 = factory(Place::class)->create(['name' => 'Lieu Intriguant', 'type_id' => $restaurantType->id]);
            $place2 = factory(Place::class)->create(['type_id' => $kebabType->id]);

            $visit1 = factory(Visit::class)->create(['user_id' => $michel->id, 'place_id' => $place1->id]);
            $visit2 = factory(Visit::class)->create(['user_id' => $michel->id, 'place_id' => $place2->id]);
            $visit3 = factory(Visit::class)->create(['user_id' => $edouard->id, 'place_id' => $place1->id]);
            $visit4 = factory(Visit::class)->create(['user_id' => $edouard->id, 'place_id' => $place2->id]);

            $this->n1 = factory(Note::class)->create([
                'visit_id' => $visit1->id,
                'n_price' => 5.8,
                'n_quality' => 13.6,
                'n_quantity' => 18.4,
                'n_ambiance' => 13.5,
                'average' => 9.7
            ]);
            $this->n2 = factory(Note::class)->create([
                'visit_id' => $visit3->id,
                'n_price' => 6.2,
                'n_quality' => 13.8,
                'n_quantity' => 16.4,
                'n_ambiance' => 13.7,
                'average' => 10.3
            ]);
            $note3 = factory(Note::class)->create([
                'visit_id' => $visit3->id,
            ]);
            $note4 = factory(Note::class)->create([
                'visit_id' => $visit4->id,
            ]);

            $puv1 = factory(PlaceUserVirtue::class)->create(['user_id' => $michel->id, 'place_id' => $place1->id, 'virtue_id' => $virtue1->id]);
            $puv2 = factory(PlaceUserVirtue::class)->create(['user_id' => $michel->id, 'place_id' => $place2->id, 'virtue_id' => $virtue1->id]);
            $puv3 = factory(PlaceUserVirtue::class)->create(['user_id' => $edouard->id, 'place_id' => $place1->id, 'virtue_id' => $virtue2->id]);
            $puv4 = factory(PlaceUserVirtue::class)->create(['user_id' => $edouard->id, 'place_id' => $place2->id, 'virtue_id' => $virtue2->id]);

        }


    }
}
