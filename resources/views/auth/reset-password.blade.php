<head>
    <title>Cross Tickets - Connexion</title>
</head>

@extends('common/layoutEmpty')

@section('content')
    <div class="w-full max-w-sm bg-background rounded-xl shadow-lg p-8">
        <h1 class="text-2xl font-bold text-center mb-6">Connexion</h1>

        <form method="POST" action="{{ route('password.store') }}" class="space-y-4">
            @csrf
            <!-- Password Reset Token -->
            <input type="hidden" name="token" value="{{ $request->route('token') }}">

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
                <input type="password" id="password" name="password" required autocomplete="new-password"
                    class="w-full rounded-lg bg-secondary px-3 py-2 focus:outline-none focus:ring-2 focus:ring-accent focus:border-accent">
                @if($errors->get('password'))
                    <span class="inline-block text-sm font-medium
                    text-red-600 rounded-md border border-red-300 bg-red-200 mt-1 ml-2 py-1 px-2">
                        {{ $errors->get('password')[0] }}
                    </span>
                @endif
            </div>

            <div>
                <label for="password_confirmation" class="block text-sm font-medium mb-1">
                    Confirmer mot de passe
                </label>
                <input type="password" id="password_confirmation" name="password_confirmation" required
                    class="w-full rounded-lg bg-secondary px-3 py-2 focus:outline-none focus:ring-2 focus:ring-accent focus:border-accent">
                @if($errors->get('password_confirmation'))
                    <span class="inline-block text-sm font-medium
                    text-red-600 rounded-md border border-red-300 bg-red-200 mt-1 ml-2 py-1 px-2">
                        {{ $errors->get('password_confirmation')[0] }}
                    </span>
                @endif
            </div>

            <button type="submit"
                class="w-full bg-primary text-white py-2 rounded-lg font-semibold hover:bg-accent transition">
                Réinitialiser le mot de passe
            </button>
        </form>
    </div>
@endsection