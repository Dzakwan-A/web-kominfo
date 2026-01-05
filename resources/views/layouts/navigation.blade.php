<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    @php
        $role = Auth::user()?->role;

        $dashboardHref = match ($role) {
            'admin' => route('admin.dashboard'),
            'penulis' => route('writer.dashboard'),
            default => route('dashboard'),
        };

        $dashboardActive = request()->routeIs('dashboard')
            || request()->routeIs('admin.*')
            || request()->routeIs('writer.*');
    @endphp

    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('home') }}" aria-label="Home">
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex items-center">

                    <x-nav-link :href="$dashboardHref" :active="$dashboardActive">
                        {{ __('Dashboard') }}
                    </x-nav-link>

                    <x-nav-link :href="route('home')" :active="request()->routeIs('home')">
                        Home
                    </x-nav-link>

                   @if($role === 'admin')
    <x-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')">
        Admin
    </x-nav-link>

    <x-nav-link :href="route('admin.users.index')" :active="request()->routeIs('admin.users.*')">
        Users
    </x-nav-link>
                    @elseif($role === 'penulis')
                        <x-nav-link :href="route('writer.dashboard')" :active="request()->routeIs('writer.*')">
                            Penulis
                        </x-nav-link>
                    @endif

                </div>
            </div>

            <!-- Right side: Logout -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="inline-flex items-center px-4 py-2 rounded-full border text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 transition">
                        Keluar
                    </button>
                </form>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="$dashboardHref" :active="$dashboardActive">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('home')" :active="request()->routeIs('home')">
                Home
            </x-responsive-nav-link>

          @if($role === 'admin')
    <x-responsive-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')">
        Admin
    </x-responsive-nav-link>

    <x-responsive-nav-link :href="route('admin.users.index')" :active="request()->routeIs('admin.users.*')">
        Users
    </x-responsive-nav-link>
            @elseif($role === 'penulis')
                <x-responsive-nav-link :href="route('writer.dashboard')" :active="request()->routeIs('writer.*')">
                    Penulis
                </x-responsive-nav-link>
            @endif
        </div>

        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="mt-3 space-y-1">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')"
                        onclick="event.preventDefault(); this.closest('form').submit();">
                        Keluar
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
