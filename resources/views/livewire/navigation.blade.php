<div>
    <header class="bg-gradient-to-r from-blue-500 via-purple-500 to-pink-500">
        <x-container class="px-4 py-4">
            <div class="flex justify-between items-center  space-x-8 ">
                <button class="text-3xl">
                    <i class="fas fa-bars text-white"></i>
                </button>
                <h1 class="text-3xl font-bold text-white">
                    <a href="/" class="inline-flex flex-col items-end">
                        <span class="text-3xl font-bold leading-6 text-white">
                            Librería Libe
                        </span>
                        <span class="text-xs">
                            Tienda Online
                        </span>
                    </a>
                </h1>
                <div class=" flex items-center space-x-4 md:space-x-8">

                    <x-dropdown>

                        <x-slot name="trigger">

                            @auth
                                <button
                                    class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                                    <img class="h-8 w-8 rounded-full object-cover"
                                        src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                                </button>
                            @else
                                <button class="text-xl md:text-3xl">
                                    <i class="fas fa-user text-white"></i>
                                </button>
                            @endauth
                        </x-slot>
                        <x-slot name="content">
                            @guest
                                <div class="px-4 py-2">
                                    <div class="flex justify-center">
                                        <a href="{{ route('login') }}" class="btn btn-purple">
                                            Iniciar Sesion
                                        </a>
                                    </div>
                                    <div>
                                        <p class="text-sm text-center ">
                                            No tienes cuenta ?
                                            <a href="{{ route('register') }}" class="text-purple-600"
                                                hover:underline>Registrate</a>
                                        </p>
                                    </div>
                                </div>
                            @else
                                <x-dropdown-link :href="route('profile.show')">
                                    Mi perfil
                                </x-dropdown-link>
                                @role('admin')
                                    <x-dropdown-link :href="route('admin.dashboard')">
                                        Admin
                                    </x-dropdown-link>
                                @endrole
                                <div class="border-t border-gray-200">
                                    <form method="POST" action="{{ route('logout') }}" x-data>
                                        @csrf

                                        <x-dropdown-link href="{{ route('logout') }}" @click.prevent="$root.submit();">
                                            {{ __('Log Out') }}
                                        </x-dropdown-link>
                                    </form>
                                </div>
                            @endguest

                        </x-slot>

                    </x-dropdown>



                    <a href="{{ route('carrito.index') }}" class="relative">
                        <i class="fas fa-shopping-cart text-white"></i>
                        <span
                            class="absolute -top-1 -right-1 w-4 h-4 rounded-full bg-red-500 text-white text-xs flex justify-center items-center">
                            {{ Cart::instance('shopping')->count() }}
                        </span>
                    </a>
                </div>
            </div>
        </x-container>
    </header>
</div>

@push('js')
    <script>
        function search(value) {
            alert(value);
        }
    </script>
@endpush
