<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Collection;
use App\Event;
use App\Category;
use App\User;
use App\Ticket;
use App\Post;
use App\Comment;
use Carbon\Carbon;
use App\Invite;

class EventController extends Controller
{   
    protected function validator($data)
    {

        return Validator::make($data, [
            'title' => 'required|string|max:50',
            'date' => 'required|string|regex:/[0-9]{2}\/[0-9]{2}\/[0-9]{4} @ [0-9][0-9]?:[0-9]{2}/',
            'location' => 'string|max:40|nullable',
            'description' => 'string|max:100|nullable',
            'price' => 'numeric|max:20|nullable',
            'capacity' => 'integer|nullable',
            'city' => 'string|max:30|nullable',
            'zip_code' => 'string|max:6|nullable',
            'country' => 'string|max:30|nullable'
        ])->validate();
        
    }

    public function create(Request $request){

        $this->validator($request->all());

       $date_created = Carbon::now()->toDateTimeString();
       if($request->input('price')== null)
        $price = 0;
       else $price = $request->input('price');

       if($request->input('is_private')=='public') 
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

        if($request->has('invites'))
            $this->sendInvites( $request->input('invites'), $event->id_event);

        return redirect("event/".$event->id_event);
    }

    public function sendInvites($invites, $id_event) {
        foreach ($invites as $id_invitee) {
            $invite = Invite::create([
                    'id_event' => $id_event,
                    'id_inviter' => Auth::user()->user_id,
                    'id_invitee' => $id_invitee
                    ]);
            $invite->save();
        }
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

    public function addComment(Request $request, $id_event, $id_post) {

        if (!Auth::check()) 
            return response(403);
        
        $id_author = Auth::user()->id_user;
        $post = Post::find($id_post);
        $id_parent = 2;

        $date_created = Carbon::now()->toDateTimeString();

        $comment = Comment::create([
            'text' => $request->input('data'),
            'id_post' => $id_post,
            'id_parent' => $id_parent,
            'id_author' => $id_author,
            'date' => $date_created
            ]);

        $comment->save();

        return response()->json([$comment]);
    }

    public function newPost(Request $request, $id_event) {

        if (!Auth::check()) 
            return response(403);
        
        $id_author = Auth::user()->id_user;

        $date_created = Carbon::now()->toDateTimeString();

        $post = Post::create([
            'date' => $date_created,
            'text' => $request->input('data'),
            'id_event' => $id_event,
            'id_author' => $id_author,
            'post_type' => $request->input('post_type')
            ]);

        $post->save();

        return response()->json([$post]);
    }

    public function getComments($id_post) {

        if (!Auth::check()) 
            return response(403);
        
        $post = Post::find($id_post);
        
        $comments = $post->comments()->get()->map(function ($comment) {
            return ['id' => $comment->id_comment, 'id_post'=> $comment->id_post, 'date'=> $comment->date, 'text'=> $comment->text];
        });

        return response()->json([$comments]);
    }
}
