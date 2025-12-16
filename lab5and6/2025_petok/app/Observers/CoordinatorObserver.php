<?php

namespace App\Observers;

use App\Models\Coordinator;
use Illuminate\Support\Facades\Log;

class CoordinatorObserver
{
    /**
     * Handle the Coordinator "created" event.
     */
    public function created(Coordinator $coordinator): void
    {
        session()->flash('message', 'New coordinator is created: ' . $coordinator->name . " " . $coordinator->surame );
    }

    /**
     * Handle the Coordinator "updated" event.
     */
    public function updated(Coordinator $coordinator): void
    {
        Log::info("Coordinator {$coordinator->name} {$coordinator->surname} is updated!");
    }

    /**
     * Handle the Coordinator "deleted" event.
     */
    public function deleted(Coordinator $coordinator): void
    {
        Log::info("Coordinator {$coordinator->name} {$coordinator->surname} is deleted!");
    }

    /**
     * Handle the Coordinator "restored" event.
     */
    public function restored(Coordinator $coordinator): void
    {
        //
    }

    /**
     * Handle the Coordinator "force deleted" event.
     */
    public function forceDeleted(Coordinator $coordinator): void
    {
        //
    }
}
