<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>INEFRAPASA</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <!-- Al final de tu plantilla inefrapasa -->


    <!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.1.1/flowbite.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            document.querySelectorAll('[data-collapse-toggle]').forEach((button) => {
                button.addEventListener('click', (event) => {
                    const targetId = event.currentTarget.getAttribute('aria-controls');
                    const target = document.getElementById(targetId);
                    if (target) {
                        target.classList.toggle('hidden');
                    }
                });
            });
        });
    </script>
</head>

<body>
    <div style="position: fixed; width: 300px;">
        @include('layouts.sidebar')
    </div>
    <section style="margin-left: 300px; margin-top: 120px; margin-right: 35px;">
        <br>
        @yield('content')
    </section>
</body>

</html>
