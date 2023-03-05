<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use App\Http\Requests;
use Brian2694\Toastr\Facades\Toastr;
use DB;
use Session;


class GroupController extends Controller
{

    public function __construct()
    {
        date_default_timezone_set('Asia/Dhaka');
        $this->rcdate           = date('Y-m-d');
        $this->logged_id        = Session::get('user_id');
        $this->current_time     = date("H:i:s");
    }

    // function for add package
    public function addGroup()
    {
        return view('admin.add-group');
    }

    // function for add package info
    public function addGroupInfo(Request $request)
    {
        // Validation
        $this->validate($request, [
            'group_name'   => 'required'
        ]);

        //Collecting data from html form
        $group_name  = trim($request->group_name);

        //Check duplicatet primary category name
        $count = DB::table('groups')
            ->where('group_name', $group_name)
            ->count();

        if($count > 0){
            Toastr::error(' already exits. try to add new group','failed');
            // Session::put('failed','Sorry ! '.$group_name. ' already exits. try to add new group');
            return Redirect::to('manage-group');
            exit();
        }

        $data = array();
        $data['group_name']     = $group_name;
        $data['added_by']       = Session::get('user_id');
        $data['created_at']     = date('Y-m-d H:i:s');

        $query = DB::table('groups')->insert($data);

        if($query){
            Toastr::success('Congratulations, Group added sucessfully !!','Success');
            // Session::put('success','Congratulations, Group added sucessfully !!');
            return Redirect::to('manage-group');
        }else{
            Toastr::error('Alas !! Error occured, try again.','failed');
            return Redirect::to('manage-group');
        }
    }

    public function manageGroup(){
        $result = DB::table('groups')->where('added_by',Session::get('user_id'))->get();
        return view('admin.manage-group')->with('result',$result);
    }

    // function for edit package
    public function editGroup($id)
    {
        $row = DB::table('groups')->where('id',$id)->first();
        return view('admin.edit-group')->with('row',$row);
    }

    // function for update package
    public function updateGroupInfo(Request $request)
    {
        // Validation
        $this->validate($request, [
            'group_name'   => 'required'
        ]);

        //Collecting data from html form
        $group_name     = trim($request->group_name);
        $id             = trim($request->_id);

        //Check duplicatet primary category name
        $count = DB::table('groups')
            ->where('group_name', $group_name)
            ->whereNotIn('id',[$id])
            ->count();

        if($count > 0){
            Toastr::error('Sorry ! already exits. Try to Add New Package','failed');
            // Session::put('failed','Sorry ! '.$group_name. ' already exits. Try to Add New Package');
            return Redirect::to('edit-group/'.$id);
            exit();
        }

        $data = array();
        $data['group_name']    = $group_name;
        $data['modified_at']     = date('Y-m-d H:i:s');

        $query = DB::table('groups')->where('id',$id)->update($data);

        if($query){
            Toastr::success('Congratulations, Group updated sucessfully !!','Success');
            return Redirect::to('manage-group');
        }else{
            Toastr::error('Alas !! Error occured, try again','failed');
            return Redirect::to('manage-group');
        }
    }

    // function for delete package
    public function deleteGroup($id)
    {

        $query = DB::table('groups')->where('id',$id)->delete();

        if($query){
             Toastr::success('Congratulations, Group Deleted sucessfully !!','Success');
            return Redirect::to('manage-group');
        }else{
            Toastr::error('Alas !! Error occured, try again','failed');
            return Redirect::to('manage-group');
        }

    }
    // public function deleteGroup($id)
    // {
    //     $check = DB::table('tbl_leads')->where('package_id',$id)->count();

    //     if($check > 0){
    //         Session::put('failed','Sorry !! This group used in Leads List You Can Not Delete, try again.');
    //         return Redirect::to('manage-group');
    //     }

    //     $query = DB::table('groups')->where('id',$id)->delete();

    //     if($query){
    //         Session::put('success','Congratulations, Group Deleted sucessfully !!');
    //         return Redirect::to('manage-group');
    //     }else{
    //         Session::put('failed','Alas !! Error occured, try again.');
    //         return Redirect::to('manage-group');
    //     }

    // }
}
