@extends('common/layoutEmpty')

{{--<script src="{{ asset('specific/newTicket.js') }}" defer></script>--}}

@section('content')
  <div class="w-full max-w-2xl bg-background rounded-xl shadow-lg p-8">
    <h1 class="text-2xl font-bold mb-6 text-text">
      Création d’un ticket
    </h1>

    <form class="space-y-1" id="submitform" action="{{ route('tickets.store') }}" method="POST">
      @csrf
      <!-- Titre -->
      <div>
        <label class="block text-sm font-medium text-accent mb-1">
          Titre *
        </label>
        <input type="text" id="title" placeholder="Ex : Dysfonctionnement de l’export PDF" name="title"
          class="w-full rounded-lg bg-secondary px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
        <p id="title_error"
          class="invisible inline-block text-sm font-medium text-red-600 rounded-md border border-red-300 bg-red-200 mt-1 ml-2 py-1 px-2">
          Veuillez inclure un titre</p> {{-- <?= ($_errorTitle) ? "" : "invisible"; ?> --}}
      </div>

      <!-- Statut et Type -->
      <div class="flex">
        <!-- Statut -->
        <div class="w-1/4 mb-2">
          <label class="block text-sm font-medium text-accent mb-1">
            Statut
          </label>
          <select name="advancement"
            class="rounded-lg bg-secondary px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            <option value="En cours">
              En cours</option>
            <option value="Ouvert">
              Ouvert</option>
            <option value="Terminé">
              Terminé</option>
          </select>
        </div>

        <!-- Type -->
        <div class="w-1/4 mb-2">
          <label class="block text-sm font-medium text-accent mb-1">
            Type
          </label>
          <select name="facturation"
            class="rounded-lg bg-secondary px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            <option value="Inclus">
              Inclus</option>
            <option value="Facturable">
              Facturable</option>
          </select>
        </div>
      </div>

      <!-- Description -->
      <div>
        <label class="block text-sm font-medium text-accent mb-1">
          Description
        </label>
        <textarea rows="4" placeholder="Décrivez le problème rencontré…"
          class="w-full rounded-lg bg-secondary px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
      </div>

      <!-- Temps estimé -->
      <div>
        <label class="block text-sm font-medium text-accent mb-1">
          Temps estimé (en heures)
        </label>
        <input type="number" id="time" min="1" step="1" placeholder="1" name="time"
          class="w-full rounded-lg bg-secondary px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
        <p id="time_error"
          class="invisible inline-block text-sm font-medium text-red-600 rounded-md border border-red-300 bg-red-200 mt-1 ml-2 py-1 px-2">
          Veuillez inclure une estimation de temps en heures entières</p> {{-- <?= ($_errorTime) ? "" : "invisible"; ?> --}}
      </div>

      <!-- Collaborateurs -->
      <div>
        <label class="block text-sm font-medium text-accent mb-1">
          Collaborateurs
        </label>
        <input type="text" name="owner" placeholder="Ex : Alice Martin, Lucas Bernard"
          class="w-full rounded-lg bg-secondary px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
        <p class="text-xs text-accent mt-1">
          Séparer les noms par des virgules
        </p>
      </div>

      <!-- Bouton -->
      <div class="flex flex-col items-center">
        <p id="success"
          class="invisible inline-block text-md font-medium text-lime-700 rounded-md border border-lime-300 mb-2 bg-lime-200 py-1 px-2">
          Ticket généré</p>
        <p class="inline-block text-md font-medium text-red-600 py-1 px-2">
          * : Champs obligatoires</p>
        <button type="submit"
          class="w-full bg-primary text-white py-2 rounded-lg font-semibold hover:bg-accent transition">
          Générer le ticket
        </button>
      </div>

    </form>
  </div>

@endsection