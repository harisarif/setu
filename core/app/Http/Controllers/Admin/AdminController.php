<?php

namespace App\Http\Controllers\Admin;

use App\Campaign;
use App\Deposit;
use App\Donation;
use App\Gateway;
use App\User;
use App\UserLogin;
use App\Withdrawal;
use App\WithdrawMethod;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Volunteer;
use Illuminate\Validation\Rule;

class AdminController extends Controller
{

    public function dashboard()
    {
        $page_title = 'Dashboard';

        // User Info
        $widget['total_users'] = User::count();
        $widget['verified_users'] = User::where('status', 1)->count();
        $widget['email_unverified_users'] = User::where('ev', 0)->count();
        $widget['sms_unverified_users'] = User::where('sv', 0)->count();

        // campaign
        $widget['total_campaign'] = Campaign::where('approval', 1)->count();
        $widget['total_donation'] = Donation::where('payment_status', 1)->sum('donation');
        $widget['total_donor'] = Donation::groupBy('email')->where('payment_status', 1)->get()->count();

        // Total Withdraw

        $widget['total_withdraw'] = Withdrawal::where('status', 1)->sum('amount');

        // Monthly Deposit & Withdraw Report Graph
        $report['months'] = collect([]);
        $report['deposit_month_amount'] = collect([]);
        $report['withdraw_month_amount'] = collect([]);

        $depositsMonth = Deposit::whereYear('created_at', '>=', Carbon::now()->subYear())
            ->selectRaw("SUM( CASE WHEN status = 1 THEN amount END) as depositAmount")
            ->selectRaw("DATE_FORMAT(created_at,'%M') as months")
            ->orderBy('created_at')
            ->groupBy(DB::Raw("MONTH(created_at)"))->get();

        $depositsMonth->map(function ($aaa) use ($report) {
            $report['months']->push($aaa->months);
            $report['deposit_month_amount']->push(getAmount($aaa->depositAmount));
        });

        $withdrawalMonth = Withdrawal::whereYear('created_at', '>=', Carbon::now()->subYear())->where('status', 1)
            ->selectRaw("SUM( CASE WHEN status = 1 THEN amount END) as withdrawAmount")
            ->selectRaw("DATE_FORMAT(created_at,'%M') as months")
            ->orderBy('created_at')
            ->groupBy(DB::Raw("MONTH(created_at)"))->get();
        $withdrawalMonth->map(function ($bb) use ($report) {
            $report['withdraw_month_amount']->push(getAmount($bb->withdrawAmount));
        });




        // Withdraw Graph
        $withdrawal = Withdrawal::where('created_at', '>=', \Carbon\Carbon::now()->subDays(30))->where('status', 1)
            ->select(array(DB::Raw('sum(amount)   as totalAmount'), DB::Raw('DATE(created_at) day')))
            ->groupBy('day')->get();
        $withdrawals['per_day'] = collect([]);
        $withdrawals['per_day_amount'] = collect([]);
        $withdrawal->map(function ($a) use ($withdrawals) {
            $withdrawals['per_day']->push(date('d M', strtotime($a->day)));
            $withdrawals['per_day_amount']->push($a->totalAmount + 0);
        });


        // user Browsing, Country, Operating Log
        $user_login_data = UserLogin::whereDate('created_at', '>=', \Carbon\Carbon::now()->subDay(30))->get(['browser', 'os', 'country']);

        $chart['user_browser_counter'] = $user_login_data->groupBy('browser')->map(function ($item, $key) {
            return collect($item)->count();
        });
        $chart['user_os_counter'] = $user_login_data->groupBy('os')->map(function ($item, $key) {
            return collect($item)->count();
        });
        $chart['user_country_counter'] = $user_login_data->groupBy('country')->map(function ($item, $key) {
            return collect($item)->count();
        })->sort()->reverse()->take(5);

        $payment['payment_method'] = Gateway::count();
        $payment['total_deposit_amount'] = Deposit::where('status', 1)->sum('amount');
        $payment['total_deposit_charge'] = Deposit::where('status', 1)->sum('charge');
        $payment['total_deposit_pending'] = Deposit::where('status', 2)->count();
        $payment['total_deposit'] = Deposit::where('status', 1)->count();

        $paymentWithdraw['withdraw_method'] = WithdrawMethod::count();
        $paymentWithdraw['total_withdraw_amount'] = Withdrawal::where('status', 1)->sum('amount');
        $paymentWithdraw['total_withdraw'] = Withdrawal::where('status', 1)->count();
        $paymentWithdraw['total_withdraw_charge'] = Withdrawal::where('status', 1)->sum('charge');
        $paymentWithdraw['total_withdraw_pending'] = Withdrawal::where('status', 2)->count();


        $latestUser = User::latest()->limit(6)->get();

        return view('admin.dashboard', compact('page_title', 'widget', 'report', 'withdrawals', 'chart', 'payment', 'paymentWithdraw', 'latestUser'));
    }


    public function profile()
    {
        $page_title = 'Profile';
        $admin = Auth::guard('admin')->user();
        return view('admin.profile', compact('page_title', 'admin'));
    }

