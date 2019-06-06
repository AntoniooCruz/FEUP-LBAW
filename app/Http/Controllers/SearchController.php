<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Str;

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

        return view('pages.search',['events' => $events,
                                    'categories' => Category::all(),'search' => $search_text,
                                    ]);
    }

    public function onpagesearch(Request $request) {

        $priceCats = $request->input('price');
        $categories = $request->input('categories');
        $events = null;

        $categoriesArray = explode(',', $categories);

        $categoriesNames = Category::all();
        $categoriesIds = [];



        for($i = 0; $i < count($categoriesArray); $i++){
            for($j = 0; $j < count($categoriesNames); $j++){
                if(Str::contains($categoriesNames[$j],$categoriesArray[$i])){
                    array_push($categoriesIds,$categoriesNames[$j]->id_category);
                }
            }
        }

        $arr = $categoriesIds;
        $arr = join(",",$arr);
        if($priceCats != null) {

            if(Str::contains($priceCats,'Free') && Str::contains($priceCats,'Paid')) {
                $events = DB::select("SELECT * FROM event WHERE search_tokens @@ plainto_tsquery('english',:search) 
                AND event.id_category IN (".$arr.") ORDER BY ts_rank(search_tokens,plainto_tsquery('english',:search)) 
                DESC;",['search' => $request->input('searchquery')]);
            } else if(Str::contains($priceCats,'Free')) {
                $events = DB::select("SELECT * FROM event WHERE search_tokens @@ plainto_tsquery('english',:search) 
                AND event.id_category IN (".$arr.") AND event.price = 0 ORDER BY ts_rank(search_tokens,plainto_tsquery('english',:search)) 
                DESC;",['search' => $request->input('searchquery')]);
            } else if(Str::contains($priceCats,'Paid')){
                $events = DB::select("SELECT * FROM event WHERE search_tokens @@ plainto_tsquery('english',:search) 
                AND event.id_category IN (".$arr.") AND event.price > 0 ORDER BY ts_rank(search_tokens,plainto_tsquery('english',:search)) 
                DESC;",['search' => $request->input('searchquery')]);
            }
        }
       
        return response()->json([$events,Category::all()], 200);
    }
}