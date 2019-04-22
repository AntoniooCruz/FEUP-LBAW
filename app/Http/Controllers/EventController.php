<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Event;

class EventController extends Controller
{
    public function show($id_event) {
        
        $event = Event::find($id_event);

        return view('event', ['event' => $event]);
    }

}
