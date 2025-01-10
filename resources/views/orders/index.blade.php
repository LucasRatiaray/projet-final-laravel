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
                <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Commandes ({{ $count }})</h1>
                <a href="{{ route('orders.create') }}"
                    class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 fixed right-4">
                    Créer
                </a>
            </div>


            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                #
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Nom client
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Email client
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Tel. client
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Adresse
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Statut
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Date
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Total
                            </th>
                            <th scope="col" class="px-6 py-3">
                                <span class="sr-only">Edit</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $o)
                            <tr
                                class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                <th scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $o->id }}
                                </th>
                                <td class="px-6 py-4">
                                    {{ $o->customer_name }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $o->customer_email }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $o->customer_phone }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $o->customer_address }}
                                </td>
                                <td class="px-6 py-4">
                                    @if ($o->status === 'pending')
                                        <span
                                            class="bg-green-100 text-green-800 me-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">{{ $o->status }}</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    {{ $o->created_at->format('d/m/Y') }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $o->total_price }} €
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <a href="{{ route('orders.show', $o->id) }}"
                                        class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Voir</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>

</x-app-layout>


<script type="text/javascript">
    setTimeout(() => {
        document.getElementById('message-flash').remove();
    }, 3000);
</script>
