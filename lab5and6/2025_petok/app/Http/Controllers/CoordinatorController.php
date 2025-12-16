<?php

namespace App\Http\Controllers;

use App\Http\Requests\Coordinator\CoordinatorStoreRequest;
use App\Http\Requests\Coordinator\CoordinatorUpdateRequest;
use App\Models\Coordinator;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;

class CoordinatorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() : View|Factory|Application
    {
        $coordinators = Coordinator::query()->paginate(10);
        return view('coordinators/index', compact('coordinators'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() :  View|Factory|Application
    {
        return view('coordinators/create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CoordinatorStoreRequest $request) : RedirectResponse
    {
        Coordinator::query()
            ->create($request->validated());

        return redirect()
            ->route('coordinators.index')
            ->with('success', 'Coordinator created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Coordinator $coordinator) : View|Factory|Application
    {
        $coordinator->loadMissing('events');

        return view('coordinators/show', compact('coordinator'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Coordinator $coordinator) : View|Factory|Application
    {
        return view('coordinators/edit', compact('coordinator'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CoordinatorUpdateRequest $request,Coordinator $coordinator) : RedirectResponse
    {
        $coordinator->update($request->validated());

        return redirect()
            ->route('coordinators.index')
            ->with('success', 'Coordinator updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Coordinator $coordinator) : RedirectResponse
    {
        $coordinator->events()->delete();
        $coordinator->delete();

        //return Redirect::route('coordinator.index');
        return redirect()
            ->route('coordinators.index')
            ->with('success', 'Coordinator deleted successfully.');
    }
}
