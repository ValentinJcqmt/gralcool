<?php

namespace App\Jobs;

use App\Place;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class UpdatePlaceNotes implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;

    private $place;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Place $place)
    {
        $this->place = $place;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->place->updateAverageNotes();
    }
}
