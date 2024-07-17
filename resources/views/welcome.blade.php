<x-app-layout>
    <x-container>
        <h1 class="mt-8 text-2xl font-medium text-gray-900 dark:text-white">
            Últimos productos
        </h1>

        <input type="text" id="search" placeholder="Buscar productos..." 
               class="border rounded p-2 w-full" 
               oninput="fetchProductos()">

        <div id="search-results" class="absolute bg-white rounded shadow-lg mt-1 w-full z-10 hidden">
            <div id="results-container"></div>
            <div id="no-results" class="p-2 text-gray-500 hidden">No hay resultados</div>
        </div>

        <div class="mt-6 grid grid-cols-1 gap-y-10 gap-x-6 sm:grid-cols-2 lg:grid-cols-4 xl:gap-x-8">
            @foreach ($lastProductos as $producto)
                <article class="bg-white shadow rounded overflow-hidden">
                    <img src="{{ $producto->image }}" class="w-full h-48 object-cover object-center" alt="">
                    <div class="p-4">
                        <h1 class="text-lg font-bold text-gray-900 line-clamp-2 min-h-[4rem]">
                            {{ $producto->nombre }}
                        </h1>
                        <p class="text-sm text-gray-600 line-clamp-1">
                            Bs/{{ $producto->precio }}
                        </p>
                        <a href="{{ route('productos.show', $producto) }}" 
                           class="btn btn-purple mt-4 block w-full">
                            Ver más
                        </a>
                    </div>
                </article>
            @endforeach
        </div>
        <div class="mt-6">
            {{ $lastProductos->links() }}
        </div>
    </x-container>
</x-app-layout>

<script>
    let timer = null; // Variable para controlar el retardo en la búsqueda

    function fetchProductos() {
        const query = document.getElementById('search').value.trim(); // Trim para eliminar espacios al inicio y final

        // Si la consulta está vacía, ocultar resultados y salir
        if (query === '') {
            document.getElementById('search-results').classList.add('hidden');
            return;
        }

        // Limpiar el timer anterior si existe para evitar múltiples búsquedas simultáneas
        if (timer) {
            clearTimeout(timer);
        }

        // Retrasar la búsqueda por 300ms después de que el usuario deje de escribir
        timer = setTimeout(() => {
            fetch(`/api/productos?query=${query}`)
                .then(response => response.json())
                .then(data => {
                    const resultsContainer = document.getElementById('results-container');
                    const noResults = document.getElementById('no-results');
                    resultsContainer.innerHTML = '';
                    noResults.classList.add('hidden');

                    if (data.length > 0) {
                        data.forEach(producto => {
                            const div = document.createElement('div');
                            div.className = 'p-2 cursor-pointer hover:bg-gray-100';
                            div.onclick = () => window.location = `/productos/${producto.id}`;
                            div.innerText = producto.nombre;
                            resultsContainer.appendChild(div);
                        });
                        document.getElementById('search-results').classList.remove('hidden');
                    } else {
                        noResults.classList.remove('hidden');
                        document.getElementById('search-results').classList.remove('hidden');
                    }
                });
        }, 300); // 300ms de retardo después de que el usuario deje de escribir
    }

    // Ocultar los resultados cuando se hace clic fuera del contenedor de búsqueda
    document.addEventListener('click', function(event) {
        const searchResults = document.getElementById('search-results');
        if (event.target !== searchResults && !searchResults.contains(event.target)) {
            searchResults.classList.add('hidden');
        }
    });
</script>
