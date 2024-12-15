<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ResultController extends Controller
{
    public function index(Request $request)
    {
        $request->validate([
            'equipment-cost' => 'required|numeric',
        ]);
        return view('result.index'); // resources/views/result/index.blade.php を表示
    }
}