<nav class="bg-white border-b border-gray-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center space-x-2">
                    <img src="{{ asset('images/logo.jpg') }}" alt="Logo" class="h-8 w-8">
                    <span class="font-bold text-xl">POSYANDU SEROJA 3</span>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    @auth
                        @if(auth()->user()->role === 'kader')
                            <x-nav-link href="{{ route('kader.dashboard') }}" :active="request()->routeIs('kader.dashboard')">
                                Dashboard
                            </x-nav-link>
                            <x-nav-link href="{{ route('kader.tambah-user') }}">
                                Tambah User
                            </x-nav-link>
                            <x-nav-link href="{{ route('pendaftaran.create') }}">
                                Pendaftaran Posyandu
                            </x-nav-link>
                            <x-nav-link href="{{ route('kader.tambah-balita') }}">
                                Tambah Balita
                            </x-nav-link>
                            <x-nav-link href="{{ route('kegiatan.create') }}">
                                Input Kegiatan
                            </x-nav-link>
                            <x-nav-link href="{{ route('kader.laporan.kegiatan') }}">
                                Laporan Kegiatan
                            </x-nav-link>
                        @elseif(auth()->user()->role === 'orangtua')
                            <x-nav-link href="{{ route('orangtua.dashboard') }}" :active="request()->routeIs('orangtua.dashboard')">
                                Dashboard
                            </x-nav-link>
                            <x-nav-link href="{{ route('pendaftaran.create') }}">
                                Pendaftaran Posyandu
                            </x-nav-link>
                            <x-nav-link href="{{ route('orangtua.laporan') }}">
                                Laporan Balita Saya
                            </x-nav-link>
                        @endif
                    @endauth
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ml-6">
                @auth
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700">
                            <div>{{ auth()->user()->nama_ortu ?? 'Akun' }}</div>
                            <div class="ml-1">
                                <svg class="fill-current h-4 w-4" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                          d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 011.414 1.414L10 13.414l-4.707-4.707a1 1 0 010-1.414z"
                                          clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <!-- Profile -->
                        <x-dropdown-link href="{{ route('profile.edit') }}">
                            Profil
                        </x-dropdown-link>

                        <!-- Logout -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                Keluar
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
                @endauth
            </div>
        </div>
    </div>
</nav>
