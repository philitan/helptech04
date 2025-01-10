<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            条件を編集
        </h2>
    </x-slot>

    <div class="py-4">
        <form action="{{ route('conditions.update', $condition) }}" method="POST" class="w-full max-w-lg mx-auto">
            @csrf
            @method('PUT')

            <!-- 名前 -->
            <div class="mb-4">
                <label for="name" class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">
                    名前
                </label>
                <input type="text" name="name" id="name" value="{{ old('name', $condition->name) }}"
                       class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 dark:text-gray-300 dark:bg-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>

            <!-- 年齢 -->
            <div class="mb-4">
                <label for="age" class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">
                    年齢
                </label>
                <input type="number" name="age" id="age" value="{{ old('age', $condition->age) }}"
                       class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 dark:text-gray-300 dark:bg-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>

            <!-- その他のフィールド -->
            <div class="mb-4">
                <label for="equipment_cost" class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">
                    装備コスト
                </label>
                <input type="number" name="equipment_cost" id="equipment_cost" value="{{ old('equipment_cost', $condition->equipment_cost) }}"
                       class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 dark:text-gray-300 dark:bg-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>

            <div class="mb-4">
                <label for="employment_type" class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">
                    雇用形態
                </label>
                <select name="employment_type" id="employment_type"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 dark:text-gray-300 dark:bg-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    <option value="fulltime" {{ old('employment_type', $condition->employment_type) == 'fulltime' ? 'selected' : '' }}>正社員</option>
                    <option value="parttime" {{ old('employment_type', $condition->employment_type) == 'parttime' ? 'selected' : '' }}>アルバイト</option>
                </select>
            </div>

            <!-- 保存ボタン -->
            <div class="flex items-center justify-between">
                <button type="submit"
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    保存
                </button>
                <a href="{{ route('conditions.index') }}" class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800">
                    キャンセル
                </a>
            </div>
        </form>
    </div>
</x-app-layout>
