<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use App\Http\Requests;
use Intervention\Image\ImageManagerStatic as Image;
use Intervention\Image\ImageManager;
use DB;
use Session;
use Brian2694\Toastr\Facades\Toastr;

class TemplateController extends Controller
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

    public function addTemplate(){
        return view('admin.add-template');
    }

    // function for add template info
    public function addTemplateInfo(Request $request)
    {
        //Collecting data from html form
        $templateName     = $request->templateName;
        $templateContent  = $request->templateContent;

        //Check duplicatet primary category name
        $count = DB::table('templates')
            ->where('template_name', $templateName)
            ->count();

        if($count > 0){
            Toastr::error('already exits. Try to add new template ','failed');
            // Session::put('failed','Sorry: '.$templateName. ' already exits. Try to add new template !!');
            return Redirect::to('manage-template');
            exit();
        }

        $data = array();
        $data['template_name']      = $templateName;
        $data['template_content']   = $templateContent;
        $data['added_by']           = Session::get('user_id');
        $data['created_at']         = $this->rcdate;

        $query = DB::table('templates')->insert($data);

        if($query){
            Toastr::success('Congratulations, Template added sucessfully ','Success');
            return Redirect::to('manage-template');
        }else{
            Toastr::error('Alas !! Error occured, try again.','failed');
            return Redirect::to('manage-template');
        }
    }

    // function for manage template
    public function manageTemplate()
    {
        $templates = DB::table('templates')->where('added_by',Session::get('user_id'))->get();
        return view('admin.manage-template')->with('templates',$templates);
    }

    // function for edit template
    public function editTemplate($id)
    {
        $row = DB::table('templates')->where('id',$id)->first();
        return view('admin.edit-template')->with('row',$row);
    }

    // function for update template
    public function updateTemplate(Request $request)
    {
         // Validation
        $this->validate($request, [
            'templateName'   => 'required',
            'templateContent'   => 'required'
        ]);

        //Collecting data from html form
        $templateName     = $request->templateName;
        $templateContent  = $request->templateContent;
        $id 			  = $request->id;
        
        // dd($templateContent);
        // exit();

        //Check duplicatet primary category name
        $count = DB::table('templates')
            ->where('template_name', $templateName)
            ->whereNotIn('id',[$id])
            ->count();

        if($count > 0){
            Toastr::error('already exits. Try to Add New Template','failed');
            return Redirect::to('editTemplate/'.$id);
            exit();
        }

        $data = array();
        $data['template_name']      = $templateName;
        $data['template_content']   = $templateContent;
        $data['modified_at']        = $this->rcdate;

        $query = DB::table('templates')->where('id',$id)->update($data);

        if($query){
            Toastr::success('Congratulations, Template added sucessfully !!','Success');
            return Redirect::to('manage-template');
        }else{
            Toastr::error('Alas !! Error occured, try again.','failed');
            // Session::put('failed','Alas !! Error occured, try again.');
            return Redirect::to('manage-template');
        }
    }

    // function for delete template
    public function deleteTemplate($id)
    {
        // $id = $request->template_id;
        // // dd($id);
        $query = DB::table('templates')->where('id',$id)->delete();
        if($query){
             Toastr::success('Congratulations, Template added sucessfully !!','Success');
            
            return Redirect::to('manage-template');
        }else{
            Toastr::error('Alas !! Error occured, try again.','failed');
            return Redirect::to('manage-template');
        }
    }

}