    public function profileUpdate(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'image' => 'nullable|image|mimes:jpg,jpeg,png'
        ]);

        $user = Auth::guard('admin')->user();

        if ($request->hasFile('image')) {
            try {
                $old = $user->image ?: null;
                $user->image = uploadImage($request->image, 'assets/admin/images/profile/', '400X400', $old);
            } catch (\Exception $exp) {
                $notify[] = ['error', 'Image could not be uploaded.'];
                return back()->withNotify($notify);
            }
        }

        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();
        $notify[] = ['success', 'Your profile has been updated.'];
        return redirect()->route('admin.profile')->withNotify($notify);
    }


    public function password()
    {
        $page_title = 'Password Setting';
        $admin = Auth::guard('admin')->user();
        return view('admin.password', compact('page_title', 'admin'));
    }

    public function passwordUpdate(Request $request)
    {
        $this->validate($request, [
            'old_password' => 'required',
            'password' => 'required|min:5|confirmed',
        ]);

        $user = Auth::guard('admin')->user();
        if (!Hash::check($request->old_password, $user->password)) {
            $notify[] = ['error', 'Password Do not match !!'];
            return back()->withErrors(['Invalid old password.']);
        }
        $user->update([
            'password' => bcrypt($request->password)
        ]);
        $notify[] = ['success', 'Password Changed Successfully.'];
        return redirect()->route('admin.password')->withNotify($notify);
    }

    public function volunteer()
    {
        $page_title = "All Volunteers";

        $volunteers = Volunteer::latest()->paginate(getPaginate());

        return view('admin.volunteer', compact('page_title', 'volunteers'));
    }

    public function volunteerEdit(Request $request)
    {
        $page_title = "Edit Volunteer";

        $volunteer = Volunteer::findOrFail($request->id);

        return view('admin.details_volunteer', compact('page_title', 'volunteer'));
    }

    public function volunteerUpdate(Request $request)
    {
        $volunteer = Volunteer::findOrFail($request->id);
        $request->validate([
            'firstname' => 'required|max:200',
            'lastname' => 'required|max:200',
            'email' => ['required', 'email', Rule::unique('volunteers')->ignore($volunteer->id)],
            'country' => 'required|max:200',
            'mobile' => ['required', 'max:100', Rule::unique('volunteers', 'phone')->ignore($volunteer->id)],
            'state' => 'required|max:100',
            'zip' => 'required|max:50',
            'city' => 'required|max:100',
            'address' => 'required',
            'status' => 'sometimes'
        ]);

        if ($volunteer->status == 0) {

            if ($request->status == 'on') {

                notify($volunteer, 'VOLUNTEER_APPROVED', [
                    'time' => now()
                ]);
            } else {

                notify($request, 'VOLUNTEER_REJECTED', [
                    'time' => now()
                ]);
            }
        }



        $volunteer->firstname = $request->firstname;
        $volunteer->lastname = $request->lastname;
        $volunteer->email = $request->email;
        $volunteer->phone = $request->mobile;
        $volunteer->participated = $request->participation;
        $volunteer->country = $request->country;
        $volunteer->address = [
            'address' => $request->address,
            'state' => $request->state,
            'zip' => $request->zip,
            'city' => $request->city
        ];
        $volunteer->status = $request->status ? 1 : 2;
        $volunteer->save();

        $notify[] = ['success', 'Update Volunteer'];
        return back()->withNotify($notify);
    }

    public function showEmailSingleForm($id)
    {
        $user = Volunteer::findOrFail($id);
        $page_title = 'Send Email To: ' . $user->username;
        return view('admin.volunteer_email', compact('page_title', 'user'));
    }

    public function sendEmailSingle(Request $request, $id)
    {
        $request->validate([
            'message' => 'required|string|max:65000',
            'subject' => 'required|string|max:190',
        ]);

        $user = Volunteer::findOrFail($id);
        send_general_email($user->email, $request->subject, $request->message, $user->username);
        $notify[] = ['success', $user->username . ' will receive an email shortly.'];
        return back()->withNotify($notify);
    }

    public function searchVolunteer(Request $request)
    {
        $search = $request->search;
        $volunteers = Volunteer::where(function ($user) use ($search) {
            $user->where('email', 'like', "%$search%")
                ->orWhere('phone', 'like', "%$search%");
        })->paginate(getPaginate());

        $page_title = 'Volunteer Search - ' . $search;
        $empty_message = 'No search result found';
        return view('admin.volunteer', compact('page_title', 'search', 'empty_message', 'volunteers'));
    }


    public function requestReport()
    {
        $page_title = 'Your Listed Report & Request';
        $arr['app_name'] = systemDetails()['name'];
        $arr['app_url'] = env('APP_URL');
        $arr['purchase_code'] = env('PURCHASE_CODE');
        $url = "https://license.viserlab.com/issue/get?".http_build_query($arr);
        $response = json_decode(curlContent($url));
        if ($response->status == 'error') {
            return redirect()->route('admin.dashboard')->withErrors($response->message);
        }
        $reports = $response->message[0];
        return view('admin.reports',compact('reports','page_title'));
    }

    public function reportSubmit(Request $request)
    {
        $request->validate([
            'type'=>'required|in:bug,feature',
            'message'=>'required',
        ]);
        $url = 'https://license.viserlab.com/issue/add';

        $arr['app_name'] = systemDetails()['name'];
        $arr['app_url'] = env('APP_URL');
        $arr['purchase_code'] = env('PURCHASE_CODE');
        $arr['req_type'] = $request->type;
        $arr['message'] = $request->message;
        $response = json_decode(curlPostContent($url,$arr));
        if ($response->status == 'error') {
            return back()->withErrors($response->message);
        }
        $notify[] = ['success',$response->message];
        return back()->withNotify($notify);
    }

    public function systemInfo(){
        $laravelVersion = app()->version();
        $serverDetails = $_SERVER;
        $currentPHP = phpversion();
        $timeZone = config('app.timezone');
        $page_title = 'System Information';
        return view('admin.info',compact('page_title', 'currentPHP', 'laravelVersion', 'serverDetails','timeZone'));
    }
}
