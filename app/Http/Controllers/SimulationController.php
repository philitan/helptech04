<?php

namespace App\Http\Controllers;

use App\Models\Simulation;
use Illuminate\Http\Request;

class SimulationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('simulation.index'); //
    }
    public function index2()
    {
        return view('simulation.add'); //
    }
    /**
     * Show the form for creating a new resource.
     */
    public function tools()
    {
        return view('simulation.tools'); //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Simulation $simulation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Simulation $simulation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Simulation $simulation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Simulation $simulation)
    {
        //
    }
}
