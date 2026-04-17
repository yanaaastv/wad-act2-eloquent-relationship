<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Vehicle Management') }}
            </h2>
            <a href="{{ route('vehicles.create') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 transition">
                + Add Vehicle
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm text-gray-600 dark:text-gray-300 table-fixed">
                        <thead class="bg-gray-50 dark:bg-gray-700 border-b border-gray-200 dark:border-gray-600 text-xs uppercase text-gray-500 dark:text-gray-400">
                            <tr>
                                <th class="px-6 py-4 font-semibold tracking-wider w-[12%]">Customer ID</th>
                                <th class="px-6 py-4 font-semibold tracking-wider w-[18%]">Plate Number</th>
                                <th class="px-6 py-4 font-semibold tracking-wider w-[15%]">Model</th>
                                <th class="px-6 py-4 font-semibold tracking-wider w-[15%]">Brand</th>
                                <th class="px-6 py-4 font-semibold tracking-wider w-[10%]">Year</th>
                                <th class="px-6 py-4 font-semibold tracking-wider w-[15%]">Color</th>
                                <th class="px-6 py-4 font-semibold tracking-wider w-[15%] text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                            @foreach($vehicles as $vehicle)
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50 transition">
                                <td class="px-6 py-4 font-medium text-gray-900 dark:text-gray-100 italic">
                                    #{{ $vehicle->customer_id }}
                                </td>
                                <td class="px-6 py-4 font-bold text-indigo-600 dark:text-indigo-400 font-mono">
                                    {{ $vehicle->plate_number }}
                                </td>
                                <td class="px-6 py-4 truncate">{{ $vehicle->model }}</td>
                                <td class="px-6 py-4 truncate">{{ $vehicle->brand }}</td>
                                <td class="px-6 py-4 font-mono">{{ $vehicle->year }}</td>
                                <td class="px-6 py-4">
                                    <span class="inline-block px-2 py-1 rounded border border-gray-500 text-[10px] leading-tight font-semibold">
                                        {{ strtoupper($vehicle->color) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <div class="flex justify-end items-center gap-4">
                                        <a href="{{ route('vehicles.edit', $vehicle) }}" class="font-medium text-blue-600 dark:text-blue-400 hover:underline">
                                            Edit
                                        </a>

                                        @if(auth()->user()->role === 'admin')
                                        <form action="{{ route('vehicles.destroy', $vehicle) }}" method="POST" class="m-0 inline-block">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="font-medium text-red-600 dark:text-red-400 hover:underline" onclick="return confirm('Sigurado ka ba?')">
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
