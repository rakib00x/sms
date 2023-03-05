<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use App\Http\Requests;
use DB;
use Session;
use Response;

class RequestController extends Controller
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

    public function checkApiRequest(Request $request)
    {
        $device = $request->device;
        $query = DB::table('requests')->where('device',$device)->where('sent',0)->orderBy('id','asc')->first();

        $device = $query->device;
        $mobile = $query->mobile;
        $content = $query->content;
        $source = $query->source;
        $group_id = $query->group_id;
        $scheduled = $query->scheduled;
        $scheduled_id = $query->scheduled_id;
        $user_id = $query->user_id;

        $id = $query->id;

        $data = array();
        $data['sent'] = 1;
        $requests = DB::table('requests')->where('id',$id)->update($data);

        if($requests){
            $data = array();
            $data['device']         =   $device;
            $data['mobile']         =   $mobile;
            $data['content']        =   $content;
            $data['content_type']   =   $source;
            $data['group_id']       =   $group_id;
            $data['scheduled']      =   $scheduled;
            $data['scheduled_id']   =   $scheduled_id;
            $data['added_id']       =   $user_id;
            $data['created_at']     =   date('Y-m-d H:i:s');
            $data['updated_at']     =   date('Y-m-d H:i:s');
            DB::table('history')->insert($data);
        }

        return Response::json(['code' => '1', 'mobile' => $mobile,'message' => $content]);
    }

    public function laravel($d,$e,$s,$mobile,$message)
    {

        $count = DB::table('admin')->where('email',$e)->where('signature',$s)->where('status',4)->count();
        $userinfo = DB::table('admin')->where('email',$e)->where('signature',$s)->where('status',4)->first();
        $user_id = $userinfo->id;

        if($count > 0){

            $data = array();
            $data['device']     = $d;
            $data['source']     = 1;
            $data['mobile']     = $mobile;
            $data['content']    = $message;
            $data['user_id']    = $user_id;
            $data['message_id'] = Str::random(16);
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

    public function general()
    {
        $device = $_GET['device'];
        $email = $_GET['email'];
        $signature = $_GET['signature'];
        $mobile = $_GET['mobile'];
        $message = $_GET['msg'];

//        return Response::json(['code' => '1001']);
//        exit();

        if(strlen($mobile) < 11 || strlen($mobile) > 12){
            return Response::json(['code' => '1008', 'error' => 'Invalid mobile number']);
        }

        $count = DB::table('admin')->where('email',$email)->where('signature',$signature)->where('status',4)->count();

        if($count == 0){
            return Response::json(['code' => '1009', 'error' => 'Authentication error']);
        }

        if($count > 0){

            $userinfo = DB::table('admin')->where('email',$email)->where('signature',$signature)->where('status',4)->first();
            $user_id = $userinfo->id;

            $message_id = Str::random(16);

            $data = array();
            $data['device']     = $device;
            $data['source']     = 1;
            $data['mobile']     = $mobile;
            $data['content']    = $message;
            $data['user_id']    = $user_id;
            $data['message_id'] = $message_id;
            $data['created_at'] = date('Y-m-d H:i:s');
            $data['updated_at'] = date('Y-m-d H:i:s');

            $query = DB::table('requests')->insert($data);

            if($query){
                return Response::json(['code' => '1000', 'message_id' => $message_id,'mobile' => $mobile, 'message' => $message]);
            }else{
                return Response::json(['code' => '1001']);
            }

        }

    }

    public function importContact(Request $request)
    {
        $name = $request->name;
        $mobile = $request->mobile;
        $admin = $request->admin;

        $info = DB::table('admin')->where('id',$admin)->first();
        $country = $info->country;
        $division = $info->division;
        $district = $info->district;
        $upzila = $info->upzila;

        $data = array();
        $data['name'] = $name;
        $data['mobile'] = $mobile;
        $data['country'] = $country;
        $data['division'] = $division;
        $data['district'] = $district;
        $data['upzila'] = $upzila;
        $data['added_by'] = $admin;

        $count = DB::table('contacts')->where('name',$name)->count();

        if($count == 0){
            $query = DB::table('contacts')->insert($data);
            if($query){
                return Response::json(['mobile' => '200']);
            }
        }

        return Response::json(['mobile' => '404']);

    }

}
