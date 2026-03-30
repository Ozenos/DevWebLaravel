<head>
    <title>Cross Tickets - Connexion</title>
</head>

@extends('common/layoutEmpty')

@section('content')
    <div class="w-full max-w-sm bg-background rounded-xl shadow-lg p-8">
        <h1 class="text-2xl font-bold text-center mb-6">Connexion</h1>

        <form method="POST" action="{{ route('login') }}" class="space-y-4">
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

            <div>
                <label for="password" class="block text-sm font-medium mb-1">
                    Mot de passe
                </label>
                <input type="password" id="password" name="password" required autocomplete="current-password"
                    class="w-full rounded-lg bg-secondary px-3 py-2 focus:outline-none focus:ring-2 focus:ring-accent focus:border-accent">
                @if($errors->get('password'))
                    <span class="inline-block text-sm font-medium
                    text-red-600 rounded-md border border-red-300 bg-red-200 mt-1 ml-2 py-1 px-2">
                        {{ $errors->get('password')[0] }}
                    </span>
                @endif
            </div>

            <div class="block mt-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox" name="remember"
                        class="rounded text-primary">
                    <span class="ms-2 text-sm text-primary">Rester connecté</span>
                </label>
            </div>

            <button type="submit"
                class="w-full bg-primary text-white py-2 rounded-lg font-semibold hover:bg-accent transition">
                Se connecter
            </button>
        </form>

        <div class="text-center mt-4 text-sm">
            @if (Route::has('password.request'))
                <a  href="{{ route('password.request') }}" class="text-primary hover:underline">
                    Mot de passe oublié ?
                </a>
            @endif
        </div>
    </div>
    <div class="w-full max-w-sm bg-background rounded-xl shadow-lg p-8">
        <div class="text-center">
            <h1 class="text-2xl font-bold text-center mb-6">Nouvel utilisateur</h1>
            <a href="{{ route('register') }}"
                class="block w-full bg-primary text-white py-2 rounded-lg font-semibold hover:bg-accent transition">
                Créer un compte
            </a>
        </div>
    </div>
@endsection