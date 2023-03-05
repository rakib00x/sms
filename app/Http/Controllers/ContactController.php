<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests;
use App\Mail\TestEmail;
use DB;
use Intervention\Image\ImageManagerStatic as Image;
use Session;
use Mail;
use Config;
use Illuminate\Support\Facades\Validator;
use Str;
use Brian2694\Toastr\Facades\Toastr;

class ContactController extends Controller
{
    public function __construct()
    {
        date_default_timezone_set('Asia/Dhaka');
        $this->rcdate           = date('Y-m-d');
        $this->logged_id        = Session::get('user_id');
        $this->current_time     = date("H:i:s");
    }

    // function for add leads by txt
    public function addContactByTxt()
    {
        $groups = DB::table('groups')->get();
        return view('admin.add-contact-by-txt')->with('groups',$groups);
    }

    // function for add leads info by txt file
    public function upload(Request $request)
    {
        // Validation
        $rules = array(
            'txtfile'  => 'required|max:900|mimes:txt,csv'
        );

        $error = Validator::make($request->all(), $rules);

        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
            exit();
        }

        //Collecting data from html form
        $txtfile    = $request->file('txtfile');
        $group_id   = trim($request->group_id);

        $image_name        = Str::random(10).time();
        $ext               = strtolower($txtfile->getClientOriginalExtension());
        $image_full_name   = $image_name.'.'.$ext;
        $upload_path       = "frontend/txtfile/";
        $txtfile->move($upload_path,$image_full_name);

        $myfile = fopen("frontend/txtfile/".$image_name.'.'.$ext, "r") or die("Unable to open file!");
        $read_file = fread($myfile,filesize("frontend/txtfile/".$image_name.'.'.$ext));
        fclose($myfile);

        $explode = explode("\n", $read_file);

        // var_dump($explode);
        // exit();

        foreach ($explode as $explode_value) {
            $mobile = trim($explode_value);
            $data = array();
            $data['group_id'] = $group_id;
            $data['name'] = "Unknown";
            $data['mobile'] = $mobile;
            $data['photo'] = 'default.jpg';
            $data['added_by'] = Session::get('user_id');
            $data['created_by'] = date('Y-m-d H:i:s');
            $data['updated_at'] = date('Y-m-d H:i:s');
            if($mobile != NULL){
                $count = DB::table('contacts')->where('group_id',$group_id)->where('mobile',$mobile)->count();
                if($count == 0){
                    DB::table('contacts')->insert($data);
                }
            }
        }

        $output = array(
            'success' => 'File Uploaded Successfully'
        );
        return response()->json($output);

