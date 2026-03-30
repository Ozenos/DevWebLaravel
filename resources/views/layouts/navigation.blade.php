@include('common.headerUtils')

<body class="min-h-screen bg-secondary">

    <!-- Bandeau supérieur -->
    <header class="fixed top-0 left-0 right-0 h-14 bg-background shadow flex items-center justify-between px-6 z-20">
        <div class="flex items-center gap-4">
            <button class="text-text hover:text-footertext">
                ☰
            </button>
            <a href="{{ route('dashboard') }}" class="font-semibold text-text">Dashboard</a>
        </div>

        <div class="flex items-center gap-4 text-sm">
            <a href={{ route('profile.edit') }} class="text-accent hover:underline">{{ Auth::user()->name }}</a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                    class="mt-3.5 bg-primary text-white p-2 rounded-lg font-semibold hover:bg-accent transition">
                    Déconnexion
                </button>
            </form>
        </div>
    </header>

    @yield('inside')

</body>
</html>