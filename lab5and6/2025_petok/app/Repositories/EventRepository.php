<?php

namespace App\Repositories;

use App\Models\Event;
use Illuminate\Database\Eloquent\Collection;

class EventRepository implements EventRepositoryInterface{

    public function all(): Collection
    {
        return Event::all();
    }

    public function find(int $id): Event
    {
        return Event::query()->findOrFail($id);
    }

    public function create(array $data): Event
    {
        return Event::query()->create($data);
    }

    public function update(Event $order, array $data): Event
    {
        $order->update($data);
        return $order;
    }

    public function delete(Event $order): bool
    {
        return $order->delete();
    }
}
