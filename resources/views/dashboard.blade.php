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
                    // 本来は月給を入れる場所、テスト用なので適当に値を入れている
                    $gekyuu = 100000;
                    $koutuu = 10000;
                    $goukei = $gekyuu+$koutuu;
                    // 標準報酬のカラムのみ取得
                    $insurances = Insurance::select('salary')->get();
                    // dd($insurances);
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

                    // 社会保険料の計算をする(ひとまず介護保険なしの場合のみ、介護保険はifで分岐すれば出来る)
                    // 労働者と事業主両方を合わせて計算しているため、企業側が何を求めるかによって変わる可能性あり
                    $health = $insurances2->health;
                    $welfare = $insurances2->welfare;
                    $employment = $goukei*0.0155;

                    $kekka = $goukei + $health + $welfare + $employment;
                    // 出力
                    echo '月給：'.$goukei."<br>";
                    echo '社会保険+雇用保険料込み：'.$kekka;
                    ?>
                </div>
            <!-- テスト用ここまで -->
            </div>
        </div>
    </div>
</x-app-layout>