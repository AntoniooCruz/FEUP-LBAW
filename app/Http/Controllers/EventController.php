<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


use App\Event;
use App\Category;
use App\User;
use App\Ticket;


class EventController extends Controller
{   

    public function getCategoryName($event) {
        
        $category = Category::where('id_category', $event->id_category)->get()->first();

        return $category->name;
    }

    public function getCreator($event) {

        return User::where('id_user', $event->id_owner)->get()->first()->name;
    }

    public function getSoldTicketsCount($event) {

        return $ticketsSold = Ticket::where('id_event', $event->id_event)->get()->count();
    }

    public function show($id_event) {

        $this->friendsGoing($id_event);
        
        $event = Event::find($id_event);

        return view('Pages.event', ['event' => $event , 'eventCategoryName' => $this->getCategoryName($event),
         'eventCreator' => $this->getCreator($event), 'eventSoldTicketsCount' => $this->getSoldTicketsCount($event)]);
    }

    public function friendsGoing($id_event){

        $ticketsSold = Ticket::where('id_event', $id_event)->get();
        $idsUsersGoing = $ticketsSold->map(function($item, $key) {
            return $item->id_ticket_owner;
        });

        return User::find(3)->following()->whereIn('id_user', $idsUsersGoing)->get();
    }

}
