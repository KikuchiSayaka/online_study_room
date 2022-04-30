<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Log;

class LearningTimeController extends Controller
{
    public function index()
    {
        return view('room');
    }


    public function update(Request $request)
    {
        Log::info($request->totalTime);

        $user = Auth::user();
        $user->total_minutes = $request->totalTime;
        $user->save();

        return  view('room');
    }
}
