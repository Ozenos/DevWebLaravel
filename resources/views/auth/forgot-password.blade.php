<head>
    <title>Cross Tickets - mot de passe perdu</title>
</head>

@extends('common/layoutEmpty')

@section('content')
    <div class="w-full max-w-sm bg-background rounded-xl shadow-lg p-8">
        <h1 class="text-2l text-justify mb-6">
            Mot de passe perdu ? Pas de problème, indiquez ici votre adresse email et nous enverrons un lien de réinitialisation
            pour en changer.
        </h1>

        <form method="POST" action="{{ route('password.email') }}" class="space-y-4">
            @csrf
            <div>
                <label for="email" class="block text-sm font-medium mb-1">
                    E-mail
                </label>
                <input type="email" id="email" name="email" required autofocus autocomplete="username"
                    class="w-full rounded-lg bg-secondary px-3 py-2 focus:outline-none focus:ring-2 focus:ring-accent focus:border-accent">
                @if($errors->get('email'))
                    <span class="inline-block text-sm font-medium
                    text-red-600 rounded-md border border-red-300 bg-red-200 mt-1 ml-2 py-1 px-2">
                        {{ $errors->get('email')[0] }}
                    </span>
                @endif
            </div>

            <button type="submit"
                class="w-full bg-primary text-white py-2 rounded-lg font-semibold hover:bg-accent transition">
                Envoyer lien de réinitialisation
            </button>
        </form>
    </div>
@endsection