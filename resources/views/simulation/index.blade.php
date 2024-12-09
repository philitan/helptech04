<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('simulation') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <form action="{{ route('result.index') }}" method="GET">
                    
                    <!-- 共通の項目 -->
                    <div id="common-fields" class="mb-6">
                        <div>
                            <label for="equipment-cost" class="block text-gray-700 dark:text-gray-300">備品の代金</label>
                            <input 
                                type="number" 
                                name="equipment-cost" 
                                id="equipment-cost" 
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 dark:text-gray-300 dark:bg-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                placeholder="備品の代金を入力してください"
                                step="1"
                                min="0"
                            >
                        </div>
                        <div class="mt-4">
                            <label for="tool-cost" class="block text-gray-700 dark:text-gray-300">ツールの代金</label>
                            <input 
                                type="number" 
                                name="tool-cost" 
                                id="tool-cost" 
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 dark:text-gray-300 dark:bg-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                placeholder="ツールの代金を入力してください"
                                step="1"
                                min="0"
                            >
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

                    <!-- フルタイム用 -->
                    <div id="fulltime-fields" class="mt-4">
                        <div>
                            <label for="monthly-salary" class="block text-gray-700 dark:text-gray-300">月収</label>
                            <input 
                                type="number" 
                                name="monthly-salary" 
                                id="monthly-salary" 
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 dark:text-gray-300 dark:bg-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                placeholder="月収を入力してください"
                                step="1"
                                min="0"
                            >
                        </div>
                        <div class="mt-4">
                            <label for="commute-cost" class="block text-gray-700 dark:text-gray-300">定期代金</label>
                            <input 
                                type="number" 
                                name="commute-cost" 
                                id="commute-cost" 
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 dark:text-gray-300 dark:bg-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                placeholder="定期代金を入力してください"
                                step="1"
                                min="0"
                            >
                        </div>
                    </div>

                    <!-- パートタイム用 -->
                    <div id="parttime-fields" class="hidden mt-4">
                        <div>
                            <label for="hourly-wage" class="block text-gray-700 dark:text-gray-300">時給</label>
                            <input 
                                type="number" 
                                name="hourly-wage" 
                                id="hourly-wage" 
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 dark:text-gray-300 dark:bg-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                placeholder="時給を入力してください"
                                step="1"
                                min="0"
                            >
                        </div>
                        <div class="mt-4">
                            <label for="hours-per-day" class="block text-gray-700 dark:text-gray-300">働く時間/日</label>
                            <input 
                                type="number" 
                                name="hours-per-day" 
                                id="hours-per-day" 
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 dark:text-gray-300 dark:bg-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                placeholder="働く時間/日"
                                step="0.5"
                                max="24"
                                min="0"
                            >
                        </div>
                        <div class="mt-4">
                            <label for="days-per-week" class="block text-gray-700 dark:text-gray-300">働く日数/週</label>
                            <input 
                                type="number" 
                                name="days-per-week" 
                                id="days-per-week" 
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 dark:text-gray-300 dark:bg-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                placeholder="働く日数/週"
                                step="1"
                                max="7"
                                min="1"
                            >
                        </div>
                        <div class="mt-4">
                            <label for="transport-cost" class="block text-gray-700 dark:text-gray-300">交通費/日</label>
                            <input 
                                type="number" 
                                name="transport-cost" 
                                id="transport-cost" 
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 dark:text-gray-300 dark:bg-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                placeholder="交通費/日"
                                step="1"
                                min="0"
                            >
                        </div>
                    </div>

                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline mt-6">
                        シミュレーションを実行
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
        const fulltimeFields = document.getElementById('fulltime-fields');
        const parttimeFields = document.getElementById('parttime-fields');

        toggleText.innerText = isPartTime ? 'パートタイム' : 'フルタイム';
        if (isPartTime) {
            fulltimeFields.classList.add('hidden');
            parttimeFields.classList.remove('hidden');
        } else {
            fulltimeFields.classList.remove('hidden');
            parttimeFields.classList.add('hidden');
        }
    }
</script>
