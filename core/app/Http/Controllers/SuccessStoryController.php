<?php

namespace App\Http\Controllers;

use App\BlogComment;
use App\Category;
use App\SuccessStory;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SuccessStoryController extends Controller
{
    public function __construct()
    {
        $this->activeTemplate = activeTemplate();
    }
    public function blogAll()
    {
        
        $page_title = 'All Success Story';
        $category = Category::where('mode',1)->whereHas('blog')->get();
        $blog = SuccessStory::latest()->with('category')->filter(request(['month','year','category']))->paginate(6);
        
        $archive = SuccessStory::selectRaw('year(created_at) Year, monthname(created_at) Month , count(*)')->groupBy('year','month')->get();
        $recent = SuccessStory::latest()->take(4)->get();

        return view($this->activeTemplate.'sections.allblog',compact('page_title','blog','category','archive','recent'));

    }
     public function showBlog($slug , Request $request)
     {
         
         $page_title = 'Success Story Details';
         $blog = SuccessStory::where('slug',$slug)->findOrFail($request->id);

         if($blog == null){
            abort(404);
         }

         $blog->view += 1;
         $blog->save();

         $category = Category::where('mode',1)->whereHas('blog')->get();
         $archive = SuccessStory::selectRaw('year(created_at) Year, monthname(created_at) Month , count(*)')->groupBy('year','month')->get();
         $recent = SuccessStory::latest()->take(4)->get();

        $comment = BlogComment::with('blog')->where('success_story_id' , $request->id)->where('status',1)->latest()->get();

         return view($this->activeTemplate.'blogDetails',compact('page_title','blog','category','archive','recent','comment'));
     }


     public function ajax(Request $request){

         $this->validate($request,[
            'search__field'=>'required',
         ]);

        $page_title = 'Search Story';

        $category = Category::where('mode',1)->whereHas('blog')->get();

        $blog = SuccessStory::where('title','LIKE','%'. $request->search__field .'%')->paginate(10);
        if($blog->count() <= 0){
            $notify[] = ['error', 'No Matching Story Found.'];
            return back()->withNotify($notify);
        }
        $archive = SuccessStory::selectRaw('year(created_at) Year, monthname(created_at) Month , count(*)')->groupBy('year','month')->get();

        $recent = SuccessStory::latest()->take(4)->get();

        return view($this->activeTemplate.'sections.allblog',compact('page_title','blog','category','archive','recent'));

     }
     public function team(Request $request){
        return view($this->activeTemplate.'success.team');

     }
     public function leaveComment(Request $request)
     {
         
         $this->validate($request,[
            'name' => 'required',
            'email' => 'required',
            'message' => 'required|max:500'
         ]);

         BlogComment::create([
             'success_story_id' => $request->id,
             'name' => $request->name,
             'email' => $request->email,
             'messages' => $request->message
         ]);


         $notify[] = ['success', 'Your Comment Has been Reviwed'];
         return back()->withNotify($notify)->withInput();
     }
}
