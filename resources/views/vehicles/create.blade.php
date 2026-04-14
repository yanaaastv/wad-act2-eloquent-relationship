<x-app-layout>
    <x-slot name="header"><h2 class="font-semibold text-xl text-gray-800">Add Vehicle</h2></x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 bg-white p-6 shadow sm:rounded-lg">
            <form action="{{ route('vehicles.store') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label class="block text-gray-700">Make:</label>
                    <input type="text" name="make" class="w-full border-gray-300 rounded-md shadow-sm" required>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700">Model:</label>
                    <input type="text" name="model" class="w-full border-gray-300 rounded-md shadow-sm" required>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700">Year:</label>
                    <input type="number" name="year" class="w-full border-gray-300 rounded-md shadow-sm" required>
                </div>
                <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">Save Vehicle</button>
            </form>
        </div>
    </div>
</x-app-layout>
