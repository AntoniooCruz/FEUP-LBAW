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

        $user = User::find($id_user); //TODO: passar para findOrFail
        
        //$followers = sizeof(Follow::where('id_user2', $user->id_user)->get());
        $followers = $user->followers()->count();
        //$following = sizeof(Follow::where('id_user1', $user->id_user)->get());
        $following = $user->following()->count();

        $isFollowing = null;

        if (Auth::check()) {
            $isFollowing = Auth::user()->following()->wherePivot('id_user2', $id_user)->exists();
        }

        $eventsOwned = Event::where('id_owner', $id_user)->get();
        $userTickets = Ticket::where('id_ticket_owner', $id_user)->get();
        $eventsAttending = [];

        foreach($userTickets as $ticket){
            array_push($eventsAttending,Event::where('id_event', $ticket->id_event)->first());
        }

        return view('pages.profile', ['user' => $user, 'eventsOwned' => $eventsOwned, 'eventsAttending' => $eventsAttending, 'isFollowing' => $isFollowing]);
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

    public function followUser($id) {

        if (!Auth::check()) {
            return response(403);
        }

        $user1 = Auth::user();
        $user2 = User::findOrFail($id);

        try {
            Follow::updateOrCreate(array('id_user1' => $user1->id_user, 'id_user2' => $user2->id_user));
        } catch (Exception $e) {
            return response()->json(["error" => $e], 400);
        }

        return response(200);
    }

    public function unfollowUser($id) {

        if (!Auth::check()) {
            return response(403);
        }

        $user1 = Auth::user();

        try {
            $f = Follow::where('id_user1', $user1->id_user)->where('id_user2', $id)->firstOrFail();
            $f->delete();
        } catch (Exception $e) {
            return response()->json(["error" => $e], 400);
        }

        return response(200);
    }
}

