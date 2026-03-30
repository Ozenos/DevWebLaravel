<head>
    <title>Cross Tickets - Connexion</title>
</head>

@extends('common/layoutEmpty')

@section('content')
    <div class="w-full max-w-sm bg-background rounded-xl shadow-lg p-8">
        <div class="text-2l text-justify mb-6">
            Merci de vous être inscrit ! Avant de commencer, pourriez-vous vérifier votre adresse email
             en cliquant sur le lien que nous venons de vous envoyer ? Si vous ne l’avez pas reçu, nous
             pouvons vous en envoyer un autre.
        </div>

        @if (session('status') == 'verification-link-sent')
            <div class="mb-4 font-medium text-sm text-green-600 dark:text-green-400">
                Un nouveau lien de vérification a été envoyé à l'adresse email que vous avez fournie lors de votre inscription.
            </div>
        @endif

        <form method="POST" action="{{ route('verification.send') }}" class="space-y-4">
            @csrf

            <button type="submit"
                class="w-full bg-primary text-white py-2 rounded-lg font-semibold hover:bg-accent transition">
                Renvoyer le lien de vérification
            </button>
        </form>

        <form method="POST" action="{{ route('logout') }}" class="space-y-4">
            @csrf

            <button type="submit"
                class="text-primary hover:underline">
                Se déconnecter
            </button>
        </form>
    </div>
@endsection