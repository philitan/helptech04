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
                    // 1つ目のデータ処理

                    // 入力されたデータの取得
                    if ($_POST["employment-type"] === "fulltime") {
                        // フルタイム
                        $monthly = $_POST["monthly-salary"] ; // 月給
                        $traffic = $_POST["commute-cost"]; // 交通費
                    } else {
                        // パートタイム
                        $monthly = $_POST["hourly-wage"] *$_POST["hours-per-day"]* $_POST["days-per-week"]*4; // 月給(1ヶ月4週間とする))
                        $traffic = $_POST["transport-cost"]* $_POST["days-per-week"]*4; // 1ヶ月の交通費
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
                    // 社会保険料と雇用保険料の計算

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

                    // 雇用形態での分岐
                    if($_POST["employment-type"] === "fulltime"){
                        // 社会保険料の計算
                        if ($age >= 40) {
                            $health = $insurances2->health_care;
                        } else {
                            $health = $insurances2->health;
                        }
                        $fraction = $health - (int)$health;
                        if ($fraction > 0) {
                            $health += 1;
                        }
                        $health = (int)$health;

                        $welfare = $insurances2->welfare;
                        $fraction = $welfare - (int)$welfare;
                        if ($fraction > 0) {
                            $welfare += 1;
                        }
                        $welfare = (int)$welfare;

                        // 雇用保険料の計算
                        $employment = $monthly * 0.0095;
                        $fraction = $employment - (int)$employment;
                        if ($fraction >= 0.5) {
                            $employment += 1;
                        }
                        $employment = (int)$employment;
                    } else {
                        // 1週間に働く時間の計算
                        $weektime = $_POST["hours-per-day"]* $_POST["days-per-week"];
                        if($weektime >= 30){
                            // 週30時間以上の処理(フルタイムと同じ)
                            // 社会保険料の計算
                            if ($age >= 40) {
                                $health = $insurances2->health_care;
                            } else {
                                $health = $insurances2->health;
                            }
                            $fraction = $health - (int)$health;
                            if ($fraction > 0) {
                                $health += 1;
                            }
                            $health = (int)$health;

                            $welfare = $insurances2->welfare;
                            $fraction = $welfare - (int)$welfare;
                            if ($fraction > 0) {
                                $welfare += 1;
                            }
                            $welfare = (int)$welfare;
                            // 雇用保険料の計算
                            $employment = $monthly * 0.0095;
                            $fraction = $employment - (int)$employment;
                            if ($fraction >= 0.5) {
                                $employment += 1;
                            }
                            $employment = (int)$employment;
                        } else if($weektime >= 20 && $weektime < 30){
                            // 週20時間以上30時間未満の処理(雇用保険料のみ)
                            $employment = $monthly * 0.0095;
                            $fraction = $employment - (int)$employment;
                            if ($fraction >= 0.5) {
                                $employment += 1;
                            }
                            $employment = (int)$employment;
                            $health = 0;
                            $welfare = 0;
                        } else {
                            // 週20時間未満の処理(両方なし)
                            $health = 0;
                            $welfare = 0;
                            $employment = 0;
                        }
                    }

                    // 初期費用とランニングコストを計算
                    $result = $base + $health + $welfare + $employment + $toolcost;
                    $first = $result + $_POST["equipment-cost"];

                    $employmentType = $_POST["employment-type"]; // 変数名を修正

                    // 2つ目のデータ処理

                    // 入力されたデータの取得
                    if ($_POST["employment-type-2"] === "fulltime") {
                        // フルタイム
                        $monthly2 = $_POST["monthly-salary-2"] ; // 月給
                        $traffic2 = $_POST["commute-cost-2"]; // 交通費
                    } else {
                        // パートタイム
                        $monthly2 = $_POST["hourly-wage-2"] *$_POST["hours-per-day-2"]* $_POST["days-per-week-2"]*4; // 月給(1ヶ月4週間とする))
                        $traffic2 = $_POST["transport-cost-2"]* $_POST["days-per-week-2"]*4; // 1ヶ月の交通費
                    }

                    // 社会保険料と雇用保険料の計算

                    // 社会保険料の計算の準備
                    $base2 = $monthly2 + $traffic2; // 基準となる金額の算出
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

                    // 雇用形態での分岐
                    if($_POST["employment-type-2"] === "fulltime"){
                        // 社会保険料の計算
                        if ($age >= 40) {
                            $health2 = $insurances2->health_care;
                        } else {
                            $health2 = $insurances2->health;
                        }
                        $fraction = $health2 - (int)$health2;
                        if ($fraction > 0) {
                            $health2 += 1;
                        }
                        $health2 = (int)$health2;

                        $welfare2 = $insurances2->welfare;
                        $fraction = $welfare2 - (int)$welfare2;
                        if ($fraction > 0) {
                            $welfare2 += 1;
                        }
                        $welfare2 = (int)$welfare2;

                        // 雇用保険料の計算
                        $employment2 = $monthly * 0.0095;
                        $fraction = $employment2 - (int)$employment2;
                        if ($fraction >= 0.5) {
                            $employment2 += 1;
                        }
                        $employment2 = (int)$employment2;
                    } else {
                        // 1週間に働く時間の計算
                        $weektime2 = $_POST["hours-per-day-2"]* $_POST["days-per-week-2"];
                        if($weektime2 >= 30){
                            // 週30時間以上の処理(フルタイムと同じ)
                            // 社会保険料の計算
                            if ($age >= 40) {
                                $health2 = $insurances2->health_care;
                            } else {
                                $health2 = $insurances2->health;
                            }
                            $fraction = $health2 - (int)$health2;
                            if ($fraction > 0) {
                                $health2 += 1;
                            }
                            $health2 = (int)$health2;

                            $welfare2 = $insurances2->welfare;
                            $fraction = $welfare2 - (int)$welfare2;
                            if ($fraction > 0) {
                                $welfare2 += 1;
                            }
                            $welfare2 = (int)$welfare2;

                            // 雇用保険料の計算
                            $employment2 = $monthly2 * 0.0095;
                            $fraction = $employment2 - (int)$employment2;
                            if ($fraction >= 0.5) {
                                $employment2 += 1;
                            }
                            $employment2 = (int)$employment2;
                        } else if($weektime2 >= 20 && $weektime2 < 30){
                            // 週20時間以上30時間未満の処理(雇用保険料のみ)
                            $employment2 = $monthly2 * 0.0095;
                            $fraction = $employment2 - (int)$employment2;
                            if ($fraction >= 0.5) {
                                $employment2 += 1;
                            }
                            $employment2 = (int)$employment2;
                            $health2 = 0;
                            $welfare2 = 0;
                        } else {
                            // 週20時間未満の処理(両方なし)
                            $health2 = 0;
                            $welfare2 = 0;
                            $employment2 = 0;
                        }
                    }

                    // 初期費用とランニングコストを計算
                    $result2 = $base2 + $health2 + $welfare2 + $employment2 + $toolcost;
                    $first2 = $result2 + $_POST["equipment-cost"];

                    $employmentType2 = $_POST["employment-type-2"]; // 変数名を修正
                    ?>

                    <!-- 出力 -->

                    <div class="flex" style="margin-top: 1%;">
                        <div>
                            <h3 class="text-xl font-bold">パターン１</h3>
                            <p class="text-xl font-bold">必要経費</p>
                            <p>初期費用：<?= $first ?>円</p>
                            <p>ランニングコスト：<?= $result ?>円</p>
                            <br>

                            <p class="text-xl font-bold">詳細情報</p>

                            <h4 class="text-l font-semibold text-gray-800 dark:text-gray-200" style="margin-top: 1%;">雇用形態: {{ $employmentType === 'fulltime' ? 'フルタイム' : 'パートタイム' }}</h4>

                            <p>月給：<?= $monthly ?>円</p>
                            <p>(手取り(大体)：<?= $monthly*0.75 ?>円～<?= $monthly*0.85 ?>円)</p>
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
                            <?php
                            if($_POST["employment-type"] === "parttime"){
                                echo "1週間で働く時間：".$weektime."時間<br>";
                            }
                            ?>
                            <br>

                            <p>社会保険料(会社側負担)：<?= $health + $welfare ?>円</p>
                            <p>(<?= $age >= 40 ? "健康保険+介護保険" : "健康保険" ?>：<?= $health ?>円、厚生年金：<?= $welfare ?>円)</p>
                            <p>雇用保険料(会社側負担)：<?= $employment ?>円</p>
                        </div>

                        <div style="margin-left: 5%;">
                            <h3 class="text-xl font-bold">パターン２</h3>
                            <p class="text-xl font-bold">必要経費</p>
                            <p>初期費用：<?= $first2 ?>円</p>
                            <p>ランニングコスト：<?= $result2 ?>円</p>
                            <br>

                            <p class="text-xl font-bold">詳細情報</p>

                            <h4 class="text-l font-semibold text-gray-800 dark:text-gray-200" style="margin-top: 1%;">雇用形態: {{ $employmentType2 === 'fulltime' ? 'フルタイム' : 'パートタイム' }}</h4>

                            <p>月給：<?= $monthly2 ?>円</p>
                            <p>(手取り(大体)：<?= $monthly2*0.75 ?>円～<?= $monthly2*0.85 ?>円)</p>
                            <p>月毎の交通費：<?= $traffic2 ?>円</p>
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
                            <?php
                            if($_POST["employment-type-2"] === "parttime"){
                                echo "1週間で働く時間：".$weektime2."時間<br>";
                            }
                            ?>
                            <br>

                            <p>社会保険料(会社側負担)：<?= $health2 + $welfare2 ?>円</p>
                            <p>(<?= $age >= 40 ? "健康保険+介護保険" : "健康保険" ?>：<?= $health2 ?>円、厚生年金：<?= $welfare2 ?>円)</p>
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