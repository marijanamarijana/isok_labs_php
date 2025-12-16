<?php
namespace App\Http\Controllers;

use App\Http\Resources\EventResource;
use App\Repositories\EventRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class EventApiController extends Controller
{
    protected EventRepositoryInterface $repository;

    public function __construct(EventRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function index(): AnonymousResourceCollection
    {
        $orders = $this->repository->all();

        return EventResource::collection($orders);
    }

    public function store(Request $request): EventResource
    {
        $data = $request->all();
        $order = $this->repository->create($data);

        return EventResource::make($order);
    }

    public function show(string $id): EventResource
    {
        $order = $this->repository->find($id);

        return EventResource::make($order);
    }

    public function update(Request $request, string $id): EventResource
    {
        $data = $request->all();
        $order = $this->repository->find($id);
        $order = $this->repository->update($order, $data);

        return EventResource::make($order);
    }

    public function destroy($id): JsonResponse
    {
        $order = $this->repository->find($id);
        $this->repository->delete($id);

        return response()->json(null, 204);
    }
}
