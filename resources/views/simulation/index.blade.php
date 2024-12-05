<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('simulation') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div  style="font-size: 20px;" class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("シミュレーション") }}

                </div>
                <div z style="font-size: 20px;" class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("雇用形態") }}

                </div>
                <div  style="font-size: 20px;" class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("ツール代") }}

                </div>
                <div z style="font-size: 20px;" class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("備品代") }}

                </div>
            </div>
        </div>
    </div>
</x-app-layout>