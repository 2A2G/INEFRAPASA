<nav class="fixed top-0 left-0 z-0 w-full bg-white border-gray-200 dark:bg-gray-900">
    <div class="flex items-center justify-between max-w-screen-xl p-4 mx-auto">
        <div class="w-full p-6 ml-64 md:w-auto">
            <h1 class="text-justify md:text-left lg:text-left xl:text-left 2xl:text-left"
                style="color: #FF7F50; text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);">
                Sistema de Votación Estudiantil</h1>
            <h1 class="text-justify md:text-left lg:text-left xl:text-left 2xl:text-left"
                style="color: #FF0000; text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);">
                INSTITUCIÓN EDUCATIVA FRANCISCO DE PAULA SANTANDER</h1>
        </div>
    </div>
</nav>

<div class="fixed top-0 left-0 z-10 flex flex-col items-center h-screen p-6 text-white bg-gray-800 lg:w-64"
    style="flex-grow: 1; flex-shrink: 1;">
    <a href="/">
        <img class="w-24 h-24 mb-4 rounded-full" src="/icon/logo-inefrapasa.jpeg" alt="Imagen de perfil">
    </a>
    <h2 class="mb-2 text-2xl">SVE INEFRAPASA</h2>
    <div>{{ Auth::user()->name }}</div>
    <hr class="w-full mb-6 border-gray-600">
    <div class="h-full px-3 py-4 overflow-y-auto bg-gray-800">
        <ul class="space-y-2 font-medium">
            <li>
                <button type="button"
                    class="flex items-center w-full p-2 text-white transition duration-75 rounded-lg group hover:bg-red-500 dark:hover:bg-gray-700"
                    aria-controls="dropdown-example1" data-collapse-toggle="dropdown-example1">
                    <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white"
                        aria-hidden="true" fill="currentColor" viewBox="0 0 18 21">
                        <path
                            d="M15 12a1 1 0 0 0 .962-.726l2-7A1 1 0 0 0 17 3H3.77L3.175.745A1 1 0 0 0 2.208 0H1a1 1 0 0 0 0 2h.438l.6 2.255v.019l2 7 .746 2.986A3 3 0 1 0 9 17a2.966 2.966 0 0 0-.184-1h2.368c-.118.32-.18.659-.184 1a3 3 0 1 0 3-3H6.78l-.5-2H15Z" />
                    </svg>
                    <span class="flex-1 ml-3 text-left whitespace-nowrap">
                        Estadísticas
                    </span>
                    <svg class="w-3 h-3 ml-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 10 6">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 4 4 4-4" />
                    </svg>
                </button>
                <ul id="dropdown-example1" class="hidden py-2 space-y-2">
                    <li>
                        <a href="{{ route('sve.showEstudiantes', ['component' => 'estudiante']) }}"
                            class="flex items-center w-full p-2 text-white transition duration-75 rounded-lg pl-11 group hover:bg-red-500 dark:hover:bg-gray-700">
                            Estudiantes
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('sve.showEstudiantes', ['component' => 'postulaciones']) }}"
                            class="flex items-center w-full p-2 text-white transition duration-75 rounded-lg pl-11 group hover:bg-red-500 dark:hover:bg-gray-700">
                            Postulaciones</a>
                    </li>
                    <li>
                        <a href="{{ route('sve.showEstudiantes', ['component' => 'conteovotos']) }}"
                            class="flex items-center w-full p-2 text-white transition duration-75 rounded-lg pl-11 group hover:bg-red-500 dark:hover:bg-gray-700">
                            Conteno de Votos</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="{{ route('profile.edit') }}" :active="request() - > routeIs('profile')"
                    class="flex items-center w-full p-2 text-white transition duration-75 rounded-lg group hover:bg-red-500 dark:hover:bg-gray-700"
                    aria-controls="dropdown-example" data-collapse-toggle="dropdown-example">
                    <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 18">
                        <path
                            d="M14 2a3.963 3.963 0 0 0-1.4.267 6.439 6.439 0 0 1-1.331 6.638A4 4 0 1 0 14 2Zm1 9h-1.264A6.957 6.957 0 0 1 15 15v2a2.97 2.97 0 0 1-.184 1H19a1 1 0 0 0 1-1v-1a5.006 5.006 0 0 0-5-5ZM6.5 9a4.5 4.5 0 1 0 0-9 4.5 4.5 0 0 0 0 9ZM8 10H5a5.006 5.006 0 0 0-5 5v2a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-2a5.006 5.006 0 0 0-5-5Z" />
                    </svg>
                    <span class="flex-1 ml-3 whitespace-nowrap">Perfil de Usuario</span>
                </a>
            </li>
            <li>
                <a href="#"
                    class="flex items-center w-full p-2 text-white transition duration-75 rounded-lg group hover:bg-red-500 dark:hover:bg-gray-700"
                    aria-controls="dropdown-example" data-collapse-toggle="dropdown-example">
                    <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 20">
                        <path
                            d="M17 5.923A1 1 0 0 0 16 5h-3V4a4 4 0 1 0-8 0v1H2a1 1 0 0 0-1 .923L.086 17.846A2 2 0 0 0 2.08 20h13.84a2 2 0 0 0 1.994-2.153L17 5.923ZM7 9a1 1 0 0 1-2 0V7h2v2Zm0-5a2 2 0 1 1 4 0v1H7V4Zm6 5a1 1 0 1 1-2 0V7h2v2Z" />
                    </svg>
                    <span class="flex-1 ml-3 whitespace-nowrap">Productos</span>
                </a>
            </li>
            <li>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="flex items-center w-full p-2 text-white transition duration-75 rounded-lg group hover:bg-red-500 dark:hover:bg-gray-700">
                        <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 16">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M1 8h11m0 0L8 4m4 4-4 4m4-11h3a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-3" />
                        </svg>
                        <span class="flex-1 ml-2 text-left whitespace-nowrap">Cerrar Sesión</span>
                    </button>
                </form>
            </li>
            <li>
                <a href="#"
                    class="flex items-center w-full p-2 text-white transition duration-75 rounded-lg group hover:bg-red-500 dark:hover:bg-gray-700"
                    aria-controls="dropdown-example" data-collapse-toggle="dropdown-example">
                    <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M5 5V.13a2.96 2.96 0 0 0-1.293.749L.879 3.707A2.96 2.96 0 0 0 .13 5H5Z" />
                        <path
                            d="M6.737 11.061a2.961 2.961 0 0 1 .81-1.515l6.117-6.116A4.839 4.839 0 0 1 16 2.141V2a1.97 1.97 0 0 0-1.933-2H7v5a2 2 0 0 1-2 2H0v11a1.969 1.969 0 0 0 1.933 2h12.134A1.97 1.97 0 0 0 16 18v-3.093l-1.546 1.546c-.413.413-.94.695-1.513.81l-3.4.679a2.947 2.947 0 0 1-1.85-.227 2.96 2.96 0 0 1-1.635-3.257l.681-3.397Z" />
                        <path
                            d="M8.961 16a.93.93 0 0 0 .189-.019l3.4-.679a.961.961 0 0 0 .49-.263l6.118-6.117a2.884 2.884 0 0 0-4.079-4.078l-6.117 6.117a.96.96 0 0 0-.263.491l-.679 3.4A.961.961 0 0 0 8.961 16Zm7.477-9.8a.958.958 0 0 1 .68-.281.961.961 0 0 1 .682 1.644l-.315.315-1.36-1.36.313-.318Zm-5.911 5.911 4.236-4.236 1.359 1.359-4.236 4.237-1.7.339.341-1.699Z" />
                    </svg>
                    <span class="flex-1 ml-3 whitespace-nowrap">Regístrate</span>
                </a>
            </li>
        </ul>
    </div>
</div>
