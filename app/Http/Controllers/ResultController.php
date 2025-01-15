<?php

namespace App\Http\Controllers;
use App\Models\Insurance;
use App\Models\Tools;
use Illuminate\Http\Request;


class ResultController extends Controller
{
    public function index(Request $request)
    {
        $request->validate([
            'equipment-cost' => 'required|numeric',
            'age' => 'required|numeric',
        ]);
        return view('result.index'); // resources/views/result/index.blade.php を表示
    }

    public function index2(Request $request)
    {
        $request->validate([
            'equipment-cost' => 'required|numeric',
            'age' => 'required|numeric',
        ]);
        return view('result.index2'); // resources/views/result/index.blade.php を表示
    }
    public function index3(Request $request)
    {
        $employmentType = $request->input('employment-type');
        $age = $request->input('age');

        if ($employmentType === 'fulltime') {
            $monthly = $request->input('monthly-salary');
            $traffic = $request->input('commute-cost');
        } else {
            $monthly = $request->input('hourly-wage') * $request->input('hours-per-day') * $request->input('days-per-week') * 4.33;
            $traffic = $request->input('transport-cost') * $request->input('days-per-week') * 4.33;
        }

        $toolcost = 0;
        $toolCostInput = $request->input('tool_cost');

        // カンマ区切りの文字列を配列に変換
        if (!is_array($toolCostInput)) {
            $toolCostInput = explode(',', $toolCostInput);
        }

        foreach ($toolCostInput as $toolName) {
            $toolName = trim($toolName); // 空白を削除
            $tool = Tools::where('name', $toolName)->first();
            if ($tool) {
                $toolcost += $tool->price;
            } else {
                \Log::warning('Tool not found', ['tool_name' => $toolName]);
            }
        }

        // 社会保険料の計算
        $base = $monthly + $traffic;
        $insurances = Insurance::all();
        $id = 0;
        foreach ($insurances as $insurance) {
            if ($base < $insurance->salary) {
                break;
            }
            $id++;
        }

        $insurance = Insurance::find($id);
        $health = ($age >= 40) ? $insurance->health_care : $insurance->health;
        $welfare = $insurance->welfare;
        $employment = $monthly * 0.0095;

        $result = $base + $health + $welfare + $employment + $toolcost;
        $first = $result + $request->input('equipment-cost');

        return view('result.index3', [
            'base' => $base,
            'monthly' => $monthly,
            'traffic' => $traffic,
            'toolcost' => $toolcost,
            'employmentType' => $employmentType,
            'first' => $first,
            'result' => $result,
            'health' => $health,
            'welfare' => $welfare,
            'employment' => $employment,
            'age' => $age,
            'toolCostInput' => $toolCostInput
        ]);
    }

}
