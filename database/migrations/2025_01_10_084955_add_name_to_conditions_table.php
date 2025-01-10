<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNameToConditionsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('conditions_table', function (Blueprint $table) {
            $table->string('name')->after('id'); // 必要に応じてカラムの位置を調整
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('conditions_table', function (Blueprint $table) {
            $table->dropColumn('name');
        });
    }
}

