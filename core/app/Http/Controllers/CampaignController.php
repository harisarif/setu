<?php

namespace App\Http\Controllers;

use App\Campaign;
use App\Category;
use App\Donation;
use App\ExtendCampaign;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CampaignController extends Controller
{

    public function __construct()
    {
        $this->activeTemplate = activeTemplate();
    }

    public function showAll(){
       
       
        $page_title = 'All Campaigns';
        
        $now = Carbon::now()->subDay()->format('Y-m-d');

        $nowDate = Carbon::now();
        $campaigns = Campaign::where('stop_status',0)->where('approval',1)->where('complete_status',0)->where('deadline','>',$nowDate)->latest()->filters(request('category'))->paginate(9);
        
        $category = Category::where('mode',1)->whereHas('campaigns',function($query) use ($nowDate){
            $query->where('approval',1)->where('complete_status',0)->where('deadline','>',$nowDate)->where('stop_status', 0);
        })->latest()->get();
        
        $featured = Campaign::where('stop_status', 0)->where('featured',1)->where('deadline','>',$nowDate)->where('complete_status',0)->latest()->filters(request('category'))->get();
        
        // Top fundrises 
        $topcampaign = Donation::where('payment_status',1)->groupBy('campaign_id')->with('campaign')->whereHas('campaign',function($campaign) use($nowDate){
            $campaign->where('approval',1)
            ->where('complete_status',0)
            ->where('deadline','>',$nowDate)
            ->where('stop_status', 0)
            ->filters(request('category'));
        })->selectRaw('*,sum(donation) as donate')->orderBy('donate','desc')->take(3)->get()->map(function($campaign){
            return $campaign->campaign;
        });
        
        
        // Urgent Campaign
        $urgent = Campaign::where('stop_status', 0)->where('deadline','>',$nowDate)->where('complete_status',0)->where('rejected',0)->where('approval',1)->whereDate('deadline', '<=' , Carbon::now()->addDays(5))->latest()->get();
        
        $priceCampaign = Campaign::where('stop_status', 0)->where('approval',1)->where('deadline','>',$nowDate)->where('complete_status',0)->selectRaw('min(goal) as min , max(goal) as max')->first()->toArray();
        
        
        $date = Campaign::where('stop_status', 0)->where('deadline','>',$nowDate)->where('complete_status', 0)->where('rejected', 0)->where('approval', 1)->selectRaw('min(created_at) as minDate')->first()->toArray();
       
        $minDate = Carbon::parse($date['minDate'])->diffInDays($nowDate) + 1;

        return view($this->activeTemplate.'sections.allcampaigns',compact('page_title','campaigns','topcampaign','urgent','featured','category','priceCampaign','minDate'));

    }

    public function filterCampaign(Request $request)
    {
        $nowDate = Carbon::now();
        $campaigns =  Campaign::where('category_id',$request->id)
                                ->where('approval',1)
                                ->where('deadline','>',$nowDate)
                                ->where('stop_status', 0)
                                ->latest()
                                ->get();

        return view(activeTemplate().'campaign', compact('campaigns'));
    }

    public function campaignStop(Request $request)
    {
        $campaign = Campaign::findOrFail($request->id);

        if($campaign->stop_status){
            $campaign->stop_status = 0;
            $campaign->save();
            $notify[] = ['success', 'Campaign Started Successfully'];
            return back()->withNotify($notify);
        }

        $campaign->stop_status = 1;
        $campaign->save();


        $notify[] = ['success', 'Campaign Stopped Successfully'];
        return back()->withNotify($notify);

    }
    public function campaignComplete(Request $request)
    {
        $campaign = Campaign::findOrFail($request->id);

        $campaign->complete_status = 1;
        $campaign->save();

        $notify[] = ['success', 'Campaign Completed Successfully'];
        return back()->withNotify($notify);
    }

    public function filterCampaignByPrice(Request $request)
    {
        $amount = $request->amount;
        $filterPrice = filter_var($amount, FILTER_SANITIZE_NUMBER_INT);
        $priceArray = explode('-', $filterPrice);
        $nowDate = Carbon::now();
        $campaigns = Campaign::where('stop_status', 0)
                            ->where('approval',1)
                            ->where('complete_status',0)
                            ->where('deadline','>',$nowDate)
                            ->whereBetween('goal',$priceArray)
                            ->get();
        return view(activeTemplate() . 'campaign', compact('campaigns'));
    }


    public function filterCampaignByDate(Request $request)
    {
       $now= Carbon::now();
       $nowDate= Carbon::now();
       $previousDate = Carbon::parse($request->date);
       $date = [$previousDate,$now];
       $campaigns = Campaign::where('stop_status', 0)
                            ->where('approval', 1)
                            ->where('complete_status', 0)
                            ->where('deadline','>',$nowDate)
                            ->whereBetween('created_at',$date)
                            ->get();
       if($campaigns == null){
           return false;
       }
        return view(activeTemplate() . 'campaign', compact('campaigns'));
       
    }

    public function searchFilter(Request $request)
    {
        $nowDate = Carbon::now();
        $campaigns = Campaign::where('stop_status', 0)
                            ->where('approval',1)
                            ->where('complete_status',0)
                            ->where('deadline','>',$nowDate)
                            ->where('title','LIKE','%'.$request->search.'%')
                            ->get();
        return view(activeTemplate() . 'campaign', compact('campaigns'));
    }

    public function campaignFilterByCheckbox(Request $request)
    {
        $nowDate = Carbon::now();
       if($request->filter == 'urgent'){
            $campaigns = Campaign::where('stop_status', 0)->where('deadline','>',$nowDate)->where('complete_status', 0)->where('rejected', 0)->where('approval', 1)->whereDate('deadline', '<=', Carbon::now()->addDays(5))->latest()->get();
            $type="Urgent";
            return view(activeTemplate() . 'campaign', compact('campaigns','type'));
       }

       if($request->filter == 'feature'){
            $type = "Feature";
            $campaigns = Campaign::where('stop_status', 0)->where('featured', 1)->where('deadline','>',$nowDate)->where('complete_status', 0)->latest()->filters(request('category'))->get();
            return view(activeTemplate() . 'campaign', compact('campaigns','type'));
       }

       if($request->filter == 'top'){
            $campaigns = Donation::where('payment_status', 1)->groupBy('campaign_id')->with('campaign')->whereHas('campaign', function ($campaign) use($nowDate) {
                $campaign->where('approval', 1)
                ->where('complete_status', 0)
                ->where('deadline','>',$nowDate)
                    ->where('stop_status', 0)
                    ->filters(request('category'));
            })->selectRaw('*,sum(donation) as donate')->orderBy('donate', 'desc')->take(3)->get()->map(function ($campaign) {
                return $campaign->campaign;
            });
            $type = "Top";
            return view(activeTemplate() . 'campaign', compact('campaigns','type'));
       }
    }
    
    public function create(){
        $page_title = 'Create Fundrise';
        $category = Category::where('mode',1)->latest()->get();
        return view($this->activeTemplate.'user.fundrise.fundrise',compact('page_title','category'));
    }

    public function details(Request $request){
        $page_title = "Campaign Details";
        $campaign = Campaign::where('slug',$request->slug)->findOrFail($request->id);
        return view($this->activeTemplate.'sections.details',compact('page_title','campaign'));
    }


    public function storeCampaign(Request $request){
        $this->validate($request,[
            'category_id' => 'required|integer',
            'title' => 'required|max:200',
            'description'=>'required|min:200',
            'goal' =>'required|integer',
            'deadline'=>'required|after:today',
            'image' => 'required|image|mimes:jpg,png,jpeg',
            'attachments.*'=>'required|mimes:jpg,png,jpeg,pdf|max:10000',
            'featured'=> 'integer',
        ]);


        // Data store for User

        if ($request->hasFile('image')) {
            try {
                $path = imagePath()['campaign']['path'];
                $size = imagePath()['campaign']['size'];

                $filename = uploadImage($request->image, $path, $size);
            } catch (\Exception $exp) {
                $notify[] = ['error', 'Could not upload Image.'];
                return back()->withNotify($notify);
            }
        }

        if ($request->hasFile('attachments')) {
            try {
                $path = imagePath()['prof']['path'];
                $size = imagePath()['prof']['size'];
                $prof_submit = [];
                foreach($request->attachments as $key => $attachment){

                    if($attachment->getClientOriginalExtension() == 'pdf'){
                        $filename2 = uniqid() . time() . '.' . $attachment->getClientOriginalExtension();
                        
                        $prof = [
                            "prof_$key" => $filename2,
                        ];
                        $prof_submit = $prof_submit + $prof;
                        
                        $attachment->move($path,$filename2);
                        
                    }else{
                        $image = [
                            "prof_$key" =>uploadImage($attachment, $path, $size)
                        ];

                        $prof_submit =  $prof_submit + $image;
                        
                        
                    }
                    
                }
                
            } catch (\Exception $exp) {
                $notify[] = ['error', 'Could not upload Prof.'];
                return back()->withNotify($notify);
            }
        }
        
       $profData = json_encode($prof_submit);
        
        Campaign::create([
            'category_id' => $request->category_id,
            'user_id' =>auth()->user()->id,
            'title' => $request->title,
            'description' => $request->description,
            'goal' =>$request->goal,
            'deadline'=>$request->deadline,
            'image' => $filename,
            'image_prof'=>$profData,
            'featured'=> $request->featured,
            'slug' => str_slug($request->title ),
            'featured'=>$request->featured
        ]);

        $notify[] = ['success', 'Create Campaign Success'];
        return back()->withNotify($notify);
    }

    public function showAllFundrise(){
        
        $page_title="All Requested Fundrise";
        $campaign = Campaign::where('user_id',auth()->user()->id)->latest()->paginate(10);
        return view($this->activeTemplate.'user.fundrise.showall',compact('page_title','campaign'));
    }


    public function editRequest($slug, Request $request){
        $page_title = "Request Edit For Campaign ";
        $campaign = Campaign::where('slug',$slug)->where('user_id',auth()->id())->findOrFail($request->id);
        $category = Category::where('mode',1)->get();
        return view($this->activeTemplate.'user.fundrise.editreq',compact('page_title','campaign','category'));
    }
    
    public function sendRequest( Request $request,$slug){
        $existing = ExtendCampaign::where('slug',$slug)->where('approval',0)->where('campaign_id',$request->id)->where('rejected',0)->first();
        
        if(!empty($existing)){
            $notify[] = ['error', 'Already Have a Pending Update Request'];
            return back()->withNotify($notify);
        } 
        $filename = '';
        $profData = '';
        $this->validate($request,[
            'category_id' => 'sometimes|required|integer',
            'title' => 'sometimes|required|max:200',
            'description'=>'sometimes|required|min:200',
            'goal' =>'sometimes|required|integer',
            'deadline'=>'sometimes|required|after:today',
            'image' => 'sometimes|image|mimes:jpg,png,jpeg',
            'attachments.*'=>'sometimes|mimes:jpg,png,jpeg,pdf|max:10000',
            'featured'=> 'integer',
        ]);
        
        $campaign = Campaign::findOrFail($request->id);

        // Data store for User

        if ($request->hasFile('image')) {
            try {
                $path = imagePath()['campaign']['path'];
                $size = imagePath()['campaign']['size'];
                $filename = uploadImage($request->image, $path, $size);

            } catch (\Exception $exp) {
                $notify[] = ['error', 'Could not upload Image.'];
                return back()->withNotify($notify);
            }
        }

        if ($request->hasFile('attachments')) {
           
            try {
                $path = imagePath()['extendImage']['path'];
                $prof_submit = [];
                foreach($request->attachments as $key => $attachment){

                    if($attachment->getClientOriginalExtension() == 'pdf'){
                        $filename2 = uniqid() . time() . '.' . $attachment->getClientOriginalExtension();
                        
                        $prof = [
                            "prof_new_$key" => $filename2,
                        ];
                        $prof_submit = $prof_submit + $prof;
                        
                        $attachment->move($path,$filename2);
                        
                    }else{
                        $image = [
                            "prof_new_$key" =>uploadImage($attachment, $path)
                        ];

                        $prof_submit =  $prof_submit + $image;
                        
                        
                    }
                    
                }
                
            } catch (\Exception $exp) {
                $notify[] = ['error', 'Could not upload Proof.'];
                return back()->withNotify($notify);
            }
            $profData = json_encode($prof_submit);
        }

        ExtendCampaign::create([
            'category_id' => $request->category_id,
            'campaign_id' =>$campaign->id,
            'user_id' =>auth()->user()->id,
            'title' => $request->title,
            'description' => $request->description,
            'goal' =>$request->goal,
            'deadline'=>$request->deadline,
            'image' => $filename,
            'image_prof'=> $profData,
            'slug' => str_slug($request->title),
        ]);

        $notify[] = ['success', 'Campaign Update Request Send  Successfully'];
        return back()->withNotify($notify);
    }


    public function delete($slug, Request $request){
        
        $delete = Campaign::where('slug',$slug)->findOrFail($request->id);
        
        removeFile(imagePath()['campaign']['path'] . '/' . $delete->image);

        $imageProf = json_decode($delete->image_prof);
        foreach($imageProf as $image){
            removeFile(imagePath()['prof']['path'] . '/' . $image);
        }

        $delete->delete();

        $notify[] = ['success', 'Deleted Campaign Successfully'];
        return back()->withNotify($notify);

    }

    public function approvedCampaign()
    {
        $page_title = "Approved Campaigns";
        $campaign = Campaign::where('approval', 1)->where('user_id',auth()->id())->paginate(5);
        $category = Category::where('mode', 1)->get();
        return view($this->activeTemplate . 'user.fundrise.approved', compact('campaign', 'category', 'page_title'));
    }


    public function rejectedCampaign(){
        $page_title = "Rejected Campaigns";
        $campaign = Campaign::where('user_id',auth()->user()->id)->where('rejected',1)->paginate(5);
        $category = Category::where('mode',1)->get();
        return view($this->activeTemplate.'user.fundrise.rejected',compact('campaign','category','page_title'));
    }

    public function pending(){

        $page_title = 'Pending Campaigns';
        $campaign = Campaign::where('user_id',auth()->user()->id)->where('approval',0)->paginate(10);

        return view($this->activeTemplate.'user.fundrise.pending',compact('page_title','campaign'));
    }

    public function complete()
    {
        $page_title = 'Success Campaigns';
        $campaign = Campaign::where('user_id',auth()->user()->id)->where('complete_status',1)->paginate(10);

        return view($this->activeTemplate.'user.fundrise.complete',compact('page_title','campaign'));
    }


    public function detailsSingleCampaign(Request $request)
    {
        $page_title = "Campaign Details";
        $campaign = Campaign::where('slug', $request->slug)->findOrFail($request->id);

        return view($this->activeTemplate.'user.fundrise.campaingdetails',compact('page_title','campaign'));
    }

    public function expired()
    {
       
        $page_title = "Expired Campaigns";
        $now = Carbon::now();

        $campaign = Campaign::where('approval', 1)->where('deadline','<',$now)->where('user_id', auth()->id())->paginate(getPaginate(10));
        $category = Category::where('mode', 1)->get();
        
        return view($this->activeTemplate . 'user.fundrise.expired', compact('campaign', 'category', 'page_title'));
    }
}
