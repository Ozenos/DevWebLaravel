@extends('layouts/contentNoAside')

<head>
    <title>Cross Tickets - Profil</title>
</head>

@section('content')
    <div class="mt-4 mb-4 flex-wrap items-center justify-center space-y-4 m-auto max-w-3xl">

        <h1 class="bg-background rounded-xl shadow-lg p-4 text-2xl font-bold text-text text-center">
            Profil
        </h1>
        
        <div class="p-4 sm:p-8 bg-background shadow-lg rounded-xl">
            <div class="max-w-xl">
                @include('profile.partials.update-profile-information-form')
            </div>
        </div>

        <div class="p-4 sm:p-8 bg-background shadow-lg rounded-xl">
            <div class="max-w-xl">
                @include('profile.partials.update-password-form')
            </div>
        </div>

        <div class="p-4 sm:p-8 bg-background shadow-lg rounded-xl">
            <div class="max-w-xl">
                @include('profile.partials.delete-user-form')
            </div>
        </div>
    </div>
@endsection
