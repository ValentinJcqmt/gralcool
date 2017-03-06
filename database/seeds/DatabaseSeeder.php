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
        $michel = factory(App\User::class)->create(['name' => 'Michel']);
        $edouard = factory(App\User::class)->create(['name' => 'Edouard']);

        $virtue1 = factory(App\Virtue::class)->create(['name' => 'Confortable']);
        $virtue2 = factory(App\Virtue::class)->create(['name' => 'Spacieux']);

        $placeType1 = factory(App\PlaceType::class)->create(['name' => 'FastFood']);
        $placeType2 = factory(App\PlaceType::class)->create(['name' => 'Bar']);

        $place1 = factory(App\Place::class)->create(['id_type' => $placeType1->id]);
        $place2 = factory(App\Place::class)->create(['id_type' => $placeType2->id]);

        $visit1 = factory(App\Visit::class)->create(['id_user' => $michel->id, 'id_place' => $place1->id]);
        $visit2 = factory(App\Visit::class)->create(['id_user' => $michel->id, 'id_place' => $place2->id]);
        $visit3 = factory(App\Visit::class)->create(['id_user' => $edouard->id, 'id_place' => $place1->id]);
        $visit4 = factory(App\Visit::class)->create(['id_user' => $edouard->id, 'id_place' => $place2->id]);

        $note1 = factory(App\Note::class)->create(['id_visit' => $visit1->id]);
        $note2 = factory(App\Note::class)->create(['id_visit' => $visit2->id]);
        $note3 = factory(App\Note::class)->create(['id_visit' => $visit3->id]);
        $note4 = factory(App\Note::class)->create(['id_visit' => $visit4->id]);

        $puv1 = factory(App\PlaceUserVirtue::class)->create(['id_user' => $michel->id, 'id_place' => $place1->id, 'id_virtue' => $virtue1->id]);
        $puv2 = factory(App\PlaceUserVirtue::class)->create(['id_user' => $michel->id, 'id_place' => $place2->id, 'id_virtue' => $virtue1->id]);
        $puv3 = factory(App\PlaceUserVirtue::class)->create(['id_user' => $edouard->id, 'id_place' => $place1->id, 'id_virtue' => $virtue2->id]);
        $puv4 = factory(App\PlaceUserVirtue::class)->create(['id_user' => $edouard->id, 'id_place' => $place2->id, 'id_virtue' => $virtue2->id]);

    }
}
