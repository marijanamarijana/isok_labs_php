<?php

namespace App\Http\Controllers;

use App\Http\Requests\Coordinator\CoordinatorStoreRequest;
use App\Http\Resources\CoordinatorResource;
use App\Repositories\CoordinatorRepositoryInterface;
use GuzzleHttp\Psr7\Request;

class CoordinatorApiController extends Controller
{
    protected CoordinatorRepositoryInterface $coordinatorRepository;

    public function __construct(CoordinatorRepositoryInterface $coordinatorRepository)
    {
        $this->coordinatorRepository = $coordinatorRepository;
    }
    public function index()
    {
        $coordinators = $this->coordinatorRepository->all();
        return CoordinatorResource::collection($coordinators);
    }
    public function store(CoordinatorStoreRequest $request)
    {
        $data = $request->all();
        $coordinator = $this->coordinatorRepository->create($data);

        return CoordinatorResource::make($coordinator);
    }
    public function show(string $id)
    {
        $coordinator = $this->coordinatorRepository->find($id);
        return CoordinatorResource::make($coordinator);
    }
    public function update(Request $request, string $id)
    {
        $data = $request->all();
        $coordinator = $this->coordinatorRepository->find($id);
        $coordinator = $this->coordinatorRepository->update($coordinator, $data);

        CoordinatorResource::make($coordinator);

}
    public function destroy($id)
    {
        $coordinator = $this->coordinatorRepository->find($id);
        $this->coordinatorRepository->delete($id);

        return response()->json(null, 204);
    }
}
