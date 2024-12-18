<?php
use App\Models\Tools;
use App\Models\Insurance;
?>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('シミュレーション結果') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                <?php
                    // dd($_POST);

                    // 入力されたデータの取得
                    $monthly = $_POST["monthly-salary"] * 10000; // 月給(万円を円に直す)
                    $traffic = $_POST["commute-cost"]; // 交通費
                    $age = $_POST["age"]; // 年齢

                    // ツール費用の計算
                    $toolcost = 0;
                    foreach($_POST["tool-cost"] as $key => $value){
                        $tools = Tools::where('name', '=', $value)->get();
                        foreach($tools as $tool){
                            $price = $tool->price;
                            $toolcost += $price;
                        }
                    }

                    // 社会保険料の計算の準備
                    $base = $monthly+$traffic; // 基準となる金額の算出
                    $insurances = Insurance::select('salary')->get(); // 標準報酬のカラムのみ取得

                    // 月給と標準報酬を比較して最適な等級(=ID)を見つけ出す
                    $id = 0;
                    $next = 0;
                    foreach($insurances as $salary){
                        $next = $salary->salary;
                        if($base < $next){
                            break;
                        }
                        $id++;
                    }

                    // 見つけ出したIDで今度はその行のみ取得
                    $insurances2 = Insurance::find($id);

                    // 社会保険料と雇用保険料の計算
                    if($age >= 40){
                        $health = $insurances2->health_care;
                    } else {
                        $health = $insurances2->health;
                    }
                    $fraction = $health - (int)$health;
                    if($fraction > 0){
                        $health += 1;
                    }
                    $health = (int)$health;

                    $welfare = $insurances2->welfare;
                    $fraction = $welfare - (int)$welfare;
                    if($fraction > 0){
                        $welfare += 1;
                    }
                    $welfare = (int)$welfare;

                    $employment = $monthly*0.0095;
                    $fraction = $employment - (int)$employment;
                    if($fraction >= 0.5){
                        $employment += 1;
                    }
                    $employment = (int)$employment;

                    // 初期費用とランニングコストを計算
                    $result = $base + $health + $welfare + $employment + $toolcost;
                    $first = $result + $_POST["equipment-cost"];
                ?>
                <!-- 出力 -->
                <p>【かかる費用】</p>
                <p>初期費用：<?= $first ?>円</p>
                <p>ランニングコスト：<?= $result ?>円</p>
                <br>

                <p>【詳細】</p>
                <p>月給：<?= ($monthly/10000) ?>万円</p>
                <p>月毎の交通費：<?= $traffic ?>円</p>
                <br>

                <p>備品代：<?= $_POST["equipment-cost"] ?>円</p>
                <p>月毎のツール代：<?= $toolcost ?>円</p>
                <p>(使用ツール：
                <?php
                    foreach($_POST["tool-cost"] as $key => $value){
                        if($key+1 == count($_POST["tool-cost"])){
                            echo $value;
                        } else {
                            echo $value.", ";
                        }
                    }
                ?>
                )</p>
                <br>

                <p>年齢：<?= $age ?>歳</p>
                <p>(介護保険の支払い：<?= $age>=40 ? "あり" : "なし" ?>)</p>
                <p>社会保険料(会社側負担)：<?= $health+$welfare ?>円</p>
                <p>(<?= $age>=40 ? "健康保険+介護保険" : "健康保険" ?>：<?= $health ?>円、厚生年金：<?= $welfare ?>円)</p>
                <p>雇用保険料(会社側負担)：<?= $employment ?>円</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>