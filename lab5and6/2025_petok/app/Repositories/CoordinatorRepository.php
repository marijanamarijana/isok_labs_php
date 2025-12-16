<?php

namespace App\Repositories;

use App\Models\Coordinator;
use Illuminate\Database\Eloquent\Collection;

class CoordinatorRepository implements CoordinatorRepositoryInterface{

    public function all(): Collection
    {
       return Coordinator::all();
    }

    public function find(int $id): Coordinator
    {
        return Coordinator::query()->findOrFail($id);
    }

    public function create(array $data): Coordinator
    {
        return Coordinator::query()->create($data);
    }

    public function update(Coordinator $order, array $data): Coordinator
    {
        $order->update($data);
        return $order;
    }

    public function delete(Coordinator $order): bool
    {
        return $order->delete();
    }
}
