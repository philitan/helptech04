<?php

namespace App\Http\Controllers;

use App\Models\Simulation;
use App\Models\Tools;
use Illuminate\Http\Request;

class ToolsController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index(Tools $tools)
    {
        $tools = Tools::all();
        return view('tools.index', compact('tools'));
    }



    public function store(Request $request)
    {
        $request->validate([
            'tool_name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
        ]);

        Tools::create([
            'name' => $request->input('tool_name'),
            'price' => $request->input('price'),
        ]);

        return redirect()->back()->with('success', 'ツールが保存されました！');
    }
    public function create()
    {
        return view('tools.create');
    }



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
