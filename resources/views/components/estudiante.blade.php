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
        // Definimos un intervalo para actualizar el conteo cada 100 milisegundos
        const interval = setInterval(updateCount, 100);

        // Configuramos las opciones para el gráfico
        const options = {
            chart: {
                type: 'bar',
                height: 350 // Altura del gráfico
            },
            title: {
                text: 'Hombres y Mujeres' // Título del gráfico
            },
            series: [{
                    name: 'Hombres', // Nombre de la serie
                    data: [20, 30, 40, 45, 50, 49, 60, 70, 91, 125, 155, 100] // Datos de la serie
                },
                {
                    name: 'Mujeres', // Nombre de la serie
                    data: [10, 23, 31, 28, 40, 36, 50, 55, 65, 85, 95, 190] // Datos de la serie
                }
            ],
            xaxis: {
                categories: ['Transición', 'Primero', 'Segundo', 'Tercero', 'Cuarto', 'Quinto',
                    'Sexto', 'Séptimo', 'Octavo', 'Noveno', 'Décimo', 'Undécimo'
                ] // Categorías para el eje X
            }
        };

        // Creamos el gráfico con las opciones definidas
        const chart = new ApexCharts(document.querySelector("#chart"), options);

        // Renderizamos el gráfico
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

        

        <!-- Tabla de Estudiantes -->
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
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
                <tbody class="bg-white divide-y divide-gray-200">
                    @if ($registroEstudiante->isEmpty())
                        <tr>
                            <td colspan="6" class="px-6 py-4 whitespace-nowrap text-center">No hay datos disponibles.
                            </td>
                        </tr>
                    @else
                        @foreach ($registroEstudiante as $student)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $student->numeroIdentificacion }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $student->nombreCompleto }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $student->curso }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $student->sexo }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if ($student->estado == 0)
                                        Activo
                                    @else
                                        Inactivo
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right">
                                    <button type="button" data-modal-target="popup-modal"
                                        data-student-id="{{ $student->id }}" data-modal-toggle="popup-modal"
                                        class="inline-block px-4 py-2 mt-2 font-semibold text-white bg-blue-500 rounded-md">
                                        Editar
                                    </button>
                                    <button data-modal-target="Eliminar" data-modal-toggle="Eliminar"
                                        class="btn btn-red inline-block px-4 py-2 mt-2 font-semibold text-white bg-red-500 rounded-md">
                                        Eliminar
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
            {{ $registroEstudiante->links() }}

            <div id="popup-modal" tabindex="-1"
                class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                <div class="w-full max-w-md p-6 bg-white rounded shadow-lg modal-content">
                    <p class="mb-4 text-2xl font-semibold text-center">Información del Estudiante</p>

                    <form action="{{ route('sve.storeStudents', ['component' => 'estudiante']) }}" method="POST">
                        @csrf
                        <div class="flex flex-wrap mb-2 -mx-3">
                            <div class="w-full px-3 mb-2">
                                <label for="numeroIdentificacion" class="block mb-2 font-semibold">Número de
                                    Identificación:</label>
                                <input type="text" id="numeroIdentificacion" name="numeroIdentificacion"
                                    value= "{{ $student->numeroIdentificacion }}" class="w-full px-4 py-2 border rounded"
                                    placeholder="Número de Identificación">
                            </div>
                            <div class="w-full px-3 mb-2">
                                <label for="nombreCompleto" class="block mb-2 font-semibold">Nombre del
                                    estudiante:</label>
                                <input type="text" id="nombreCompleto" name="nombreCompleto"
                                    value= "{{ $student->nombreCompleto }}" class="w-full px-4 py-2 border rounded"
                                    placeholder="Nombre del estudiante">
                            </div>
                        </div>
                        <div class="flex flex-wrap mb-2 -mx-3">
                            <div class="w-full px-3 mb-2">
                                <label for="curso" class="block mb-2 font-semibold">Grado:</label>
                                <input type="text" id="curso" name="curso" class="w-full px-4 py-2 border rounded"
                                    value= "{{ $student->curso }}" placeholder="Grado">
                            </div>
                            <div class="w-full px-3 mb-2">
                                <label for="sexo" class="block mb-2 font-semibold">Sexo:</label>
                                <select id="sexo" name="sexo" class="w-full px-4 py-2 border rounded">
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

            <div id="Eliminar" tabindex="-1"
                class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                <div class="relative p-4 w-full max-w-md max-h-full">
                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                        <button type="button"
                            class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                            data-modal-hide="Eliminar">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                        <div class="p-4 md:p-5 text-center">
                            <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>
                            <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">¿Está seguro que desea
                                eliminar este registro? Esta acción es irreversible</h3>
                            <form
                                action="{{ route('sve.deleteStudents', ['component' => 'estudiante', 'estudiante' => $student]) }}"
                                method="POST">
                                @csrf

                                <!-- Aquí puedes agregar un botón de envío o cualquier otro elemento de formulario que necesites -->
                                <button data-modal-hide="Eliminar" type="submit"
                                    class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center me-2">
                                    Si, confirmar
                                </button>
                            </form>

                            <button data-modal-hide="Eliminar" type="button"
                                class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">No,
                                cancelar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
@endsection
