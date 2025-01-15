<?php

namespace App\Http\Controllers;

use App\Models\Simulation;
use App\Models\Tools;
use App\Models\Insurance;
use Illuminate\Http\Request;

class ToolsController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index(Tools $tools)
    {
        $tools = Tools::paginate(5);
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

    public function search(Request $request)
    {
        $keyword = $request->input('keyword');

        if (!empty($keyword)) {
            $tools = Tools::where('name', 'LIKE', "%{$keyword}%")->paginate(10);
        } else {
            $tools = Tools::paginate(10);
        }

        return view('tools.index', compact('tools'));
    }




    public function show(Simulation $simulation) {}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tools $tool)
    {
        return view('tools.edit', compact('tool')); //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tools $tool)
    {
        $request->validate([

            'price' => 'required|numeric|min:0',
        ]);

        $tool->update($request->only('price'));

        return redirect()->route('tools.index', $tool);
    }

    /**
     * Remove the specified resource from storage.
     */

    public function destroy(Tools $tool)
    {
        $tool->delete();

        return redirect()->route('tools.index');
    }
}
