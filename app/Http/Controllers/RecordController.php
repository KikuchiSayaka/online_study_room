<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Models\Record;
use Auth;

class RecordController extends Controller
{
    // 記録一覧を表示させる
    public function index()
    {
        $records = Record::where('user_id',Auth::id())
                ->orderBy('id','desc')
                ->take(10)
                ->get();

        $user = Auth::user();
        $email = $user->email;
        // Log::info($email);

        return view('my-page')
        ->with(compact('records', 'email'));
    }
}
