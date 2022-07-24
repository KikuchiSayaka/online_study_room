<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

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

    public function store(Request $request)
    {
        // Log::info('押した');

        $user = Auth::user();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;

        $user->save();

        return response() ->json(compact('user'));
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:12', 'confirmed'],
        ]);
    }

}
