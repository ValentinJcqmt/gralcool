<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $michel = factory(App\User::class)->create(['name' => 'Michel', 'password' => 'azerty']);
        $edouard = factory(App\User::class)->create(['name' => 'Edouard', 'password' => 'azerty']);

        $virtue1 = factory(App\Virtue::class)->create(['name' => 'Confortable']);
        $virtue2 = factory(App\Virtue::class)->create(['name' => 'Spacieux']);

        $placeType1 = factory(App\PlaceType::class)->create(['name' => 'FastFood']);
        $placeType2 = factory(App\PlaceType::class)->create(['name' => 'Bar']);

        $place1 = factory(App\Place::class)->create(['type_id' => $placeType1->id]);
        $place2 = factory(App\Place::class)->create(['type_id' => $placeType2->id]);

        $visit1 = factory(App\Visit::class)->create(['user_id' => $michel->id, 'place_id' => $place1->id]);
        $visit2 = factory(App\Visit::class)->create(['user_id' => $michel->id, 'place_id' => $place2->id]);
        $visit3 = factory(App\Visit::class)->create(['user_id' => $edouard->id, 'place_id' => $place1->id]);
        $visit4 = factory(App\Visit::class)->create(['user_id' => $edouard->id, 'place_id' => $place2->id]);

        $note1 = factory(App\Note::class)->create(['visit_id' => $visit1->id]);
        $note2 = factory(App\Note::class)->create(['visit_id' => $visit2->id]);
        $note3 = factory(App\Note::class)->create(['visit_id' => $visit3->id]);
        $note4 = factory(App\Note::class)->create(['visit_id' => $visit4->id]);

        $puv1 = factory(App\PlaceUserVirtue::class)->create(['user_id' => $michel->id, 'place_id' => $place1->id, 'virtue_id' => $virtue1->id]);
        $puv2 = factory(App\PlaceUserVirtue::class)->create(['user_id' => $michel->id, 'place_id' => $place2->id, 'virtue_id' => $virtue1->id]);
        $puv3 = factory(App\PlaceUserVirtue::class)->create(['user_id' => $edouard->id, 'place_id' => $place1->id, 'virtue_id' => $virtue2->id]);
        $puv4 = factory(App\PlaceUserVirtue::class)->create(['user_id' => $edouard->id, 'place_id' => $place2->id, 'virtue_id' => $virtue2->id]);

    }
}
