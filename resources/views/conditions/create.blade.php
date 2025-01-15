<?php
use App\Models\Tools;
?>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('simulation') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <form action="{{ route('conditions.store') }}" method="POST">
                    @csrf
                    <!-- 共通の項目 -->
                    <div id="common-fields" class="mb-6">
                        
                       <div>
                            <label for="name" class="block text-gray-700 dark:text-gray-300">名前の入力</label>
                            <input 
                                type="text" 
                                name="name" 
                                id="name" 
                                class="shadow appearance-none border rounded w-96 py-2 px-3 text-gray-700 dark:text-gray-300 dark:bg-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                placeholder="名前を入力してください"
                                required
                                value="{{ old('name') }}"
                            >
                            @error('name')
                                <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="age" class="block text-gray-700 dark:text-gray-300">年齢(歳)</label>
                            <input 
                                type="number" 
                                name="age" 
                                id="age" 
                                class="shadow appearance-none border rounded w-96 py-2 px-3 text-gray-700 dark:text-gray-300 dark:bg-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                placeholder="年齢を入力してください(歳)"
                                step="1"
                                min="0"
                                required
                            >
                        </div>
                        <div>
                            <label for="equipment-cost" class="block text-gray-700 dark:text-gray-300">初期費用</label>
                            <input 
                                type="number" 
                                name="equipment-cost" 
                                id="equipment-cost" 
                                class="shadow appearance-none border rounded w-96 py-2 px-3 text-gray-700 dark:text-gray-300 dark:bg-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                placeholder="初期費用を入力してください"
                                min="0"
                                required
                            >
                        </div>
                        
                        <!-- チェックboxの処理 -->
                        <div>
                            <label for="tool-cost" class="block text-gray-700 dark:text-gray-300">現在使用しているツールの選択</label>
                            <?php
                            $tools = Tools::select('name')->get();
                            foreach ($tools as $item) {
                                $value = $item["name"];
                                echo '<div class="flex items-center space-x-3 mb-2">';
                                echo '<input type="checkbox" id="tool-cost" name="tool-cost[]" value="'.$value.'" class="text-gray-700 dark:text-gray-300 bg-gray-100 dark:bg-gray-800 border rounded p-2 focus:outline-none focus:ring-2 focus:ring-blue-500">';
                                echo '<label for="tool-cost" class="text-gray-700 dark:text-gray-300">'.$value.'</label>';
                                echo '</div>';
                            }
                            ?>
                        </div>

                    </div>

                    <!-- 雇用形態の切り替え -->
                    <div style="font-size: 20px;" class="p-6 text-gray-900 dark:text-gray-100">
                        {{ __("雇用形態") }}
                        <div class="flex items-center">
                            <label for="toggle" class="relative cursor-pointer">
                                <input type="checkbox" id="toggle" class="sr-only peer" onchange="toggleFields(this)">
                                <div class="w-10 h-6 bg-gray-300 rounded-full peer-checked:bg-blue-500 peer-focus:ring-2 peer-focus:ring-blue-500 transition"></div>
                                <div class="w-4 h-4 bg-white rounded-full absolute top-1 left-1 peer-checked:translate-x-4 transition"></div>
                            </label>
                            <span id="toggle-text" class="ml-3 text-gray-900 dark:text-gray-100">フルタイム</span>
                        </div>
                    </div>
                    <input type="hidden" name="employment-type" id="employment-type" value="fulltime">

                    <!-- フルタイム用 -->
                    <div id="fulltime-fields" class="mt-4">
                        <div>
                            <label for="monthly-salary" class="block text-gray-700 dark:text-gray-300">月収(円)</label>
                            <input 
                                type="number" 
                                name="monthly-salary" 
                                id="monthly-salary" 
                                class="shadow appearance-none border rounded w-96 py-2 px-3 text-gray-700 dark:text-gray-300 dark:bg-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                placeholder="月収を入力してください(万円)"
                                step="0.1"
                                min="0"
                            >
                        </div>
                        <div class="mt-4">
                            <label for="commute-cost" class="block text-gray-700 dark:text-gray-300">1月あたりの定期代金(円)</label>
                            <input 
                                type="number" 
                                name="commute-cost" 
                                id="commute-cost" 
                                class="shadow appearance-none border rounded w-96 py-2 px-3 text-gray-700 dark:text-gray-300 dark:bg-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                placeholder="定期代金を入力してください"
                                min="0"
                            >
                        </div>
                    </div>

                    <!-- パートタイム用 -->
                    <div id="parttime-fields" class="hidden mt-4">
                        <div>
                            <label for="hourly-wage" class="block text-gray-700 dark:text-gray-300">時給(円)</label>
                            <input 
                                type="number" 
                                name="hourly-wage" 
                                id="hourly-wage" 
                                class="shadow appearance-none border rounded w-96 py-2 px-3 text-gray-700 dark:text-gray-300 dark:bg-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                placeholder="時給を入力してください(円)"
                                step="1"
                                min="0"
                            >
                        </div>
                        <div class="mt-4">
                            <label for="hours-per-day" class="block text-gray-700 dark:text-gray-300">1日に働く時間</label>
                            <input 
                                type="number" 
                                name="hours-per-day" 
                                id="hours-per-day" 
                                class="shadow appearance-none border rounded w-96 py-2 px-3 text-gray-700 dark:text-gray-300 dark:bg-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                placeholder="1日に働く時間"
                                step="0.5"
                                max="24"
                                min="0"
                            >
                        </div>
                        <div class="mt-4">
                            <label for="days-per-week" class="block text-gray-700 dark:text-gray-300">1週間に働く日数</label>
                            <input 
                                type="number" 
                                name="days-per-week" 
                                id="days-per-week" 
                                class="shadow appearance-none border rounded w-96 py-2 px-3 text-gray-700 dark:text-gray-300 dark:bg-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                placeholder="1週間に働く日数"
                                step="1"
                                max="7"
                                min="1"
                            >
                        </div>
                        <div class="mt-4">
                            <label for="transport-cost" class="block text-gray-700 dark:text-gray-300">1日あたりの交通費</label>
                            <input 
                                type="number" 
                                name="transport-cost" 
                                id="transport-cost" 
                                class="shadow appearance-none border rounded w-96 py-2 px-3 text-gray-700 dark:text-gray-300 dark:bg-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                placeholder="1日あたりの交通費"
                                step="1"
                                min="0"
                            >
                        </div>
                    </div>

                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline mt-6">
                        コンディションを保存
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    function toggleFields(toggle) {
        const isPartTime = toggle.checked;
        const toggleText = document.getElementById('toggle-text');
        const fulltimeFields = document.querySelectorAll('#fulltime-fields input');
        const parttimeFields = document.querySelectorAll('#parttime-fields input');
        const employmentTypeField = document.getElementById('employment-type'); // 隠しフィールドの取得

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
</script>