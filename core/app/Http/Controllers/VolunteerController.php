<?php

namespace App\Http\Controllers;

use App\Volunteer;
use Illuminate\Http\Request;

class VolunteerController extends Controller
{
    public function __construct()
    {
        $this->activeTemplate = activeTemplate();
    }
    public function index()
    {
        $page_title = "Join As volunteer";
        $info = json_decode(json_encode(getIpInfo()), true);
        $mobile_code = @implode(',', $info['code']);
        $countries = json_decode(file_get_contents(resource_path('views/partials/country.json')));

        return view($this->activeTemplate.'volunteer',compact('page_title','mobile_code','countries'));
    }

    public function volunteerStore(Request $request)
    {


        $request->validate([
            'firstname' => 'required|max:200',
            'lastname' => 'required|max:200',
            'email' => 'required|email|unique:volunteers',
            'country' => 'required|max:200',
            'mobile_code' => 'required|max:100',
            'country_code' => 'required|max:100',
            'mobile' => 'required|max:100|unique:volunteers,phone',
            'state' => 'required|max:100',
            'zip' => 'required|max:50',
            'city' => 'required|max:100',
            'address' => 'required',
            'image' => 'required|image|mimes:jpg,png,jpeg'
        ]);

        if($request->has('image')){
            try {
                $path = imagePath()['volunteer']['path'];
                $size = imagePath()['volunteer']['size'];
                $filename = uploadImage($request->image,$path,$size);
            } catch (\Throwable $th) {
               $notify[] = ['error','Image Could Not Uploaded'];
               return back()->withNotify($notify);
            }
        }

        $volunteer = new Volunteer();
        $volunteer->firstname = $request->firstname;
        $volunteer->lastname = $request->lastname;
        $volunteer->email = $request->email;
        $volunteer->phone = $request->mobile_code . $request->mobile;
        $volunteer->country = $request->country;
        $volunteer->country_code = $request->country_code;
        $volunteer->address =[
            'address' => $request->address,
            'state' => $request->state,
            'zip' => $request->zip,
            'city' => $request->city
        ];
        $volunteer->image = $filename;

        $volunteer->save();

        $notify[] = ['success', 'Admin will review your request'];
        return back()->withNotify($notify);

    }

    public function volunteerList()
    {
        $page_title = "Volunteers List";

        $volunteers = Volunteer::where('status',1)->paginate(getPaginate());
        $countries = json_decode(file_get_contents(resource_path('views/partials/country.json')));
        return view($this->activeTemplate.'volunteer_list',compact('page_title', 'volunteers', 'countries'));
    }

    public function volunteerSearch(Request $request)
    {
        $page_title = "Volunteers List";

        $volunteers = Volunteer::where('status', 1)->where('firstname','LIKE','%'.$request->search.'%')->orWhere('lastname', 'LIKE', '%' . $request->search . '%')->paginate(getPaginate());

        return view($this->activeTemplate . 'volunteer_partial_list', compact('page_title', 'volunteers'));
    }
    public function volunteerSearchByCountry(Request $request)
    {

        $page_title = "Volunteers List";

        $volunteers = Volunteer::where('status', 1)->where('country','LIKE','%'.$request->search.'%')->paginate(getPaginate(1));

        return view($this->activeTemplate . 'volunteer_partial_list', compact('page_title', 'volunteers'));
    }
}
