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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Invite  $invite
     * @return \Illuminate\Http\Response
     */
    public function show(Invite $invite)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Invite  $invite
     * @return \Illuminate\Http\Response
     */
    public function edit(Invite $invite)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Invite  $invite
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Invite $invite)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Invite  $invite
     * @return \Illuminate\Http\Response
     */
    public function destroy(Invite $invite)
    {
        //
    }
    public function usersGoing($id_event){

        $ticketsSold = Ticket::where('id_event', $id_event)->get();
        $idsUsersGoing = $ticketsSold->map(function($item, $key) {
            return $item->id_ticket_owner;
        });

        return $idsUsersGoing;
    }
    


    public function showMyTickets(){

        $user = Auth::user();
        $id_user = $user->id_user;
        //dd($user);

        //INSERT INTO ticket (id_event,id_ticket_owner,date_acquired,checked_in) VALUES (1, 1,'5/16/2018',false);
        //INSERT INTO event (title, date_created, date, location, description, price, capacity, is_private, id_owner, id_category, city,search_tokens) 
        //VALUES ('My 21st BDAY', '1/11/2018', '12/1/2020 02:11:00', '8446 Rockefeller Parkway', 'ut at dolor queima odio consequat varius', 127, 20, false, 12, 6, 'Vukatanë',null);


        //DB::table('event')->insert(
        //    ['title' => 'Bday','date_created' => '5/16/2018' ,'date' => '9/16/2019' ,'location' => '8446 Rockefeller Parkway' ,'description' => 'ut at dolor queima odio consequat varius' ,'price' => 20 ,'capacity' => 100 ,'is_private' => false ,'id_owner' => 10 ,'id_category' => 2 ,'city' => 'Porto' ,'search_tokens' => null]
        //);

        //DB::table('ticket')->insert(
        //    ['id_event' => 23,'id_ticket_owner' => 34, 'date_acquired' => '5/16/2018' ,'checked_in' => false]
        //);

        //$tickets = Ticket::where('id_ticket_owner', $id_user)->get();

        $activeEvents = [];
        $activeEventsTickets = Ticket::where('id_ticket_owner', $id_user)->get();
        $activeEventsCreators = [];


        $pastEvents = [];
        $pastEventsTickets = Ticket::where('id_ticket_owner', $id_user)->get();
        $pastEventsCreators = [];

        $date_created = Carbon::now();

        foreach($activeEventsTickets as $ticket){
            //TODO diferenciar eventos futuros e eventos passados
            //array_push($eventsInvited,Event::where('id_event', $invite->id_event)->first());
            array_push($activeEvents, Event::where('id_event', $ticket->id_event)->first());
            array_push($pastEvents, Event::where('id_event', $ticket->id_event)->first());
            //array_push($activeEventsCreators, User::where('id_user', )->where( , $ticket->id_event));
        }
        
        return view('pages.my-tickets',['user' => $user,
                                    'categories' => Category::all(),
                                    'activeEvents' => $activeEvents,
                                    'activeEventsTickets' => $activeEventsTickets,
                                    'activeEventsCreator' => $activeEventsCreators,
                                    'pastEvents' => $pastEvents,
                                    'pastEventsTickets' => $pastEventsTickets,
                                    'pastEventsCreator' => $pastEventsCreators]);
    }
}
