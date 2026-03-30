<section class="space-y-6">
    <header>
        <h2 class="text-xl font-bold text-text">
            Supprimer le compte
        </h2>

        <p class="mt-2 text-sm text-justify">
            Une fois votre compte supprimé, toutes ses ressources et données seront définitivement effacées.
            Avant de supprimer votre compte, veuillez télécharger les données ou informations que vous souhaitez
            conserver.
        </p>
    </header>

    <button type="button"
        class="p-4 border border-red-300 text-red-700 py-2 rounded-lg font-semibold hover:bg-red-100 transition"
        onclick="document.getElementById('confirmModal').showModal()">
        Supprimer le compte
    </button>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const dialog = document.getElementById('confirmModal');

            @if ($errors->userDeletion->isNotEmpty())
                dialog.showModal();
            @endif
        });
    </script>
    <dialog id="confirmModal" class="rounded-lg">
        <div class="flex items-center justify-center m-auto max-w-3xl">
            <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
                @csrf
                @method('delete')

                <h2 class="text-xl font-bold text-text">
                    Êtes-vous sûrs de vouloir supprimer votre compte ?
                </h2>

                <p class="mt-2 text-sm text-justify">
                    Une fois votre compte supprimé, toutes ses ressources et données seront définitivement effacées. Veuillez saisir votre mot de passe pour confirmer la suppression définitive de votre compte.
                </p>

                <div class="mt-6">
                    <label for="password" class="sr-only block text-sm font-medium mb-1">Mot de passe</label>
                    <input id="password" name="password" type="password" placeholder="Mot de passe"
                    class="w-full rounded-lg bg-secondary px-3 py-2 focus:outline-none focus:ring-2 focus:ring-accent focus:border-accent">
                    @if($errors->userDeletion->get('password'))
                        <span class="inline-block text-sm font-medium
                        text-red-600 rounded-md border border-red-300 bg-red-200 mt-1 ml-2 py-1 px-2">
                            {{ $errors->userDeletion->get('password')[0] }}
                        </span>
                    @endif
                </div>

                <div class="mt-6 flex justify-end">
                    <button type="button" onclick="document.getElementById('confirmModal').close()"
                    class="p-4 bg-primary text-white py-2 rounded-lg font-semibold hover:bg-accent transition mr-2">
                        Annuler
                    </button>

                    <button type="submit"
                        class="p-4 border border-red-300 text-red-700 py-2 rounded-lg font-semibold hover:bg-red-100 transition">
                        Supprimer le compte
                    </button>
                </div>
            </form>
        </div>
    </dialog>
</section>

<!--
<form method="post" action="{{ route('profile.destroy') }}" class="p-6">
            @csrf
            @method('delete')

            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                {{ __('Are you sure you want to delete your account?') }}
            </h2>

            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
            </p>

            <div class="mt-6">
                <label for="password" class="sr-only">Mot de passe</label>

                <input id="password" name="password" type="password" class="mt-1 block w-3/4"
                    placeholder="Mot de passe" />
                @if($errors->userDeletion->get('password'))
                    <span class="inline-block text-sm font-medium
                    text-red-600 rounded-md border border-red-300 bg-red-200 mt-1 ml-2 py-1 px-2">
                        {{ $errors->userDeletion->get('password')[0] }}
                    </span>
                @endif
            </div>

            <div class="mt-6 flex justify-end">
                <button type="button" onclick="document.getElementById('confirmModal').close()"
                class="p-4 bg-primary text-white py-2 rounded-lg font-semibold hover:bg-accent transition">
                    Annuler
                </button>

                <button type="submit"
                    class="p-4 border border-red-300 text-red-700 py-2 rounded-lg font-semibold hover:bg-red-100 transition">
                    Supprimer le compte
                </button>
            </div>
        </form>