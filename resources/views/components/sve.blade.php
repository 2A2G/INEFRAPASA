@extends('layouts.inefrapasa') <!-- Asegúrate de que estás extendiendo la plantilla inefrapasa -->

@section('content')
    <div class="container p-4 mx-auto">
        <h1 class="mb-0 text-2xl font-bold">Postulantes</h1>
        <div class="py-10">
            <div class="mx-auto mb-5 max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                </div>
            </div>
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
                                <p class="mb-3 font-normal text-gray-700 dark-text-gray-400">
                                    Postula a: {{ $postulante->cargo_postulante }}
                                    <br>
                                    De grado: {{ $postulante->curso_postulante }}
                                </p>
                            </div>                    
                        </div>

                        @if (($index + 1) % 3 == 0)
                </div>
                <div class="grid max-w-6xl gap-5 mx-auto place-content-center md:grid-cols-3">
            @endif
            @endforeach
        </div>
    @else
        <div class="text-center"
            style="height: 100vh; display: flex; flex-direction: column; justify-content: flex-start; position: relative; top: 10%;">
            <p>No hay postulantes para mostrar.</p>
        </div>
        @endif
        {{ $registroPostulante->links() }}
    </div>
    </div>


    <br>
    <h1 class="mb-4 text-2xl font-bold">Agregar Postulantes a Cargos Estudiantiles</h1>

    <div class="flex space-x-4">
        <a href="#" class="btn btn-blue cargo-button" id="representante" data-target="representante">Representante de
            Curso</a>
        <a href="#" class="btn btn-blue cargo-button" id="contralor" data-target="contralor">Controlador</a>
        <a href="#" class="btn btn-blue cargo-button" id="personero" data-target="personero">Personero</a>
    </div>

    <div id="agregar-otro" style="display: none;">
        <div class="form-container" style="margin-top: 40px; position: relative;">
            <div class="relative p-5 border border-gray-300 rounded-lg shadow-lg w-250"
                style="width: 350px; height: 360px; display: flex; flex-direction: column; justify-content: center; align-items: center;">
                <!-- Input para agregar una imagen -->
                <input id="imageUpload" type="file" accept="image/*" class="hidden">
                <!-- Vista previa de la imagen -->
                <img id="imagePreview" class="rounded-t-lg w-200 h-300 object-cover" src=""
                    alt="Imagen del candidato" style="object-fit: contain; max-height: 300px;">

                <!-- Botón para cambiar la imagen -->
                <button type="button" onclick="document.getElementById('imageUpload').click()"
                    style="text-align: center; text-decoration: underline;">Cambiar imagen</button>
                <!-- Botón "Agregar postulante" superpuesto en la caja de la imagen -->
                <button type="button" class="add-postulante-button"
                    style="position: absolute; bottom: calc(120px + 30px); right: calc(80px - 80%)"
                    onclick="addPostulante()">Guardar candidatura</button>

            </div>
            <!-- Input para el nombre y el select -->
            <h3 style="margin-top:
                    20px; width: 350px; display: flex; justify-content: center;">
                <input type="text" id="name" placeholder="Número de identidad   "
                    class="text-gray-900 bg-transparent border-b border-gray-500 dark:text-white focus:outline-none w-250">
                <select name="curso_postulante" class="select-css">
                    <option value="" disabled selected>¿De que curso</option>
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
            </h3>
        </div>
    </div>
    <button id="finalizar" class="btn btn-red" style="display: none; float: right;">Finalizar Postulantes</button>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            const cargoButtons = document.querySelectorAll('.cargo-button');
            const agregarOtroButton = document.getElementById('agregar-otro');
            const finalizarButton = document.getElementById('finalizar');

            // Función para mostrar la caja y el botón "Finalizar"
            function showForm() {
                // Mostrar la caja y el botón "Finalizar"
                if (agregarOtroButton && finalizarButton) {
                    agregarOtroButton.style.display = 'block';
                    finalizarButton.style.display = 'block';
                }
            }

            // Eventos de clic para los botones de cargo
            cargoButtons.forEach(button => {
                button.addEventListener('click', (event) => {
                    event.preventDefault();
                    showForm();

                    var cargo = button.getAttribute(
                        'id'); // Obtén el cargo del atributo 'data-target' del botón
                    var curso;

                    // Define el curso en función del cargo
                    switch (cargo) {
                        case 'contralor':
                            curso = 'decimo';
                            cargo = 'Contralor'
                            break;
                        case 'personero':
                            curso = 'undecimo';
                            cargo = 'Personero'
                            break;
                    }

                    console.log('curso: ' + curso);
                    console.log('cargo: ' + cargo);

                    // Si curso no es undefined, entonces asigna su valor al select
                    if (curso !== undefined) {
                        // Obtén el elemento select por su nombre
                        var selectCurso = document.querySelector('select[name="curso_postulante"]');

                        // Encuentra la opción con el valor que quieres seleccionar
                        for (var i = 0; i < selectCurso.options.length; i++) {
                            if (selectCurso.options[i].value == curso) {
                                // Si el valor de la opción coincide con 'curso', selecciona esa opción
                                selectCurso.options[i].selected = true;
                                break;
                            }
                        }
                    }
                });
            });

            // Evento de clic para el botón "Finalizar Postulación"
            if (finalizarButton) {
                finalizarButton.addEventListener('click', () => {
                    // Aquí puedes agregar lógica para guardar todos los formularios completados y finalizar la postulación.
                    // Ocultar la caja y el botón "Finalizar" cuando se hace clic en "Finalizar Postulantes"
                    agregarOtroButton.style.display = 'none';
                    finalizarButton.style.display = 'none';
                    curso = null;

                    // Obtén el elemento select por su nombre
                    var selectCurso = document.querySelector('select[name="curso_postulante"]');

                    // Selecciona la primera opción del select
                    selectCurso.selectedIndex = 0;
                });
            }

        });
        document.getElementById('imageUpload').addEventListener('change', function(e) {
            var reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('imagePreview').src = e.target.result;
            }
            reader.readAsDataURL(this.files[0]);
        });


        function addPostulante() {
            var numero_identificacion_postulante = document.getElementById('numero_identificacion_postulante').value;
            var curso_postulante = document.getElementById('curso_postulante').value;
            var cargo_postulante = document.getElementById('cargo_postulante').value;
            var foto_postulante = document.getElementById('imagePreview').src;

            // Primero, verifica si el número de identificación es válido
            if (numero_identificacion_postulante) {
                // Luego, verifica si el estudiante existe en la base de datos y si el curso es correcto
                fetch('/estudiantes/' + numero_identificacion_postulante)
                    .then(response => response.json())
                    .then(estudiante => {
                        if (estudiante && estudiante.curso == curso_postulante) {
                            // Si todo está bien, guarda la postulación
                            var data = {
                                numero_identificacion_postulante: estudiante
                                    .numeroIdentificacion, // Usa el número de identificación del estudiante
                                nombre_estudiante: estudiante
                                    .nombreCompleto, // Agrega el nombre del estudiante a los datos
                                cargo_postulante: cargo_postulante,
                                curso_postulante: curso_postulante,
                                foto_postulante: foto_postulante,
                            };

                            fetch('/postulantes', {
                                    method: 'POST',
                                    headers: {
                                        'Content-Type': 'application/json',
                                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                            .getAttribute(
                                                'content')
                                    },
                                    body: JSON.stringify(data)
                                })
                                .then(response => response.json())
                                .then(data => {
                                    console.log('Success:', data);
                                    addNewForm();
                                })
                                .catch((error) => {
                                    console.error('Error:', error);
                                });
                        } else {
                            alert('El curso no coincide con el registrado en la base de datos');
                        }
                    })
                    .catch((error) => {
                        console.error('Error:', error);
                        alert('No se encontró al estudiante en la base de datos');
                    });
            } else {
                alert('Por favor ingrese un número de identificación válido');
            }
        }
    </script>
@endsection
