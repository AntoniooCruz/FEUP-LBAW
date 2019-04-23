<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Collection;
use App\Event;
use App\Category;
use App\User;
use App\Ticket;


class EventController extends Controller
{   

    public function show($id_event) {


        $this->friendsGoing($id_event);
        
        $event = Event::find($id_event);

        if(Auth::check() || $event->isprivate){
            $this->authorize('view', $event);
        }

            return view('Pages.event', ['event' => $event , 
                                        'friendsGoing' => $this->friendsGoing($id_event),
                                        'usersGoing' => $this->usersGoing($id_event)
                                        ] 
            );

        
    }

    public function friendsGoing($id_event){

        $ticketsSold = Ticket::where('id_event', $id_event)->get();
        $idsUsersGoing = $ticketsSold->map(function($item, $key) {
            return $item->id_ticket_owner;
        });
        //temporary
        if(Auth::check()){
            return Auth::user()->following()->whereIn('id_user', $idsUsersGoing)->get();
        } else return new Collection();
    }

    public function usersGoing($id_event){

        $ticketsSold = Ticket::where('id_event', $id_event)->get();
        $idsUsersGoing = $ticketsSold->map(function($item, $key) {
            return $item->id_ticket_owner;
        });

        return $idsUsersGoing;
    }

}
