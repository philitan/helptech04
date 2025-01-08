<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Condition extends Model
{
    use HasFactory;

    protected $table = 'conditions_table'; // 正しいテーブル名を指定
    protected $fillable = [
        'name', 'equipment_cost', 'employment_type', 'monthly_salary', 
        'commute_cost', 'hourly_wage', 'hours_per_day', 'days_per_week', 
        'transport_cost', 'age', 'tool_cost'
    ];
}

