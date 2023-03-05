<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use App\Http\Requests;
use DB;
use Nette\Utils\DateTime;
use Response;
use Config;
use Brian2694\Toastr\Facades\Toastr;

class UserController extends Controller
{

    // The Constructor Function
    public function __construct()
    {
        date_default_timezone_set('Asia/Dhaka');
        $this->rcdate       = date('Y-m-d');
        $this->current_time = date("H:i:s");

        // $mainIp = '';
        // if (getenv('HTTP_CLIENT_IP')){
        //     $mainIp = getenv('HTTP_CLIENT_IP');
        // }else if(getenv('HTTP_X_FORWARDED_FOR')){
        //     $mainIp = getenv('HTTP_X_FORWARDED_FOR');
        // }else if(getenv('HTTP_X_FORWARDED')){
        //     $mainIp = getenv('HTTP_X_FORWARDED');
        // }else if(getenv('HTTP_FORWARDED_FOR')){
        //     $mainIp = getenv('HTTP_FORWARDED_FOR');
        // }else if(getenv('HTTP_FORWARDED')){
        //     $mainIp = getenv('HTTP_FORWARDED');
        // }else if(getenv('REMOTE_ADDR')){
        //     $mainIp = getenv('REMOTE_ADDR');
        // }else{
        //     $mainIp = 'UNKNOWN';
        // }

        //$this->ip_address = $mainIp;

        //$ip = '118.179.192.122';

        // Use JSON encoded string and converts
        // it into a PHP variable
        //$ipdat = @json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=" . $ip));

        //$this->country_name = $ipdat->geoplugin_countryName;
        //$this->country_code = $ipdat->geoplugin_countryCode;
    }
    
    public function index(){
        return view('frontend.index');
    }
    
    public function sim(){
        return view('frontend.sim');
    }
    
    public function smspacakge(){
        return view('frontend.pacakge');
    }
    public function contacts(){
        return view('frontend.contact');
    }
     public function condition(){
        return view('frontend.terms-condition');
    }

    // going to signup page
    public function getUserRegistrationForm()
    {
        $countries = DB::table('country')->get();
        $divisions = DB::table('divisions')->get();
        $occupations = DB::table('occupation')->get();
        return view('authentication.signup')->with('countries',$countries)->with('divisions',$divisions)->with('occupations',$occupations);
    }

    # Collecting Signup Data and inserting into database

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postUserRegistrationData(Request $request)
    {

        date_default_timezone_set('Asia/Dhaka');

        $name 			    = trim($request->name);
        $mobile 			= trim($request->mobile);
        $email 				= trim($request->email);
        $password 			= trim($request->password);
        $country 			= trim($request->country);
        $division 			= trim($request->division);
        $district 	        = trim($request->district);
        $upzila 			= trim($request->upzila);
        $occupation 		= trim($request->occupation);

//        var_dump($name);
//        exit();

        if ($name == "" || $name == NULL) {
            Toastr::error('Full name is missing','failed');
            return Redirect::to('get-user-registration-form');
        }

        if ($mobile == "") {
            Toastr::error('Mobile is missing','failed');
            return Redirect::to('get-user-registration-form');
        }

        if ($email == "") {
            Toastr::error('E-mail is missing','failed');
            return Redirect::to('get-user-registration-form');
        }

        if ($country == "") {
            Toastr::error('Country is missing','failed');
            return Redirect::to('get-user-registration-form');
        }

        if ($password == "") {
            Toastr::error('Password is missing','failed');
            return Redirect::to('get-user-registration-form');
        }

        if (strlen($password) > 4) {
            Toastr::error('Password is greater than 4 digit','failed');
            return Redirect::to('get-user-registration-form');
        }

        if (strlen($password) < 4) {
             Toastr::error('Password is less than 4 digit','failed');
            return Redirect::to('get-user-registration-form');
        }

        if ($division == "") {
            Toastr::error('Division is missing','failed');
            return Redirect::to('get-user-registration-form');
        }

        if ($district == "") {
            Toastr::error('District is missing','failed');
            return Redirect::to('get-user-registration-form');
        }

        if ($upzila == "") {
            Toastr::error('Upzila is missing','failed');
            return Redirect::to('get-user-registration-form');
        }

        if ($occupation == "") {
            Toastr::error('Occupation is missing','failed');
            return Redirect::to('get-user-registration-form');
        }

        # DUPLICATE MAIL CHECK
        $mobile_check = DB::table('admin')->where('mobile', $mobile)->count();

        if ($mobile_check > 0) {
            Toastr::error('mobile already exit','failed');
            // Session::put('failed', 'Sorry ! '.$mobile.' mobile already exit.');
            return Redirect::to('get-user-registration-form');
        }

        // Scanning the default value
        $default = DB::table('settings')->where('id',1)->first();
        $default_sending_limit = $default->default_sending_limit;
        $default_days = $default->default_days;

        $today = date('Y-m-d');
        $date = new DateTime($today);
        $date->modify("+$default_days day");
        $validity_expire_at = $date->format("Y-m-d");

        $salt      		= 'a123A321';
        $fpassword  	= sha1($password.$salt);

        $data 						    = array() ;
        $data['name'] 			        = $name ;
        $data['email'] 				    = $email ;
        $data['mobile'] 			    = $mobile ;
        $data['password'] 			    = $fpassword ;
        $data['country'] 		        = $country ;
        $data['division'] 		        = $division ;
        $data['district'] 		        = $district ;
        $data['upzila'] 		        = $upzila ;
        $data['occupation'] 		    = $occupation ;
        $data['status'] 			    = 1 ;
        $data['default_sending_limit']  = $default_sending_limit ;
        $data['default_days']           = $default_days ;
        $data['validity_expire_at']     = $validity_expire_at ;
        $data['created_at'] 	        = $this->rcdate ;
        $data['created_time'] 	        = $this->current_time ;

        $query = DB::table('admin')->insert($data);

        if($query){
            $message_id = Str::random(16);
            $smsdata = array();
            $smsdata['device']     = "101";
            $smsdata['source']     = 2;
            $smsdata['mobile']     = $mobile;
            $smsdata['content']    = "You are most welcome to availtrade SMS Service, you can take our service from right now.";
            $smsdata['message_id'] = $message_id;
            $smsdata['user_id']    = 1;
            $smsdata['created_at'] = date('Y-m-d H:i:s');
            $smsdata['updated_at'] = date('Y-m-d H:i:s');
            DB::table('requests')->insert($smsdata);
            Toastr::success('Thanks !! Registration Successfully Completed.','Success');
            return Redirect::to('/login');
        }

    }

