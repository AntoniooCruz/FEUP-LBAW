<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Follow;
use App\User;
use App\Event;
use App\Ticket;

class ProfileController extends Controller
{
    public function show() {

        $user = Auth::user();

        $followers = sizeof(Follow::where('id_user2', $user->id_user)->get());
        $following = sizeof(Follow::where('id_user1', $user->id_user)->get());

        $eventsOwned = Event::where('id_owner', 3)->get();
        $userTickets = Ticket::where('id_ticket_owner', 3)->get();
        $eventsAttending = [];

        foreach($userTickets as $ticket){
            array_push($eventsAttending,Event::where('id_event', $ticket->id_event)->first());
        }

        return view('profile', ['user' => $user, 'followers' => $followers, 'following' =>$following, 'eventsOwned' => $eventsOwned, 'eventsAttending' => $eventsAttending]);
    }

}

