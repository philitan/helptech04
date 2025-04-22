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
        // 入力データ全体を確認
        //dd($request->all()); // リクエストデータ全体を確認して、必要なデータが正しく送信されているかチェック


        $employmentType = $request->input('employment-type');
        $age = $request->input('age');

        if ($employmentType === 'fulltime') {
            $monthly = $request->input('monthly-salary');
            $traffic = $request->input('commute-cost');
            //dd(compact('monthly', 'traffic')); // 月給と交通費が正しいか確認
        } else {
            $monthly = $request->input('hourly-wage') * $request->input('hours-per-day') * $request->input('days-per-week') * 4.33;
            $traffic = $request->input('transport-cost') * $request->input('days-per-week') * 4.33;
            //dd(compact('monthly', 'traffic')); // 時給ベースでの計算結果を確認
        }

        $toolcost = 0;
        $toolCostInput = $request->input('tool_cost');

        // カンマ区切りの文字列を配列に変換
        if (!is_array($toolCostInput)) {
            $toolCostInput = explode(',', $toolCostInput);
        }
        //dd($toolCostInput); // ツールコストの入力データが配列に変換されているか確認

        // ツール費用の計算
        $toolcost = 0;
        if (isset($request->tool_cost)) {
            // カンマ区切りの文字列を配列に変換
            $tool_names = explode(',', $request->tool_cost);

            foreach ($tool_names as $value) {
                // ツール名をトリムしてから検索
                $value = trim($value);
                $tools = Tools::where('name', '=', $value)->get();

                foreach ($tools as $tool) {
                    $price = $tool->price;
                    $toolcost += $price;
                }
            }
        }

        //dd($toolcost); // 積算結果を確認

        // 社会保険料の計算
        $base = $monthly + $traffic;
        $insurances = Insurance::all();
        //dd($insurances); // 保険データが取得できているか確認

        $id = 0;
        foreach ($insurances as $insurance) {
            if ($base < $insurance->salary) {
                break;
            }
            $id++;
        }
        //dd($id); // 適用される保険IDが正しいか確認

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