    public function getDivisionByCountry(Request $request)
    {
        $country_id = $request->country_id;
        $divisions = DB::table('divisions')->where('country_id',$country_id)->get();
        return view('ajax-requested-files.get-division-by-country')->with('divisions',$divisions);
    }

    public function getDistrictByDivision(Request $request)
    {
        $division_id = $request->division_id;
        $districts = DB::table('districts')->where('division_id',$division_id)->get();
        return view('ajax-requested-files.get-districts-by-division')->with('districts',$districts);
    }

    public function getUpzilaByDistrict(Request $request)
    {
        $district_id = $request->district_id;
        $upazilas = DB::table('upazilas')->where('district_id',$district_id)->get();
        return view('ajax-requested-files.get-upzilas-by-district')->with('upazilas',$upazilas);
    }

    // going to login page
    public function apanel()
    {
        return view('authentication.userLogin');
    }

    public function signin(Request $request)
    {

        $this->validate($request, [
            'email'     => 'required' ,
            'password'  => 'required'
        ]);

        $email  = trim($request->email) ;
        $pwd    = trim($request->password) ;

        $salt       = 'a123A321';
        $password   = sha1($pwd.$salt);

        $check_count = DB::table('admin')
            ->where('email', $email)
            ->where('password', $password)
            ->count();

        if ($check_count > 0) {

            // end of checking Approval
            $user_login = DB::table('admin')
                ->where('email', $email)
                ->where('password', $password)
                ->first();

            // Storing data in session variable, 1 means admin
            Session::put('user_name',$user_login->name);
            Session::put('user_id',$user_login->id);
            Session::put('photo',$user_login->photo);
            Session::put('type',$user_login->type);

            return "admin"."@".$user_login->id;
        }else{
            return 'failed'."@"."nothing";
        }
    }

    // access profile by button
    public function accessProfileByAdmin(Request $request)
    {
        $user_id    = trim($request->user_id);
        $user_info  = DB::table('admin')->where('id', $user_id)->first();

        $check_count = DB::table('admin')
            ->where('email', $user_info->email)
            ->where('password', $user_info->password)
            ->count();

        if ($check_count > 0) {

            $user_login = DB::table('admin')
                ->where('email', $user_info->email)
                ->where('password', $user_info->password)
                ->first();

            if($user_login->user_type == 1){
                // Storing data in session variable, 1 means admin
                Session::put('user_name',$user_login->name);
                Session::put('user_id',$user_login->id);
                Session::put('user_type',$user_login->user_type);
                Session::put('user_skype',$user_login->skype);
                Session::put('photo',$user_login->photo);
                return "admin";
            }else if($user_login->user_type == 2){
                // Storing data in session variable, 1 means admin
                Session::put('user_name',$user_login->name);
                Session::put('user_id',$user_login->id);
                Session::put('user_type',$user_login->user_type);
                Session::put('user_skype',$user_login->skype);
                Session::put('photo',$user_login->photo);
                return "manager";
            }else if($user_login->user_type == 3){
                // Storing data in session variable, 1 means admin
                Session::put('user_name',$user_login->name);
                Session::put('user_id',$user_login->id);
                Session::put('user_type',$user_login->user_type);
                Session::put('user_skype',$user_login->skype);
                Session::put('photo',$user_login->photo);
                return 'advertiser';
            }else{
                // Storing data in session variable, 1 means admin
                Session::put('user_name',$user_login->name);
                Session::put('user_id',$user_login->id);
                Session::put('user_type',$user_login->user_type);
                Session::put('user_skype',$user_login->skype);
                Session::put('photo',$user_login->photo);
                return 'affiliate';
            }
        }else{
            return 'failed';
        }
    }

