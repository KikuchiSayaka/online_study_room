<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Log;

class OtherUserListController extends Controller
{
    public function update(Request $request)
    {
        $users = User::select('name','is_online','learning_content','total_minutes')
        ->where('is_online',1)
        ->orderBy('id','desc')
        ->take(7)
        ->get();

        // dd($users);

        // 何件習得できたかカウントする
        $count = count($users);

        // 上限値7から取得件数を引いて空室分を調べる
        $vacancies = 7-$count;

        // Log::info($users);

        return  response()
        ->json(compact('users', 'vacancies'),200);
    }
}
