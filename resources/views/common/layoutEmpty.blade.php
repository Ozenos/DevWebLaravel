@include('common.headerUtils')

<body class="mt-2 min-h-screen flex flex-col justify-between items-center justify-center bg-secondary text-text">
    
    @yield('content')
    <footer class="bg-background w-full text-footertext">
        @yield('footer', view('common.footerDefault'))
    </footer>
</body>