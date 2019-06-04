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
use Carbon\Carbon;

class EventController extends Controller
{   

    public function create(Request $request){
    

       $date_created = Carbon::now()->toDateTimeString();
       if($request->input('price')== null)
        $price = 0;
       else $price = $request->input('price');

       if( $request->input('is_private')=='public') 
        $private = false;
       else if( $request->input('is_private')=='private') 
        $private = true;

        $splitDatepicker = explode(' @', $request->input('date'), 2);
        $date = $splitDatepicker[0];
        $time = !empty($splitDatepicker[1]) ? $splitDatepicker[1] : '';
        $datetime = $date . $time;

        $event = Event::create([
            'title' => $request->input('title'),
            'date_created' => $date_created,
            'date' => $datetime,
            'location' => $request->input('street'),
            'description' => $request->input('title'),
            'price' => $price,
            'capacity' => $request->input('capacity'),
            'is_private' => $private,
            'id_owner' => Auth::user()->id_user,
            'id_category' => $request->input('category'),
            'city' => $request->input('city'),
            'zip_code' => $request->input('zip_code'),
            'country' => $request->input('country')
            ]);
        $event->save();


        return view('pages.event', ['event' => $event , 
                                        'friendsGoing' => $this->friendsGoing($event->id_event),
                                        'usersGoing' => $this->usersGoing($event->id_event),
                                        'categories' => Category::all()
                                        ] 
            );
    }

    public function show($id_event) {


        $this->friendsGoing($id_event);
        
        $event = Event::find($id_event);

        if(Auth::check() || $event->is_private){
            $this->authorize('view', $event);
        }

            return view('pages.event', ['event' => $event , 
                                        'friendsGoing' => $this->friendsGoing($id_event),
                                        'usersGoing' => $this->usersGoing($id_event),
                                        'categories' => Category::all()
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
