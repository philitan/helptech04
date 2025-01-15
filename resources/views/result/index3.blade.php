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
                

                    // 初期費用とランニングコストを計算
                    $result = $base + $health + $welfare + $employment + $toolcost;
                    $first = $result + $_POST["equipment-cost"];

                    $employmentType = $_POST["employment-type"]; // 変数名を修正
                    ?>

                    <!-- 出力 -->
                    <p class="text-xl font-bold">必要経費</p>
                    <p>初期費用：<?= $first ?>円</p>
                    <p>ランニングコスト：<?= $result ?>円</p>
                    <br>

                    <p class="text-xl font-bold">詳細情報</p>
                    <p>月給：<?= ($monthly / 10000) ?>万円</p>
                    <p>(手取り(大体)：<?= $monthly*0.75 ?>円～<?= $monthly*0.85 ?>円)</p>
                    <p>月毎の交通費：<?= $traffic ?>円</p>
                    <br>

                    <p>備品代：<?= $_POST["equipment-cost"] ?>円</p>
                    <p>月毎のツール代：<?= $toolcost ?>円</p>
                    <p>使用ツール：
                        @if(!empty($toolCosts))
                            @foreach($toolCosts as $key => $value)
                                {{ $value }}@if(!$loop->last), @endif
                            @endforeach
                        @else
                            なし
                        @endif
                    </p>

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
                    ['条件1', <?= $monthly*0.8 ?>],
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