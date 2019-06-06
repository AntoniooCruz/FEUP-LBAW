<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

use App\Report;
use App\UserReport;

use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function accept(Request $request, $id_request){

        if (!Auth::check()) 
        return response()->json(400);

        $report = Report::find($id_request);
        $report->veridict = "Approved";
        $report->id_admin = Auth::user()->id_user;
        $report->save();
        return response()->json(['id_request'=>$id_request],200);

    }
}
