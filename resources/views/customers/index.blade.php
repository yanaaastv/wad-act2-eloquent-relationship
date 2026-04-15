<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Customer Management') }}
            </h2>
            {{-- Button para sa Create Customer --}}
            <a href="{{ route('customers.create') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 transition ease-in-out duration-150">
                + Add New Customer
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Alert Message kapag may success --}}
            @if(session('success'))
                <div class="mb-6 bg-green-50 border-l-4 border-green-500 p-4 rounded-md shadow-sm">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-green-400" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-green-800">{{ session('success') }}</p>
                        </div>
                    </div>
                </div>
            @endif

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="overflow-x-auto">
                    {{-- Ginamit ko ang 'table-fixed' para siguradong pantay ang columns --}}
                    <table class="w-full text-left text-sm text-gray-600 dark:text-gray-300 table-fixed">
                        <thead class="bg-gray-50 dark:bg-gray-700 border-b border-gray-200 dark:border-gray-600 text-xs uppercase text-gray-500 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-4 font-semibold tracking-wider w-[15%]">Customer ID</th>
                                <th scope="col" class="px-6 py-4 font-semibold tracking-wider w-[35%]">Name</th>
                                <th scope="col" class="px-6 py-4 font-semibold tracking-wider w-[35%]">Email</th>
                                <th scope="col" class="px-6 py-4 font-semibold tracking-wider w-[15%] text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                            @foreach($customers as $customer)
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors duration-200">
                                {{-- FIX: Inayos ko ang ID dito para hindi na mag-duplicate --}}
                                <td class="px-6 py-4 whitespace-nowrap text-gray-400 font-mono">
                                    #{{ $customer->id }}
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap font-medium text-gray-900 dark:text-gray-100 truncate">
                                    {{ $customer->name }}
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap text-gray-600 dark:text-gray-400 truncate">
                                    {{ $customer->email }}
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap text-right">
                                    <div class="flex items-center justify-end gap-4">
                                        <a href="{{ route('customers.edit', $customer) }}" class="font-medium text-blue-600 dark:text-blue-400 hover:text-blue-900 dark:hover:text-blue-300 transition-colors">
                                            Edit
                                        </a>

                                        {{-- Delete button - Admin only protection --}}
                                        @if(auth()->user()->role === 'admin')
                                        <form action="{{ route('customers.destroy', $customer) }}" method="POST" class="m-0 p-0 inline-block">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="font-medium text-red-600 dark:text-red-400 hover:text-red-900 dark:hover:text-red-300 transition-colors" onclick="return confirm('Sigurado ka ba?')">
                                                Delete
                                            </button>
                                        </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
