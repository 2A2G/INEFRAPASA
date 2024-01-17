@extends('layouts.inefrapasa') <!-- Asegúrate de que estás extendiendo la plantilla inefrapasa -->

@section('content')
    <div class="container p-4 mx-auto">
        <h1 class="mb-0 text-2xl font-bold">Postulantes</h1>
        <div class="py-10">
            @if (count($registroPostulante) > 0)
                <div class="grid grid-cols-3 gap-4">
                    <!-- Asegúrate de que cada elemento de la cuadrícula tenga la misma clase -->
                    @foreach ($registroPostulante as $index => $postulante)
                        <div
                            class="col-span-1 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                            <img class="rounded-t-lg w-full h-48 object-cover"
                                src="{{ asset('storage/postulantes/' . $postulante->photo->imagenCandidato) }}"
                                alt="Imagen del candidato"
                                onerror="this.onerror=null; this.src='{{ asset('ruta/a/imagen-alternativa.jpg') }}'">
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
                            <form
                                action="{{ route('sve.deletePostulante', ['component' => 'postulaciones', 'postulante' => $postulante->postulante_id]) }}"
                                method="POST">
                                @csrf
                                <!-- Agrega un campo oculto para el postulante_id -->
                                <input type="hidden" name="postulante_id" value="{{ $postulante->postulante_id }}">

                                <div class="flex justify-end p-5">
                                    <button type="submit"
                                        class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded transition duration-300 ease-in-out transform hover:scale-105">
                                        Eliminar Postulación
                                    </button>
                                </div>
                            </form>

                        </div>
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
                    <form action="{{ route('store.storePostulante', ['component' => 'postulaciones']) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div
                            class="p-5 border border-gray-300 rounded-lg shadow-lg flex flex-col items-center w-full max-w-lg mx-auto">
                            <!-- Input para agregar una imagen -->
                            <input id="imagenCandidato" name="imagenCandidato" required type="file" accept="image/*"
                                class="hidden">
                            <!-- Vista previa de la imagen con tamaño fijo y centrado -->
                            <div class="flex justify-center items-center overflow-hidden h-48 w-full">
                                <img id="imagePreview" class="object-contain max-w-full max-h-full"
                                    src="ruta/a/tu-imagen.jpg" alt="Imagen del candidato">
                            </div>
                            <!-- Botón para cambiar la imagen -->
                            <button type="button" onclick="document.getElementById('imagenCandidato').click()"
                                class="mt-4 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition duration-300 ease-in-out transform hover:scale-105">
                                Cambiar imagen
                            </button>
                        </div>

                        <div class="mt-5 w-full max-w-lg mx-auto flex flex-wrap justify-between">
                            <input type="text" name="estudiante_id" placeholder="Número de identidad"
                                class="text-gray-900 bg-transparent border-b border-gray-500 dark:text-white focus:outline-none w-full md:w-5/12 mr-2 mb-4 md:mb-0">
                            <select name="cargo_id" class="w-full md:w-6/12 px-4 py-2 border rounded">
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
                document.getElementById('imagenCandidato').addEventListener('change', function(e) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        document.getElementById('imagePreview').src = e.target.result;
                    }
                    reader.readAsDataURL(this.files[0]);
                });
            </script>

        @endsection
