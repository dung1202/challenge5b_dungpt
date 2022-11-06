<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Messenger;
use Illuminate\Support\Facades\Auth;

class MessengerController extends Controller
{
    //
    public function create($id)
    {
        $messengers = Messenger::selectRaw('messengers.*, updated_at as time_update')->where([
            ['user_from', $id],
            ['parent_id', 0]
        ])->get();
        return view('messenger.add_messenger', compact('messengers'));
    }
    public function store(Request $request, $user, $mess, $from = null)
    {

            $request->validate([
                'messenger' => 'required',
            ], [
                'messenger.required' => 'Comment không được để trống',
            ]);
 
        $data = [
            'user_from' => $user,
            'user_to' => auth()->user()->id,
            'messenger' => $request->messenger,
            'parent_id' => $mess,
        ];
        $mess = Messenger::create($data);
        return redirect()->back();
    }
    public function edit($id)
    {
        if(!request()->ajax()) {
            return redirect()->back();
        }
        return response()->json([
            'error' => 0,
            'data' => Messenger::where('id', $id)->first()
        ]);
    }
    public function update(Request $request, $idMess)
    {

            $request->validate([
                'messenger' => 'required',
            ], [
                'messenger.required' => 'Comment không được để trống',
            ]);
  
        $data = [
            'messenger' => $request->messenger,
        ];
        $mess = Messenger::where('id', $idMess)->update($data);
        return redirect()->back();
    }
    public function delete($id)
    {
        $del = Messenger::where('id', $id)->delete();
        if( $del ) {
            return redirect()->back();
        }
        return abort(404);
    }
    public function notify()
    {
        $id = auth()->user()->id;
        $linkTo = Messenger::where('user_to', $id)->get()->groupBy('user_to');
        $linkFrom = Messenger::where([
            ['user_from', $id],
            ['parent_id', '=', 0]
        ])->get();
        return view('messenger.notify', compact('linkTo', 'linkFrom'));
    }
}
