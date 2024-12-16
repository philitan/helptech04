<?php
use App\Models\Tools;
?>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('シミュレーション結果') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                <?php
                    // dd($_POST);
                    foreach($_POST as $key => $value){
                        if($key === "tool-cost"){
                            echo "tool-cost {<br>";
                            foreach($value as $key2 => $value2){
                                $tools = Tools::where('name', '=', $value2)->get();
                                foreach($tools as $tool){
                                    $price = $tool->price;
                                    echo "　".$value2." = ".(int)$price."円<br>";
                                }
                            }
                            echo "}<br>";
                        }
                        else if($key !== "_token"){
                            if(!empty($value)){
                                echo $key." = ".$value."円<br>";
                            }
                        }
                    }
                ?>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>