<div class="container mx-auto px-4 sm:px-8">
    <div class="py-8">
        <div class="flex justify-between">
            <h2 class="text-2xl font-semibold leading-tight">{{ $estudiante->nombreCompleto }}</h2>
            <p class="text-xl">Estás votando por el cargo de: </p>
        </div>
    </div>
</div>



<div class="flex flex-wrap justify-around">
    @foreach ($postulaciones as $postulante)
        <a href="#" id="miCuadro{{ $loop->index }}"
            class="miCuadro block max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 hover:shadow-lg transition-shadow duration-200 ease-in m-2">
            <div class="relative pb-5/6">
                <img class="p-8 rounded-t-lg"
                    src="{{ asset('storage/postulantes/' . $postulante->photo->imagenCandidato) }}"
                    alt="Imagen del candidato" />
            </div>
            <div class="p-5">
                <h5 class="text-2xl font-bold tracking-tight text-gray-900 dark:text-white mb-2">
                    NOMBRE: {{ $postulante->estudiante->nombreCompleto }}</h5>
                <h6 class="text-blue-800 text-lg font-semibold px-2.5 py-0.5 rounded dark:text-blue-800">
                    CURSO: {{ $postulante->estudiante->curso->nombreCurso }}
                </h6>
            </div>
        </a>
    @endforeach
    <a href="#" id="miCuadroBlanco"
        class="miCuadro block w-80 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 hover:shadow-lg transition-shadow duration-200 ease-in m-2">
        <div class="flex items-center justify-center h-full">
            <div class="text-center p-8">
                <h5 class="text-3xl font-bold tracking-tight text-gray-900 dark:text-white mb-2">
                    VOTO EN</h5>
                <h5 class="text-3xl font-bold tracking-tight text-gray-900 dark:text-white">
                    BLANCO</h5>
            </div>
        </div>
    </a>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $(".miCuadro").click(function() {
            $(".miCuadro").css("background-color", "white");
            $(this).css("background-color", "yellow");
        });
    });
</script>
