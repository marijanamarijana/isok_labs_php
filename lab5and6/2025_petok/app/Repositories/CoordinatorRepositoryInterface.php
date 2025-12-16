<?php

namespace App\Repositories;

use App\Models\Coordinator;
use Illuminate\Database\Eloquent\Collection;

interface CoordinatorRepositoryInterface{
    public function all(): Collection;

    public function find(int $id): Coordinator;

    public function create(array $data): Coordinator;

    public function update(Coordinator $order, array $data): Coordinator;

    public function delete(Coordinator $order): bool;
}
