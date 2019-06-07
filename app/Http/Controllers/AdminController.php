<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\UserReport;
use App\File;

class AdminController extends Controller
{
    public function show(){

        $tempUserReports = UserReport::all();
        $userReports = [];
        $seenReports = [];


        foreach ($tempUserReports as $report) {
            if($report->report->veridict == 'Pending')
                array_push($userReports,$report);
        }

        foreach ($tempUserReports as $report) {
            if($report->report->veridict != 'Pending')
                array_push($seenReports,$report);
        }

        return view('pages.admin', ['user' => Auth::user(),
                                    'userReports' => $userReports,
                                    'seenReports' => $seenReports
                                    ]);
    }
}