<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\UserUpdateRequest;
use App\Http\Requests\CreateAccountRequest;
use App\Http\Requests\ChangeNameRequest;
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

        $user = Auth::user();
        $email = $user->email;
        Log::info($email);

        return view('room')
        ->with(compact('users', 'vacancies', 'email'));
    }

    // ユーザ名と学習内容を変更するだけのフォーム
    public function update(ChangeNameRequest $request)
    {
        // Log::info($request->totalTime);
        $user = Auth::user();
        $user->name = $request->name;
        // userInfo.jsのJSONで、キーがcontentなので、$request->contentにしないといけない
        $user->learning_content = $request->content;
        $user->save();

        return response() ->json(compact('user'));
    }

    // 新規会員登録(初めてメアドと、パスワードを登録する)フォーム
    public function store(CreateAccountRequest $request)
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
