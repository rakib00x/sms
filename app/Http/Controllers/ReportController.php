<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use App\Http\Requests;
use DB;
use Session;

class ReportController extends Controller
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

    public function groupWiseReport()
    {
        $groups = DB::table('groups')->get();
        return view('report.group-wise-report')->with('groups',$groups);
    }

    public function getGroupWiseReport(Request $request)
    {

        $from_date  = $request->from_date;
        $to_date    = $request->to_date;

        $from       = date('Y-m-d',strtotime($from_date));
        $to         = date('Y-m-d',strtotime($to_date));
        $group_id   = $request->group_id;

        $groups     = DB::table('history')
                    ->where('group_id',$group_id)
                    ->whereBetween('created_at', [$from.' 00:00:00',$to.' 23:59:59'])
                    ->get();

        return view('admin.reports.get-group-wise-report')->with('groups',$groups);
    }

    public function singleWiseReport()
    {
        return view('report.single-wise-report');
    }

    public function getSingleWiseReport(Request $request)
    {

        $from_date  = $request->from_date;
        $to_date    = $request->to_date;

        $from       = date('Y-m-d',strtotime($from_date));
        $to         = date('Y-m-d',strtotime($to_date));
        $mobile     = $request->mobile;

        $groups     = DB::table('history')
                    ->where('mobile',$mobile)
                    ->whereBetween('created_at', [$from.' 00:00:00',$to.' 23:59:59'])
                    ->get();

        return view('admin.reports.get-single-wise-report')->with('groups',$groups);
    }

}
