<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function comment(Request $request)
    {
        $this->validate($request,[
            'campaign' => 'required|numeric',
            'fullname' => 'required|min:3|max:200',
            'email' => 'required|email',
            'details' => 'required|min:10|max:2000',

        ]);


        Comment::create([
            'campaign_id' => $request->campaign,
            'fullname' => $request->fullname,
            'email' => $request->email,
            'details' => $request->details
        ]);


        $notify[] = ['success', 'Comment Successfully Saved! Please Wait for Approval'];
            return redirect()->back()->withNotify($notify);


        
    }
}
