<x-admin-layout>
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <div class="bg-gradient-to-r from-blue-500 via-purple-500 to-pink-500 rounded-lg shadow-lg p-6 text-white">
            <div class="flex items-center">
                <img class="h-12 w-12 rounded-full object-cover border-2 border-white"
                    src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                <div class="ml-4 flex-1">
                    <h2 class="text-lg font-semibold">
                        Bienvenido, {{ auth()->user()->name }}
                    </h2>
                    <form action="{{ route('logout') }}" method="POST" class="mt-2">
                        @csrf
                        <button
                            class="text-sm bg-white text-blue-600 px-3 py-1 rounded-lg font-semibold shadow hover:bg-gray-200 transition duration-300">
                            Cerrar sesión
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <div class="bg-gradient-to-r from-blue-500 via-purple-500 to-pink-500 rounded-lg shadow-lg p-6 text-white">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-3xl font-bold">
                    Librería Libe
                </h2>
                <svg class="w-10 h-10 text-white opacity-75" fill="none" stroke="currentColor" stroke-width="2"
                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 7h4l3 9l4-16h6m-7 9h6"></path>
                </svg>
            </div>
            <p class="mt-2 text-white opacity-90">
                Bienvenido a la Librería Libe. Explora nuestra amplia colección de libros y encuentra tu próxima lectura
                favorita.
            </p>
        </div>
    </div>
</x-admin-layout>
