<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;


use App\Invite;
use App\User;
use App\Event;
use App\Ticket;
use App\Category;
use Carbon\Carbon;



class TicketController extends Controller
{

    public function usersGoing($id_event){

        $ticketsSold = Ticket::where('id_event', $id_event)->get();
        $idsUsersGoing = $ticketsSold->map(function($item, $key) {
            return $item->id_ticket_owner;
        });

        return $idsUsersGoing;
    }
    


    public function showMyTickets(){

        if(Auth::check()){
            $user = Auth::user();

            DB::beginTransaction();

            try{
            $id_user = $user->id_user;

            $tickets = Ticket::where('id_ticket_owner', $id_user)->get();


            $event = Event::where('id_event', 24)->first();

            $activeEvents = [];
            $activeEventsTickets = [];

            $pastEvents = [];
            $pastEventsTickets = [];

            $now = Carbon::now()->toDateTimeString();

            foreach($tickets as $ticket){

                if( strcmp($ticket->event->date, $now)){
                    //active
                    array_push($activeEvents, Event::where('id_event', $ticket->id_event)->first());
                    array_push($activeEventsTickets, $ticket);

                }else {
                    // past
                    array_push($pastEvents, Event::where('id_event', $ticket->id_event)->first());
                    array_push($pastEventsTickets, $ticket);
                }

            } 
            DB::commit();
            
        } catch (\Throwable $th) {
            DB::rollback();
        }
            return view('pages.my-tickets',['user' => $user,
                                        'categories' => Category::all(),
                                        'activeEvents' => $activeEvents,
                                        'activeEventsTickets' => $activeEventsTickets,
                                        'pastEvents' => $pastEvents,
                                        'pastEventsTickets' => $pastEventsTickets]);
        } else return redirect('login');
    }
}
