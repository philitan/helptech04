<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in!") }}
                </div>
            <!-- 以下、計算のテスト用 -->
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <?php
                    use App\Models\Insurance;

                    $kihon = 100000;
                    $insurance = Insurance::where('salary', '<=', "$kihon")->get();
                    $insurance2 = $insurance::first();
                    echo $kihon;
                    ?>
                </div>
            <!-- テスト用ここまで -->
            </div>
        </div>
    </div>
</x-app-layout>