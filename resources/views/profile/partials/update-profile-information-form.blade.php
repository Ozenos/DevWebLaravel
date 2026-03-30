<section>
    <header>
        <h2 class="text-xl font-bold text-text">
            Informations
        </h2>

        <p class="mt-2 text-sm text-justify">
            Mettez à jour les informations de votre profil et votre adresse e-mail.
        </p>
    </header>

    <!-- A adapter ! -->
    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <label for="name" class="block text-sm font-medium mb-1">Nom</label>
            <input id="name" name="name" type="text"
            class="w-full rounded-lg bg-secondary px-3 py-2 focus:outline-none focus:ring-2 focus:ring-accent focus:border-accent"
            required autocomplete="current-password" value="{{ old('name', $user->name) }}">
            @if($errors->get('name'))
                <span class="inline-block text-sm font-medium
                text-red-600 rounded-md border border-red-300 bg-red-200 mt-1 ml-2 py-1 px-2">
                    {{ $errors->get('name')[0] }}
                </span>
            @endif
        </div>

        <div>
            <label for="email">Email</label>
            <input id="email" name="email" type="email"
            class="w-full rounded-lg bg-secondary px-3 py-2 focus:outline-none focus:ring-2 focus:ring-accent focus:border-accent"
            required autocomplete="username" value="{{ old('email', $user->email) }}">
            @if($errors->get('email'))
                <span class="inline-block text-sm font-medium
                text-red-600 rounded-md border border-red-300 bg-red-200 mt-1 ml-2 py-1 px-2">
                    {{ $errors->get('email')[0] }}
                </span>
            @endif

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800 dark:text-gray-200">
                        Votre adresse email n'est pas vérifiée

                        <button form="send-verification" class="p-4 border border-red-300 text-red-700 py-2 rounded-lg font-semibold hover:bg-red-100 transition">
                            Cliquez ici pour envoyer le mail de vérification
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="inline-block text-sm font-medium
                            text-green-600 rounded-md border border-green-300 bg-green-200 mt-1 ml-2 py-1 px-2">
                            Un nouveau lien de vérification a été envoyé à votre adresse email.
                        </p>
                    @endif
                </div>
            @endif  
        </div>

        <div class="flex items-center gap-4">
            <button type="submit" class="p-4 bg-primary text-white py-2 rounded-lg font-semibold hover:bg-accent transition">
                Sauvegarder
            </button>

            @if (session('status') === 'profile-updated')
                <p class="inline-block text-sm font-medium
                    text-green-600 rounded-md border border-green-300 bg-green-200 mt-1 ml-2 py-1 px-2">
                    Sauvegardé
                </p>
            @endif
        </div>
    </form>
</section>
