<section>
    <header>
        <h2 class="text-xl font-bold text-text">
            Mettre à jour le mot de passe
        </h2>

        <p class="mt-2 text-sm text-justify">
            Pour garantir la sécurité de votre compte, assurez-vous d'utiliser un mot de passe long et aléatoire.
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        <div>
            <label for="update_password_current_password">Mot de passe actuel</label>
            <input id="update_password_current_password" name="current_password" type="password"
            class="w-full rounded-lg bg-secondary px-3 py-2 focus:outline-none focus:ring-2 focus:ring-accent focus:border-accent"
            autocomplete="current-password">
            @if($errors->updatePassword->get('current_password'))
                <span class="inline-block text-sm font-medium
                text-red-600 rounded-md border border-red-300 bg-red-200 mt-1 ml-2 py-1 px-2">
                    {{ $errors->updatePassword->get('current_password')[0] }}
                </span>
            @endif
        </div>

        <div>
            <label for="update_password_password">Nouveau mot de passe</label>
            <input id="update_password_password" name="password" type="password"
            class="w-full rounded-lg bg-secondary px-3 py-2 focus:outline-none focus:ring-2 focus:ring-accent focus:border-accent"
            autocomplete="new-password">
            @if($errors->updatePassword->get('password'))
                <span class="inline-block text-sm font-medium
                text-red-600 rounded-md border border-red-300 bg-red-200 mt-1 ml-2 py-1 px-2">
                    {{ $errors->updatePassword->get('password')[0] }}
                </span>
            @endif
        </div>

        <div>
            <label for="update_password_password_confirmation">Confirmer le mot de passe</label>
            <input id="update_password_password_confirmation" name="password_confirmation" type="password"
            class="w-full rounded-lg bg-secondary px-3 py-2 focus:outline-none focus:ring-2 focus:ring-accent focus:border-accent"
            autocomplete="new-password">
            @if($errors->updatePassword->get('password_confirmation'))
                <span class="inline-block text-sm font-medium
                text-red-600 rounded-md border border-red-300 bg-red-200 mt-1 ml-2 py-1 px-2">
                    {{ $errors->updatePassword->get('password_confirmation')[0] }}
                </span>
            @endif
        </div>

        <div class="flex items-center gap-4">
            <button type="submit" class="p-4 bg-primary text-white py-2 rounded-lg font-semibold hover:bg-accent transition">
                Sauvegarder
            </button>

            @if (session('status') === 'password-updated')
                <p class="inline-block text-sm font-medium
                    text-green-600 rounded-md border border-green-300 bg-green-200 mt-1 ml-2 py-1 px-2">
                    Sauvegardé
                </p>
            @endif
        </div>
    </form>
</section>
