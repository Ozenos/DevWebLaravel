<?php

namespace App\Http\Controllers;

use App\Models\Collaborator;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function list()
    {
        //dd(Ticket::all()[0]->user);
        return view('listTicket', [
            'tickets' => Ticket::with('user')->get()
        ]);
    }
    public function ticketsOLD()
    {
        return view('listTicketOLD');
    }

    public function about()
    {
        return view('about');
    }
}
