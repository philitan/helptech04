<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ToggleController extends Controller
{
    public function update(Request $request)
    {
        $state = $request->input('state'); // true: パートタイム, false: フルタイム
        return response()->json(['message' => $state ? 'パートタイム' : 'フルタイム']);
    }
}
