<head>
    <title>Cross Tickets - Connexion</title>
</head>

@extends('common/layoutEmpty')

@section('content')
    <div class="w-full max-w-sm bg-background rounded-xl shadow-lg p-8">
        <h1 class="text-2xl font-bold text-center mb-6">Connexion</h1>

        <form method="POST" action="{{ route('password.confirm') }}" class="space-y-4">
            @csrf
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

            <button type="submit"
                class="w-full bg-primary text-white py-2 rounded-lg font-semibold hover:bg-accent transition">
                Confirmer
            </button>
        </form>
    </div>
@endsection