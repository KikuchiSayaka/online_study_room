<?php

namespace App\Http\Controllers;

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

        return view('my-page')
        ->with(compact('records'));
    }
}
