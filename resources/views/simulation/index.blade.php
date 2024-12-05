<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('simulation') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <form>
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
                    <script>
                        function toggleText(toggle) {
                            const text = toggle.checked ? 'パートタイム' : 'フルタイム';
                            document.getElementById('toggle-text').innerText = text;
                        }
                    </script>
                </div>
                <div  style="font-size: 20px;" class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("ツール代") }}


                </div>
                <div  style="font-size: 20px;" class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("備品代") }}
                    

                </div>
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">シミュレーションを実行
                </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>