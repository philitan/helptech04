<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('ツールの追加') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="POST" action="{{ route('tools.store') }}" enctype="multipart/form-data">
                        @csrf
                        <!-- ツール名 -->
                        <div class="mb-4">
                            <label for="tool_name" class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">ツール名</label>
                            <input type="text" name="tool_name" id="tool_name"
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 dark:text-gray-300 dark:bg-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                placeholder="ツール名を入力">
                            @error('tool_name')
                            <span class="text-red-500 text-xs italic">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- 値段 -->
                        <div class="mb-4">
                            <label for="price" class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">値段</label>
                            <input type="number" name="price" id="price" step="0.01"
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 dark:text-gray-300 dark:bg-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                placeholder="値段を入力">
                            @error('price')
                            <span class="text-red-500 text-xs italic">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- 送信ボタン -->
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                            保存
                        </button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>