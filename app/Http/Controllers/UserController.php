<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\UserUpdateRequest;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::where('is_online',1)
                ->orderBy('id','desc')
                ->take(7)
                ->get();

        // dd($users);

        // 何件習得できたかカウントする
        $count = count($users);

        // 上限値7から取得件数を引いて空室分を調べる
        $vacancies = 7-$count;

        // Log::info($users);

        return view('room')
        ->with(compact('users', 'vacancies'));
    }

    public function update(Request $request)
    {
        // Log::info($request->totalTime);
        $user = Auth::user();
        $user->name = $request->name;
        // userInfo.jsのJSONで、キーがcontentなので、$request->contentにしないといけない
        $user->learning_content = $request->content;
        $user->save();

        return response() ->json(compact('user'));
        // view('room');
    }

    public function store(UserUpdateRequest $request)
    {


        $user = Auth::user();
        $user->name = $request ->name;
        // \Log::info($request->name);
        $user->email = $request ->email;
        $user->password = Hash::make($request ->password);

        $user->save();

        return response()->json(compact('user'));
    }
}
