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
                    <p>
                        <?php
                        // 入力されたデータの取得
                        if ($_POST["employment-type"] === "fulltime") {
                            // フルタイム
                            $monthly = $_POST["monthly-salary"];
                            $traffic = $_POST["commute-cost"]; // 交通費
                        } else {
                            // パートタイム
                            $monthly = $_POST["hourly-wage"] * $_POST["hours-per-day"] * $_POST["days-per-week"] * 4; // 月給(1ヶ月4週間とする))
                            $traffic = $_POST["transport-cost"] * $_POST["days-per-week"] * 4; // 1ヶ月の交通費
                        }
                        $age = $_POST["age"]; // 年齢

                        // ツール費用の計算
                        $toolcost = 0;
                        if (isset($_POST["tool-cost"])) {
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
                        $employment2 = $monthly * 0.006;
                        $fraction = $employment2 - (int)$employment2;
                        if ($fraction > 0.5) {
                            $employment2 += 1;
                        }
                        $employment2 = (int)$employment2;

                        $social = $health2 + $welfare2 + $employment2; // 控除額の計算
                        $income = $monthly - $social; // 月給から控除額を排除

                        $employmentType = $_POST["employment-type"]; // 変数名を修正
                        ?>
                    </p>
                    <p>
                        <?php
                        // 入力されたデータの取得
                        if ($_POST["employment-type-2"] === "fulltime") {
                            // フルタイム
                            $monthly2 = $_POST["monthly-salary-2"];
                            $traffic2 = $_POST["commute-cost-2"]; // 交通費
                        } else {
                            // パートタイム
                            $monthly2 = $_POST["hourly-wage-2"] * $_POST["hours-per-day-2"] * $_POST["days-per-week-2"] * 4; // 月給(1ヶ月4週間とする))
                            $traffic2 = $_POST["transport-cost-2"] * $_POST["days-per-week-2"] * 4; // 1ヶ月の交通費
                        }
                        $age = $_POST["age"]; // 年齢



                        // 社会保険料の計算の準備
                        $base2 = $monthly2 + $traffic2; // 基準となる金額の算出
                        $insurances3 = Insurance::select('salary')->get(); // 標準報酬のカラムのみ取得

                        // 月給と標準報酬を比較して最適な等級(=ID)を見つけ出す
                        $id = 0;
                        $next = 0;
                        foreach ($insurances3 as $salary) {
                            $next = $salary->salary;
                            if ($base < $next) {
                                break;
                            }
                            $id++;
                        }

                        // 見つけ出したIDで今度はその行のみ取得
                        $insurances4 = Insurance::find($id);

                        // 社会保険料と雇用保険料の計算
                        if ($age >= 40) {
                            $health3 = $insurances4->health_care;
                        } else {
                            $health3 = $insurances4->health;
                        }
                        $health4 = $health3;
                        $fraction2 = $health3 - (int)$health3;
                        if ($fraction2 > 0) {
                            $health3 += 1;
                        }
                        $health3 = (int)$health3;
                        $health4 = (int)$health4;

                        $welfare3 = $insurances4->welfare;
                        $welfare4 = $welfare3;
                        $fraction2 = $welfare3 - (int)$welfare3;
                        if ($fraction2 > 0) {
                            $welfare3 += 1;
                        }
                        $welfare3 = (int)$welfare3;
                        $welfare4 = (int)$welfare4;

                        $employment3 = $monthly2 * 0.0095;
                        $fraction2 = $employment3 - (int)$employment3;
                        if ($fraction2 >= 0.5) {
                            $employment3 += 1;
                        }
                        $employment3 = (int)$employment3;

                        // 初期費用とランニングコストを計算
                        $result2 = $base2 + $health3 + $welfare3 + $employment3 + $toolcost;
                        $first2 = $result2 + $_POST["equipment-cost"];

                        // 手取りの計算
                        $employment4 = $monthly2 * 0.006;
                        $fraction2 = $employment4 - (int)$employment4;
                        if ($fraction2 > 0.5) {
                            $employment4 += 1;
                        }
                        $employment4 = (int)$employment4;

                        $social2 = $health4 + $welfare4 + $employment4; // 控除額の計算
                        $income2 = $monthly2 - $social2; // 月給から控除額を排除

                        $employmentType2 = $_POST["employment-type-2"]; // 変数名を修正
                        ?>
                    </p>

                    <!-- 出力 -->

                    <div class="flex" style="margin-top: 1%;">
                        <div>
                            <h3 class="text-xl font-bold">パターン１</h3>
                            <p>初期費用：<?= $first ?>円</p>
                            <p>ランニングコスト：<?= $result ?>円</p>
                            <br>

                            <p class="text-xl font-bold">詳細情報</p>

                            <h4 class="text-l font-semibold text-gray-800 dark:text-gray-200" style="margin-top: 1%;">雇用形態: {{ $employmentType === 'fulltime' ? 'フルタイム' : 'パートタイム' }}</h4>

                            <p>月給：<?= ($monthly / 10000) ?>万円</p>
                            <p>(手取り：<?= $income ?>円)※税金は未反映</p>
                            <p>月毎の交通費：<?= $traffic ?>円</p>
                            <br>

                            <p>備品代：<?= $_POST["equipment-cost"] ?>円</p>
                            <p>月毎のツール代：<?= $toolcost ?>円</p>
                            <p>(使用ツール：
                                <?php
                                if (isset($_POST["tool-cost"])) {
                                    foreach ($_POST["tool-cost"] as $key => $value) {
                                        if ($key + 1 == count($_POST["tool-cost"])) {
                                            echo $value;
                                        } else {
                                            echo $value . ", ";
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
                        <div style="margin-left: 5%;">
                            <h3 class="text-xl font-bold">パターン２</h3>
                            <p>初期費用：<?= $first2 ?>円</p>
                            <p>ランニングコスト：<?= $result2 ?>円</p>
                            <br>

                            <p class="text-xl font-bold">詳細情報</p>

                            <h4 class="text-l font-semibold text-gray-800 dark:text-gray-200" style="margin-top: 1%;">雇用形態: {{ $employmentType2 === 'fulltime' ? 'フルタイム' : 'パートタイム' }}</h4>

                            <p>月給：<?= ($monthly2 / 10000) ?>万円</p>
                            <p>(手取り：<?= $income2 ?>円)※税金は未反映</p>
                            <p>月毎の交通費：<?= $traffic2 ?>円</p>
                            <br>

                            <p>備品代：<?= $_POST["equipment-cost"] ?>円</p>
                            <p>月毎のツール代：<?= $toolcost ?>円</p>
                            <p>(使用ツール：
                                <?php
                                if (isset($_POST["tool-cost"])) {
                                    foreach ($_POST["tool-cost"] as $key => $value) {
                                        if ($key + 1 == count($_POST["tool-cost"])) {
                                            echo $value;
                                        } else {
                                            echo $value . ", ";
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
                            <p>社会保険料(会社側負担)：<?= $health3 + $welfare3 ?>円</p>
                            <p>(<?= $age >= 40 ? "健康保険+介護保険" : "健康保険" ?>：<?= $health3 ?>円、厚生年金：<?= $welfare3 ?>円)</p>
                            <p>雇用保険料(会社側負担)：<?= $employment2 ?>円</p>
                        </div>
                    </div>
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
            google.charts.load('current', {
                packages: ['corechart']
            });
            // ロード完了まで待機
            google.charts.setOnLoadCallback(drawCharts);

            // コールバック関数の実装
            function drawCharts() {
                // データの準備
                var data1 = google.visualization.arrayToDataTable([
                    ['number', '月収', '交通費', '社会保険', '雇用保険'],
                    ['条件1', <?= $monthly ?>, <?= $traffic ?>, <?= $health + $welfare ?>, <?= $employment ?>],
                    ['条件2', <?= $monthly2 ?>, <?= $traffic2 ?>, <?= $health3 + $welfare3 ?>, <?= $employment ?>],
                ]);

                var data2 = google.visualization.arrayToDataTable([
                    ['number', '手取り'],
                    ['条件1', <?= $monthly * 0.8 ?>],
                    ['条件2', <?= $monthly2 * 0.8 ?>],
                ]);

                // オプション設定
                var options1 = {
                    title: '会社負担額',
                    seriesType: "bars",
                    isStacked: true,
                };

                var options2 = {
                    title: '手取り額(給与の80%と仮定)',
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