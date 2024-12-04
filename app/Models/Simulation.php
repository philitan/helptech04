<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Simulation extends Model
{
    /** @use HasFactory<\Database\Factories\SimulationFactory> */
    use HasFactory;

    protected $fillable = ['simulation'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