        // Session::put('success','Congratulations, Leads added sucessfully By txt !!');
        // return Redirect::to('addLeadsByTxt');
    }

    ## Start of File upload by apps ##

    public function getFileUploadByApps()
    {
        $user_id = Session::get('user_id');
        $encoded = base64_encode($user_id);
        return view('upload.index')->with('encoded',$encoded);
    }

    public function addContactByTxtByApps($user_id)
    {
        $decoded = base64_decode($user_id);
        $groups = DB::table('groups')->where('id',$decoded)->get();
        return view('upload.upload')->with('groups',$groups)->with('decoded',$decoded);
    }

    // function for add leads info by txt file
    public function uploadbyapps(Request $request)
    {

        // Validation
        $this->validate($request, [
            'group_id' => 'required',
            'txtfile'  => 'required|mimes:csv,txt|max:30000',
        ]);

        //Collecting data from html form
        $txtfile    = $request->file('txtfile');
        $group_id   = trim($request->group_id);
        $user_id = $request->user_id;

        $image_name        = Str::random(10).time();
        $ext               = strtolower($txtfile->getClientOriginalExtension());
        $image_full_name   = $image_name.'.'.$ext;
        $upload_path       = "frontend/txtfile/";
        $txtfile->move($upload_path,$image_full_name);

        $myfile = fopen("frontend/txtfile/".$image_name.'.'.$ext, "r") or die("Unable to open file!");
        $read_file = fread($myfile,filesize("frontend/txtfile/".$image_name.'.'.$ext));
        fclose($myfile);

        $explode = explode("\n", $read_file);

        // var_dump($explode);
        // exit();

        foreach ($explode as $explode_value) {
            $mobile = trim($explode_value);
            $data = array();
            $data['group_id'] = $group_id;
            $data['name'] = "Unknown";
            $data['mobile'] = $mobile;
            $data['photo'] = 'default.jpg';
            $data['added_by'] = $user_id;
            $data['created_by'] = date('Y-m-d H:i:s');
            $data['updated_at'] = date('Y-m-d H:i:s');
            if($mobile != NULL){
                $count = DB::table('contacts')->where('group_id',$group_id)->where('mobile',$mobile)->count();
                if($count == 0){
                    DB::table('contacts')->insert($data);
                }
            }
        }

        $encoded = base64_encode($user_id);
        Toastr::success('Congratulations, Contact added sucessfully !!','Success');
        return Redirect::to('file-upload-by-apps/'.$encoded);
    }
    ## End of File upload by apps ##

    // function for manage leads by txt
    public function manageContact()
    {
        $contacts = DB::table('groups')->where('added_by',Session::get('user_id'))->get();
        $groups = DB::table('groups')->where('added_by',Session::get('user_id'))->get();
        return view('admin.manage-contact')->with('contacts',$contacts)->with('groups',$groups);
    }

    // function for view leads by package
    public function getAllContactByGroup(Request $request)
    {
        $group_id = $request->group_id;
        $packageQuery = DB::table('groups')->where('id',$group_id)->first();

        $result = DB::table('contacts')
            ->join('groups','contacts.group_id','=','groups.id')
            ->select('contacts.*','groups.*','contacts.id as contact_id')
            ->where('contacts.group_id',$group_id)
            ->get();

        return view('admin.reports.get-contact-by-group')->with('result',$result)->with('packageQuery',$packageQuery);
    }

    public function editContact($id){
        $contact = DB::table('contacts')->where('id',$id)->first();
        return view('admin.edit-contact')->with('contact',$contact);
    }

    public function updateContact(Request $request){

        // Validation
        $this->validate($request, [
            'mobile' => 'required'
        ]);

        //Collecting data from html form
        $mobile = trim($request->mobile);
        $_id = trim($request->_id);

        //Check duplicatet user name
        $count = DB::table('contacts')->whereNotIn('id',[$_id])->where('mobile',$mobile)->count();

        $scan = DB::table('contacts')->where('id',[$_id])->first();
        $recent_lead = $scan->mobile;

        if($count > 0){
            Toastr::error('Sorry ! contact already exits. Try to add new lead !!','failed');
            return Redirect::to('edit-contact/'.$_id);
        }

        if($mobile == $recent_lead){
            Toastr::error('Sorry ! this is your current email, nothing new here !!','failed');
            // Session::put('failed','Sorry ! '.$mobile. ' this is your current email, nothing new here !!');
            return Redirect::to('edit-contact/'.$_id);
        }

        $data = array();
        $data['mobile']  = $mobile;

        $query = DB::table('contacts')->where('id',$_id)->update($data);

        if($query){
            Toastr::success('Congratulations, contact updated successfully !!','Success');
            return Redirect::to('edit-contact/'.$_id);
        }else{
            Toastr::error('Alas !! Error occurred, try again.','failed');
            return Redirect::to('edit-contact/'.$_id);
        }
    }

    public function deleteContact(Request $request){
        $id = $request->contact_id;
        $query = DB::table('contacts')->where('id',$id)->delete();
        if($query){
            return "true";
        }else{
            return "false";
        }
    }

    public function addContact()
    {
        $groups = DB::table('groups')->get();
        return view('admin.add-contact')->with('groups',$groups);
    }

    public function addContactInfo(Request $request)
    {
        // Validation
        $this->validate($request, [
            'group_id' => 'required',
            'mobile' => 'required'
        ]);


        // Collecting data from html form
        $group_id       = trim($request->group_id);
        $name           = trim($request->name);
        $mobile         = trim($request->mobile);
        $email          = trim($request->email);
        $photo          = $request->file('photo');
        $occupation     = trim($request->occupation);
        $designation    = trim($request->designation);
        $institute      = trim($request->institute);
        $location       = trim($request->location);
        $relation       = trim($request->relation);

        //Check duplicatet user name
        $count = DB::table('contacts')->where('group_id',$group_id)->where('mobile',$mobile)->count();
        $groupQuery = DB::table('groups')->where('id',$group_id)->first();
        $group_name = $groupQuery->group_name;

        if($count > 0){
            Toastr::error('Sorry ! contact already exits in group, try to add unique contact','failed');
            // Session::put('failed','Sorry ! '.$mobile. ' contact already exits in '.$group_name.' group, try to add unique contact');
            return Redirect::to('manage-contact');
            exit();
        }

        $data = array();

        $year = date('Y');

        if($request->hasfile('photo')){
            $imagename       = $year.'_'. \Illuminate\Support\Str::random(16).'_'.time()*rand(111,999).'_'.Str::random(4);
            $image_full_name = $imagename.'.'.$photo->extension();
            $filePath = public_path('/frontend/contact');
            $img = Image::make($photo->path());
            $img->save($filePath.'/'.$image_full_name);
            $data['photo']            = $image_full_name;
        }

        $data['group_id']         = $group_id;
        $data['name']             = $name;
        $data['mobile']           = $mobile;
        $data['email']            = $email;

        $data['occupation']       = $occupation;
        $data['designation']      = $designation;
        $data['institute']        = $institute;
        $data['location']         = $location;
        $data['relation']         = $relation;
        $data['added_by']         = Session::get('user_id');
        $data['created_by']       = date('Y-m-d H:i:s');
        $data['updated_at']       = date('Y-m-d H:i:s');

        $query = DB::table('contacts')->insert($data);

        if($query){
            Toastr::success('Congratulations, Contact added sucessfully !!','Success');
            return Redirect::to('manage-contact');
        }else{
            Toastr::error('Alas !! Error occured, try again.','failed');
            return Redirect::to('manage-contact');
        }

    }

    public function getContactCountByUpzela(Request $request)
    {
        $country_id = $request->country_id;
        $division_id = $request->division_id;
        $district_id = $request->district_id;
        $upzila = $request->upzila;
        $count = DB::table('contacts')->where('country',$country_id)->where('division',$division_id)->where('district',$district_id)->where('upzila',$upzila)->count();
        return $count;
    }

    public function myContact()
    {
        $contacts = DB::table('contacts')->where('added_by',Session::get('user_id'))->orderBy('name', 'ASC')->get();
        return view('admin.my-contact')->with('contacts',$contacts);
    }

}
