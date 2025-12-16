<?php

namespace App\Observers;

use App\Models\Event;
use Illuminate\Support\Facades\Log;

class EventObserver
{
    /**
     * Handle the Event "created" event.
     */
    public function created(Event $event): void
    {
        session()->flash('message', 'New event ' . $event->name);
    }

    /**
     * Handle the Event "updated" event.
     */
    public function updated(Event $event): void
    {
        Log::info("Event is updated {$event->name}");
    }

    /**
     * Handle the Event "deleted" event.
     */
    public function deleted(Event $event): void
    {
        Log::info("Event is cancelled {$event->name}");
    }

    /**
     * Handle the Event "restored" event.
     */
    public function restored(Event $event): void
    {
        //
    }

    /**
     * Handle the Event "force deleted" event.
     */
    public function forceDeleted(Event $event): void
    {
        //
    }
}
