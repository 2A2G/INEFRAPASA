@extends('layouts.inefrapasa')
@section('content')
    <div class="flex justify-between pb-4 mb-4 border-b border-gray-200 dark:border-gray-700">
        <div class="flex items-center">
            <div class="flex items-center justify-center w-12 h-12 mr-3 bg-gray-100 rounded-lg dark:bg-gray-700">
                <svg class="w-6 h-6 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    fill="currentColor" viewBox="0 0 20 19">
                    <path
                        d="M14.5 0A3.987 3.987 0 0 0 11 2.1a4.977 4.977 0 0 1 3.9 5.858A3.989 3.989 0 0 0 14.5 0ZM9 13h2a4 4 0 0 1 4 4v2H5v-2a4 4 0 0 1 4-4Z" />
                    <path
                        d="M5 19h10v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2ZM5 7a5.008 5.008 0 0 1 4-4.9 3.988 3.988 0 1 0-3.9 5.859A4.974 4.974 0 0 1 5 7Zm5 3a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm5-1h-.424a5.016 5.016 0 0 1-1.942 2.232A6.007 6.007 0 0 1 17 17h2a1 1 0 0 0 1-1v-2a5.006 5.006 0 0 0-5-5ZM5.424 9H5a5.006 5.006 0 0 0-5 5v2a1 1 0 0 0 1 1h2a6.007 6.007 0 0 1 4.366-5.768A5.016 5.016 0 0 1 5.424 9Z" />
                </svg>
            </div>
            <div>
                <h5 id="Total" class="pb-1 text-2xl font-bold leading-none text-gray-900 dark:text-white"> Cantidad de
                    estudiantes: </h5>
                <h5 id="studentCount" class="pb-1 text-2xl font-bold leading-none text-gray-900 dark:text-white"></h5>
                <p id="totalMen" class="text-sm font-normal text-gray-500 dark:text-gray-400">Total de hombres: </p>
                <p id="totalWomen" class="text-sm font-normal text-gray-500 dark:text-gray-400">Total de mujeres: </p>
            </div>
        </div>
    </div>

    <div id="chart"></div>

    <script>
        // Aquí es donde defines la cantidad total de estudiantes
        const totalStudents = [850];

        let count = 0;
        const element = document.getElementById('studentCount');

        // Esta función se llama una vez por segundo para actualizar el recuento
        function updateCount() {
            if (count < totalStudents) {
                // Si la cantidad total de estudiantes es mayor que 100 y la diferencia entre el conteo y el total es mayor o igual a 40, incrementa el conteo de 40 en 40
                if (totalStudents > 100 && (totalStudents - count) >= 40) {
                    count += 40;
                } else {
                    // Si la diferencia entre el conteo y el total es menor a 40, incrementa el conteo de 1 en 1
                    count++;
                }
                element.innerText = count;
            } else {
                // Detén la actualización una vez que alcances el total de estudiantes
                clearInterval(interval);
            }
        }

        // Comienza a actualizar el recuento
        const interval = setInterval(updateCount, 100);
        const options = {
            chart: {
                type: 'bar',
                height: 350
            },
            title: {
                text: 'Hombres y Mujeres'
            },
            series: [{
                name: 'Hombres',
                data: [20, 30, 40, 45, 50, 49, 60, 70, 91, 125, 155, 100]
            }, {
                name: 'Mujeres',
                data: [10, 23, 31, 28, 40, 36, 50, 55, 65, 85, 95, 190]
            }],
            xaxis: {
                categories: ['Transición', 'Primero', 'Segundo', 'Tercero', 'Cuarto', 'Quinto',
                    'Sexto', 'Séptimo', 'Octavo', 'Noveno', 'Décimo', 'Undécimo'
                ]
            }
        };

        const chart = new ApexCharts(document.querySelector("#chart"), options);
        chart.render();
    </script>


    <hr>
    <div class="mt-4">
        <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Lista de Estudiantes</h2>

        <!-- Botón para agregar estudiante -->
        <button type="button" data-modal-target="popup-modal" data-modal-toggle="popup-modal"
            class="inline-block px-4 py-2 mt-2 font-semibold text-white bg-blue-500 rounded-md">
            Agregar Estudiante
        </button>


        <div id="popup-modal" tabindex="-1"
            class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="w-full max-w-md p-6 bg-white rounded shadow-lg modal-content">
                <p class="mb-4 text-2xl font-semibold">Agregar Estudiante</p>

                <form id="form-1" method="POST">
                    @csrf
                    <div class="flex flex-wrap mb-2 -mx-3">
                        <div class="w-full px-3 mb-2">
                            <label for="numeroIdentificacion" class="block mb-2 font-semibold">Número de
                                Identificación:</label>
                            <input type="text" id="numeroIdentificacion" class="w-full px-4 py-2 border rounded"
                                placeholder="Número de Identificación">
                        </div>
                        <div class="w-full px-3 mb-2">
                            <label for="nombreCompleto" class="block mb-2 font-semibold">Nombre del estudiante:</label>
                            <input type="text" id="nombreCompleto" class="w-full px-4 py-2 border rounded"
                                placeholder="Nombre del estudiante">
                        </div>
                    </div>
                    <div class="flex flex-wrap mb-2 -mx-3">
                        <div class="w-full px-3 mb-2">
                            <label for="curso" class="block mb-2 font-semibold">Grado:</label>
                            <input type="text" id="curso" class="w-full px-4 py-2 border rounded"
                                placeholder="Grado">
                        </div>
                        <div class="w-full px-3 mb-2">
                            <label for="sexo" class="block mb-2 font-semibold">Sexo:</label>
                            <select id="sexo" class="w-full px-4 py-2 border rounded">
                                <option value="hombre">Hombre</option>
                                <option value="mujer">Mujer</option>
                            </select>
                        </div>
                    </div>
                    <div class="mt-4 text-center">
                        <button type="submit" class="px-4 py-2 mx-2 text-white bg-blue-500 rounded">Guardar</button>

                        <button type="button" data-modal-hide="popup-modal"
                            class="px-4 py-2 mx-2 text-white bg-red-500 rounded">Cancelar</button>
                    </div>
                </form>

            </div>
        </div>


        <!-- Tabla de Estudiantes -->
        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
            <table class="min-w-full mt-4 divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Número de
                            Identificación</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nombre
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Grado
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Sexo</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Estado
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acción
                        </th>
                    </tr>
                </thead>
                {{-- <tbody class="bg-white divide-y divide-gray-200">
                    @if ($registroEstudiante->isEmpty())
                        <tr>
                            <td colspan="6" class="px-6 py-4 whitespace-nowrap">No hay datos disponibles.</td>
                        </tr>
                    @else
                        @foreach ($registroEstudiante as $student)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $student->identification_number }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $student->name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $student->grade }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $student->status }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <a href="#" class="mr-2 text-blue-500 hover:underline edit-student">Editar</a>
                                    <a href="{{ route('students.delete', $student->id) }}"
                                        class="text-red-500 hover:underline">Eliminar</a>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody> --}}
            </table>
        </div>

    </div>

    <!-- Modal de Confirmación -->
    <div id="confirmation-modal" class="fixed inset-0 z-10 flex items-center justify-center hidden">
        <div class="absolute inset-0 bg-black opacity-25 modal-bg"></div>
        <div class="w-1/3 p-6 bg-white rounded shadow-lg modal-content">
            <p id="confirmation-message" class="mb-4 text-2xl font-semibold">Editar Estudiante</p>
            <form id="edit-form">
                {{-- <input type="text" name="identification_number" class="w-full px-4 py-2 mb-2 border rounded" placeholder="Número de Identificación" value="{{ $student->identification_number }}"> --}}
                {{-- <input type="text" name="name" class="w-full px-4 py-2 mb-2 border rounded" placeholder="Nombre del estudiante" value="{{ $student->name }}"> --}}
                {{-- <input type="text" name="grade" class="w-full px-4 py-2 mb-2 border rounded" placeholder="Grado" value="{{ $student->grade }}">
            <select name="status" class="w-full px-4 py-2 mb-2 border rounded"> --}}
                {{-- <option value="hombre" {{ $student->status === 'hombre' ? 'selected' : '' }}>Hombre</option> --}}
                {{-- <option value="mujer" {{ $student->status === 'mujer' ? 'selected' : '' }}>Mujer</option> --}}
                </select>
                <button id="save-edit" class="px-4 py-2 text-white bg-blue-500 rounded">Guardar</button>
                <button class="px-4 py-2 ml-2 text-white bg-red-500 rounded" id="cancel-edit">Cancelar</button>
            </form>
        </div>
    </div>
    <br>
@endsection


@section('scripts')
    <script>
        document.querySelector('#form-1').addEventListener('submit', function(e) {
            e.preventDefault();
            console.log('hola')
            var numeroIdentificacion = document.querySelector('#numeroIdentificacion').value;
            var nombreCompleto = document.querySelector('#nombreCompleto').value;
            var curso = document.querySelector('#curso').value;
            var sexo = document.querySelector('#sexo').value;

            console.log(numeroIdentificacion);
            axios.post('/inefrapasa/estadistica/', {
                numeroIdentificacion: numeroIdentificacion,
                nombreCompleto: nombreCompleto,
                curso: curso,
                sexo: sexo
            })
            console.log(ok);
            .then(function(response) {
                    console.log(response);
                })
                .catch(function(error) {
                    console.log(error);
                });
        });
    </script>
@endsection
