<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ResultController extends Controller
{
    public function index(Request $request)
    {
        $request->validate([
            'equipment-cost' => 'required|numeric',
            'age' => 'required|numeric',
        ]);
        return view('result.index'); // resources/views/result/index.blade.php を表示
    }
    public function index2(Request $request)
    {
        $request->validate([
            'equipment-cost' => 'required|numeric',
            'age' => 'required|numeric',
        ]);
        return view('result.index2'); // resources/views/result/index.blade.php を表示
    }
}
