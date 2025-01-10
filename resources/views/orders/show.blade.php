<x-app-layout>

    <div class="sm:ml-64 pt-[64px]">
        <div class="p-4 rounded-lg dark:border-gray-700">
            <div class="flex items-center justify-between mb-4">
                <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Produits de la commande :
                    #{{ $order->id }}</h1>
                <p class="text-sm text-gray-500 dark:text-gray-400">Total de produits : {{ $count }}</p>
            </div>

            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">#</th>
                            <th scope="col" class="px-6 py-3">Nom</th>
                            <th scope="col" class="px-6 py-3">Prix</th>
                            <th scope="col" class="px-6 py-3">En Stock</th>
                            <th scope="col" class="px-6 py-3">Dimensions (L x H x P)</th>
                            <th scope="col" class="px-6 py-3">Catégorie</th>
                            <th scope="col" class="px-6 py-3">Image</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                            <tr onclick="window.location='{{ route('products.show', $product->id) }}'"
                                class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 hover:cursor-pointer">
                                <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $product->id }}</td>
                                <td class="px-6 py-4">{{ $product->name }}</td>
                                <td class="px-6 py-4">{{ $product->price }} €</td>
                                <td class="px-6 py-4">
                                    @if ($product->in_stock === 0)
                                        <span
                                            class="bg-red-100 text-red-800 me-2 px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-red-300">Non</span>
                                    @elseif ($product->in_stock === 1)
                                        <span
                                            class="bg-green-100 text-green-800 me-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">Oui</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4">{{ $product->width }} x {{ $product->height }} x
                                    {{ $product->depth }}</td>
                                @if ($product->category_id)
                                    <td class="px-6 py-4"> <span
                                            class="bg-indigo-100 text-indigo-800 me-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">{{ $product->category->name }}</span>
                                    </td>
                                @else
                                    <td class="px-6 py-4"> <span
                                            class="bg-red-100 text-red-800 me-2 px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-red-300">Non
                                            défini</span>
                                    </td>
                                @endif
                                <td class="px-6 py-4">
                                    @if ($product->image_url)
                                        <img src="{{ Storage::url($product->image_url) }}" alt="{{ $product->name }}"
                                            class="w-16 h-16 object-cover rounded-md">
                                    @else
                                        <span class="text-gray-500 dark:text-gray-400">Pas d'image</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <form class="flex items-center px-4 gap-4" method="POST" action="{{ route('orders.update', $order->id) }}">
            @csrf
            @method('PUT')
            <div class="mb-5 flex flex-col">
                <label for="status" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Statut de la
                    commande</label>
                <select id="status" name="status"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <!-- Option actuelle comme sélectionnée -->
                    <option value="{{ $order->status }}" selected>{{ ucfirst($order->status) }}</option>

                    <!-- Autres options disponibles -->
                    @if ($order->status !== 'pending')
                        <option value="pending">Pending</option>
                    @endif
                    @if ($order->status !== 'delivered')
                        <option value="delivered">Delivered</option>
                    @endif
                    @if ($order->status !== 'shipped')
                        <option value="shipped">Shipped</option>
                    @endif
                    @if ($order->status !== 'cancelled')
                        <option value="cancelled">Cancelled</option>
                    @endif
                    <!-- Ajoutez d'autres statuts si nécessaire -->
                </select>
            </div>
            <button type="submit"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                Mettre à jour
            </button>
        </form>

        <div class="flex items-center px-4 gap-4">
            <a href="{{ route('orders.index') }}"
                class="py-3 px-5  text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                Retour
            </a>
            <form method="POST" action="{{ route('orders.destroy', $order->id) }}">
                @csrf
                @method('DELETE')
                <button type="submit" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette catégorie ?')"
                    class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">Supprimer</button>
            </form>
        </div>
    </div>

</x-app-layout>
