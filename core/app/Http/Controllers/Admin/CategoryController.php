<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function index(){
        $category = Category::latest()->paginate(10);
        $page_title = 'Category Page';
        $empty_mesasage = 'No Category Has been Created Yet';
        $size = imagePath()['category']['size'];

        return view('admin.category.category',compact('page_title','empty_mesasage','category','size'));
    }

    public function store(Request $request){
        
        $this->validate($request,[
            'name'=>'required|max:50|unique:categories,id',
            'icon'=>'required|image|mimes:jpg,png,jpeg',
            'mode'=> 'required|integer'
        ]);


        if ($request->hasFile('icon')) {
            try {
                $path = imagePath()['category']['path'];
                $size = imagePath()['category']['size'];

                $filename = uploadImage($request->icon, $path, $size);
            } catch (\Exception $exp) {
                $notify[] = ['error', 'Could not upload icon.'];
                return back()->withNotify($notify);
            }
        }


        Category::create([
            'name'  =>    $request->name,
            'icon'  =>    $filename,
            'slug'  =>    $request->name,
            'mode'  =>    $request->mode
        ]);


        $notify[] = ['success', 'Category Created Successfully'];
        return back()->withNotify($notify);
    }

    public function updateCategory(Category $slug,Request $request){
        if($request->mode > 1 || $request->mode < 0){
            $notify[] = ['error', 'You cannot Modify The Value'];
            return back()->withNotify($notify);
        }

        $this->validate($request,[
            'name'=>'sometimes|required|max:50',
            'icon'=>'sometimes|required|image|mimes:jpg,png,jpeg',
            'mode'=> 'sometimes|required|integer'
        ]);
        

       

        if ($request->hasFile('icon')) {
            try {

                

                $path = imagePath()['category']['path'];
                $size = imagePath()['category']['size'];

                

                removeFile(imagePath()['category']['path'] . '/' . $slug->icon);
                
                $filename = uploadImage($request->icon, $path, $size);

                $slug->icon = $filename;
                $slug->save();

            } catch (\Exception $exp) {
                $notify[] = ['error', 'Could not upload icon.'];
                return back()->withNotify($notify);
            }
        }

        
        $slug->name = $request->name;
        $slug->mode = $request->mode;
        $slug->save();

        $notify[] = ['success', 'Updated Successfull'];
        return back()->withNotify($notify);

    }

}
