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
                // 入力されたデータの取得
                if ($_POST["employment-type"] === "fulltime") {
                    // フルタイム
                    $monthly = $_POST["monthly-salary"] ; // 月給(万円を円に直す)
                    $traffic = $_POST["commute-cost"]; // 交通費
                } else {
                    // パートタイム
                    $monthly = $_POST["hourly-wage"] *$_POST["hours-per-day"]* $_POST["days-per-week"]*4.33; // 月給(1ヶ月4.33週間とする))
                    $traffic = $_POST["transport-cost"]* $_POST["days-per-week"]*4.33; // 1ヶ月の交通費
                }
                $age = $_POST["age"]; // 年齢

                // ツール費用の計算
                $toolcost = 0;
                if(isset($_POST["tool-cost"])){
                  foreach ($_POST["tool-cost"] as $key => $value) {
                      $tools = Tools::where('name', '=', $value)->get();
                      foreach ($tools as $tool) {
                          $price = $tool->price;
                          $toolcost += $price;
                      }
                  }
                }

                // 社会保険料の計算の準備
                $base = $monthly + $traffic; // 基準となる金額の算出
                $insurances = Insurance::select('salary')->get(); // 標準報酬のカラムのみ取得

                // 月給と標準報酬を比較して最適な等級(=ID)を見つけ出す
                $id = 0;
                $next = 0;
                foreach ($insurances as $salary) {
                    $next = $salary->salary;
                    if ($base < $next) {
                        break;
                    }
                    $id++;
                }

                // 見つけ出したIDで今度はその行のみ取得
                $insurances2 = Insurance::find($id);

                // 社会保険料と雇用保険料の計算
                if ($age >= 40) {
                    $health = $insurances2->health_care;
                } else {
                    $health = $insurances2->health;
                }
                $health2 = $health;
                $fraction = $health - (int)$health;
                if ($fraction > 0) {
                    $health += 1;
                }
                $health = (int)$health;
                $health2 = (int)$health2;

                $welfare = $insurances2->welfare;
                $welfare2 = $welfare;
                $fraction = $welfare - (int)$welfare;
                if ($fraction > 0) {
                    $welfare += 1;
                }
                $welfare = (int)$welfare;
                $welfare2 = (int)$welfare2;

                $employment = $monthly * 0.0095;
                $fraction = $employment - (int)$employment;
                if ($fraction >= 0.5) {
                    $employment += 1;
                }
                $employment = (int)$employment;

                // 初期費用とランニングコストを計算
                $result = $base + $health + $welfare + $employment + $toolcost;
                $first = $result + $_POST["equipment-cost"];

                // 手取りの計算
                $employment2 = $monthly*0.006;
                $fraction = $employment2 - (int)$employment2;
                if($fraction > 0.5){
                    $employment2 += 1;
                }
                $employment2 = (int)$employment2;

                $social = $health2 + $welfare2 + $employment2; // 控除額の計算
                $income = $monthly - $social; // 月給から控除額を排除

                $employmentType = $_POST["employment-type"]; // 変数名を修正
            ?>

                <!-- 出力 -->
                <p class="text-xl font-bold">必要経費</p>
                <p>初期費用：<?= $first ?>円</p>
                <p>ランニングコスト：<?= $result ?>円</p>
                <br>

                <p class="text-xl font-bold">詳細情報</p>
                <p>月給：<?= ($monthly / 10000) ?>万円</p>
                <p>(手取り：<?= $income ?>円)※税金は未反映</p>
                <p>月毎の交通費：<?= $traffic ?>円</p>
                <br>

                <p>備品代：<?= $_POST["equipment-cost"] ?>円</p>
                <p>月毎のツール代：<?= $toolcost ?>円</p>
                <p>(使用ツール：
                <?php
                if(isset($_POST["tool-cost"])){
                    foreach($_POST["tool-cost"] as $key => $value){
                        if($key+1 == count($_POST["tool-cost"])){
                            echo $value;
                        } else {
                            echo $value.", ";
                        }
                    }
                } else {
                    echo "なし";
                }
                ?>
                )</p>
                <br>

                <p>年齢：<?= $age ?>歳</p>
                <p>(介護保険の支払い：<?= $age >= 40 ? "あり" : "なし" ?>)</p>
                <p>社会保険料(会社側負担)：<?= $health + $welfare ?>円</p>
                <p>(<?= $age >= 40 ? "健康保険+介護保険" : "健康保険" ?>：<?= $health ?>円、厚生年金：<?= $welfare ?>円)</p>
                <p>雇用保険料(会社側負担)：<?= $employment ?>円</p>
                </div>
                <div class="mt-6">
                    <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-200" style="margin-left: 2%;">雇用形態: {{ $employmentType === 'fulltime' ? 'フルタイム' : 'パートタイム' }}</h3>
                </div>
            </div>
        </div>
    </div>

   <div>
        <div id="chart1"></div>
        <div id="chart2"></div>
        <script src="https://www.gstatic.com/charts/loader.js"></script>
        <script type="text/javascript">
            // パッケージのロード
            google.charts.load('current', {packages: ['corechart']});
            // ロード完了まで待機
            google.charts.setOnLoadCallback(drawCharts);

            // コールバック関数の実装
            function drawCharts() {
                // データの準備
                var data1 = google.visualization.arrayToDataTable([
                    ['number', '月収', '交通費', '社会保険', '雇用保険'],
                    ['条件1', <?= $monthly ?>, <?= $traffic ?>, <?= $health + $welfare ?>, <?= $employment ?>],
                ]);

                var data2 = google.visualization.arrayToDataTable([
                    ['number', '手取り'],
                    ['条件1', <?= $income ?>],
                ]);

                // オプション設定
                var options1 = {
                    title: '会社負担額',
                    seriesType: "bars",
                    isStacked: true,
                };

                var options2 = {
                    title: '手取り額',
                    seriesType: "bars",
                };

                // グラフ1の描画
                var chart1 = new google.visualization.ComboChart(document.getElementById('chart1'));
                chart1.draw(data1, options1);

                // グラフ2の描画
                var chart2 = new google.visualization.ComboChart(document.getElementById('chart2'));
                chart2.draw(data2, options2);
            }
        </script>
    </div>

</x-app-layout>
