<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('conditions_table', function (Blueprint $table) {
            $table->id();
            $table->integer('equipment_cost');
            $table->integer('age');
            $table->string('tool_cost')->nullable();
            $table->string('employment_type');
            $table->decimal('monthly_salary', 10, 2)->nullable();
            $table->decimal('commute_cost', 10, 2)->nullable();
            $table->decimal('hourly_wage', 10, 2)->nullable();
            $table->decimal('hours_per_day', 5, 2)->nullable();
            $table->integer('days_per_week')->nullable();
            $table->decimal('transport_cost', 10, 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('conditions_table');
    }
};
