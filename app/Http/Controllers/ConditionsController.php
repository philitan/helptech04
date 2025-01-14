<?php

namespace App\Http\Controllers;

use App\Models\Simulation;
use App\Models\Tools;
use App\Models\Condition;
use Illuminate\Http\Request;

class ConditionsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $conditions = Condition::all(); // ここで条件のリストを取得
        return view('conditions.index', compact('conditions'));
    }

    public function create()
    {
        return view('conditions.create'); //
    }

    public function store(Request $request)
    {
        // バリデーション
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'equipment-cost' => 'required|integer|min:0',
            'age' => 'required|integer|min:0',
            'tool-cost' => 'nullable|array',
            'employment-type' => 'required|string|in:fulltime,parttime',
            'monthly-salary' => 'nullable|numeric|min:0',
            'commute-cost' => 'nullable|numeric|min:0',
            'hourly-wage' => 'nullable|numeric|min:0',
            'hours-per-day' => 'nullable|numeric|min:0|max:24',
            'days-per-week' => 'nullable|integer|min:1|max:7',
            'transport-cost' => 'nullable|numeric|min:0',
        ]);

        // 保存処理
        $condition = new Condition();   
        $condition->name = $validated['name'];     
        $condition->equipment_cost = $validated['equipment-cost'];
        $condition->age = $validated['age'];
        $condition->tool_cost = isset($validated['tool-cost']) ? implode(',', $validated['tool-cost']) : 0;
        $condition->employment_type = $validated['employment-type'];

        if ($validated['employment-type'] === 'fulltime') {
            $condition->monthly_salary = $validated['monthly-salary'];
            $condition->commute_cost = $validated['commute-cost'];
        } else {
            $condition->hourly_wage = $validated['hourly-wage'];
            $condition->hours_per_day = $validated['hours-per-day'];
            $condition->days_per_week = $validated['days-per-week'];
            $condition->transport_cost = $validated['transport-cost'];
        }

        $condition->save();

        return redirect()->back()->with('success', 'データを保存しました');
    }

    public function search(Request $request)
    {
        $keyword = $request->input('keyword');

        if (!empty($keyword)) {
            $conditions = Condition::where('name', 'LIKE', "%{$keyword}%")
                ->orderBy('created_at', 'desc')
                ->paginate(10);
        } else {
            $conditions = Condition::orderBy('created_at', 'desc')->paginate(10);
        }

        return view('conditions.index', compact('conditions'));
    }


    public function edit(Condition $condition)
    {
        return view('conditions.edit', compact('condition'));
    }

    public function update(Request $request, Condition $condition)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'age' => 'required|integer|min:0',
            'equipment_cost' => 'nullable|integer|min:0',
            'employment_type' => 'required|string|in:fulltime,parttime',
        ]);

        $condition->update($validated);

        return redirect()->route('conditions.index')->with('success', '条件を更新しました');
    }

    public function destroy(Condition $condition)
    {
        $condition->delete();

        return redirect()->route('conditions.index')->with('success', '条件を消去しました');
    }

    public function show(Condition $condition)
    {
        return view('conditions.index', compact('condition'));
    }
}