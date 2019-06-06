<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\UserReport;

class AdminController extends Controller
{
    public function show(){

        $tempUserReports = UserReport::all();
        $userReports = [];

        foreach ($tempUserReports as $report) {

            if($report->first()->report->veridict == 'Pending')
                array_push($userReports,$report);
        }

        return view('pages.admin', ['user' => Auth::user(),
                                    'userReports' => $userReports]);
    }
}