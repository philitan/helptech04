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
        // テスト用に短めで作成(金額は全額で計算)
        // salaryはその等級の月額の最低
        Insurance::create([
            'salary' => 0,
            'health' => 6003,
            'health_care' => 6931,
            'welfare' => 16104,
        ]);
        Insurance::create([
            'salary' => 63000,
            'health' => 7038,
            'health_care' => 8126,
            'welfare' => 16104,
        ]);
        Insurance::create([
            'salary' => 73000,
            'health' => 8073,
            'health_care' => 9321,
            'welfare' => 16104,
        ]);
        Insurance::create([
            'salary' => 83000,
            'health' => 9108,
            'health_care' => 10516,
            'welfare' => 16104,
        ]);
        Insurance::create([
            'salary' => 93000,
            'health' => 10143,
            'health_care' => 11711,
            'welfare' => 17934,
        ]);
        Insurance::create([
            'salary' => 101000,
            'health' => 10764,
            'health_care' => 12428,
            'welfare' => 19032,
        ]);
    }
}
