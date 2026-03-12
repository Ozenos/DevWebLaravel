@extends('layout')

<head><title>About - Cross Tickets</title></head>

@section('aside')
    <div class="bg-blue-600 text-white py-6">
        <h1 class="text-3xl font-bold text-center">À propos de nous</h1>
    </div>
@endsection

@section('content')
    <main class="max-w-3xl mx-auto p-6 space-y-6">
        <section>
        <h2 class="text-2xl font-semibold mb-2">Notre mission</h2>
        <p>
            Nous cherchons à créer des expériences web simples et accessibles pour tous, 
            en utilisant des technologies modernes et légères.
        </p>
        </section>

        <section>
        <h2 class="text-2xl font-semibold mb-2">Notre équipe</h2>
        <p>
            Une petite équipe passionnée de développeurs et de designers, motivée par la créativité et l'innovation.
        </p>
        </section>

        <section>
        <h2 class="text-2xl font-semibold mb-2">Contact</h2>
        <p>
            Vous pouvez nous envoyer un message à <a href="mailto:contact@example.com" class="text-blue-600 underline">contact@example.com</a>.
        </p>
        </section>
    </main>

@endsection