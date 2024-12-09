<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Insurance;

class InsuranceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // salaryはその等級の月額の最低
        Insurance::create([
            'salary' => 0,
            'health' => 3001.5,
            'health_care' => 3465.5,
            'welfare' => 8052,
        ]);
        Insurance::create([
            'salary' => 63000,
            'health' => 3519.0,
            'health_care' => 4063.0,
            'welfare' => 8052,
        ]);
        Insurance::create([
            'salary' => 73000,
            'health' => 4036.5,
            'health_care' => 4660.5,
            'welfare' => 8052,
        ]);
        Insurance::create([
            'salary' => 83000,
            'health' => 4554.0,
            'health_care' => 5258.0,
            'welfare' => 8052,
        ]);
        Insurance::create([
            'salary' => 93000,
            'health' => 5071.5,
            'health_care' => 5855.5,
            'welfare' => 8967,
        ]);
        Insurance::create([
            'salary' => 101000,
            'health' => 5382.0,
            'health_care' => 6214.0,
            'welfare' => 9516,
        ]);
        Insurance::create([
            'salary' => 101000,
            'health' => 5382.0,
            'health_care' => 6214.0,
            'welfare' => 9516,
        ]);
    }
}
