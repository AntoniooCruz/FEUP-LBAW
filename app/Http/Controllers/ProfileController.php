<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;

use App\User;
use App\Event;
use App\Ticket;
use App\Category;
use App\Report;

class ProfileController extends Controller
{
    public function show() {
        if(Auth::check()){

            $user = Auth::user();

            DB::beginTransaction();

            try {
                $eventsOwned = Event::where('id_owner', $user->id_user)->get();
            
                $userTickets = Ticket::where('id_ticket_owner', $user->id_user)->get();
                $eventsAttending = [];

                foreach($userTickets as $ticket){
                    array_push($eventsAttending,Event::where('id_event', $ticket->id_event)->first());
                }

                $usersGoing = [];

                foreach ($eventsOwned as $event) {
                    array_push($usersGoing, $this->usersGoing($event->id_event));
                }


                $usersAttending =[];
                foreach ($eventsAttending as $event) {
                    array_push($usersAttending, $this->usersGoing($event->id_event));
                }

                DB::commit();

            } catch (\Throwable $th) {
                DB::rollback();
            }
            return view('pages.my-profile', ['user' => $user,
                                            'eventsOwned' => $eventsOwned, 
                                            'eventsAttending' => $eventsAttending,
                                            'categories' => Category::all(),
                                            'usersGoing' => $usersGoing,
                                            'usersAttending' => $usersAttending
                                            ]);
        } else return redirect('login');
                                        
    }

    public function showUser($id_user) {

        DB::beginTransaction();

        try{
            $user = User::findOrFail($id_user); 

            $followers = $user->followers()->count();
            $following = $user->following()->count();

            $isFollowing = null;

            if (Auth::check()) {
                $isFollowing = Auth::user()->following()->get()->contains($user);
            }

            $eventsOwned = Event::where('id_owner', $id_user)->get();
            $userTickets = Ticket::where('id_ticket_owner', $id_user)->get();
            $eventsAttending = [];

            foreach($userTickets as $ticket){
                array_push($eventsAttending,Event::where('id_event', $ticket->id_event)->first());
            }

            $usersGoing = [];
            foreach ($eventsOwned as $event) {
                array_push($usersGoing, $this->usersGoing($event->id_event));
            }

            $usersAttending =[];
            foreach ($eventsAttending as $event) {
                array_push($usersAttending, $this->usersGoing($event->id_event));
            }

            DB::commit();

        }catch (\Throwable $th) {
            DB::rollback();
        }
        return view('pages.profile',['user' => $user, 
                                    'eventsOwned' => $eventsOwned,
                                    'eventsAttending' => $eventsAttending, 
                                    'isFollowing' => $isFollowing,
                                    'categories' => Category::all(),
                                    'usersGoing' => $usersGoing,
                                    'usersAttending' => $usersAttending
                                    ]);
    }

    public function showEdit() {

        $user = Auth::user();

        $followers = $user->followers()->count();
        $following = $user->following()->count();

        $eventsOwned = Event::where('id_owner', $user->id_user)->get();
        $userTickets = Ticket::where('id_ticket_owner', $user->id_user)->get();
        $eventsAttending = [];

        foreach($userTickets as $ticket){
            array_push($eventsAttending,Event::where('id_event', $ticket->id_event)->first());
        }

        $usersGoing = [];

        foreach ($eventsOwned as $event) {
            array_push($usersGoing, $this->usersGoing($event->id_event));
        }

        $usersAttending =[];
        foreach ($eventsOwned as $event) {
            array_push($usersGoing, $this->eventsAttending($event->id_event));
        }
        
        return view('pages.edit-profile', 
                    ['user' => $user, 
                    'eventsOwned' => $eventsOwned, 
                    'eventsAttending' => $eventsAttending,
                    'categories' => Category::all(),
                    'usersGoing' => $usersGoing,
                    'usersAttending' => $usersAttending
                    ]);
    }

    public function usersGoing($id_event){

        $ticketsSold = Ticket::where('id_event', $id_event)->get();
        $idsUsersGoing = $ticketsSold->map(function($item, $key) {
            return $item->id_ticket_owner;
        });

        return $idsUsersGoing;
    }
    


    protected function validator($data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:30',
            'username' => 'required|string|max:20',
            'email' => 'required|string|email|max:100',
            'description' => 'string|max:100',
        ])->validate();
    }

    public function update(Request $request) {

        if (!Auth::check()) 
                return redirect('home');
        
        $user = Auth::user();
        $user_id = $user->id_user;

        $this->validator($request->all());

        $user-> name = $request->input('name');
        $user-> username = $request->input('username');
        $user-> description = $request->input('description');
        
        $file = Input::file('file');

        $originalFileName = "./img/users/originals";

        $file->move($originalFileName, strval($user_id) . ".png");

        $user->save();
        
        return redirect('profile');
    }

    public function remove(Request $request){
            if (!Auth::check()) 
                return redirect('home');

            $user = Auth::user();

            try {
                $user->delete();
                return redirect('home');
            } catch (Exception $e) {
                return redirect('profile');
            }
    }

    public function followUser($id) {

        if (!Auth::check()) 
            return response(403);
        
        $user1 = Auth::user();
        $user2 = User::findOrFail($id);

        try {
            $user1->following()->attach($user2);

        } catch (Exception $e) {
            return response()->json(["error" => $e], 400);
        }

        return response(200);
    }

    public function unfollowUser($id) {

        if (!Auth::check()) 
            return response(403);

        $user1 = Auth::user();
        $user2 = User::findOrFail($id);

        try {
            $user1->following()->detach($user2);
            $user2->followers()->detach($user1);
        } catch (Exception $e) {
            return response()->json(["error" => $e], 400);
        }

        return response(200);
    }

    public function ban($id_user){
        
        if (!Auth::check()) 
            return response(403);

        $user2 = Auth::user();
        if($user2->is_admin){
            
            $user = User::find($id_user);

            $user->active = false;
            $user->save();
            return response(200);
        } else {
            return response(403);
        }
       
    }


    public function report(Request $request, $id_user){
        if (!Auth::check()) 
            return response(403);

        $report  = Report::create([
            'reason' => $request->input('reason'),
            'report_type' => 'User'
        ]);

        DB::insert('insert into report_user (id_report, id_reporter, id_reported_user)  values (?, ?,?)', [$report->id_report, Auth::user()->id_user,$id_user]);
        return response(200);
    }
}

