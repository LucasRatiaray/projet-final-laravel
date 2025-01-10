<x-app-layout>
    <div class="sm:ml-64 pt-[64px] min-h-screen">
        <div class="p-4 rounded-lg dark:border-gray-700 py-12">
            <form class="max-w-lg mx-auto" action="{{ route('categories.store') }}" method="POST">
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

                <h1 class="text-2xl font-bold mb-6">Créer une catégorie</h1>

                <div class="mb-5">
                    <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nom de la catégorie</label>
                    <input type="text" id="name" name="name"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Nom de la catégorie" required>
                </div>

                <div class="mt-6 flex space-x-4">
                    <button type="submit"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        Valider
                    </button>
                    <a href="{{ route('categories.index') }}"
                        class="py-3 px-5 sm:ms-4 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                        Retour
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
