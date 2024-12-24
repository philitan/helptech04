<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('ツール一覧') }}
        </h2>
    </x-slot>

    <div class="py-4">
        <a href="{{route('tools.create')}}" class="ml-4 px-4 py-4 bg-gray-700 text-white rounded-lg hover:bg-gray-800" style="margin-left: 6%;  position:fixed; z-index:900; bottom:5%;">ツールを追加する</a>
        <!-- 検索フォーム -->
        <form action="{{ route('tools.search') }}" method="GET" class="mb-6">
            <div class="flex items-center">
                <input type="text" name="keyword"
                    class="shadow appearance-none border rounded py-2 px-3 text-gray-700 dark:text-gray-300 dark:bg-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    style="width: 80rem; margin-left:3%; "
                    placeholder="ツールを検索..."
                    value="{{ request('keyword') }}">
                <button type="submit" class="ml-4 px-4 py-2 bg-gray-700 text-white rounded-lg hover:bg-gray-800" style="margin-right:3%">
                    検索
                </button>
            </div>
        </form>
        @foreach($tools as $tool)
        <div class="mx-auto sm:px-6 lg:px-8 w-[94%]">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-4">
                <div class="p-6 text-gray-900 dark:text-gray-100 flex justify-between items-center">
                    <!-- ツール名 -->
                    <p class="text-gray-800 dark:text-gray-300 text-lg">
                        {{ $tool->name }}
                    </p>
                    <div class="flex items-center justify-between w-64">
                        <!-- 値段 -->
                        <p class="text-gray-800 dark:text-gray-300 text-lg font-bold text-center flex-1">
                            ¥{{ intval($tool->price) }}
                        </p>

                        <!-- 編集リンク -->
                        <a href="{{ route('tools.edit', $tool) }}" class="text-gray-500 hover:text-black-700 text-center flex-1">
                            編集
                        </a>

                        <!-- 削除フォーム -->
                        <form action="{{ route('tools.destroy', $tool) }}" method="POST" onsubmit="return confirm('本当に削除しますか？');" class="text-center flex-1">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-gray-500 hover:text-black-700">
                                削除
                            </button>
                        </form>
                    </div>




                </div>
            </div>
        </div>
        @endforeach
    </div>

</x-app-layout>