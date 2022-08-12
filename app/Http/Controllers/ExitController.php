<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Log;
use App\Models\Record;


class ExitController extends Controller
{
    public function index()
    {

        $user = Auth::user();
        $email = $user->email;
        // Log::info($email);
    // \Log::info($user);
        return view('exit')
        ->with(compact('user', 'email'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        // \Log::info('確認');
        $user = Auth::user();
        $user->is_online = 0;
        $user->save();

        if($user-> total_minutes >0 ){
            $record = new Record;
            $record->user_id = $user->id;
            $record->learning_content = $user->learning_content;
            $record->total_minutes = $user->total_minutes;
            $record->save();
        }


        // return redirect()->route('exit');
    }

}
