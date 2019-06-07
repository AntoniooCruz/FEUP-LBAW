<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

use App\Report;
use App\UserReport;
use App\EventReport;
use App\File;
use App\Event;

use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function accept(Request $request, $id_request){

        if (!Auth::check()) 
        return response()->json(400);
        /*if(Auth::user()->id_admin == false)
            return response()->json(400);*/
        //handle report
        $report = Report::find($id_request);
        $report->veridict = "Approved";
        $report->id_admin = Auth::user()->id_user;
        $report->save();

        if($report->report_type == "User"){
            $user = UserReport::find($id_request)->reportee;
            $user->active = false;
            $user->save();
        }


        if($report->report_type == "Event"){
            $event = EventReport::find($id_request)->event;
            /*Event::where("id_event",)*/
        }
        

        return response()->json(['id_report'=>$id_request],200);

    }

    public function archive(Request $request, $id_request){

        if (!Auth::check()) 
        return response()->json(400);

        //handle report
        $report = Report::find($id_request);
        $report->veridict = "Ignored";
        $report->id_admin = Auth::user()->id_user;
        $report->save();

        return response()->json(['id_report'=>$id_request],200);

    }
}
