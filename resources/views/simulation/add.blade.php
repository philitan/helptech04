<?php

use App\Models\Tools;
?>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl font-bold text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('simulation') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-8 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <form action="{{ route('result.index2') }}" method="POST">
                    @csrf
                    <!-- 共通の項目 -->
                    <div id="common-fields" class="mb-6" style="margin-top: 2%; margin-left:1%;">
                        <div style="margin-bottom: 2%;">
                            <label for="equipment-cost" class="block text-l font-bold text-gray-700 dark:text-gray-300">備品の代金(円)</label>
                            <input
                                type="number"
                                name="equipment-cost"
                                id="equipment-cost"
                                class="shadow appearance-none border rounded w-96 py-2 px-3  text-gray-700 dark:text-gray-300 dark:bg-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                style="width:20rem; margin-left: 2%; "
                                placeholder=""
                                step="1"
                                min="0"
                                required>
                        </div>
                        <div style="margin-bottom: 2%;">
                            <label for="age" class="block text-l font-bold text-gray-700 dark:text-gray-300">年齢(歳)</label>
                            <input
                                type="number"
                                name="age"
                                id="age"
                                class="shadow appearance-none border rounded w-96 py-2 px-4 text-gray-700 dark:text-gray-300 dark:bg-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                style="width:20rem; margin-left: 2%; "
                                placeholder=""
                                step="1"
                                min="0"
                                required>
                        </div>

                        <!-- チェックboxの処理 -->
                        <div>
                            <label for="tool-cost" class="block text-l font-bold text-gray-700 dark:text-gray-300">使用するツールの選択</label>

                            <?php
                            $tools = Tools::select('name')->get();
                            foreach ($tools as $item) {
                                $value = $item["name"];
                                echo '<div class="flex items-center space-x-3 mb-2">';
                                echo '<input type="checkbox" id="tool-cost" name="tool-cost[]" value="' . $value . '" class="text-gray-700 dark:text-gray-300 bg-gray-100 dark:bg-gray-800 border rounded p-2 focus:outline-none focus:ring-2 focus:ring-blue-500" style="margin-left:2.5%;">';
                                echo '<label for="tool-cost" class="text-gray-700 dark:text-gray-300" style="margin-left:1%;">' . $value . '</label>';
                                echo '</div>';
                            }
                            ?>

                        </div>

                    </div>
                    <div class="flex">
                        <div>
                            <!-- 雇用形態の切り替え -->
                            <div style="font-size: 20px; margin-left:4%;" class="text-gray-900 dark:text-gray-100">
                                <div class="text-l font-bold"> {{("雇用形態") }}</div>
                                <div class="flex items-center" style="margin-left: 2%;margin-top: 0.6%;">
                                    <label for="toggle1" class="relative cursor-pointer">
                                        <input type="checkbox" id="toggle1" class="sr-only peer" onchange="toggleFields1(this)">
                                        <div class="w-10 h-6 bg-gray-300 rounded-full peer-checked:bg-blue-500 peer-focus:ring-2 peer-focus:ring-blue-500 transition"></div>
                                        <div class="w-4 h-4 bg-white rounded-full absolute top-1 left-1 peer-checked:translate-x-4 transition"></div>
                                    </label>
                                    <span id="toggle-text" class="ml-3 text-gray-900 dark:text-gray-100">フルタイム</span>
                                </div>
                            </div>
                            <input type="hidden" name="employment-type" id="employment-type" value="fulltime">

                            <!-- フルタイム用 -->
                            <div id="fulltime-fields" class="mt-4" style=" margin-left: 2%;  ">
                                <div>
                                    <label for="monthly-salary" class="block text-l font-bold text-gray-700 dark:text-gray-300">月収(円)</label>
                                    <input
                                        type="number"
                                        name="monthly-salary"
                                        id="monthly-salary"
                                        class="shadow appearance-none border rounded w-96 py-2 px-3 text-gray-700 dark:text-gray-300 dark:bg-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                        style="width:20rem; margin-left: 6%; margin-bottom: 1%;"
                                        placeholder=""
                                        step="1"
                                        min="0">
                                </div>
                                <div class="mt-4">
                                    <label for="commute-cost" class="block text-l font-bold text-gray-700 dark:text-gray-300">1ヶ月の定期代金(円)</label>
                                    <input
                                        type="number"
                                        name="commute-cost"
                                        id="commute-cost"
                                        class="shadow appearance-none border rounded w-96 py-2 px-3 text-gray-700 dark:text-gray-300 dark:bg-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                        style="width:20rem; margin-left: 6%; margin-bottom: 1%;"
                                        placeholder=""
                                        min="0">
                                </div>
                            </div>

                            <!-- パートタイム用 -->
                            <div id="parttime-fields" class="hidden mt-4" style=" margin-left: 2%;  ">
                                <div>
                                    <label for="hourly-wage" class="block text-l font-bold text-gray-700 dark:text-gray-300">時給(円)</label>
                                    <input
                                        type="number"
                                        name="hourly-wage"
                                        id="hourly-wage"
                                        class="shadow appearance-none border rounded w-96 py-2 px-3 text-gray-700 dark:text-gray-300 dark:bg-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                        style="width:20rem; margin-left: 6%; margin-bottom: 1%;"
                                        placeholder=""
                                        step="1"
                                        min="0">
                                </div>
                                <div class="mt-4">
                                    <label for="hours-per-day" class="block text-l font-bold text-gray-700 dark:text-gray-300">1日に働く時間(h) </label>
                                    <input
                                        type="number"
                                        name="hours-per-day"
                                        id="hours-per-day"
                                        class="shadow appearance-none border rounded w-96 py-2 px-3 text-gray-700 dark:text-gray-300 dark:bg-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                        style="width:20rem; margin-left: 6%; margin-bottom: 1%;"
                                        placeholder=""
                                        step="0.5"
                                        max="24"
                                        min="0">
                                </div>
                                <div class="mt-4">
                                    <label for="days-per-week" class="block text-l font-bold text-gray-700 dark:text-gray-300">1週間に働く日数(日)</label>
                                    <input
                                        type="number"
                                        name="days-per-week"
                                        id="days-per-week"
                                        class="shadow appearance-none border rounded w-96 py-2 px-3 text-gray-700 dark:text-gray-300 dark:bg-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                        style="width:20rem; margin-left: 6%; margin-bottom: 1%;"
                                        placeholder=""
                                        step="1"
                                        max="7"
                                        min="1">
                                </div>
                                <div class="mt-4">
                                    <label for="transport-cost" class="block text-l font-bold text-gray-700 dark:text-gray-300">1日あたりの交通費</label>
                                    <input
                                        type="number"
                                        name="transport-cost"
                                        id="transport-cost"
                                        class="shadow appearance-none border rounded w-96 py-2 px-3 text-gray-700 dark:text-gray-300 dark:bg-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                        style="width:20rem; margin-left: 6%; margin-bottom: 1%;"
                                        placeholder=""
                                        step="1"
                                        min="0">
                                </div>
                            </div>

                        </div>
                        <div style="margin-left: 5%;">
                            <!-- 雇用形態の切り替え -->
                            <div style="font-size: 20px; margin-left:1%;" class="text-gray-900 dark:text-gray-100">
                                <div class="text-l font-bold"> {{("雇用形態") }}</div>
                                <div class="flex items-center" style="margin-left: 2%;margin-top: 0.6%;">
                                    <label for="toggle2" class="relative cursor-pointer">
                                        <input type="checkbox" id="toggle2" class="sr-only peer" onchange="toggleFields2(this)">
                                        <div class="w-10 h-6 bg-gray-300 rounded-full peer-checked:bg-blue-500 peer-focus:ring-2 peer-focus:ring-blue-500 transition"></div>
                                        <div class="w-4 h-4 bg-white rounded-full absolute top-1 left-1 peer-checked:translate-x-4 transition"></div>
                                    </label>
                                    <span id="toggle-text2" class="ml-3 text-gray-900 dark:text-gray-100">フルタイム</span>
                                </div>
                            </div>
                            <input type="hidden" name="employment-type-2" id="employment-type-2" value="fulltime">

                            <!-- フルタイム用 -->
                            <div id="fulltime-fields-2" class="mt-4" style=" margin-left: 1%;  ">
                                <div>
                                    <label for="monthly-salary-2" class="block text-l font-bold text-gray-700 dark:text-gray-300">月収(円)</label>
                                    <input
                                        type="number"
                                        name="monthly-salary-2"
                                        id="monthly-salary-2"
                                        class="shadow appearance-none border rounded w-96 py-2 px-3 text-gray-700 dark:text-gray-300 dark:bg-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                        style="width:20rem; margin-left: 2%; margin-bottom: 1%;"
                                        placeholder=""
                                        step="1"
                                        min="0">
                                </div>
                                <div class="mt-4">
                                    <label for="commute-cost-2" class="block text-l font-bold text-gray-700 dark:text-gray-300">1ヶ月の定期代金(円)</label>
                                    <input
                                        type="number"
                                        name="commute-cost-2"
                                        id="commute-cost-2"
                                        class="shadow appearance-none border rounded w-96 py-2 px-3 text-gray-700 dark:text-gray-300 dark:bg-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                        style="width:20rem; margin-left: 2%; margin-bottom: 1%;"
                                        placeholder=""
                                        min="0">
                                </div>
                            </div>

                            <!-- パートタイム用 -->
                            <div id="parttime-fields-2" class="hidden mt-4" style=" margin-left: 1%;  ">
                                <div>
                                    <label for="hourly-wage-2" class="block text-l font-bold text-gray-700 dark:text-gray-300">時給(円)</label>
                                    <input
                                        type="number"
                                        name="hourly-wage-2"
                                        id="hourly-wage-2"
                                        class="shadow appearance-none border rounded w-96 py-2 px-3 text-gray-700 dark:text-gray-300 dark:bg-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                        style="width:20rem; margin-left: 2%; margin-bottom: 1%;"
                                        placeholder=""
                                        step="1"
                                        min="0">
                                </div>
                                <div class="mt-4">
                                    <label for="hours-per-day-2" class="block text-l font-bold text-gray-700 dark:text-gray-300">1日に働く時間(h) </label>
                                    <input
                                        type="number"
                                        name="hours-per-day-2"
                                        id="hours-per-day-2"
                                        class="shadow appearance-none border rounded w-96 py-2 px-3 text-gray-700 dark:text-gray-300 dark:bg-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                        style="width:20rem; margin-left: 2%; margin-bottom: 1%;"
                                        placeholder=""
                                        step="0.5"
                                        max="24"
                                        min="0">
                                </div>
                                <div class="mt-4">
                                    <label for="days-per-week-2" class="block text-l font-bold text-gray-700 dark:text-gray-300">1週間に働く日数(日)</label>
                                    <input
                                        type="number"
                                        name="days-per-week-2"
                                        id="days-per-week-2"
                                        class="shadow appearance-none border rounded w-96 py-2 px-3 text-gray-700 dark:text-gray-300 dark:bg-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                        style="width:20rem; margin-left: 2%; margin-bottom: 1%;"
                                        placeholder=""
                                        step="1"
                                        max="7"
                                        min="1">
                                </div>
                                <div class="mt-4">
                                    <label for="transport-cost-2" class="block text-l font-bold text-gray-700 dark:text-gray-300">1日あたりの交通費</label>
                                    <input
                                        type="number"
                                        name="transport-cost-2"
                                        id="transport-cost-2"
                                        class="shadow appearance-none border rounded w-96 py-2 px-3 text-gray-700 dark:text-gray-300 dark:bg-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                        style="width:20rem; margin-left: 2%; margin-bottom: 1%;"
                                        placeholder=""
                                        step="1"
                                        min="0">
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="flex">
                        <button type="submit" class="bg-gray-700 hover:bg-gray-800 text-white font-bold py-4 px-4 rounded focus:outline-none focus:shadow-outline mt-6" style="margin-bottom: 2%; margin-left:2%;">
                            シミュレーションを実行
                        </button>
                        <a href="{{ route('simulation.index') }}" class="bg-gray-700 hover:bg-gray-800 text-white font-bold py-4 px-4 rounded focus:outline-none focus:shadow-outline mt-6" style="margin-bottom: 2%; margin-left:3%;">
                            パターンを減らす
                        </a>
                    </div>

                </form>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    function toggleFields1(toggle) {
        const isPartTime = toggle.checked;
        const toggleText = document.getElementById('toggle-text'); // 1つ目のトグルのテキスト
        const fulltimeFields = document.querySelectorAll('#fulltime-fields input');
        const parttimeFields = document.querySelectorAll('#parttime-fields input');
        const employmentTypeField = document.getElementById('employment-type'); // 1つ目の隠しフィールド

        // 雇用形態の表示を変更
        toggleText.textContent = isPartTime ? 'パートタイム' : 'フルタイム';

        // 雇用形態の隠しフィールドに値を設定
        employmentTypeField.value = isPartTime ? 'parttime' : 'fulltime';

        // フィールドの必須状態と表示を切り替える
        if (isPartTime) {
            fulltimeFields.forEach(field => field.required = false);
            parttimeFields.forEach(field => field.required = true);
            document.getElementById('parttime-fields').classList.remove('hidden');
            document.getElementById('fulltime-fields').classList.add('hidden');
        } else {
            fulltimeFields.forEach(field => field.required = true);
            parttimeFields.forEach(field => field.required = false);
            document.getElementById('parttime-fields').classList.add('hidden');
            document.getElementById('fulltime-fields').classList.remove('hidden');
        }
    }

    function toggleFields2(toggle) {
        const isPartTime = toggle.checked;
        const toggleText = document.getElementById('toggle-text2'); // IDを修正
        const fulltimeFields = document.querySelectorAll('#fulltime-fields-2 input'); // フルタイム入力フィールド
        const parttimeFields = document.querySelectorAll('#parttime-fields-2 input'); // パートタイム入力フィールド
        const employmentTypeField = document.getElementById('employment-type-2'); // 2つ目の隠しフィールド

        // 雇用形態の表示を変更
        toggleText.textContent = isPartTime ? 'パートタイム' : 'フルタイム';

        // 雇用形態の隠しフィールドに値を設定
        employmentTypeField.value = isPartTime ? 'parttime' : 'fulltime';

        // フィールドの必須状態と表示を切り替える
        if (isPartTime) {
            fulltimeFields.forEach(field => field.required = false);
            parttimeFields.forEach(field => field.required = true);
            document.getElementById('parttime-fields-2').classList.remove('hidden'); // パートタイム表示
            document.getElementById('fulltime-fields-2').classList.add('hidden'); // フルタイム非表示
        } else {
            fulltimeFields.forEach(field => field.required = true);
            parttimeFields.forEach(field => field.required = false);
            document.getElementById('parttime-fields-2').classList.add('hidden'); // パートタイム非表示
            document.getElementById('fulltime-fields-2').classList.remove('hidden'); // フルタイム表示
        }
    }
</script>