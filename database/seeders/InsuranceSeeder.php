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
        // salaryはその等級の給料の範囲の最低
        // それ以外は保険料で全て折半額となっている
        // idは判別用につけているだけなのでコメントのままで
        Insurance::create([
            // id = 1
            'salary' => 0,
            'health' => 3001.5,
            'health_care' => 3465.5,
            'welfare' => 8052,
        ]);
        Insurance::create([
            // id = 2
            'salary' => 63000,
            'health' => 3519.0,
            'health_care' => 4063.0,
            'welfare' => 8052,
        ]);
        Insurance::create([
            // id = 3
            'salary' => 73000,
            'health' => 4036.5,
            'health_care' => 4660.5,
            'welfare' => 8052,
        ]);
        Insurance::create([
            // id = 4
            'salary' => 83000,
            'health' => 4554.0,
            'health_care' => 5258.0,
            'welfare' => 8052,
        ]);
        Insurance::create([
            // id = 5
            'salary' => 93000,
            'health' => 5071.5,
            'health_care' => 5855.5,
            'welfare' => 8967,
        ]);
        Insurance::create([
            // id = 6
            'salary' => 101000,
            'health' => 5382.0,
            'health_care' => 6214.0,
            'welfare' => 9516,
        ]);
        Insurance::create([
            // id = 7
            'salary' => 107000,
            'health' => 5692.5,
            'health_care' => 6572.5,
            'welfare' => 10065,
        ]);
        Insurance::create([
            // id = 8
            'salary' => 114000,
            'health' => 6106.5,
            'health_care' => 7050.5,
            'welfare' => 10797,
        ]);
        Insurance::create([
            // id = 9
            'salary' => 122000,
            'health' => 6520.5,
            'health_care' => 7528.5,
            'welfare' => 11529,
        ]);
        Insurance::create([
            // id = 10
            'salary' => 130000,
            'health' => 6934.5,
            'health_care' => 8006.5,
            'welfare' => 12261,
        ]);

        Insurance::create([
            // id = 11
            'salary' => 138000,
            'health' => 7348.5,
            'health_care' => 8484.5,
            'welfare' => 12993,
        ]);
        Insurance::create([
            // id = 12
            'salary' => 146000,
            'health' => 7762.5,
            'health_care' => 8962.5,
            'welfare' => 13725,
        ]);
        Insurance::create([
            // id = 13
            'salary' => 155000,
            'health' => 8280.0,
            'health_care' => 9560.0,
            'welfare' => 14640,
        ]);
        Insurance::create([
            // id = 14
            'salary' => 165000,
            'health' => 8797.5,
            'health_care' => 10157.5,
            'welfare' => 15555,
        ]);
        Insurance::create([
            // id = 15
            'salary' => 175000,
            'health' => 9315.0,
            'health_care' => 10755.0,
            'welfare' => 16470,
        ]);
        Insurance::create([
            // id = 16
            'salary' => 185000,
            'health' => 9832.5,
            'health_care' => 11352.5,
            'welfare' => 17385,
        ]);
        Insurance::create([
            // id = 17
            'salary' => 195000,
            'health' => 10350.0,
            'health_care' => 11950.0,
            'welfare' => 18300,
        ]);
        Insurance::create([
            // id = 18
            'salary' => 210000,
            'health' => 11385.0,
            'health_care' => 13145.0,
            'welfare' => 20130,
        ]);
        Insurance::create([
            // id = 19
            'salary' => 230000,
            'health' => 12420.0,
            'health_care' => 14340.0,
            'welfare' => 21960,
        ]);
        Insurance::create([
            // id = 20
            'salary' => 250000,
            'health' => 13455.0,
            'health_care' => 15535.0,
            'welfare' => 23790,
        ]);

        Insurance::create([
            // id = 21
            'salary' => 270000,
            'health' => 14490.0,
            'health_care' => 16730.0,
            'welfare' => 25620,
        ]);
        Insurance::create([
            // id = 22
            'salary' => 290000,
            'health' => 15525.0,
            'health_care' => 17925.0,
            'welfare' => 27450,
        ]);
        Insurance::create([
            // id = 23
            'salary' => 310000,
            'health' => 16560.0,
            'health_care' => 19120.0,
            'welfare' => 29280,
        ]);
        Insurance::create([
            // id = 24
            'salary' => 330000,
            'health' => 17595.0,
            'health_care' => 20315.0,
            'welfare' => 31110,
        ]);
        Insurance::create([
            // id = 25
            'salary' => 350000,
            'health' => 18630.0,
            'health_care' => 21510.0,
            'welfare' => 32940,
        ]);
        Insurance::create([
            // id = 26
            'salary' => 370000,
            'health' => 19665,
            'health_care' => 22705,
            'welfare' => 34770,
        ]);
        Insurance::create([
            // id = 27
            'salary' => 395000,
            'health' => 21217.5,
            'health_care' => 24497.5,
            'welfare' => 37515,
        ]);
        Insurance::create([
            // id = 28
            'salary' => 425000,
            'health' => 22770.0,
            'health_care' => 26290.0,
            'welfare' => 40260,
        ]);
        Insurance::create([
            // id = 29
            'salary' => 455000,
            'health' => 24322.5,
            'health_care' => 28082.5,
            'welfare' => 43005,
        ]);
        Insurance::create([
            // id = 30
            'salary' => 485000,
            'health' => 25875.0,
            'health_care' => 29875.0,
            'welfare' => 45750,
        ]);

        Insurance::create([
            // id = 31
            'salary' => 515000,
            'health' => 27427.5,
            'health_care' => 31667.5,
            'welfare' => 48495,
        ]);
        Insurance::create([
            // id = 32
            'salary' => 545000,
            'health' => 28980.0,
            'health_care' => 33460.0,
            'welfare' => 51240,
        ]);
        Insurance::create([
            // id = 33
            'salary' => 575000,
            'health' => 30532.5,
            'health_care' => 35252.5,
            'welfare' => 53985,
        ]);
        Insurance::create([
            // id = 34
            'salary' => 605000,
            'health' => 32085.0,
            'health_care' => 37045.0,
            'welfare' => 56730,
        ]);
        Insurance::create([
            // id = 35
            'salary' => 635000,
            'health' => 33637.5,
            'health_care' => 38837.5,
            'welfare' => 59475,
        ]);
        Insurance::create([
            // id = 36
            'salary' => 665000,
            'health' => 35190.0,
            'health_care' => 40630.0,
            'welfare' => 59475,
        ]);
        Insurance::create([
            // id = 37
            'salary' => 695000,
            'health' => 36742.5,
            'health_care' => 42422.5,
            'welfare' => 59475,
        ]);
        Insurance::create([
            // id = 38
            'salary' => 730000,
            'health' => 38812.5,
            'health_care' => 44812.5,
            'welfare' => 59475,
        ]);
        Insurance::create([
            // id = 39
            'salary' => 770000,
            'health' => 40882.5,
            'health_care' => 47202.5,
            'welfare' => 59475,
        ]);
        Insurance::create([
            // id = 40
            'salary' => 810000,
            'health' => 42952.5,
            'health_care' => 49592.5,
            'welfare' => 59475,
        ]);

        Insurance::create([
            // id = 41
            'salary' => 855000,
            'health' => 45540.0,
            'health_care' => 52580.0,
            'welfare' => 59475,
        ]);
        Insurance::create([
            // id = 42
            'salary' => 905000,
            'health' => 48127.5,
            'health_care' => 55567.5,
            'welfare' => 59475,
        ]);
        Insurance::create([
            // id = 43
            'salary' => 955000,
            'health' => 50715.0,
            'health_care' => 58555.0,
            'welfare' => 59475,
        ]);
        Insurance::create([
            // id = 44
            'salary' => 1005000,
            'health' => 53302.5,
            'health_care' => 61542.5,
            'welfare' => 59475,
        ]);
        Insurance::create([
            // id = 45
            'salary' => 1055000,
            'health' => 56407.5,
            'health_care' => 65127.5,
            'welfare' => 59475,
        ]);
        Insurance::create([
            // id = 46
            'salary' => 1115000,
            'health' => 59512.5,
            'health_care' => 68712.5,
            'welfare' => 59475,
        ]);
        Insurance::create([
            // id = 47
            'salary' => 1175000,
            'health' => 62617.5,
            'health_care' => 72297.5,
            'welfare' => 59475,
        ]);
        Insurance::create([
            // id = 48
            'salary' => 1235000,
            'health' => 65722.5,
            'health_care' => 75882.5,
            'welfare' => 59475,
        ]);
        Insurance::create([
            // id = 49
            'salary' => 1295000,
            'health' => 68827.5,
            'health_care' => 79467.5,
            'welfare' => 59475,
        ]);
        Insurance::create([
            // id = 50
            'salary' => 1355000,
            'health' => 71932.5,
            'health_care' => 83052.5,
            'welfare' => 59475,
        ]);
    }
}
