<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Beranda')</title>
    @vite('resources/css/app.css')
    <link rel="icon" type="image/png" href="{{ asset('img/al_ikhlas_logo.jpg') }}">    
    <script src="https://unpkg.com/lucide@latest"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        'poppins': ['Poppins', 'sans-serif'],
                    },
                    colors: {
                        'primary': '#15803d',
                        'primary-dark': '#166534',
                        'accent': '#facc15',
                        'accent-dark': '#eab308',
                    }
                }
            }
        }
    </script>
</head>

<body>
    <div>
        @include('navbar')

        <div class="min-h-screen bg-gray-100">
            @yield('content')
        </div>

        @include('footer')
    </div>
    <script>
        function toggleMobileMenu() {
            const menu = document.getElementById('mobile-menu');
            menu.classList.toggle('hidden');
        }
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            lucide.createIcons();
        });
    </script>
</body>

</html>