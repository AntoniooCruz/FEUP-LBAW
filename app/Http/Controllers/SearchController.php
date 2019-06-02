<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Input;

use App\Event;
use App\Category;
use App\User;
use App\Ticket;
use Carbon\Carbon;

class SearchController extends Controller
{   
    public function search() {
        $search_text = Input::get('search');

        $events = DB::select("SELECT * FROM event WHERE search_tokens @@ plainto_tsquery('english',:search) 
        ORDER BY ts_rank(search_tokens,plainto_tsquery('english',:search)) 
        DESC;",['search' => $search_text]);

        return view('pages.search',['events' => $events
        ]);
    }


}
