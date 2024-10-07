<?php

namespace App\Http\Controllers\Admin;

use App\BlogComment;
use App\Category;
use App\Http\Controllers\Controller;
use App\SuccessStory;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        $category = Category::where('mode', 1)->get();
        $page_title = "Success Story";
        return view('admin.success.create', compact('page_title', 'category'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'category' => 'required|numeric|min:1',
            'title' => 'required|min:5|max:300',
            'short_description' => 'required|min:5|max:200',
            'description' => 'required|min:100',
            'file' => 'required|image|mimes:jpg,png,jpeg',
        ]);

        if ($request->hasFile('file')) {
            try {

                $path = imagePath()['success']['path'];
                $size = imagePath()['success']['size'];

                $filename = uploadImage($request->file, $path, '720x600');
            } catch (\Exception $exp) {
                $notify[] = ['error', 'Could not upload icon.'];
                return back()->withNotify($notify);
            }
        }

        SuccessStory::create([
            'category_id' => $request->category,
            'title' => $request->title,
            'short_description' => $request->short_description,
            'details' => $request->description,
            'image' => $filename,
            'slug' => slug($request->title)
        ]);

        $notify[] = ['success', 'Created Successfully'];
        return back()->withNotify($notify);
    }


    public function showAll()
    {
        $success = SuccessStory::with('category')->latest()->paginate();
        $page_title = "All Success Story";
        return view('admin.success.showall', compact('page_title', 'success'));
    }

    public function details(Request $request)
    {
        $success = SuccessStory::with('category')->with('comment')->findOrFail($request->id);
        $page_title = "Success Story Details";

        return view('admin.success.details', compact('page_title', 'success'));
    }


    public function edit($slug, Request $request)
    {
        $category = Category::where('mode', 1)->get();
        $success = SuccessStory::where('slug', $slug)->findOrFail($request->id);

        $page_title = "All Success Story";
        return view('admin.success.edit', compact('page_title', 'success', 'category'));
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'success' => 'required|numeric|min:1',
            'category' => 'sometimes|required|numeric|min:1',
            'title' => 'sometimes|min:5|max:300',
            'short_description'=> 'required|min:5|max:200',
            'description' => 'sometimes|required|min:100',
            'file' => 'image|mimes:jpg,png,jpeg',
        ]);

        $success = SuccessStory::find($request->success);
        if ($request->hasFile('file')) {
            try {

                $path = imagePath()['success']['path'];
                $size = imagePath()['success']['size'];
                removeFile(imagePath()['success']['path'] . '/' . $success->image);

                $filename = uploadImage($request->file, $path, $size);

                $success->image = $filename;
                $success->save();
            } catch (\Exception $exp) {
                $notify[] = ['error', 'Could not upload icon.'];
                return back()->withNotify($notify);
            }
        }

        $success->category_id = $request->category;
        $success->title = $request->title;
        $success->details = $request->description;
        $success->short_description = $request->short_description;
        $success->save();


        $notify[] = ['success', 'Updated Succesfully'];
        return back()->withNotify($notify);
    }

    public function delete($slug)
    {
        $success = SuccessStory::where('slug', $slug)->first();

        removeFile(imagePath()['success']['path'] . '/' . $success->image);

        $success->delete();

        $notify[] = ['success', 'Deleted Succesfully'];
        return back()->withNotify($notify);
    }


    public function review()
    {

        $page_title = "Campaign Review";
        $empty_message = "No review";
        $comment = BlogComment::with('blog')->whereHas('blog')->latest()->paginate(10);
        return view('admin.success.review', compact('page_title', 'comment', 'empty_message'));
    }


    public function reviewUpdate(Request $request)
    {
        if ($request->status > 2 || $request->status < 0) {
            $notify[] = ['error', 'You Can not Modify The Values'];
            return redirect()->back()->withNotify($notify);
        }

        $this->validate($request, [
            'id' => 'required|numeric|exists:blog_comments,id',
            'status' => 'required|numeric',
        ]);

        $comment = BlogComment::find($request->id);

        $comment->status = $request->status;
        $comment->save();

        $notify[] = ['success', 'Updated successfull'];
        return redirect()->back()->withNotify($notify);
    }
}
