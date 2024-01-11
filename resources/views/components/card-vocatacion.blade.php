<div class="container mx-auto px-4 sm:px-8">
    <div class="py-8">
        <div class="flex justify-between">
            <h2 class="text-2xl font-semibold leading-tight">{{ $estudiante->nombreCompleto }}</h2>
            @foreach ($cargos as $cargo)
            @endforeach
            <p class="text-xl">Estás votando por el cargo de:</p>
        </div>
    </div>
</div>



@foreach ($postulantes as $postulante)
    <div class="w-full max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
        <a href="#">
            <img class="p-8 rounded-t-lg" src="/docs/images/products/apple-watch.png" alt="product image" />
        </a>
        <div class="px-5 pb-5">
            <a href="#">
                <h5 class="text-xl font-semibold tracking-tight text-gray-900 dark:text-white">
                    {{ $postulante->nombreCompleto }}</h5>
            </a>
            <div class="flex items-center mt-2.5 mb-5">
                <span
                    class="bg-blue-100 text-blue-800 text-xs font-semibold px-2.5 py-0.5 rounded dark:bg-blue-200 dark:text-blue-800 ms-3">GRADO:
                    {{ $postulante->grado }}</span>
            </div>
        </div>
    </div>
@endforeach
