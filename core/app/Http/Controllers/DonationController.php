<?php

namespace App\Http\Controllers;

use App\Campaign;
use App\Deposit;
use App\Donation;
use App\GatewayCurrency;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class DonationController extends Controller
{
    public function __construct()
    {
        $this->activeTemplate = activeTemplate();
    }

    public function donation(Request $request){
        $campaign = Campaign::where('slug',$request->slug)->findOrFail($request->id);
        $page_title = "Donation Payment Method";
        if(Auth::check()){
            if($campaign->user_id == auth()->user()->id){
                $notify[] = ['error', 'You Can not Donate Your Own Campaign'];
                return back()->withNotify($notify);
            }
        }
        
       
        
        if(isset($request->anonymous)){
            
            $this->validate($request,[
                'amount'=>'numeric|required|min:1|max:10000',
                'anonymous' => 'numeric|min:1'
            ]);
            

            $donation = Donation::create([
                'user_id'=> $campaign->user_id,
                'campaign_id'=> $campaign->id,
                'anonymous' => 1,
                'fullname'=>'anonymous',
                'email' => 'anonymous@guest.com',
                'mobile'=>'anonymous',
                'country'=>'anonymous',
                'donation'=>$request->amount
            ]);


            $gatewayCurrency = GatewayCurrency::whereHas('method', function ($gate) {
                $gate->where('status', 1);
            })->with('method')->orderby('method_code')->get();
    
           return  view($this->activeTemplate.'user.payment.deposit',compact('page_title','donation','gatewayCurrency'));
            
        }

        

        $this->validate($request,[
            'amount'=>'integer|required|min:1|max:10000',
            'name'=>'required|min:3|max:200',
            'email'=>'required|email|max:300',
            'mobile'=>'required|min:3|max:50',
            'country'=>'required|min:3|max:200'
        ]);

        
        
        $donation = Donation::create([
            'user_id'=> $campaign->user_id,
            'campaign_id'=> $campaign->id,
            'fullname'=>$request->name,
            'email' => $request->email,
            'mobile'=>$request->mobile,
            'country'=>$request->country,
            'donation'=>$request->amount
        ]);
        $gatewayCurrency = GatewayCurrency::whereHas('method', function ($gate) {
            $gate->where('status', 1);
        })->with('method')->orderby('method_code')->get();

        return view($this->activeTemplate.'user.payment.deposit',compact('page_title','donation','gatewayCurrency'));
    }

    public function donationInsert(Request $request){
        
        $request->validate([
            'userid'=>'required|numeric',
            'donation_id'=>'required|numeric|min:1',
            'campaign_id'=>'required|numeric|min:1',
            'amount' => 'required|numeric|min:1',
            'method_code' => 'required',
            'currency' => 'required',
        ]);

        $campaign = Campaign::findOrFail($request->campaign_id);
        $donation = Donation::findOrFail($request->donation_id);

        

        $now = \Carbon\Carbon::now();
        if (session()->has('req_time') && $now->diffInSeconds(\Carbon\Carbon::parse(session('req_time'))) <= 2) {
            $notify[] = ['error', 'Please wait a moment, processing your deposit'];
            return redirect()->route('payment.preview')->withNotify($notify);
        }
        session()->put('req_time', $now);

        $gate = GatewayCurrency::where('method_code', $request->method_code)->where('currency', $request->currency)->first();


        if (!$gate) {
            $notify[] = ['error', 'Invalid Gateway'];
            return back()->withNotify($notify);
        }

        if ($gate->min_amount > $donation->donation || $gate->max_amount < $donation->donation) {
            $notify[] = ['error', 'Please Follow Deposit Limit'];
            return back()->withNotify($notify);
        }


        $charge = getAmount($gate->fixed_charge + ($donation->donation * $gate->percent_charge / 100));
        $payable = getAmount($donation->donation + $charge);
        $final_amo = getAmount($payable * $gate->rate);
       

        $depo['user_id'] =  $request->userid;
        $depo['donation_id'] = $request->donation_id;
        $depo['campaign_id'] = $request->campaign_id;
        $depo['method_code'] = $gate->method_code;
        $depo['method_currency'] = strtoupper($gate->currency);
        $depo['amount'] = $donation->donation;
        $depo['charge'] = $charge;
        $depo['rate'] = $gate->rate;
        $depo['final_amo'] = $final_amo;
        $depo['btc_amo'] = 0;
        $depo['btc_wallet'] = "";
        $depo['trx'] = getTrx();
        $depo['try'] = 0;
        $depo['status'] = 0;
        $data = Deposit::create($depo);
        Session::put('Track', $data['trx']);
        return redirect()->route('user.donation.preview');
    }

    public function preview(){
        $track = Session::get('Track');
        $data = Deposit::where('trx', $track)->orderBy('id', 'DESC')->firstOrFail();
        if (is_null($data)) {
            $notify[] = ['error', 'Invalid Deposit Request'];
            return redirect()->route('user.deposit')->withNotify($notify);
        }
        if ($data->status != 0) {
            $notify[] = ['error', 'Invalid Deposit Request'];
            return redirect()->route('user.deposit')->withNotify($notify);
        }
        $page_title = 'Payment Preview';
        return view($this->activeTemplate . 'user.payment.preview', compact('data', 'page_title'));
    }

    public function donationLog(Request $request){
        
        if($request->has('log')){
            $donation =  Donation::where('user_id', auth()->user()->id)->where('campaign_id',$request->log)->where('payment_status', 1)->get();
            $page_title = "Donation Log";
            $empty_message = "No Donation have been Made";
            return view($this->activeTemplate . 'sections.donationlog', compact('donation', 'page_title','empty_message'));
        }
        
        $donation =  Donation::where('user_id',auth()->user()->id)->where('payment_status',1)->get();
        $page_title ="Donation Log";
        return view($this->activeTemplate.'sections.donationlog',compact('donation','page_title'));
    }


    public function donationDetails($id){

        $donor = Donation::findOrFail($id);

        $page_title = "Donor Information";

        return view($this->activeTemplate.'sections.donationinfo',compact('page_title','donor'));

    }

    
}
