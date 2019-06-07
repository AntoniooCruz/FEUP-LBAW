<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Illuminate\Database\QueryException;

use Illuminate\Support\Collection;
use App\Event;
use App\Category;
use App\User;
use App\Ticket;
use App\Post;
use App\Comment;
use Carbon\Carbon;
use App\Invite;
use App\PollOption;
use App\Poll;
use App\File;
use App\VoteOnPoll;
use App\Report;

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
        
        if(Auth::check()){

            $this->validator($request->all());
        if(Auth::user()->active == false)
            return redirect('login');
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

            try{
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
                
                if($request->has('invites'))
                $this->sendInvites( $request->input('invites'), $event->id_event);

                $file = Input::file('file');

                $originalFileName = "./img/events/originals";
        
                $file->move($originalFileName, strval($event->id_event) . ".png");

                return redirect("event/".$event->id_event);


            }catch(\Illuminate\Database\QueryException $e){
                $orderLog = new Logger('db');
                $orderLog->pushHandler(new StreamHandler(storage_path('logs/db.log')), Logger::ERROR);
                $orderLog->info('db', ['error'=>$e->getMessage()]);
            }
           
        } else return redirect('login');
    }

    public function sendInvites($invites, $id_event) {
        foreach ($invites as $id_invitee) {
            $invite = Invite::create([
                    'id_event' => $id_event,
                    'id_inviter' => Auth::user()->user_id,
                    'id_invitee' => $id_invitee
                    ]);
        }
    }

    public function show($id_event) {

        DB::beginTransaction();

        $hasTicket = false;

        try{

            $this->friendsGoing($id_event);
            
            $event = Event::find($id_event);
            $friendsGoing = $this->friendsGoing($id_event);
            $usersGoing = $this->usersGoing($id_event);
            
            if($event == null) {
                echo("Event does not exist");
                return;
            }
            if(Auth::check() || $event->is_private){
                $this->authorize('view', $event);
            }

            if(Auth::check())
                $hasTicket = !empty($event->tickets()->where('id_ticket_owner', Auth::user()->id_user)->first());
            else $hasTicket = false;
        
            DB::commit();

        }catch (\Throwable $th) {
            DB::rollback();
        }

        return view('pages.event', ['event' => $event , 
                                     'friendsGoing' => $friendsGoing,
                                    'usersGoing' => $usersGoing,
                                    'categories' => Category::all(),
                                    'hasTicket' => $hasTicket
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
        if(Auth::user()->active == false)
            return response(403);
        
        $id_author = Auth::user()->id_user;
        $post = Post::find($id_post);
        $id_parent = null;

        $date_created = Carbon::now()->toDateTimeString();

        $comment = Comment::create([
            'text' => $request->input('data'),
            'id_post' => $id_post,
            'id_parent' => $id_parent,
            'id_author' => $id_author,
            'date' => $date_created
            ]);
            
        return response()->json([$comment]);
    }

    public function newPost(Request $request, $id_event) {

        if (!Auth::check()) 
            return response(403);

        if(Auth::user()->active == false)
            return response(403);
        
        $id_author = Auth::user()->id_user;

        $date_created = Carbon::now()->toDateTimeString();

        $event_name = Event::find($id_event)->title;
        $author_name = User::find($id_author)->username;

        $post = Post::create([
            'date' => $date_created,
            'text' => $request->input('data'),
            'id_event' => $id_event,
            'id_author' => $id_author,
            'post_type' => $request->input('post_type')
            ]);
        
        $new_arr2 = [];
        if($request->input('post_type') == 'Poll'){

            $poll = Poll::create([
                'id_post' => $post->id_post
            ]);
            
            $arr = $request->input('poll_options');
            $new_arr = explode(",", $arr);
            
            foreach ($new_arr as $value) {
                array_push($new_arr2, PollOption::create([
                    'name' => $value,
                    'id_poll' => $poll->id_poll
                ]));
            }
        }

        return response()->json([$post, $event_name, $author_name, $request->input('post_type') ,$new_arr2, $id_author]);
    }

    public function deletePost($id_event, $id_post) {

        if (!Auth::check()) 
            return response(403);

        if(Auth::user()->active == false)
            return response(403);

        $post = Post::find($id_post);

        $post->delete();

        return response()->json([$id_event, $id_post, 200]);
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

    public function purchaseTicket(Request $request, $id_event){

        $date_created = Carbon::now()->toDateTimeString();

        $ticket = Ticket::create([
            'id_event' => $id_event,
            'id_ticket_owner' => Auth::user()->id_user,
            'date_acquired' =>  $date_created,
            'checked_in' => false
        ]);

        
        return response()->json($id_event, 200);
    }

    public function vote($id_poll_option) {

        $poll_option = PollOption::find($id_poll_option);

        $poll = Poll::find($poll_option->id_poll);

        $post = Post::find($poll->id_post);

        if (!Auth::check()) 
            return response(403);

        if(Auth::user()->active == false)
            return response(403);

        $oldVote = VoteOnPoll::where('id_user', Auth::user()->id_user)->where('id_poll', $poll_option->id_poll);

        if(!empty($oldVote->first())){
            $oldPollOptId = $oldVote->first()->id_poll_option;
            $oldVotes = VoteOnPoll::where('id_poll_option', $oldPollOptId)->count();
        }else{
            $oldPollOptId = null;
        } 

        $oldVote->delete();


        $vote_on_poll = VoteOnPoll::create([
                'id_user' => Auth::user()->id_user,
                'id_poll' =>  $poll_option->id_poll ,
                'id_poll_option' =>  $id_poll_option
        ]);

        $noVotes = VoteOnPoll::where('id_poll_option', $id_poll_option)->count();
        $noVotesTotal = VoteOnPoll::where('id_poll', $poll_option->id_poll)->count();
        $perc = floor(($noVotes/$noVotesTotal)*100);

        if($oldPollOptId!=null){
            $temp1 = VoteOnPoll::where('id_poll_option', $oldPollOptId)->count();
            $oldPerc = floor(($temp1/$noVotesTotal)*100);
        } else $oldPerc = null;

        $pollOptionsIds = $post->poll->pollOptions()->get();

        return response()->json(['perc'=>$perc, 'oldPollOptId' =>$oldPollOptId, 'noVotesTotal' => $noVotesTotal, 'pollOptsID' => $pollOptionsIds, 200]);

        
    }

    public function report(Request $request, $id_event){
        if (!Auth::check()) 
            return response(403);
        if(Auth::user()->active == false)
            return response(403);

        $exists = DB::select('SELECT * FROM report_event WHERE id_reporter = ? AND id_event = ?;',[Auth::user()->id_user,$id_event]);
        if($exists != null)
            return response(405);

        $report  = Report::create([
            'reason' => $request->input('reason'),
            'report_type' => 'Event'
        ]);

        DB::insert('insert into report_event (id_report, id_reporter, id_event)  values (?, ?,?)', [$report->id_report, Auth::user()->id_user,$id_event]);
        return response(200);
    }

    public function reportPost(Request $request, $id_post){
        if (!Auth::check()) 
        return response(403);

        if(Auth::user()->active == false)
        return response(403);

        $exists = DB::select('SELECT * FROM report_post WHERE id_reporter = ? AND id_post = ?;',[Auth::user()->id_user,$id_post]);
        if($exists != null)
         return response(405);

        $report  = Report::create([
            'reason' => $request->input('reason'),
            'report_type' => 'Post'
        ]);

    DB::insert('insert into report_post (id_report, id_reporter, id_post)  values (?, ?,?)', [$report->id_report, Auth::user()->id_user,$id_post]);
    return response(200);
    }

}
