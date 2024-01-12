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
                            <img class="rounded-t-lg" src="{{ asset($postulante->foto_postulante) }}"
                                alt="Imagen del candidato"
                                onerror="this.onerror=null; this.src='{{ asset('ruta/a/imagen-alternativa.jpg') }}'"
                                style="max-width: 100%; height: auto;">
                            <div class="p-5">
                                <a href="#">
                                    <h5
                                        class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white text-center">
                                        {{ $postulante->nombre_postulante }}
                                    </h5>
                                </a>
                                <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">
                                    Postula a: {{ $postulante->cargo_postulante }}
                                    <br>
                                    De grado: {{ $postulante->curso_postulante }}
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

        <br>
        <h1 class="mb-4 text-2xl font-bold">Agregar Postulantes a Cargos Estudiantiles</h1>

        <div class="flex justify-center">
            <div class="flex space-x-4 text-center">
                <a href="#" class="btn btn-blue cargo-button" id="representante"
                    data-target="representante">Representante de Curso</a>
                <a href="#" class="btn btn-blue cargo-button" id="contralor" data-target="contralor">Controlador</a>
                <a href="#" class="btn btn-blue cargo-button" id="personero" data-target="personero">Personero</a>
            </div>
        </div>

        <div id="agregar-otro" class="w-full flex justify-center">
            <div class="form-container mt-10">
                <form action="{{ route('sve.storePostulante', ['component' => 'postulaciones']) }}" method="POST">
                    @csrf
                    <div class="p-5 border border-gray-300 rounded-lg shadow-lg flex flex-col items-center">
                        <!-- Input para agregar una imagen -->
                        <input id="imageUpload" type="file" accept="image/*" class="hidden">
                        <!-- Vista previa de la imagen -->
                        <img id="imagePreview" class="rounded-lg w-200 h-300 object-cover mb-4" src=""
                            alt="Imagen del candidato" style="max-height: 300px;">
                        <!-- Botón para cambiar la imagen -->
                        <button type="button" onclick="document.getElementById('imageUpload').click()"
                            class="btn btn-blue mb-4">Cambiar imagen</button>
                    </div>

                    <!-- Input para el nombre y el select -->
                    <div style="margin-top: 20px; width: 350px; display: flex; justify-content: space-between;">
                        <input type="text" name="numeroIdentificacion_id" placeholder="Número de identidad"
                            class="text-gray-900 bg-transparent border-b border-gray-500 dark:text-white focus:outline-none w-full mr-2">
                        <select name="curso" class="select-css w-full">
                            <option value="" disabled selected>¿De qué curso?</option>
                            <option value="transicion">Transición</option>
                            <option value="primero">Primero</option>
                            <option value="segundo">Segundo</option>
                            <option value="tercero">Tercero</option>
                            <option value="cuarto">Cuarto</option>
                            <option value="quinto">Quinto</option>
                            <option value="sexto">Sexto</option>
                            <option value="septimo">Septimo</option>
                            <option value="octavo">Octavo</option>
                            <option value="noveno">Noveno</option>
                            <option value="decimo">Décimo</option>
                            <option value="undecimo">Undécimo</option>
                        </select>
                    </div>

                    <!-- Input para el cargo -->
                    <div style="margin-top: 20px; width: 350px; display: flex; justify-content: space-between;">
                        <select name="cargo_id" class="select-css w-full">
                            <option value="" disabled selected>¿Que cargo?</option>
                            <option value="representante">Representante de Curso</option>
                            <option value="contralor">Contralor</option>
                            <option value="personero">Personero</option>
                        </select>
                    </div>

                    <div class="mt-4 w-full flex justify-center">
                        <button type="submit"
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded shadow-lg transform transition duration-500 hover:scale-110">
                            Agregar postulante
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', (event) => {
                const cargoButtons = document.querySelectorAll('.cargo-button');
                const agregarOtroButton = document.getElementById('agregar-otro');

                // Eventos de clic para los botones de cargo
                cargoButtons.forEach(button => {
                    button.addEventListener('click', (event) => {
                        event.preventDefault();

                        var cargo = button.getAttribute(
                            'id'); // Obtén el cargo del atributo 'data-target' del botón
                        var curso;

                        // Define el curso en función del cargo
                        switch (cargo) {
                            case 'representante':
                                curso = 'transicion';
                                cargo = 'representante'
                                break;
                            case 'contralor':
                                curso = 'decimo';
                                cargo = 'contralor'
                                break;
                            case 'personero':
                                curso = 'undecimo';
                                cargo = 'personero'
                                break;
                        }

                        console.log('curso: ' + curso);
                        console.log('cargo: ' + cargo);

                        // Si curso no es undefined, entonces asigna su valor al select
                        if (curso !== undefined) {
                            // Obtén el elemento select por su nombre
                            var selectCurso = document.querySelector('select[name="curso"]');
                            var selectCargo = document.querySelector('select[name="cargo_id"]');

                            // Encuentra la opción con el valor que quieres seleccionar
                            for (var i = 0; i < selectCurso.options.length; i++) {
                                if (selectCurso.options[i].value == curso) {
                                    // Si el valor de la opción coincide con 'curso', selecciona esa opción
                                    selectCurso.options[i].selected = true;
                                    break;
                                }
                            }
                            for (var i = 0; i < selectCargo.options.length; i++) {
                                if (selectCargo.options[i].value == cargo) {
                                    // Si el valor de la opción coincide con 'cargo', selecciona esa opción
                                    selectCargo.options[i].selected = true;
                                    break;
                                }
                            }
                        }
                    });
                });

            });
            document.getElementById('imageUpload').addEventListener('change', function(e) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('imagePreview').src = e.target.result;
                }
                reader.readAsDataURL(this.files[0]);
            });
        </script>
    @endsection
