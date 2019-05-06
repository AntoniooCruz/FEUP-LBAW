<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;


use App\Follow;
use App\User;
use App\Event;
use App\Ticket;

class ProfileController extends Controller
{
    public function show() {

        $user = Auth::user();

        $eventsOwned = Event::where('id_owner', $user->id_user)->get();
        
        $userTickets = Ticket::where('id_ticket_owner', $user->id_user)->get();
        $eventsAttending = [];

        foreach($userTickets as $ticket){
            array_push($eventsAttending,Event::where('id_event', $ticket->id_event)->first());
        }

        return view('pages.my-profile', ['user' => $user,
                                        'eventsOwned' => $eventsOwned, 
                                        'eventsAttending' => $eventsAttending
                                        ]);
    }

    public function showUser($id_user) {

        $user = User::find($id_user);

        $followers = sizeof(Follow::where('id_user2', $user->id_user)->get());
        $following = sizeof(Follow::where('id_user1', $user->id_user)->get());

        $eventsOwned = Event::where('id_owner', $id_user)->get();
        $userTickets = Ticket::where('id_ticket_owner', $id_user)->get();
        $eventsAttending = [];

        foreach($userTickets as $ticket){
            array_push($eventsAttending,Event::where('id_event', $ticket->id_event)->first());
        }

        return view('pages.profile', ['user' => $user, 'eventsOwned' => $eventsOwned, 'eventsAttending' => $eventsAttending]);
    }

    public function showEdit() {

        $user = Auth::user();

        $followers = sizeof(Follow::where('id_user2', $user->id_user)->get());
        $following = sizeof(Follow::where('id_user1', $user->id_user)->get());

        $eventsOwned = Event::where('id_owner', $user->id_user)->get();
        $userTickets = Ticket::where('id_ticket_owner', $user->id_user)->get();
        $eventsAttending = [];

        foreach($userTickets as $ticket){
            array_push($eventsAttending,Event::where('id_event', $ticket->id_event)->first());
        }

        return view('pages.edit-profile', ['user' => $user, 'eventsOwned' => $eventsOwned, 'eventsAttending' => $eventsAttending]);
    }


    protected function validator($data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:30',
            'username' => 'required|string|max:20',
            'email' => 'required|string|email|max:100',
            'description' => 'string|max:100',
        ])->validate();
    }

    public function update(Request $request) {
        
        $user = Auth::user();

        $this->validator($request->all());

        $user-> name = $request->input('name');
        $user-> username = $request->input('username');
        $user-> description = $request->input('description');
        $user->save();
        
        return redirect('profile');

    }

    public function remove(Request $request){
        $user = Auth::user();
        $user-> active = false;
        $user->save();

        return redirect('logout');
    }
}

