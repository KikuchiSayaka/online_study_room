<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    public function index()
    {
        return view('room');
    }

    public function update(Request $request)
    {
        Log::info($request->totalTime);

        $user = Auth::user();
        $user->name = $request->name;
        // userInfo.jsのJSONで、キーがcontentなので、$request->contentにしないといけない
        $user->learning_content = $request->content;
        $user->save();

        return  view('room');
    }
}
