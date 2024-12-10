<?php
use App\Models\Insurance;
?>

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
            <!-- 以下、計算のテスト用 -->
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <?php
                    // 本来は月給、交通費、年齢を入力情報から取得する、今回は計算のテスト用なので適当に値を入れている
                    $gekyuu = 200000;
                    $koutuu = 10000;
                    $age = 25;
                    $goukei = $gekyuu+$koutuu;

                    // 標準報酬のカラムのみ取得
                    $insurances = Insurance::select('salary')->get();
                    // 月給と標準報酬を比較して最適な等級(=ID)を見つけ出す
                    $id = 0;
                    $next = 0;
                    foreach($insurances as $salary){
                        $next = $salary->salary;
                        if($goukei < $next){
                            break;
                        }
                        $id++;
                    }

                    // 見つけ出したIDで今度はその行のみ取得
                    $insurances2 = Insurance::find($id);
                    // 社会保険料の計算をする
                    if($age >= 40){
                        $health = $insurances2->health_care;
                    } else {
                        $health = $insurances2->health;
                    }
                    $welfare = $insurances2->welfare;
                    $employment = $goukei*0.0155;

                    $kekka = $goukei + $health + $welfare + $employment;
                    $kekka = (int)$kekka;

                    // 出力
                    echo '月給：'.$gekyuu."<br>";
                    echo '交通費：'.$koutuu."<br>";
                    echo '年齢：'.$age."歳<br>";
                    echo '社会保険料込み：'.$kekka;
                    ?>
                </div>
            <!-- テスト用ここまで -->
            </div>
        </div>
    </div>
</x-app-layout>