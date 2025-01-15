<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('条件一覧') }}
        </h2>
    </x-slot>

    <div class="py-4">
        <a href="{{ route('conditions.create') }}" class="ml-4 px-4 py-4 bg-gray-700 text-white rounded-lg hover:bg-gray-800" style="position:fixed; z-index:900; bottom:5%; left: 50%; transform: translateX(-50%);">
            条件を追加する
        </a>

        <!-- 検索フォーム -->
        <form action="{{ route('conditions.search') }}" method="GET" class="mb-6">
            <div class="flex items-center justify-center">
                <input type="text" name="keyword"
                    class="shadow appearance-none border rounded py-2 px-3 text-gray-700 dark:text-gray-300 dark:bg-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    style="width: 80rem; margin-left:3%; "
                    placeholder="ツールを検索..."
                    value="{{ request('keyword') }}">
                <button type="submit" class="ml-4 px-4 py-2 bg-gray-700 text-white rounded-lg hover:bg-gray-800">
                    検索
                </button>
            </div>
        </form>

        @if($conditions->isEmpty())
            <p class="text-gray-800 dark:text-gray-300 text-lg text-center">
                条件が見つかりませんでした。
            </p>
        @else
            <div class="flex flex-wrap justify-center">
                @foreach($conditions as $condition)
                    <div class="mx-auto sm:px-6 lg:px-8 w-full sm:w-96 md:w-1/3">
                        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-4">
                            <div class="p-6 text-gray-900 dark:text-gray-100 flex flex-col items-center">
                                <!-- 条件名 -->
                                <p class="text-gray-800 dark:text-gray-300 text-lg text-center mb-2">
                                    {{ $condition->name ?? '未設定' }}
                                </p>

                                <!-- employment_type による条件分岐 -->
                                <p class="text-gray-800 dark:text-gray-300 text-lg font-bold text-center mb-2">
                                    職種: {{ ucfirst($condition->employment_type) }}
                                </p>

                                @if($condition->employment_type === 'fulltime')
                                    <!-- Fulltimeの場合 -->
                                    <p class="text-gray-800 dark:text-gray-300 text-lg font-bold text-center mb-2">
                                        設備費: ¥{{ $condition->equipment_cost }}
                                    </p>
                                    <p class="text-gray-800 dark:text-gray-300 text-lg font-bold text-center mb-2">
                                        月給: ¥{{ $condition->monthly_salary }}
                                    </p>
                                    <p class="text-gray-800 dark:text-gray-300 text-lg font-bold text-center mb-2">
                                        通勤費: ¥{{ $condition->commute_cost }}
                                    </p>
                                    <p class="text-gray-800 dark:text-gray-300 text-lg font-bold text-center mb-2">
                                        使用ツール:{{ $condition->tool_cost}}
                                    </p>
                                @else
                                    <!-- Parttimeの場合 -->
                                    <p class="text-gray-800 dark:text-gray-300 text-lg font-bold text-center mb-2">
                                        時給: ¥{{ $condition->hourly_wage }}
                                    </p>
                                    <p class="text-gray-800 dark:text-gray-300 text-lg font-bold text-center mb-2">
                                        1日の労働時間: {{ $condition->hours_per_day }} 時間
                                    </p>
                                    <p class="text-gray-800 dark:text-gray-300 text-lg font-bold text-center mb-2">
                                        1週間の労働日数: {{ $condition->days_per_week }} 日
                                    </p>
                                    <p class="text-gray-800 dark:text-gray-300 text-lg font-bold text-center mb-2">
                                        交通費: ¥{{ $condition->transport_cost }}
                                    </p>
                                    <p class="text-gray-800 dark:text-gray-300 text-lg font-bold text-center mb-2">
                                        使用ツール: {{ $condition->tool_cost }}
                                    </p>
                                @endif

                                <!-- 編集リンク -->
                                <a href="{{ route('conditions.edit', $condition) }}" class="text-gray-500 hover:text-black-700 text-center mb-2">
                                    編集
                                </a>

                                <!-- 削除フォーム -->
                                <form action="{{ route('conditions.destroy', $condition) }}" method="POST" onsubmit="return confirm('本当に削除しますか？');" class="text-center">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-gray-500 hover:text-black-700">
                                        削除
                                    </button>
                                </form>
                                <form action="{{ route('result.index3') }}" method="POST" onsubmit="return confirm('シミュレーションを実行しますか？');" class="text-center">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $condition->id }}">
                                    <input type="hidden" name="name" value="{{ $condition->name }}">
                                

                                    <!-- その他のフォームフィールド -->
                                    <input type="hidden" name="equipment-cost" value="{{ $condition->equipment_cost }}" required>
                                    <input type="hidden" name="age" value="{{ $condition->age }}" required>
                                    <input type="hidden" name="tool_cost" value="{{ is_array($condition->tool_cost) ? implode(', ', $condition->tool_cost) : $condition->tool_cost }}">
                                    <input type="hidden" name="employment-type" value="{{ $condition->employment_type }}" required>
                                    <input type="hidden" name="monthly-salary" value="{{ $condition->monthly_salary ?? '' }}">
                                    <input type="hidden" name="commute-cost" value="{{ $condition->commute_cost ?? '' }}">
                                    <input type="hidden" name="hourly-wage" value="{{ $condition->hourly_wage ?? '' }}">
                                    <input type="hidden" name="hours-per-day" value="{{ $condition->hours_per_day ?? '' }}">
                                    <input type="hidden" name="days-per-week" value="{{ $condition->days_per_week ?? '' }}">
                                    <input type="hidden" name="transport-cost" value="{{ $condition->transport_cost ?? '' }}">

                                    <button type="submit" class="text-gray-500 hover:text-black-700">
                                        シミュレーションの実行
                                    </button>
                                </form>                               
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

    </div>
    <div>
        {{ $conditions->links() }}
    </div>
</x-app-layout>