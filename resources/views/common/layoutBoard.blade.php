@include('common/headerUtils')

<body class="min-h-screen bg-secondary">

    <!-- Bandeau supérieur -->
    <header class="fixed top-0 left-0 right-0 h-14 bg-background shadow flex items-center justify-between px-6 z-20">
        <div class="flex items-center gap-4">
            <button class="text-text hover:text-footertext">
                ☰
            </button>
            <a href="dashboard.html" class="font-semibold text-text">Dashboard</a>
        </div>

        <div class="flex items-center gap-4 text-sm">
            <a href="#" class="text-accent">Jean Dupont</a>
            <a :href="route('logout')"
                class="bg-primary text-white p-2 rounded-lg font-semibold hover:bg-accent transition">
                Déconnexion
            </a>
        </div>
    </header>

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
                @yield('footer', view('common/footerDefault'))
            </footer>
        </div>
    </div>

</body>
</html>