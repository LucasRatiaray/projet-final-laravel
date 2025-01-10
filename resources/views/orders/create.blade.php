<x-app-layout>

    <div class="sm:ml-64 pt-[64px] min-h-screen">
        <div class="p-4 rounded-lg dark:border-gray-700 py-12">
            <form class="max-w-lg mx-auto" action="{{ route('orders.store') }}" method="POST">
                @csrf

                @if ($errors->any())
                    <div class="bg-red-100 text-red-700 px-4 py-3 rounded-lg mb-4">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <h1 class="text-2xl font-bold mb-6">Créer une commande</h1>

                <div class="mb-5">
                    <label for="customer_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nom du client</label>
                    <input type="text" id="customer_name" name="customer_name"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="John Doe"
                        required>
                </div>

                <div class="mb-5">
                    <label for="customer_email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email du client</label>
                    <input type="email" id="customer_email" name="customer_email"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="john@example.com"
                        required>
                </div>

                <div class="mb-5">
                    <label for="customer_phone" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Téléphone du client</label>
                    <input type="text" id="customer_phone" name="customer_phone"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="0123456789"
                        required>
                </div>

                <div class="mb-5">
                    <label for="customer_address" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Adresse du client</label>
                    <input type="text" id="customer_address" name="customer_address"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="123 rue de Paris"
                        required>
                </div>

                <h2 class="text-xl font-semibold mb-4">Produits</h2>
                <div id="products" class="space-y-4">
                    <div class="product flex items-center space-x-4">
                        <div class="flex-1">
                            <label for="product_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Produit</label>
                            <select name="products[0][id]"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                required>
                                <option value="" disabled selected>Sélectionner un produit</option>
                                @foreach($products as $product)
                                    <option value="{{ $product->id }}">{{ $product->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="flex-1">
                            <label for="quantity" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Quantité</label>
                            <input type="number" name="products[0][quantity]"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="8"
                                required>
                        </div>
                    </div>
                </div>

                <button type="button" onclick="addProduct()"
                    class="mt-4 px-4 py-2 bg-gray-100 border border-gray-300 rounded-lg text-sm text-gray-900 hover:text-blue-700 hover:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-700">
                    Ajouter un produit
                </button>

                <div class="mt-6 flex space-x-4">
                    <button type="submit"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        Valider
                    </button>
                    <a href="{{ route('orders.index') }}"
                        class="py-3 px-5 sm:ms-4 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                        Retour
                    </a>
                </div>
            </form>
        </div>
    </div>

</x-app-layout>

<script>
    let productIndex = 1;

    function addProduct() {
        const productsDiv = document.getElementById('products');
        const newProduct = document.createElement('div');
        newProduct.classList.add('product', 'flex', 'items-center', 'space-x-4', 'mt-4');
        newProduct.innerHTML = `
            <div class="flex-1">
                <label for="product_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Produit</label>
                <select name="products[${productIndex}][id]"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    required>
                    <option value="" disabled selected>Sélectionner un produit</option>
                    @foreach($products as $product)
                        <option value="{{ $product->id }}">{{ $product->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="flex-1">
                <label for="quantity" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Quantité</label>
                <input type="number" name="products[${productIndex}][quantity]"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="8"
                    required>
            </div>
        `;
        productsDiv.appendChild(newProduct);
        productIndex++;
    }
</script>
