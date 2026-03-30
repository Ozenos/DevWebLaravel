<head>
    <title>Cross Tickets - Inscription</title>
</head>

@extends('common/layoutEmpty')

@section('content')

    <div class="w-full max-w-sm bg-background rounded-xl shadow-lg p-8">
        <h1 class="text-2xl font-bold text-center mb-6">Inscription</h1>

        <form method="POST" action="{{ route('register') }}" class="space-y-3">
            @csrf
            <label for="name" class="block text-sm font-medium mb-1"> Nom
                <input type="name" id="name" name="name" required autocomplete="name"
                class="block w-full rounded-lg bg-secondary px-3 py-3 focus:outline-none focus:ring-2 focus:ring-accent focus:border-accent mb-2">
            </label>
            @if($errors->get('name'))
                <span class="inline-block text-sm font-medium
                text-red-600 rounded-md border border-red-300 bg-red-200 mt-1 ml-2 py-1 px-2">
                    {{ $errors->get('name')[0] }}
                </span>
            @endif

            <label for="email" class="block text-sm font-medium mb-1"> Email
                <input type="email" id="email" name="email" required autocomplete="username"
                class="block w-full rounded-lg bg-secondary px-3 py-3 focus:outline-none focus:ring-2 focus:ring-accent focus:border-accent mb-2">
            </label>
            @if($errors->get('email'))
                <span class="inline-block text-sm font-medium
                text-red-600 rounded-md border border-red-300 bg-red-200 mt-1 ml-2 py-1 px-2">
                    {{ $errors->get('email')[0] }}
                </span>
            @endif

            <label for="password" class="block text-sm font-medium mb-1">Mot de passe
                <input type="password" id="password" name="password" autocomplete="new-password"
                required placeholder="entrer le mot de passe"
                class="block w-full rounded-lg bg-secondary px-3 py-3 focus:outline-none focus:ring-2 focus:ring-accent focus:border-accent mb-1">
                @if($errors->get('password'))
                    <span class="inline-block text-sm font-medium
                    text-red-600 rounded-md border border-red-300 bg-red-200 mt-1 ml-2 py-1 px-2">
                        {{ $errors->get('password')[0] }}
                    </span>
                @endif
                <input type="password" id="password_confirmation" name="password_confirmation"
                required placeholder="confirmer le mot de passe"
                class="block w-full rounded-lg bg-secondary px-3 py-3 focus:outline-none focus:ring-2 focus:ring-accent focus:border-accent">
                @if($errors->get('password_confirmation'))
                    <span class="inline-block text-sm font-medium
                    text-red-600 rounded-md border border-red-300 bg-red-200 mt-1 ml-2 py-1 px-2">
                        {{ $errors->get('password_confirmation')[0] }}
                    </span>
                @endif
            </label>

            <button type="submit"
                class="w-full bg-primary text-white py-2 rounded-lg font-semibold hover:bg-accent transition">
                S'inscrire
            </button>
        </form>
    </div>

    <div class="w-full max-w-sm bg-background rounded-xl shadow-lg p-8">
        <div class="text-center">
            <h1 class="text-2xl font-bold text-center mb-6">Déjà un compte ?</h1>
            <a href="{{ route('login') }}" class="block w-full bg-primary text-white py-2 rounded-lg font-semibold hover:bg-accent transition">
                Se connecter
            </a>
        </div>
    </div>

@endsection