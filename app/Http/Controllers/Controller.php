<?php

namespace App\Http\Controllers;

use App\ActionAttachments;
use App\ActionItems;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function index(){
        $actionItems = ActionItems::get();
        return view('home', compact('actionItems'));
    }

    public function store(Request $request){

        $inputs = $request->all();
        $v = Validator::make($inputs, [
            'attachment' => ['required', 'file', 'image']
        ]);

        if($v->fails()){
            return Redirect::back()->withErrors($v);
        }

        $filename = time().$inputs['attachment']->getClientOriginalName();

        Storage::disk('public')->putFileAs(
            'attachments/'.$filename,
            $inputs['attachment'],null
        );

//        create new attachment
        ActionAttachments::create(['attachment_path' => $filename, 'action_item_id' => $inputs['action_id'], 'user_id' => Auth::id()]);

        return Redirect::to('/');

    }

    public function getActionItem($id){
        $actionItem = ActionItems::where('id', $id)->first();
        return view('item', compact('actionItem'));
    }
}
