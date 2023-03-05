<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use App\Http\Requests;
use DB;
use Session;
use Brian2694\Toastr\Facades\Toastr;
use Intervention\Image\ImageManagerStatic as Image;

class AdminController extends Controller
{

    // basic function
    private $rcdate;
    private $logged_id;
    private $current_time;

    public function __construct()
    {
        date_default_timezone_set('Asia/Dhaka');
        $this->rcdate           = date('Y-m-d');
        $this->logged_id        = Session::get('user_id');
        $this->current_time     = date('H:i:s');
    }

    // taking me to admin login page
    public function adminDashboard($user_id)
    {
        Session::put('user_id',$user_id);
        return view('admin.admin-dashboard');
    }

    // taking me to admin login page
    public function adminProfile()
    {
        $admin_info = DB::table('admin')->where('id',Session::get('user_id'))->first();
        return view('admin.adminProfile')->with('admin_info',$admin_info)->with('_id',Session::get('user_id'));
    }

    public function updateAdminProfile(Request $request)
    {
        // Validation
        $this->validate($request, [
            'name'  => 'required',
            'email' => 'required',
            'mobile' => 'required',
            'photo' => 'mimes:jpeg,jpg,png|max:300',
        ]);

        //Collecting data from html form
        $name   = trim($request->name);
        $email  = trim($request->email);
        $mobile  = trim($request->mobile);
        $_id    = trim($request->_id);
        $photo  = $request->file('photo');

        //Check duplicatet user name
        $count = DB::table('admin')->whereNotIn('id',[$_id])->where('email', $email)->count();

        if($count > 0){
            Toastr::error('Sorry ! email already exits, try to add new e-mail','failed');
            return Redirect::to('admin-profile/'.$_id);
            exit();
        }

        $data = array();

        if($request->hasFile('photo')){
            $image_name         = Str::random(12);
            $ext                = strtolower($photo->getClientOriginalExtension());
            $image_full_name    = $image_name.'.'.$ext;
            $upload_path        = "frontend/admin/";
            $photo->move($upload_path,$image_full_name);
            $data['photo']      = $image_full_name;
        }

//        if($request->hasFile('photo')){
//            $imagename        = Str::random(12);
//            $image_name       = $imagename.'.'.$photo->extension();
//            $filePath = public_path('/frontend/admin');
//            $img = Image::make($photo->path());
//            $img->resize(300, 300, function () {
//
//            })->save($filePath.'/'.$image_name);
//        }

        $data['name']   = $name;
        $data['email']  = $email;
        $data['mobile']  = $mobile;

        $query = DB::table('admin')->where('id',Session::get('user_id'))->update($data);

        if($query){
            Toastr::success('Congratulations, data updated sucessfully !!','Success');
            return Redirect::to('admin-profile');
        }else{
            Toastr::error('Alas !! error occured, try again.','failed');
            return Redirect::to('admin-profile');
        }
    }

    public function addSmtp(){
        return view('admin.add-smtp');
    }

    public function activeSmtp(){
        $result = DB::table('tbl_smtp')->where('active',1)->get();
        return view('admin.active-smtp')->with('result',$result);
    }

    public function inactiveSmtp(){
        $result = DB::table('tbl_smtp')->where('active',0)->get();
        return view('admin.inactive-smtp')->with('result',$result);
    }

    public function enableSmtp(Request $request){
        $smtp = $request->smtp;

        foreach ($smtp as $value){
            $data = array();
            $data['active'] = 1;
            DB::table('tbl_smtp')->where('id',$value)->update($data);
        }

        return "true";
    }

    public function disableSmtp(Request $request){
        $smtp = $request->smtp;

        foreach ($smtp as $value){
            $data = array();
            $data['active'] = 0;
            DB::table('tbl_smtp')->where('id',$value)->update($data);
        }

        return "true";
    }

    public function smtpIntervalTime()
    {
        $query = DB::table('settings')->where('id',1)->first();
        return view('admin.smtp-interval-time')->with('query',$query);
    }

    public function updateSmtpIntervalTime(Request $request)
    {
        $seconds = $request->seconds;
        $data = array();
        $data['seconds'] = $seconds;

        $query = DB::table('settings')->where('id',1)->update($data);

        if($query){
            Toastr::success('Congratulations, SMTP Interval Time updated sucessfully !!','Success');
            return Redirect::to('smtp-interval-time');
        }else{
            Toastr::error('Alas !! Error occured, try again.','failed');
            return Redirect::to('smtp-interval-time');
        }

    }

}
