@extends('layouts.inefrapasa') <!-- Asegúrate de que estás extendiendo la plantilla inefrapasa -->

@section('content')
    <div class="container p-4 mx-auto">
        <h1 class="mb-0 text-2xl font-bold">Postulantes</h1>
        <div class="py-10">
            @if (count($registroPostulante) > 0)
                <div class="grid max-w-6xl gap-5 mx-auto place-content-center md:grid-cols-3">
                    @foreach ($registroPostulante as $index => $postulante)
                        <div
                            class="max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                            <img class="rounded-t-lg" src="{{ asset($postulante->fotoPostulante) }}" alt="Imagen del candidato"
                                onerror="this.onerror=null; this.src='{{ asset('ruta/a/imagen-alternativa.jpg') }}'"
                                style="max-width: 100%; height: auto;">
                            <div class="p-5">
                                <hr>
                                <h5
                                    class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white text-center">
                                    {{ $postulante->estudiante->nombreCompleto }}
                                </h5>
                                <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">
                                    Postulante a: {{ $postulante->cargo->nombreCargo }}
                                    <br>
                                    Del Curso: {{ $postulante->estudiante->curso->nombreCurso }}
                                </p>
                            </div>
                        </div>
                        @if (($index + 1) % 3 == 0)
                            <div class="w-full"></div> <!-- Añade un divisor si es necesario -->
                        @endif
                    @endforeach
                </div>
                {{ $registroPostulante->links() }} <!-- Paginación -->
            @else
                <div style="display: flex; justify-content: center; align-items: center;">
                    <p>No hay postulantes para mostrar.</p>
                </div>
            @endif
        </div>
        <hr>
        <h1 class="mb-4 text-2xl font-bold">Agregar Postulantes a Cargos Estudiantiles</h1>

        <div id="agregar-otro" class="w-full flex justify-center high-500px">
            <div id="agregar-otro" class="w-full flex justify-center high-500px">
                <div class="form-container mt-10 w-full max-w-4xl mx-auto">
                    <form action="{{ route('sve.storePostulante', ['component' => 'postulaciones']) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="p-5 border border-gray-300 rounded-lg shadow-lg flex flex-col items-center w-full"
                            style="max-width: 700px;">
                            <!-- Input para agregar una imagen -->
                            <input id="fotoPostulante" name="fotoPostulante" required type="file" accept="image/*"
                                class="hidden">
                            <!-- Vista previa de la imagen -->
                            <img id="imagePreview" class="rounded-lg object-cover w-full" src=""
                                alt="Imagen del candidato" style="height: auto;">
                            <!-- Botón para cambiar la imagen -->
                            <br>
                            <button type="button" onclick="document.getElementById('fotoPostulante').click()"
                                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition duration-300 ease-in-out transform hover:scale-105">
                                Cambiar imagen
                            </button>
                        </div>  
                        <div
                            style="margin-top: 20px; width: 100%; max-width: 700px; display: flex; justify-content: space-between;">
                            <input type="text" name="estudiante_id" placeholder="Número de identidad"
                                class="text-gray-900 bg-transparent border-b border-gray-500 dark:text-white focus:outline-none w-full mr-2">
                            <select name="cargo_id" class="w-full px-4 py-2 border rounded">
                                <option value="" selected disabled>Seleccione un cargo</option>
                                @foreach ($cargos as $cargo)
                                    <option value="{{ $cargo->cargo_id }}">{{ $cargo->nombreCargo }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mt-4 w-full flex justify-center">
                            <button type="submit"
                                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition duration-300 ease-in-out transform hover:scale-105">
                                Agregar postulante
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <script>
                document.getElementById('fotoPostulante').addEventListener('change', function(e) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        document.getElementById('imagePreview').src = e.target.result;
                    }
                    reader.readAsDataURL(this.files[0]);
                });
            </script>

        @endsection
