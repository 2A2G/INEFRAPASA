@extends('layouts.inefrapasa')



@switch(session('status') ?? 'default')
    @case(1+2)

    @break

    @default
        @section('content')
            <div
                style="display: flex; justify-content: center; align-items: center; height: 100vh; position: fixed; inset: 0; width: calc(100% - 300px); margin-left: 300px;">
                <div style="text-align: center;">
                    <h1 class="mb-4 text-4xl font-extrabold leading-none tracking-tight md:text-5xl lg:text-6xl"
                        style="color: #FF7F50; text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);">INICIAR</h1>
                    <h1 class="mb-4 text-4xl font-extrabold leading-none tracking-tight md:text-5xl lg:text-6xl"
                        style="color: #FF0000; text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);">Sistema de Votación Estudiantil</h1>
                    <a href="#">
                        <button type="button"
                            class="text-white bg-gradient-to-r from-red-500 via-red-600 to-red-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Empezar</button>
                    </a>
                </div>
            </div>
        @endsection

@endswitch
