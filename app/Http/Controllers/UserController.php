<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class UserController extends Controller
{
    public function index()
    {
        return view('room');
    }

    public function update(Request $request)
    {
        \Log::info($request->content);

        $user = Auth::user();
        $user->name = $request->name;
        $user->learning_content = $request->content;
        $user->save();



        return  view('room');
    }
}
