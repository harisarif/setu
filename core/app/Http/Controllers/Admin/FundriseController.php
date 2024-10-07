<?php

namespace App\Http\Controllers\Admin;

use App\Campaign;
use App\Comment;
use App\Donation;
use App\ExtendCampaign;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FundriseController extends Controller
{
    public function showAllFundReq(){
        
        $page_title = 'New Campaign Request';
        $empty_message = "No data Found";
        $campaign = Campaign::with('user')->with('category')->where('approval',0)->where('rejected',0)->latest()->paginate(10);
        $size = imagePath()['category']['size'];

        return view('admin.fundrise.fundreq',compact('campaign','page_title','empty_message','size'));
    }

    public function edit($slug,$id){
        $page_title = "Edit Campaign";
        $campaign = Campaign::findOrFail($id);

        $documents = json_decode($campaign->image_prof);

        $donate = $campaign->donation->where('payment_status', 1)->sum('donation');
        $donor = $campaign->donation->where('payment_status', 1)->count();
        $donorList = $campaign->donation->where('payment_status', 1);

        $percent  = ($donate * 100) / $campaign->goal;
        return view('admin.fundrise.editfund',compact('page_title','campaign','documents','donate','donor','donorList','percent'));
    }

    public function approve(Request $request){
       
        $campaign = Campaign::findOrFail($request->id);
        
        $campaign->approval = 1;
        $campaign->rejected = 0;

        $campaign->save();

        $notify[] = ['success', 'Approve Successfully'];
        return redirect()->route('admin.fundrise.approved')->withNotify($notify);
    }

    public function reject(Request $request){
        $campaign = Campaign::findOrFail($request->id);
        $campaign->rejected = 1;
        $campaign->approval = 0;
        $campaign->save();

        $notify[] = ['success', 'Rejected Successfully'];
        return redirect()->route('admin.fundrise.rejected')->withNotify($notify);
    }

    


    public function delete(Request $request){
        
        $delete = Campaign::findOrFail($request->id);
        
        $path = imagePath()['prof']['path'];
        $path2 = imagePath()['campaign']['path'];  
        unlink($path2.'/'.$delete->image);

        $prof = json_decode($delete->image_prof,true);
        foreach($prof as $pro){
            unlink($path.'/'.$pro);
        }


        $delete->delete();

        $notify[] = ['success', 'Deleted Successfully'];
        return back()->withNotify($notify);
        


    }

    public function fundRequest(){
        $update = ExtendCampaign::whereHas('campaign')->where('approval',0)->latest()->paginate(10);
        $page_title = 'Campaign Updated Request';
        $empty_message = "No data Found";
        
        return view('admin.fundrise.reqapproval',compact('update','page_title','empty_message'));

    }

    public function fundRequestEdit($slug,Request $request){
      
        $update = ExtendCampaign::where('slug',$slug)->where('approval',0)->where('rejected',0)->findOrFail($request->id);
        $page_title = 'Campaign Update Request';
        $empty_message = "No data Found";

        return view('admin.fundrise.editupdaterequest',compact('update','page_title','empty_message'));
    }

    public function fundRequestDelete(Request $request ,$slug)
    {
        
        
        $delete = ExtendCampaign::where('slug',$slug)->where('rejected',1)->findOrFail($request->id);

        $delete->delete();

        $notify[] = ['success', 'Successfully Deleted'];
        return redirect()->route('admin.fundrise.request')->withNotify($notify);
    }

    public function fundRequestEditApproved(Request $request, $slug){
       
        $extend = ExtendCampaign::where('slug',$slug)->where('approval',0)->where('rejected',0)->findOrFail($request->id);

        $campaign = Campaign::findOrFail($extend->campaign_id);
        
        $a = json_decode($campaign->image_prof,true);
        if($extend->image_prof != null){
            $b = json_decode($extend->image_prof,true);
            $data = array_merge($a,$b);
        }
        

        
        if($extend->image != null){
            $campaign->image = $extend->image;
        }

        if($extend->image_prof != null){
            $campaign->image_prof = json_encode($data);
        }
        $campaign->category_id = $extend->category_id;
        $campaign->title = $extend->title;
        $campaign->description = $extend->description;
        $campaign->goal = $extend->goal;
        $campaign->deadline = $extend->deadline;
        $campaign->expired = 0;
        $campaign->save();

        $extend->approval = 1;
        $extend->save();

        $notify[] = ['success', 'Successfully Accepted'];
        return redirect()->route('admin.fundrise.request')->withNotify($notify);
        
    }

    public function fundRequestEditrejected($slug,$id)
    {   
        $extend = ExtendCampaign::where('slug',$slug)->where('approval',0)->findOrFail($id);
        $extend->rejected = 1;

        $extend->save();
        $notify[] = ['success', 'Rejected Update Request'];
        return redirect()->route('admin.fundrise.request')->withNotify($notify);
    }

    public function approved()
    {
        $page_title = 'Approved Campaign';
        $empty_message = "No data Found";
        $campaign = Campaign::with('user')->with('category')->where('approval',1)->latest()->paginate(10);
        $size = imagePath()['category']['size'];

        return view('admin.fundrise.fundreq',compact('campaign','page_title','empty_message','size'));

    }

    public function pending()
    {
        $page_title = 'Pending Campaign';
        $empty_message = "No data Found";
        $campaign = Campaign::with('user')->with('category')->where('approval',0)->where('rejected',0)->latest()->paginate(10);
        $size = imagePath()['category']['size'];

        return view('admin.fundrise.fundreq',compact('campaign','page_title','empty_message','size'));

    }


    public function rejected()
    {
        $page_title = 'Rejected Campaign';
        $empty_message = "No data Found";
        $campaign = Campaign::with('user')->with('category')->where('rejected',1)->latest()->paginate(10);
        $size = imagePath()['category']['size'];

        return view('admin.fundrise.fundreq',compact('campaign','page_title','empty_message','size'));

    }

    // Donation 

    public function allDonor(Request $request)
    {
        
        $page_title = "Donation List";
        $donor = Donation::latest()->with('campaign')->whereHas('campaign')->filter(request(['counter','campaign']))->paginate(10);
        
        $empty_message = 'No Donation Found';
        
        return view('admin.donation.donation',compact('page_title','donor', 'empty_message'));
    }


    public function fundReview()
    {
        $page_title = "Campaign Review";
        $empty_message = "No review";

        $comment = Comment::with('campaign')->latest()->paginate(10);

        return view('admin.fundrise.review',compact('page_title','comment','empty_message'));
    }


    public function fundReviewPublished(Request $request)
    {
        if($request->status > 2 || $request->status < 0){
            $notify[] = ['error', 'You Can not Modify The Values'];
            return redirect()->back()->withNotify($notify);
        }

        $this->validate($request,[
            'id' => 'required|numeric|exists:comments',
            'details' => 'sometimes|required|exists:comments',
            'status' => 'required|numeric',
        ]);

        $comment = Comment::find($request->id);

        $comment->published = $request->status;
        $comment->save();
        
        $notify[] = ['success', 'Updated successfull'];
        return redirect()->back()->withNotify($notify);
        
    }

    public function running()
    {
        $page_title = 'Running Campaign';
        $empty_message = "No data Found";
        $campaign = Campaign::with('user')->with('category')->where('approval',1)->where('complete_status',0)->where('rejected',0)->where('expired',0)->latest()->paginate(10);
        $size = imagePath()['category']['size'];

        return view('admin.fundrise.fundreq',compact('campaign','page_title','empty_message','size'));
    }


    public function success(){
        $page_title = 'Successfull Campaign';
        $empty_message = "No data Found";
        $campaign = Campaign::with('user')->with('category')->where('complete_status',1)->latest()->paginate(10);
        $size = imagePath()['category']['size'];

        return view('admin.fundrise.fundreq',compact('campaign','page_title','empty_message','size'));
    }


    public function featured(Request $request)
    {
        $campaign = Campaign::findOrFail($request->id);
        
        $campaign->featured = $request->status;

        $campaign->save();
        
    }
}
