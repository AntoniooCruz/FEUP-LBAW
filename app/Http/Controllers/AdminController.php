<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\UserReport;
use App\EventReport;
use App\PostReport;
use App\File;
use App\User;
use App\Business;

class AdminController extends Controller
{
    public function show(){
        if(Auth::user()->isAdmin == false)
            return redirect('home');
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

        $tempEventReports = EventReport::all();
        $eventReports = [];
        $seenEventReports = [];

        foreach ($tempEventReports as $report) {
            if($report->report->veridict == 'Pending')
                array_push($eventReports,$report);
        }

        foreach ($tempEventReports as $report) {
            if($report->report->veridict != 'Pending')
                array_push($seenEventReports,$report);
        }

        $tempPostReports = PostReport::all();
        $postReports = [];
        $seenPostReports = [];

        foreach ($tempPostReports as $report) {
            if($report->report->veridict == 'Pending')
                array_push($postReports,$report);
        }

        foreach ($tempPostReports as $report) {
            if($report->report->veridict != 'Pending')
                array_push($seenPostReports,$report);
        }

        $tempBusinessUsers = Business::all();
        $businessUsers = [];
        foreach ($tempBusinessUsers as $user) {
            if($user->verification == 'Pending')
                array_push($businessUsers,$user);
        }


        return view('pages.admin', ['user' => Auth::user(),
                                    'userReports' => $userReports,
                                    'seenReports' => $seenReports,
                                    'eventReports' => $eventReports,
                                    'seenEventReports' => $seenEventReports,
                                    'postReports' => $postReports,
                                    'seenPostReports' => $seenPostReports,
                                    'business' => $businessUsers
                                    ]);
    }
}