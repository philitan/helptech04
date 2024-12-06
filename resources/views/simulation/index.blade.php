<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('simulation') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <form method="POST">
                <div  style="font-size: 20px;" class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("シミュレーション") }}

                </div>
                <div  style="font-size: 20px;" class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("雇用形態") }}
                    <div class="flex items-center">
                        <label for="toggle" class="relative cursor-pointer">
                            <input type="checkbox" id="toggle" class="sr-only peer" onchange="toggleText(this)">
                            <div class="w-10 h-6 bg-gray-300 rounded-full peer-checked:bg-blue-500 peer-focus:ring-2 peer-focus:ring-blue-500 transition"></div>
                            <div class="w-4 h-4 bg-white rounded-full absolute top-1 left-1 peer-checked:translate-x-4 transition"></div>
                        </label>
                        <span id="toggle-text" class="ml-3 text-gray-900 dark:text-gray-100">フルタイム</span>
                    </div>

                    <!-- 月収 or 時給 入力フィールド -->
                    <input 
                        type="number" 
                        name="bihin" 
                        id="bihin" 
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 dark:text-gray-300 dark:bg-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        placeholder="月収を入力してください"
                        step="0.1"
                        min="0"
                    >

                    <!-- パートタイムの一日あたりの時間と週何日かを入力 -->
                    <div id="part-time-fields" class="hidden">
                        <div class="mt-4">
                            <label for="work-hours" class="block text-gray-700 dark:text-gray-300">一日あたりの時間</label>
                            <input 
                                type="number" 
                                name="work-hours" 
                                id="work-hours" 
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 dark:text-gray-300 dark:bg-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                placeholder="一日あたりの時間"
                                step="0.5"
                                max="24"
                                min="0"
                            >
                        </div>
                        <div class="mt-4">
                            <label for="work-days" class="block text-gray-700 dark:text-gray-300">週何日働くか</label>
                            <input 
                                type="number" 
                                name="work-days" 
                                id="work-days" 
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 dark:text-gray-300 dark:bg-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                placeholder="週何日働くか"
                                step="1"
                                max="7"
                                min="1"
                            >
                        </div>
                    </div>

                    <script>
                        function toggleText(toggle) {
                            const text = toggle.checked ? 'パートタイム' : 'フルタイム';
                            const placeholder = toggle.checked ? '時給を入力してください' : '月収を入力してください';

                            document.getElementById('toggle-text').innerText = text;
                            document.getElementById('bihin').placeholder = placeholder;

                            // パートタイムの場合は追加フィールドを表示
                            const partTimeFields = document.getElementById('part-time-fields');
                            if (toggle.checked) {
                                partTimeFields.classList.remove('hidden');
                            } else {
                                partTimeFields.classList.add('hidden');
                            }
                        }
                    </script>

                </div>
                <div  style="font-size: 20px;" class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("ツール代") }}


                </div>
                <div  style="font-size: 20px;" class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("備品代") }}
                    <input 
                        type="number" 
                        name="bihin" 
                        id="bihin" 
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 dark:text-gray-300 dark:bg-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        placeholder="費用を入力してください"
                        step="1"
                        min="0"
                    >

                    

                </div>
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">シミュレーションを実行
                </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>