<?php

namespace App\Http\Controllers;


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


class InviteController extends Controller
{

    public function usersGoing($id_event)
    {

        $ticketsSold = Ticket::where('id_event', $id_event)->get();
        $idsUsersGoing = $ticketsSold->map(function ($item, $key) {
            return $item->id_ticket_owner;
        });

        return $idsUsersGoing;
    }



    public function showMyInvites()
    {

        $user = Auth::user();
        $id_user = $user->id_user;

        $invites = $user->invited()->get();

        $usersGoing = [];
        foreach ($invites as $invite) {
            array_push($usersGoing, $this->usersGoing($invite->id_event));
        }


        return view('pages.my-invites', [
            'invites' => $user->invited()->get(),
            'categories' => Category::all(),
            'usersGoing' => $usersGoing
        ]);
    }
}
