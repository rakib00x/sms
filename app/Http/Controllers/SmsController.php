<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use App\Http\Requests;
use DB;
use Nette\Utils\DateTime;
use Session;

class SmsController extends Controller
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

    public function sendSingleSms()
    {
        $contacts = DB::table('contacts')->where('added_by',Session::get('user_id'))->orderBy('name', 'ASC')->get();
        return view('admin.send-single-sms',compact('contacts'));
    }

    public function sendSingleSmsByPhone(Request $request)
    {
        date_default_timezone_set('Asia/Dhaka');

        $mobile     = $request->mobile;
        $message    = $request->message;
        $sms_count  = $request->sms_count;

        $user_id = Session::get('user_id');

        // Getting the default value
        $dafault_info = DB::table('settings')->where('id',1)->first();
        $default_sending_limit_from_settings_table = $dafault_info->default_sending_limit;

        $info = DB::table('admin')->where('id',$user_id)->first();
        $default_sending_limit = $info->default_sending_limit;
        $validity_expire_at = $info->validity_expire_at;

        $today = date('Y-m-d');

        if($validity_expire_at < $today){

            // expired
            if($default_sending_limit_from_settings_table < $sms_count){
                return "sms_count_bigger";
                return false;
            }

            $message_id = Str::random(16);

            $data = array();
            $data['device']     = "101";
            $data['source']     = 2;
            $data['mobile']     = $mobile;
            $data['content']    = $message;
            $data['message_id'] = $message_id;
            $data['user_id']    = Session::get('user_id');
            $data['created_at'] = date('Y-m-d H:i:s');
            $data['updated_at'] = date('Y-m-d H:i:s');

            $query = DB::table('requests')->insert($data);

            if($query){
                return "true";
            }else{
                return "false";
            }

        }else{

            if($default_sending_limit < $sms_count){
                return "exceeded";
                return false;
            }

            $message_id = Str::random(16);

            $data = array();
            $data['device']     = "101";
            $data['source']     = 2;
            $data['mobile']     = $mobile;
            $data['content']    = $message;
            $data['message_id'] = $message_id;
            $data['user_id']    = Session::get('user_id');
            $data['created_at'] = date('Y-m-d H:i:s');
            $data['updated_at'] = date('Y-m-d H:i:s');

            $query = DB::table('requests')->insert($data);

            if($query){
                return "true";
            }else{
                return "false";
            }

        }

    }

    public function sendMyContact(Request $request)
    {
        date_default_timezone_set('Asia/Dhaka');

        $mobiles = $request->arr;

//        var_dump($request->arr);
//        exit();

        $message    = $request->message;
        $sms_count  = $request->sms_count;

        $user_id = Session::get('user_id');

        // Getting the default value
        $dafault_info = DB::table('settings')->where('id',1)->first();
        $default_sending_limit_from_settings_table = $dafault_info->default_sending_limit;

        $info = DB::table('admin')->where('id',$user_id)->first();
        $default_sending_limit = $info->default_sending_limit;
        $validity_expire_at = $info->validity_expire_at;

        $today = date('Y-m-d');

        if($validity_expire_at < $today){

            if($default_sending_limit_from_settings_table < $sms_count){
                return "sms_count_bigger";
                return false;
            }

            foreach($mobiles as $mobile) {
                $message_id = Str::random(16);
                $data = array();
                $data['device']     = "101";
                $data['source']     = 2;
                $data['mobile']     = $mobile;
                $data['content']    = $message;
                $data['message_id'] = $message_id;
                $data['user_id']    = Session::get('user_id');
                $data['created_at'] = date('Y-m-d H:i:s');
                $data['updated_at'] = date('Y-m-d H:i:s');
                DB::table('requests')->insert($data);
            }

        }else{

            if($default_sending_limit < $sms_count){
                return "exceeded";
                return false;
            }

            foreach($mobiles as $mobile) {
                $message_id = Str::random(16);
                $data = array();
                $data['device']     = "101";
                $data['source']     = 2;
                $data['mobile']     = $mobile;
                $data['content']    = $message;
                $data['message_id'] = $message_id;
                $data['user_id']    = Session::get('user_id');
                $data['created_at'] = date('Y-m-d H:i:s');
                $data['updated_at'] = date('Y-m-d H:i:s');
                DB::table('requests')->insert($data);
            }

        }

    }

    public function sendGroupSms()
    {
        $groups = DB::table('groups')->where('added_by',Session::get('user_id'))->get();
        return view('admin.send-group-sms')->with('groups',$groups);
    }

    public function sendGroupSmsByPhone(Request $request)
    {
        $group_id   = $request->group_id;
        $message    = $request->message;

        $contactQuery = DB::table('contacts')->where('group_id',$group_id)->get();

        foreach ($contactQuery as $contact){

            $message_id = Str::random(16);

            $data = array();
            $data['device']     = "101";
            $data['source']     = 3;
            $data['group_id']   = $group_id;
            $data['mobile']     = $contact->mobile;
            $data['content']    = $message;
            $data['message_id'] = $message_id;
            $data['user_id']    = Session::get('user_id');
            $data['created_at'] = date('Y-m-d H:i:s');
            $data['updated_at'] = date('Y-m-d H:i:s');
            DB::table('requests')->insert($data);
        }

        return "true";
    }

    public function sendGeoSms()
    {
        $countries = DB::table('country')->get();
        return view('admin.send-geo-sms')->with('countries',$countries);
    }

    public function sendGeoSmsByApi(Request $request)
    {
        $country        = $request->country;
        $division       = $request->division;
        $district       = $request->district;
        $upzila         = $request->upzila;
        $contact_number = $request->contact_number;
        $message        = $request->message;

        $contactCount = DB::table('contacts')->where('country',$country)->where('division',$division)->where('district',$district)->where('upzila',$upzila)->count();

        if($contact_number > $contactCount){
            return "count";
            return false;
        }

        $contactQuery = DB::table('contacts')->where('country',$country)->where('division',$division)->where('district',$district)->where('upzila',$upzila)->inRandomOrder()->take($contact_number);

        foreach ($contactQuery as $contact){

            $message_id = Str::random(16);
            $data = array();
            $data['device']     = "101";
            $data['source']     = 3;
            $data['mobile']     = $contact->mobile;
            $data['content']    = $message;
            $data['message_id'] = $message_id;
            $data['user_id']    = Session::get('user_id');
            $data['created_at'] = date('Y-m-d H:i:s');
            $data['updated_at'] = date('Y-m-d H:i:s');
            DB::table('requests')->insert($data);
        }

        return "true";
    }

    public function checkApiRequest(Request $request)
    {

    }

    public function sendScheduledSms()
    {
        date_default_timezone_set('Asia/Dhaka');
        $date = date('Y-m-d H:i'.':00');
        
        // echo $date;
        // exit();
        
        $schedules = DB::table('schedules')->where('status',0)->get();
        foreach ($schedules as $schedule){
            
            //echo $schedule->schedule_time."<br>";
            
            if($date == $schedule->schedule_time){
                $contacts = DB::table('contacts')->where('group_id',$schedule->group_id)->get();
                foreach ($contacts as $contact){
                    $templates = DB::table('templates')->where('id',$schedule->template_id)->first();
                    $message_id = Str::random(16);
                    $data = array();
                    $data['device']     = "101";
                    $data['source']     = 4;
                    $data['mobile']     = $contact->mobile;
                    $data['content']    = $templates->template_content;
                    $data['message_id'] = $message_id;
                    $data['user_id']    = $schedule->added_by;
                    $data['created_at'] = date('Y-m-d H:i:s');
                    $data['updated_at'] = date('Y-m-d H:i:s');
                    DB::table('requests')->insert($data);
                }
                $data = array();
                $data['status'] = 1;
                DB::table('schedules')->where('id',$schedule->id)->update($data);
            }

        }
    }

}
