@extends('layouts.navigation')

@section('inside')
    <div class="flex pt-14 min-h-screen">
        <!-- Bandeau gauche -->
        <aside class="w-64 bg-background shadow-lg p-6">
            @yield('aside')
        </aside>

        <div class="flex-1 flex flex-col">
            <div class="flex-1">
                @yield('content')
            </div>

            <footer class="bg-background text-footertext">
                @yield('footer', view('common.footerDefault'))
            </footer>
        </div>
    </div>
@endsection