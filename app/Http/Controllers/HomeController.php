<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Event;
use App\Ticket;
use App\User;
use App\Comment;
use App\Post;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::check()){
            $user = User::find(1);
            if($user->user_type == 'Personal'){
                $canViewEvents = DB::select('SELECT e1.id_event 
                FROM event e1,users user1, category, users user2
                WHERE e1.id_owner=user1.id_user
                    AND e1.id_category=category.id_category
                        AND user2.username = :username
                        AND (	is_private = false
                                OR
                                (user2.id_user IN (SELECT id_invitee
                                                    FROM invite
                                                    WHERE invite.id_event=e1.id_event
                                                )
                                )
                            );',['username' => $user->username]);

                $ids = [];
                foreach($canViewEvents as $id){
                    array_push($ids,$id->id_event);
                }
                $following = $user->following()->get()->pluck('id_user')->toArray();

                $events = Event::whereIn('id_event',$ids)
                                ->whereIn('id_owner',$following)
                                ->get();
                
                $events_id = $events->pluck('id_event');
                $events_id = $events_id->toArray();

                $posts = Post::whereIn('id_event',$events_id)
                                ->get();

                $posts_id = $posts->pluck('id_post');
                $posts_id = $posts_id->toArray();

                $comments = Comment::whereIn('id_post',$posts_id)
                                    ->get();
                $tickets = Ticket::whereIn('id_event',$events_id)
                                    ->get();

                $feed_items = collect([]);

                foreach($events as $event){
                    $feed_items->push($event);
                }
                foreach($posts as $post){
                    $feed_items->push($post);
                }
                foreach($comments as $comment){
                    $feed_items->push($comment);
                }
                foreach($tickets as $ticket){
                    $feed_items->push($ticket);
                }

                $feed_items = $feed_items->sortBy(function($item){
                    if(is_a($item,'App\Ticket')){
                       return $item->date_acquired;
                    } else if(is_a($item,'App\Event')){
                        return $item->date_created;
                    } else if(is_a($item,'App\Comment')){
                        return $item->date;
                    } else {
                        return $item->date;
                    }
                    return $item->date;
                })->values()->all();
                
                /*$trending = Event::where('is_private',false)->get();
                $trending = $trending->sortBy(function($item){
                    
                    return $item->date;
                })->values()->all();
                dd($trending);*/
               return view('pages.feed',['items' => $feed_items]);
            } else {
                return redirect('profile');
            }
        } else {
            return view('home');
        }
    }
}
