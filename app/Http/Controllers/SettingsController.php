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
use Brian2694\Toastr\Facades\Toastr;

class SettingsController extends Controller
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

    public function defaultSettings()
    {
        $settings = DB::table('settings')->where('id',1)->first();
        return view('admin.default-settings')->with('settings',$settings);
    }

    public function updateDefaultSettings(Request $request)
    {
        $default_sending_limit = $request->default_sending_limit;
        $default_days = $request->default_days;
        $expired_sending_limit = $request->expired_sending_limit;

        $data = array();
        $data['default_sending_limit'] = $default_sending_limit;
        $data['default_days'] = $default_days;
        $data['expired_sending_limit'] = $expired_sending_limit;

        $query = DB::table('settings')->where('id',1)->update($data);

        if($query){
            return "true";
        }else{
            return "false";
        }

    }

    public function extendValidity()
    {
        $customers = DB::table('admin')->where('type',0)->get();
        return view('admin.extend-validity')->with('customers',$customers);
    }

    public function updateExtendValidity(Request $request)
    {
        date_default_timezone_set('Asia/Dhaka');
        $customer_id = $request->customer_id;
        $default_sending_limit = $request->default_sending_limit;
        $default_days = $request->default_days;

        $today = date('Y-m-d');
        $date = new DateTime($today);
        $date->modify("+$default_days day");
        $validity_expire_at = $date->format("Y-m-d");

        $data['default_sending_limit'] = $default_sending_limit;
        $data['default_days'] = $default_days;
        $data['validity_expire_at'] = $validity_expire_at;
        $data['updated_at'] = $today;

        $query = DB::table('admin')->where('id',$customer_id)->update($data);

        if($query){
            return "true";
        }else{
            return "false";
        }
    }

    public function userValidityInfo()
    {
        date_default_timezone_set('Asia/Dhaka');

        $customer_id = Session::get('user_id');
        $query = DB::table('admin')->where('id',$customer_id)->first();

        $default_sending_limit = $query->default_sending_limit;
        $default_days = $query->default_days;
        $validity_expire_at = $query->validity_expire_at;
        $updated_at = $query->updated_at;

        // remaining day
        $today = date('Y-m-d');
        $date1 = new DateTime($today);  //current date or any date
        $date2 = new DateTime($validity_expire_at);   //Future date
        $diff = $date2->diff($date1)->format("%a");  //find difference

        $remaining = intval($diff);   //rounding days

        return view('admin.user-validity-info')
            ->with('default_sending_limit',$default_sending_limit)
            ->with('default_days',$default_days)
            ->with('validity_expire_at',$validity_expire_at)
            ->with('remaining',$remaining)
            ->with('updated_at',$updated_at);
    }

    public function getValidityInfo(Request $request)
    {
        date_default_timezone_set('Asia/Dhaka');

        $customer_id = $request->customer_id;
        $query = DB::table('admin')->where('id',$customer_id)->first();

        $default_sending_limit = $query->default_sending_limit;
        $default_days = $query->default_days;
        $validity_expire_at = $query->validity_expire_at;
        $updated_at = $query->updated_at;

        // remaining day
        $today = date('Y-m-d');
        $date1 = new DateTime($today);  //current date or any date
        $date2 = new DateTime($validity_expire_at);   //Future date
        $diff = $date2->diff($date1)->format("%a");  //find difference

        $remaining = intval($diff);   //rounding days

        if($query){
            return $default_sending_limit."#".$default_days."#".$validity_expire_at."#".$remaining."#".$updated_at;
        }else{
            return "false";
        }
    }

    public function addDivision()
    {
        $countries = DB::table('country')->get();
        // return view('admin.add-division')->with('countries',$countries);
        $division = DB::table('divisions')->get();
        return view('admin.manage-division')->with('countries',$countries)->with('division',$division);
    }

    public function storeDivision(Request $request)
    {
        $country_id = $request->country_id;
        $div_name = $request->div_name;
        $data = array();
        $data['country_id'] = $country_id;
        $data['div_name'] = $div_name;
        $query = DB::table('divisions')->insert($data);
        if($query){
           return "true";
        }else{
            return "false";
        }
    }
 
        public function deleteDivision($id)
       {

        $query = DB::table('divisions')->where('id',$id)->delete();

        if($query){
             Toastr::success('Congratulations, Division Deleted sucessfully !!','Success');
            return Redirect::to('add-division');
        }else{
            Toastr::error('Alas !! Error occured, try again','failed');
            return Redirect::to('add-division');
        }

    }
    
    // function for edit package
    public function editDivision($id)
    {
        $countries = DB::table('country')->get();
        $row = DB::table('divisions')->where('id',$id)->first();
        return view('admin.edit-division')->with('countries',$countries)->with('row',$row);
    }

    // function for update package
    public function updateDivision(Request $request)
    {
        // Validation
        $this->validate($request, [
            'div_name'   => 'required'
        ]);

        //Collecting data from html form
        $div_name     = $request->div_name;
        $contry_id     = $request->country;
        $id             = $request->id;

        //Check duplicatet primary category name
        $count = DB::table('divisions')
            ->where('div_name', $div_name)
            ->whereNotIn('id',[$id])
            ->count();

        if($count > 0){
            Toastr::error('Sorry ! already exits. Try to Add New Package','failed');
            // Session::put('failed','Sorry ! '.$group_name. ' already exits. Try to Add New Package');
            return Redirect::to('edit-division/'.$id);
            exit();
        }

        $data = array();
        $data['country_id'] = $contry_id;
        $data['div_name'] = $div_name;
        
        
        
        $query = DB::table('divisions')->where('id',$id)->update($data);

        if($query){
            Toastr::success('Congratulations, Division updated sucessfully !!','Success');
            return Redirect::to('add-division');
        }else{
            Toastr::error('Alas !! Error occured, try again','failed');
            return Redirect::to('add-division');
        }
    }


    public function addDistrict()
    {
        $districts = DB::table('districts')->paginate(15);
        $countries = DB::table('country')->get();
        return view('admin.manage-district')->with('countries',$countries)->with('districts', $districts);
    }

    public function storeDistrict(Request $request)
    {
        $division_id = $request->division_id;
        $ds_name = $request->ds_name;

        $data = array();
        $data['division_id'] = $division_id;
        $data['ds_name'] = $ds_name;
        $query = DB::table('districts')->insert($data);
        if($query){
           return "true";
        }else{
            return "false";
        }
    }
      public function deleteDistrict($id)
       {

        $query = DB::table('districts')->where('id',$id)->delete();

        if($query){
             Toastr::success('Congratulations, Districts Deleted sucessfully !!','Success');
            return Redirect::to('add-district');
        }else{
            Toastr::error('Alas !! Error occured, try again','failed');
            return Redirect::to('add-district');
        }

    }
    
    // function for edit package
    public function editDistrict($id)
    {
        $countries = DB::table('divisions')->get();
        $row = DB::table('districts')->where('id',$id)->first();
        return view('admin.edit-district')->with('countries',$countries)->with('row',$row);
    }

    // function for update package
    public function updateDistrict(Request $request)
    {
        // Validation
        $this->validate($request, [
            'ds_name'   => 'required'
        ]);

        //Collecting data from html form
        $ds_name     = $request->ds_name;
        $dis_id     = $request->district;
        $id             = $request->id;
        
        

        //Check duplicatet primary category name
        $count = DB::table('districts')
            ->where('ds_name', $ds_name)
            ->whereNotIn('id',[$id])
            ->count();

        if($count > 0){
            Toastr::error('Sorry ! already exits. Try to Add Anthoer ','failed');
            // Session::put('failed','Sorry ! '.$group_name. ' already exits. Try to Add New Package');
            return Redirect::to('edit-district/'.$id);
            exit();
        }

        $data = array();
        $data['division_id'] = $dis_id;
        
        $data['ds_name'] = $ds_name;
        
        $query = DB::table('districts')->where('id',$id)->update($data);

        if($query){
            Toastr::success('Congratulations, District updated sucessfully !!','Success');
            return Redirect::to('add-district');
        }else{
            Toastr::error('Alas !! Error occured, try again','failed');
            return Redirect::to('add-district');
        }
    }
    
    

    public function addUpzela()
    {
        $countries = DB::table('country')->get();
        $upzila = DB::table('upazilas')->paginate(15);
        return view('admin.manage-upzila')->with('upzila',$upzila)->with('countries',$countries);
    }

    public function storeUpzela(Request $request)
    {
        $district = $request->district;
        $upzela = $request->upzela;

        $data = array();
        $data['district_id'] = $district;
        $data['up_name'] = $upzela;
        $query = DB::table('upazilas')->insert($data);
        if($query){
           return "true";
        }else{
            return "false";
        }
    }
    
    public function deleteUpzela($id)
       {

        $query = DB::table('upazilas')->where('id',$id)->delete();

        if($query){
             Toastr::success('Congratulations, Upozila Deleted sucessfully !!','Success');
            return Redirect::to('add-district');
        }else{
            Toastr::error('Alas !! Error occured, try again','failed');
            return Redirect::to('add-district');
        }

    }
    
    // function for edit package
    public function editUpzela($id)
    {
        $countries = DB::table('districts')->get();
        $row = DB::table('upazilas')->where('id',$id)->first();
        return view('admin.edit-upzila')->with('countries',$countries)->with('row',$row);
    }

    // function for update package
    public function updateUpzela(Request $request)
    {
        // Validation
        $this->validate($request, [
            'up_name'   => 'required',
        ]);

        //Collecting data from html form
        $ds_name     = $request->up_name;
        $dis_id     = $request->district;
        $id             = $request->id;
   
        //Check duplicatet primary category name
        $count = DB::table('upazilas')
            ->where('up_name', $ds_name)
            ->whereNotIn('id',[$id])
            ->count();

        if($count > 0){
            Toastr::error('Sorry ! already exits. Try to Add Anthoer ','failed');
            // Session::put('failed','Sorry ! '.$group_name. ' already exits. Try to Add New Package');
            return Redirect::to('edit-upzela/'.$id);
            exit();
        }

        $data = array();
        $data['district_id'] = $dis_id;
        
        $data['up_name'] = $ds_name;
        
        $query = DB::table('upazilas')->where('id',$id)->update($data);

        if($query){
            Toastr::success('Congratulations, Upozila updated sucessfully !!','Success');
            return Redirect::to('add-upzela');
        }else{
            Toastr::error('Alas !! Error occured, try again','failed');
            return Redirect::to('add-upzela');
        }
    }

}
