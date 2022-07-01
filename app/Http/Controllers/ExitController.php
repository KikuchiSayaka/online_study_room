<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Log;
use App\Models\Record;


class ExitController extends Controller
{

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $user = Auth::user();
        $user->is_online = 0;
        $user->save();

        $record = new Record;
        $record->name = $request->name;
        $record->learning_content = $request->learning_content;
        $record->total_minutes = $request->total_minutes;
        $record->save();

        return redirect()->route('exit');
    }

}
