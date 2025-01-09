<nav x-data="{ open: false }" class="bg-indigo-800 dark:bg-gray-800 border-b border-gray-100 fixed w-full z-10">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <x-application-logo class="block h-10 w-auto fill-current text-gray-300" />
                    </a>
                </div>

                <!-- Navigation Links -->
                {{-- <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Dashboard') }}
                    </x-nav-link>
                </div> --}}
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button
                            class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-700 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                            <div>{{ Auth::user()->name }}</div>

                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open"
                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                        onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>

<button data-drawer-target="default-sidebar" data-drawer-toggle="default-sidebar" aria-controls="default-sidebar"
    type="button"
    class="inline-flex items-center p-2 mt-2 ms-3 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
    <span class="sr-only">Open sidebar</span>
    <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
        <path clip-rule="evenodd" fill-rule="evenodd"
            d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z">
        </path>
    </svg>
</button>

<aside id="default-sidebar"
    class="fixed top-[64px] left-0 z-40 w-64 h-screen transition-transform -translate-x-full sm:translate-x-0"
    aria-label="Sidebar">
    <div class="h-full px-3 py-4 overflow-y-auto bg-indigo-500 dark:bg-gray-800">
        <ul class="space-y-2 font-medium">
            <li>
                <a href="{{ route('dashboard') }}"
                    class="flex items-center p-2 rounded-lg group {{ request()->routeIs('dashboard') ? 'text-gray-900 bg-gray-100 dark:bg-gray-700' : 'text-white dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 hover:text-gray-900' }}">
                    <svg class="w-5 h-5 transition duration-75 {{ request()->routeIs('dashboard') ? 'text-gray-900 group-hover:text-gray-900 dark:text-white' : 'text-white dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white' }}"
                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 21">
                        <path
                            d="M16.975 11H10V4.025a1 1 0 0 0-1.066-.998 8.5 8.5 0 1 0 9.039 9.039.999.999 0 0 0-1-1.066h.002Z" />
                        <path
                            d="M12.5 0c-.157 0-.311.01-.565.027A1 1 0 0 0 11 1.02V10h8.975a1 1 0 0 0 1-.935c.013-.188.028-.374.028-.565A8.51 8.51 0 0 0 12.5 0Z" />
                    </svg>
                    <span class="ms-3">{{ __('Dashboard') }}</span>
                </a>
            </li>
            <li>
                <a href="{{ route('products.index') }}"
                class="flex items-center p-2 rounded-lg group {{ request()->routeIs('products.index') ? 'text-gray-900 bg-gray-100 dark:bg-gray-700' : 'text-white dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 hover:text-gray-900' }}">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="w-5 h-5 transition duration-75 {{ request()->routeIs('products.index') ? 'text-gray-900 group-hover:text-gray-900 dark:text-white' : 'text-white dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white' }}"
                        viewBox="0 0 50 50">
                        <path fill="currentColor"
                            d="M46.495 11H3.521c-1.382 0-2.513 1.257-2.513 2.5s1.131 2.499 2.513 2.499h.607v5h41.821v-5h.546c1.383 0 2.513-1.256 2.513-2.499s-1.13-2.5-2.513-2.5m-21.487 7.52c-.694 0-1.256-.579-1.256-1.292s.562-1.292 1.256-1.292c.695 0 1.256.579 1.256 1.292s-.561 1.292-1.256 1.292M4.128 30.998h41.821V23H4.128zm20.88-5.374c.695 0 1.256.578 1.256 1.291c0 .714-.561 1.292-1.256 1.292c-.694 0-1.256-.578-1.256-1.292c-.001-.713.562-1.291 1.256-1.291M4.128 37.895v5.814c0 .71.089 1.292.78 1.292h5.024c.691 0 1.004-.582 1.004-1.292v-3.71h28.205v3.71c0 .71.252 1.292.942 1.292h5.025c.689 0 .84-.582.84-1.292V33H4.128zm20.88-2.583c.695 0 1.256.579 1.256 1.291c0 .715-.561 1.291-1.256 1.291c-.694 0-1.256-.576-1.256-1.291c-.001-.711.562-1.291 1.256-1.291" />
                    </svg>
                    <span class="flex-1 ms-3 whitespace-nowrap">Furnitures</span>
                </a>
            </li>
            <li>
                <a href="{{ route('orders.index') }}"
                class="flex items-center p-2 rounded-lg group {{ request()->routeIs('orders.index') ? 'text-gray-900 bg-gray-100 dark:bg-gray-700' : 'text-white dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 hover:text-gray-900' }}">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="w-5 h-5 transition duration-75 {{ request()->routeIs('orders.index') ? 'text-gray-900 group-hover:text-gray-900 dark:text-white' : 'text-white dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white' }}"
                        viewBox="0 0 24 24">
                        <path fill="currentColor"
                            d="M17 18c-1.11 0-2 .89-2 2a2 2 0 0 0 2 2a2 2 0 0 0 2-2a2 2 0 0 0-2-2M1 2v2h2l3.6 7.59l-1.36 2.45c-.15.28-.24.61-.24.96a2 2 0 0 0 2 2h12v-2H7.42a.25.25 0 0 1-.25-.25q0-.075.03-.12L8.1 13h7.45c.75 0 1.41-.42 1.75-1.03l3.58-6.47c.07-.16.12-.33.12-.5a1 1 0 0 0-1-1H5.21l-.94-2M7 18c-1.11 0-2 .89-2 2a2 2 0 0 0 2 2a2 2 0 0 0 2-2a2 2 0 0 0-2-2" />
                    </svg>
                    <span class="flex-1 ms-3 whitespace-nowrap">Orders</span>
                </a>
            </li>
            <li>
                <a href="#"
                class="flex items-center p-2 rounded-lg group {{ request()->routeIs('products.index') ? 'text-gray-900 bg-gray-100 dark:bg-gray-700' : 'text-white dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 hover:text-gray-900' }}">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="w-5 h-5 transition duration-75 {{ request()->routeIs('products.index') ? 'text-gray-900 group-hover:text-gray-900 dark:text-white' : 'text-white dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white' }}"
                        viewBox="0 0 24 24">
                        <path fill="currentColor" fill-rule="evenodd"
                            d="M17 3a4 4 0 1 0 0 8a4 4 0 0 0 0-8M3 17a4 4 0 1 1 8 0a4 4 0 0 1-8 0m10-3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v5a2 2 0 0 1-2 2h-4a2 2 0 0 1-2-2zM3 4a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v5a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"
                            clip-rule="evenodd" />
                    </svg>
                    <span class="flex-1 ms-3 whitespace-nowrap">Categories</span>
                </a>
            </li>
            <li>
                <a href="#"
                class="flex items-center p-2 rounded-lg group {{ request()->routeIs('products.index') ? 'text-gray-900 bg-gray-100 dark:bg-gray-700' : 'text-white dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 hover:text-gray-900' }}">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="w-5 h-5 transition duration-75 {{ request()->routeIs('products.index') ? 'text-gray-900 group-hover:text-gray-900 dark:text-white' : 'text-white dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white' }}"
                        viewBox="0 0 24 24">
                        <path fill="currentColor" d="M18 8a2 2 0 1 1-4 0a2 2 0 0 1 4 0" />
                        <path fill="currentColor" fill-rule="evenodd"
                            d="M11.943 1.25h.114c2.309 0 4.118 0 5.53.19c1.444.194 2.584.6 3.479 1.494c.895.895 1.3 2.035 1.494 3.48c.19 1.411.19 3.22.19 5.529v.088c0 1.909 0 3.471-.104 4.743c-.104 1.28-.317 2.347-.795 3.235q-.314.586-.785 1.057c-.895.895-2.035 1.3-3.48 1.494c-1.411.19-3.22.19-5.529.19h-.114c-2.309 0-4.118 0-5.53-.19c-1.444-.194-2.584-.6-3.479-1.494c-.793-.793-1.203-1.78-1.42-3.006c-.215-1.203-.254-2.7-.262-4.558Q1.25 12.792 1.25 12v-.058c0-2.309 0-4.118.19-5.53c.194-1.444.6-2.584 1.494-3.479c.895-.895 2.035-1.3 3.48-1.494c1.411-.19 3.22-.19 5.529-.19m-5.33 1.676c-1.278.172-2.049.5-2.618 1.069c-.57.57-.897 1.34-1.069 2.619c-.174 1.3-.176 3.008-.176 5.386v.844l1.001-.876a2.3 2.3 0 0 1 3.141.104l4.29 4.29a2 2 0 0 0 2.564.222l.298-.21a3 3 0 0 1 3.732.225l2.83 2.547c.286-.598.455-1.384.545-2.493c.098-1.205.099-2.707.099-4.653c0-2.378-.002-4.086-.176-5.386c-.172-1.279-.5-2.05-1.069-2.62c-.57-.569-1.34-.896-2.619-1.068c-1.3-.174-3.008-.176-5.386-.176s-4.086.002-5.386.176"
                            clip-rule="evenodd" />
                    </svg>

                    <span class="flex-1 ms-3 whitespace-nowrap">Gallery</span>
                </a>
            </li>
        </ul>
    </div>
</aside>
