<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('ツール編集') }}
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="POST" action="{{route('tools.update',$tool)}}">
                        @csrf
                        @method('PUT')
                        <!-- ツール名 -->
                        <h1 class="text-xl font-bold text-gray-800 dark:text-gray-200">
                            {{$tool->name}}
                        </h1>

                        <!-- 値段 -->
                        <div class="mb-4">

                            <div class="flex items-center space-x-2">
                                <h1 class="text-gray-800 dark:text-gray-200"> ¥{{ intval($tool->price) }}-></h1>
                                <input type="number" name="price" id="price" step="0.01"
                                    class="shadow appearance-none border rounded w-64 py-2 px-3 text-gray-700 dark:text-gray-300 dark:bg-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                    placeholder="値段を編集">
                            </div>
                            @error('price')
                            <span class="text-red-500 text-xs italic">{{ $message }}</span>
                            @enderror
                        </div>
                        <button type="submit" class="bg-gray-500 hover:bg-black-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Update</button>
                    </form>
                </div>
            </div>
            <br>
            <a href="{{route('tools.index',$tool)}}" class="text-xl font-semibold text-gray-500 hover:text-black-700 mr-2">＜戻る</a>
        </div>
    </div>

</x-app-layout>