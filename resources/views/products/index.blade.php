<x-app-layout>

    @session('success')
        <div id="message-flash"
            class="p-4 mb-4 text-md text-white rounded-lg bg-green-500 dark:bg-green-500 dark:text-white fixed top-[70px] right-24"
            role="alert">
            <span class="font-medium">{{ session('success') }}</span>
        </div>
    @endsession

    <div class="sm:ml-64 pt-[64px]">
        <div class="p-4 rounded-lg dark:border-gray-700">
            <div class="flex items-center justify-between mb-4">
                <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Produits ({{ $count }})</h1>
                <a href="{{ route('products.create') }}"
                    class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 fixed right-4">
                    Créer
                </a>
            </div>
            <div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-3">
                @foreach ($products as $p)
                    <div
                        class="max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                        <a href="{{ route('products.show', $p->id) }}">
                            <div class="rounded-t-lg w-full h-56 overflow-hidden">
                                <img class="w-full h-full object-cover object-center"
                                    src="{{ $p->image_url ? '/storage/' . $p->image_url : 'https://www.drawer.fr/95563-thickbox_default/meuble-tv-2-portes-bois-metal-l150cm-drawer-krokom.jpg' }}"
                                    alt="" />
                            </div>
                        </a>
                        <div class="p-5">
                            <a href="{{ route('products.show', $p->id) }}">
                                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                                    {{ $p->name }}
                                </h5>
                            </a>
                            <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">
                                {{ Str::limit($p->description, 30, '...') }}
                            </p>

                            <div class="flex items-center justify-between mb-3">
                                <span class="text-xl font-bold text-gray-900 dark:text-white">
                                    {{ number_format($p->price, 2) }} €
                                </span>
                                <div class="flex gap-2">
                                    @if ($p->category)
                                        <span
                                            class="bg-indigo-100 text-indigo-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-indigo-900 dark:text-indigo-300">
                                            {{ $p->category->name }}
                                        </span>
                                    @endif
                                    @if ($p->in_stock == 0)
                                        <span
                                            class="bg-red-100 text-red-800 text-xs font-medium px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-red-300">
                                            En rupture
                                        </span>
                                    @elseif ($p->in_stock == 1)
                                        <span
                                            class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">
                                            En stock
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="flex items-center justify-between">
                                <a href="{{ route('products.show', $p->id) }}"
                                    class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                    Voir plus
                                    <svg class="rtl:rotate-180 w-3.5 h-3.5 ml-2" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9" />
                                    </svg>
                                </a>
                                <form method="POST"
                                    action="{{ route('products.destroy', $p->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"><svg xmlns="http://www.w3.org/2000/svg"
                                            class="w-4 h-4 text-red-600" viewBox="0 0 16 16">
                                            <path fill="currentColor"
                                                d="M2 5v10c0 .55.45 1 1 1h9c.55 0 1-.45 1-1V5zm3 9H4V7h1zm2 0H6V7h1zm2 0H8V7h1zm2 0h-1V7h1zm2.25-12H10V.75A.753.753 0 0 0 9.25 0h-3.5A.753.753 0 0 0 5 .75V2H1.75a.75.75 0 0 0-.75.75V4h13V2.75a.75.75 0 0 0-.75-.75M9 2H6v-.987h3z" />
                                        </svg></button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

</x-app-layout>


<script type="text/javascript">
    setTimeout(() => {
        document.getElementById('message-flash').remove();
    }, 3000);
</script>
