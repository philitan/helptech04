<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('ツール一覧') }}
        </h2>
    </x-slot>

    <div class="py-4">
        <!-- 検索フォーム -->
        <form action="{{ route('tools.index') }}" method="GET" class="mb-6">
            <div class="flex items-center">
                <input type="text" name="keyword"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 dark:text-gray-300 dark:bg-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    placeholder="ツールを検索..."
                    value="{{ request('keyword') }}">
                <button type="submit" class="ml-4 px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-700">
                    検索
                </button>
            </div>
        </form>

        @foreach($tools as $tool)
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-4">
                <div class="p-6 text-gray-900 dark:text-gray-100 flex justify-between items-center">
                    <!-- ツール名 -->
                    <p class="text-gray-800 dark:text-gray-300 text-lg">
                        {{ $tool->name }}
                    </p>
                    <!-- 値段 -->
                    <p class="text-gray-800 dark:text-gray-300 text-lg font-bold">
                        ¥{{ intval($tool->price) }}
                    </p>
                </div>
            </div>
        </div>
        @endforeach

    </div>
</x-app-layout>