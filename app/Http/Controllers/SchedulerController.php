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

class SchedulerController extends Controller
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

    public function index()
    {
        $groups = DB::table('groups')->where('added_by',Session::get('user_id'))->get();
        $templates = DB::table('templates')->where('added_by',Session::get('user_id'))->get();
        
            $result=  DB::table('schedules')
            ->leftjoin('groups', 'schedules.group_id', '=', 'groups.id')
            ->leftjoin('templates', 'schedules.template_id', '=', 'templates.id')
            ->select('schedules.*', 'groups.group_name', 'templates.template_name')
            ->where('schedules.added_by',Session::get('user_id'))->get();
            
        return view('admin.set-schedule')->with('groups',$groups)->with('templates',$templates)->with('result',$result);
    }

    public function saveSchedule(Request $request)
    {
        date_default_timezone_set("Asia/Dhaka");

        $group_id       = $request->group_id;
        $template_id    = $request->template_id;
        $schedule_time  = date("Y-m-d H:i:s", strtotime($request->schedule_time));
        $current_time   = date("Y-m-d H:i:s");

        if($schedule_time <  $current_time){
            Toastr::error('Sorry, the schedule can not be added in back date and time !!','failed');
            return Redirect::to('set-schedule');
        }

        # CHECK DUPLICATE
        $check = DB::table('schedules')
            ->where('group_id', $group_id)
            ->where('template_id', $template_id)
            ->where('schedule_time', $schedule_time)
            ->count();

        if($check > 0){
            Toastr::error('Sorry, the schedule already added !!','failed');
            return Redirect::to('set-schedule');
        }

        $data                   = array();
        $data['group_id']       = $group_id;
        $data['template_id']    = $template_id;
        $data['schedule_id']    = 0;
        $data['schedule_time']  = $schedule_time;
        $data['status']         = 0;
        $data['added_by']       = Session::get('user_id');
        $data['created_at']     = date("Y-m-d H:i:s");
        $data['updated_at']     = date("Y-m-d H:i:s");

        $query = DB::table('schedules')->insert($data);

        if($query){
            Toastr::success('Congratulations, Schedule added sucessfully !!','Success');
            return Redirect::to('set-schedule');
        }else{
            Toastr::error('Alas !! Error occured, try again.','failed');
            return Redirect::to('set-schedule');
        }

    }
     public function editSchedule($id){
          $groups = DB::table('groups')->where('added_by',Session::get('user_id'))->get();
         $templates = DB::table('templates')->where('added_by',Session::get('user_id'))->get();
         
        $schedule=  DB::table('schedules')
            ->leftjoin('groups', 'schedules.group_id', '=', 'groups.id')
            ->leftjoin('templates', 'schedules.template_id', '=', 'templates.id')
            ->select('schedules.*', 'groups.group_name', 'templates.template_name')
            ->where('schedules.id',$id)->first();
            
        return view('admin.edit-schedule')->with('schedule',$schedule);
    }
    public function updateSchedule(Request $request){
        
        // Validation
        $this->validate($request, [
            'group_id' => 'required',
            'template_id' => 'required',
            'schedule_time' => 'required'
        ]);

        //Collecting data from html form
        $group_id = trim($request->group_id);
        $template_id = trim($request->template_id);
        $schedule_time = trim($request->schedule_time);
        $id = trim($request->id);

        $data = array();
        $data['group_id']  = $group_id;
        $data['template_id']  = $template_id;
        $data['schedule_time']  = $schedule_time;

        $query = DB::table('schedules')->where('id',$id)->update($data);

        if($query){
            Toastr::success('Congratulations, Schedule updated successfully !!','Success');
            return Redirect::to('set-schedule');
        }else{
            Toastr::error('Alas !! Error occurred, try again.','failed');
            return Redirect::to('edit-schedule/'.$id);
        } 
    }
    
    public function deleteSchedule($id){
        $query = DB::table('schedules')->where('id',$id)->delete();
        if($query){
            Toastr::success('Congratulations, Schedule Deleted sucessfully !!','Success');
            return Redirect::to('set-schedule');
        }else{
            Toastr::error('Alas !! Error occured, try again.','failed');
            return Redirect::to('set-schedule');
        }
    
        
    }

}
