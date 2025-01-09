<x-app-layout>

    <div class="sm:ml-64 pt-[64px]">
        <div class="p-4 rounded-lg dark:border-gray-700">
            <div class="bg-white dark:bg-gray-900 rounded-lg shadow">
                <div class="p-4 mx-auto max-w-screen-xl text-center">
                    <div class="rounded-t-lg w-full h-96 overflow-hidden">
                        <img class="w-full h-full object-cover object-center"
                            src="{{ $product->image_url ? '/storage/' . $product->image_url : 'https://www.drawer.fr/95563-thickbox_default/meuble-tv-2-portes-bois-metal-l150cm-drawer-krokom.jpg' }}"
                            alt="" />
                    </div>
                    <h1
                        class="mb-4 text-4xl font-extrabold tracking-tight leading-none text-gray-900 md:text-5xl lg:text-6xl dark:text-white">
                        {{ $product->name }}</h1>
                    <p class="mb-4 text-lg font-normal text-gray-500 lg:text-xl sm:px-16 lg:px-48 dark:text-gray-400">
                        {{ $product->description }} </p>
                    <p class="mb-4">{{ $product->width }} x {{ $product->height }} x {{ $product->depth }} cm </p>
                    <div class="flex items-center justify-center mb-3">
                        @if ($product->category)
                            <span
                                class="bg-indigo-100 text-indigo-800 text-sm font-medium me-2 px-2.5 py-0.5 rounded dark:bg-indigo-900 dark:text-indigo-300">{{ $product->category->name }}</span>
                        @endif
                        @if ($product->in_stock == 0)
                            <span
                                class="bg-red-100 text-red-800 text-xs font-medium px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-red-300">
                                En rupture
                            </span>
                        @elseif ($product->in_stock == 1)
                            <span
                                class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">
                                En stock
                            </span>
                        @endif
                    </div>
                    <div class="flex items-center justify-center mb-3">
                        <span class="text-xl font-bold text-gray-900 dark:text-white">
                            {{ $product->price }} €</span>
                    </div>
                    <div class="flex flex-col space-y-4 sm:flex-row sm:justify-center sm:space-y-0">
                        <a href="{{ route('products.edit', $product->id) }}"
                            class="inline-flex justify-center items-center py-3 px-5 text-base font-medium text-center text-white rounded-lg bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 dark:focus:ring-blue-900">
                            Modifier
                            <svg class="w-3.5 h-3.5 ms-2 rtl:rotate-180" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9" />
                            </svg>
                        </a>
                        <a href="{{ route('products.index') }}"
                            class="py-3 px-5 sm:ms-4 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                            Retour
                        </a>
                    </div>
                </div>
            </div>
        </div>

</x-app-layout>
