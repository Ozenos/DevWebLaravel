<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TicketController extends Controller
{
    /**
     * Display the tickets list.
     */
    public function list(Request $request): View
    {
        $userId = auth()->id();


        return view('tickets.listTicket', [
            "tickets" => Ticket::where('user_id', $userId)
                ->orWhereHas('collaborators', function ($query) use ($userId) {
                    $query->where('users.id', $userId);
                })
                ->distinct()
                ->get(),
        ]);
        /*
        return view('tickets.listTicket', [
            "tickets" => Ticket::where('user_id', auth()->id())->get(),
        ]);*/
    }
    /**
     * Display a ticket's creation view.
     */
    public function create(): View
    {
        return view('tickets.create', [
            'ticket' => null
        ]);
    }
    /**
     * Display a ticket's edit view.
     */
    public function edit($id): View
    {
        $ticket = Ticket::findOrFail($id);

        return view('tickets.create', [
            'ticket' => $ticket
        ]);
    }
    /**
     * Register a new ticket.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
        ]);

        Ticket::create([
            'title' => $validated['title'],
            'user_id' => auth()->id(),
            'time' => 0,
        ]);

        return redirect()->route('tickets.list');
    }
    public function storeApi(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'time' => ['required', 'integer', 'min:1'],
            'advancement' => ['nullable', 'string'],
            'facturation' => ['nullable', 'string'],
            'user_id' => ['required', 'integer', 'min:0'],
        ]);

        $ticket = Ticket::create([
            'title' => $validated['title'],
            'time' => $validated['time'],
            'advancement' => $validated['advancement'] ?? null,
            'facturation' => $validated['facturation'] ?? null,
            'user_id' => $validated['user_id']
        ]);

        return response()->json([
            'message' => 'Ticket ajoute avec succes.',
            'ticket' => [
                'title' => $ticket->title,
                'time' => $ticket->time,
                'advancement' => $ticket->advancement,
                'facturation' => $ticket->facturation,
                'user_id' => $ticket->user_id,
            ],
        ], 201);
    }
    public function updateApi(Request $request, Ticket $ticket)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'time' => ['required', 'integer', 'min:1'],
            'advancement' => ['nullable', 'string'],
            'facturation' => ['nullable', 'string'],
        ]);

        $ticket->update([
            'title' => $validated['title'],
            'time' => $validated['time'],
            'advancement' => $validated['advancement'] ?? null,
            'facturation' => $validated['facturation'] ?? null,
        ]);

        return response()->json([
            'message' => 'Ticket modifie avec succes.',
            'ticket' => [
                'id' => $ticket->id,
                'title' => $ticket->title,
                'time' => $ticket->time,
                'advancement' => $ticket->advancement,
                'facturation' => $ticket->facturation,
                'user_id' => $ticket->user_id,
            ],
        ], 200);
    }
}
