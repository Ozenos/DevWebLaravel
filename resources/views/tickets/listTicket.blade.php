@extends('layouts.contentAside')

<head><title>Cross Tickets - Tickets</title></head>

<?php
    $advancementStyles = [
        "open" => "bg-blue-100 text-blue-700",
        "progress" => "bg-orange-100 text-orange-700",
        "completed" => "bg-purple-100 text-purple-700"
    ];
    $advancementNames = [
        "open" => "Ouvert",
        "progress" => "En cours",
        "completed" => "Terminé"
    ];
    $facturationStyles = [
        "included" => "bg-lime-100 text-lime-700",
        "facturable" => "bg-yellow-100 text-yellow-700",
    ];
?>
<script src="{{ asset('specific/listTicket.js') }}" defer></script>
<script id="n9drde">
    window.advancementStyles = @json($advancementStyles);
    window.facturationStyles = @json($facturationStyles);
</script>

@section('aside')
    <button onclick="openCreateDialog()"
        class="w-full text-center inline-block bg-primary text-white p-2 rounded-lg font-semibold hover:bg-accent transition mb-4">
        Nouveau ticket
    </button>
    <form method="get" class="space-y-6">

        <!-- Facturation -->
        <div>
            <h2 class="text-md font-semibold text-accent uppercase mb-3">
                Facturation
            </h2>
            <div class="flex flex-col gap-2">
                <label class="px-3 py-2 rounded-md border border-tertiary bg-lime-100">
                    <input type="checkbox" name="facturation[]" value="included" data-filter="included"
                        {{ in_array("included", $_GET["facturation"] ?? []) ? "checked" : "" }}>
                    <span class="text-md text-lime-700">Inclus</span>
                </label>

                <label class="px-3 py-2 rounded-md border border-tertiary bg-yellow-100">
                    <input type="checkbox" name="facturation[]" value="facturable" data-filter="facturable"
                        {{ in_array("facturable", $_GET["facturation"] ?? []) ? "checked" : "" }}>
                    <span class="text-md text-yellow-700">Facturable</span>
                </label>
            </div>
        </div>

        <!-- Avancement -->
        <div>
            <h2 class="text-md font-semibold text-accent uppercase mb-3">
                Avancement
            </h2>
            <div class="flex flex-col gap-2">
                @foreach (["open", "progress", "completed"] as $status)
                    <label class="px-3 py-2 rounded-md border border-tertiary
                    {{ $advancementStyles[$status] ?? "bg-gray-100 text-gray-700" }}">
                        <input type="checkbox" name="advancement[]" value="{{ $status }}" data-filter="{{ $status }}"
                            {{ in_array($status, $_GET["advancement"] ?? []) ? "checked" : ""}}>
                        <span class="text-md {{ $advancementStyles[$status] ?? "bg-gray-100 text-gray-700" }}">
                            {{ $advancementNames[$status] }}</span>
                    </label>
                @endforeach
            </div>
        </div>

    </form>
@endsection

@section('content')
    <div class="mt-5 grid
        grid-cols-[repeat(auto-fill,340px)]
        justify-center gap-6
        w-full min-w-0 py-4" id="ticket_list">
        @foreach($tickets as $ticket)
            <div class="bg-background rounded-xl shadow-lg p-8 space-y-6 w-[340px] max-w-[340px] self-start"
            data-tags="{{ $ticket->advancement }} {{ $ticket->facturation }}" data-id="{{ $ticket->id }}">

                <!-- En-tête -->
                <div class="flex justify-center">
                    <h1 class="title text-2xl font-bold text-text text-center" data-field="title">
                        {{ $ticket->title }}
                    </h1>
                </div>

                <!-- Temps passé -->
                <div class="flex mb-2 justify-between gap-2">
                    <div>
                        <h2 class="text-sm font-semibold text-accent">
                            Temps passé
                        </h2>
                        <p class="time text-text" data-field="time">
                            {{ $ticket->time }} heure{{ $ticket->time > 1 ? "s" : "" }}
                        </p>
                    </div>

                    <div class="text-right">
                    <span data-field="advancement" class="inline-block px-3 py-1 text-sm font-semibold rounded-full
                        {{ $advancementStyles[$ticket->advancement] ?? "bg-gray-100 text-gray-700" }}">
                        {{ $ticket->displayAdvancement() }}
                    </span>
                    <span data-field="facturation" class="facturation inline-block px-3 mt-1 py-1 text-sm font-semibold rounded-full
                        {{ $facturationStyles[$ticket->facturation] ?? "bg-gray-100 text-gray-700" }}">
                        {{ $ticket->displayFacturation() }}
                    </span>
                </div>
                </div>

                <!-- Propriétaire et Collaborateurs -->
                <div>
                    <h2 class="text-sm font-semibold text-accent mb-2">
                        Propriétaire et collaborateurs
                    </h2>
                    <ul class="flex gap-2 flex-wrap">
                        <li class="px-3 py-1 text-sm rounded-full bg-tertiary text-text">
                            {{ $ticket->user->name }}
                        </li>
                        @foreach($ticket->collaborators as $collaborator)
                            <li class="px-3 py-1 text-sm rounded-full bg-secondary text-text">
                                {{ $collaborator->name }}
                            </li>
                        @endforeach
                    </ul>
                </div>

                @if ($ticket->user_id === auth()->id())
                    <div class="text-right">
                        <a onclick='openEditDialog({{ $ticket->id }})'
                            class="inline-block bg-primary text-white p-2 rounded-lg font-semibold hover:bg-accent transition">
                            Modifier
                        </a>
                    </div>
                @endif

            </div>
        @endforeach

    </div>
    <dialog id="newTicketDialog" class="w-full max-w-2xl bg-background rounded-xl shadow-lg px-8 pt-4">
        <script src="{{ asset('specific/newTicket.js') }}" defer></script>
        <style>
            dialog::backdrop {
            background: rgba(0, 0, 0, 0.4); /* fond noir semi-transparent */
            }
        </style>
        @include('tickets/newTicket', ['ticket' => null])
    </dialog>
@endsection