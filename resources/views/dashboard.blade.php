@extends('layouts.inefrapasa')

@switch($component ?? 'default') {{-- Usar 'default' como valor predeterminado si $component no está definido --}}
    @case('estudiante')
        @section('content')
            @component('components.estudiante', ['registroEstudiante' => $data, 'cursos' => $curso, 
            'cargos' => $cargo, 'totalEstudiantes' => $totalEstudiantes, 'totalHombres' => $totalHombres, 
            'totalMujeres' => $totalMujeres,])
            @endcomponent
        @endsection
    @break

    @case('postulaciones')
        @section('content')
            @component('components.postulaciones', ['registroPostulante' => $data, 'cursos' => $curso, 'cargos' => $cargo])
            @endcomponent
        @endsection
    @break

    @case('conteovotos')
        @section('content')
            @component('components.conteovotos', ['registroEstudiante' => $data])
            @endcomponent
        @endsection
    @break

    @case('editar_perfil')
        @section('content')
            @include('profile.edit', ['data' => $data])
        @endsection
    @break

    @default
        @section('content')
            <div class="w-full max-w-md mt-16 mx-auto" data-style="clean">
                <div class="text-center">
                    <h1 class="mb-4 text-4xl font-extrabold leading-none tracking-tight md:text-5xl lg:text-6xl"
                        style="color: #FF7F50; text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5;">BIENVENIDOS</h1>
                    <h1 class="mb-4 text-4xl font-extrabold leading-none tracking-tight md:text-5xl lg:text-6xl"
                        style="color: #FF0000; text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5;">AL FUTURO</h1>
                </div>
            </div>
        @endsection
@endswitch
