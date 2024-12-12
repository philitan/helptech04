<!-- 計算のテストに使うモデルの読み込み -->
<?php
use App\Models\Insurance;
?>
<!-- モデルの読み込みここまで -->

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in!") }}
                </div>
            <!-- 以下、計算のテスト(メモとしてシミュ画面に組み込むまでは残します) -->
                <div class="p-6 text-green-600 dark:text-green-400">
                    <p>【計算のテスト用】(シミュ画面に処理を組み込んだら消します)</p>
                    <?php
                    // 本来は月給、交通費、年齢を入力情報から取得する、今回は計算のテストなので適当に値を入れている
                    $monthly = 200000; // 月給
                    $traffic = 10000; // 交通費
                    $age = 25; // 年齢
                    $base = $monthly+$traffic; // 計算の基準となる額

                    // 標準報酬のカラムのみ取得
                    $insurances = Insurance::select('salary')->get();
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
                    // 社会保険料と雇用保険料の計算をする
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

                    $result = $base + $health + $welfare + $employment;

                    // 出力(テストということで一応全て出力している)
                    echo '月給：'.$monthly."<br>";
                    echo '交通費：'.$traffic."<br>";
                    echo '年齢：'.$age."歳<br>";
                    echo '社会保険料+雇用保険料込み：'.$result;
                    ?>
                </div>
            <!-- 計算のテストここまで -->
            </div>
        </div>
    </div>
</x-app-layout>