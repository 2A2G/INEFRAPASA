<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.1.1/flowbite.min.js"></script>
    <title>INEFRAPASA</title>
</head>

<body class="flex flex-col items-center justify-center min-h-screen">

    <nav class="fixed top-0 left-0 z-50 w-full bg-white border-gray-200 dark:bg-gray-900">
        <div class="flex items-center justify-between max-w-screen-xl p-4 mx-auto">
            <div class="w-1/4">
                <a href="/">
                    <img src="/icon/logo-inefrapasa.jpeg" alt="Descripción de la imagen" style="max-width: 35%;">
                </a>
            </div>
            <div class="w-3/4 p-6">
                <h1 style="color: #FF7F50; text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5); text-align: center;">
                    Sistema de Votación Estudiantil</h1>
                <h1 style="color: #FF0000; text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5); text-align: center;">
                    INSTITUCIÓN EDUCATIVA FRANCISCO DE PAULA SANTANDER</h1>
            </div>
        </div>
    </nav>

    @switch(session('status') ?? 'default')
        @case('success')
            @component('components.card-vocatacion', ['cargos' => $cargos, 'postulantes'=> $postulantes, 'estudiante' => $estudiante]);
            @endcomponent
        @break

        @default
            @if (session('message'))
                <div class="alert alert-{{ session('status') }}">
                    {{ session('message') }}
                </div>
            @endif
            <div class="w-full max-w-md mt-16" data-style="clean">
                <form action="{{ route('sve.create', ['numeroIdentidad' => old('numeroIdentidad')]) }}" method="POST">
                    @csrf
                    <input type="integer" id="numeroIdentidad" name="numeroIdentidad"
                        class="block w-full px-4 py-4 pl-12 text-base text-gray-900 bg-white border border-gray-200 rounded-xl formkit-input focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Ingrese su número de identidad" required>
                    <button type="submit"
                        class="block w-full px-5 py-2 mt-4 text-base font-semibold text-white bg-blue-500 rounded-full hover:bg-blue-600 focus:outline-none focus:ring focus:border-blue-300 focus:ring-blue-200">
                        Validar
                    </button>
                </form>
            </div>
    @endswitch

</body>

</html>