    // Sign Out
    public function signout()
    {
        Session::put('user_name',null);
        Session::put('user_id',null);
        Session::put('user_type',null);
        Session::put('user_photo',null);
        return Redirect::to('/');
    }

    // taking me to forgot page
    public function forgot()
    {
        return view('authentication.forgot');
    }

    public function sendRandomPassword(Request $request)
    {
        $email = $request->email;

        if($email == "" || $email == NULL){
            return "e";
            exit();
        }

        $scan = DB::table('admin')->where('mobile',$email)->count();

        if($scan == 0){
            return "no";
            exit();
        }

        $pwd        = rand(1111,9999);
        $salt       = 'a123A321';
        $new_generated_password  = sha1($pwd.$salt);

        $fpdata = array();
        $fpdata['password'] = $new_generated_password;
        $query = DB::table('admin')->where('mobile',$email)->update($fpdata);

        if($query){
            $message_id = Str::random(16);
            $data = array();
            $data['device']     = "101";
            $data['source']     = 2;
            $data['mobile']     = $email;
            $data['content']    = "Your generated password is: ".$pwd;
            $data['message_id'] = $message_id;
            $data['user_id']    = Session::get('user_id');
            $data['created_at'] = date('Y-m-d H:i:s');
            $data['updated_at'] = date('Y-m-d H:i:s');

            DB::table('requests')->insert($data);
            return "true";
        }

    }

    public function androidLogin(Request $request)
    {
        $username = $request->username;
        $pwd = $request->password;

        $status = preg_match('/^([0-9]*)$/', $pwd);

        if($username == ""){
            return Response::json(['code' => '1']);
            return false;
        }

        if($pwd == ""){
            return Response::json(['code' => '2']);
            return false;
        }

        if($status !=  true){
            return Response::json(['code' => '3']);
            return false;
        }

        if(strlen($pwd) > 4){
            return Response::json(['code' => '4']);
            return false;
        }

        if(strlen($pwd) < 4){
            return Response::json(['code' => '5']);
            return false;
        }

        $salt       = 'a123A321';
        $password   = sha1($pwd.$salt);

        $count = DB::table('admin')->where('mobile',$username)->where('password',$password)->count();

        if($count > 0){
            $query = DB::table('admin')->where('mobile',$username)->where('password',$password)->first();
            $user_id = $query->id;
            $mobile = $query->mobile;
            return Response::json(['code' => '200', 'mobile' => $mobile, 'admin' => $user_id]);
        }else{
            return Response::json(['code' => '1001']);
        }
    }

    public function getUserLoginForm()
    {
        return view('authentication.signin');
    }

    public function postUserLoginData(Request $request)
    {
        $mobile = $request->mobile;
        $pwd = $request->password;

//        return "hacked";
//        exit();

        if($mobile == ""){
            return "m";
            exit();
        }

        if($pwd == ""){
            return "p";
            exit();
        }

        $salt       = 'a123A321';
        $password   = sha1($pwd.$salt);

        $count = DB::table('admin')->where('mobile',$mobile)->where('password',$password)->count();

        if($count > 0){
            $query = DB::table('admin')->where('mobile',$mobile)->where('password',$password)->first();
            Session::put('user_id',$query->id);
            return $query->id;
        }else{
            return "no";
        }
    }

    public function changePassword()
    {
        return view('admin.change-password');
    }

    public function updatePassword(Request $request)
    {
        $old_pass = $request->old_pass;
        $new_pass = $request->new_pass;
        $confirm_new_pass = $request->confirm_new_pass;

        if($old_pass == ""){
            Toastr::error('You are missing *Old Password*','failed');
            return Redirect::to('change-password');
        }

        if($new_pass == ""){
            Toastr::error('You are missing *New Password*','failed');
            return Redirect::to('change-password');
        }

        if($confirm_new_pass == ""){
            Toastr::error('You are missing *Confirm New Password*','failed');
            return Redirect::to('change-password');
        }

        $query = DB::table('admin')->where('id',Session::get('user_id'))->first();
        $password_from_database = $query->password;

        $salt = 'a123A321';
        $password_from_user_input = sha1($old_pass.$salt);

        if($password_from_database != $password_from_user_input){
            Toastr::error('Old password does not matched','Warning');
            return Redirect::to('change-password');
        }

        if($new_pass != $confirm_new_pass){
            Toastr::error('New password and Confirm new password does not matched','Warning');
            return Redirect::to('change-password');
        }

        $password_from_user_input_in_new_password_field = sha1($new_pass.$salt);

        $fpdata = array();
        $fpdata['password'] = $password_from_user_input_in_new_password_field;
        $query = DB::table('admin')->where('id',Session::get('user_id'))->update($fpdata);

        if($query){
            Toastr::success('Password changed successfully','Success');
            Session::put('user_name',null);
            Session::put('user_id',null);
            Session::put('user_type',null);
            Session::put('user_photo',null);
            return Redirect::to('/login');
        }else{
            Toastr::success('Something went wrong','Warning');
            return view('admin.change-password');
        }

    }

}
