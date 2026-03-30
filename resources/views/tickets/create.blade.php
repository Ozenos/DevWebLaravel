@extends('common.layoutEmpty')

<script src="{{ asset('specific/newTicket.js') }}" defer></script>

@section('content')
  <div class="w-full max-w-2xl bg-background rounded-xl shadow-lg px-8 pt-4">
    @include('tickets.newTicket', ['ticket' => $ticket ?? null])
  </div>
@endsection