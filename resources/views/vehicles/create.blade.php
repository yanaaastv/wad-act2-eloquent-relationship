<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Add New Vehicle
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">

                <form action="{{ route('vehicles.store') }}" method="POST" class="space-y-6">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        {{-- Customer Selection --}}
                        <div>
                            <x-input-label for="customer_id" :value="__('Customer Owner')" />
                            <select id="customer_id" name="customer_id" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 rounded-md shadow-sm" required>
                                <option value="" disabled selected>Select a Customer</option>
                                @foreach(\App\Models\Customer::all() as $customer)
                                    <option value="{{ $customer->id }}">{{ $customer->name }} (ID: {{ $customer->id }})</option>
                                @endforeach
                            </select>
                            <x-input-error class="mt-2" :messages="$errors->get('customer_id')" />
                        </div>

                        {{-- Plate Number --}}
                        <div>
                            <x-input-label for="plate_number" :value="__('Plate Number')" />
                            <x-text-input id="plate_number" name="plate_number" type="text" class="mt-1 block w-full" placeholder="ABC-1234" :value="old('plate_number')" required />
                            <x-input-error class="mt-2" :messages="$errors->get('plate_number')" />
                        </div>

                        {{-- Brand --}}
                        <div>
                            <x-input-label for="brand" :value="__('Brand')" />
                            <x-text-input id="brand" name="brand" type="text" class="mt-1 block w-full" placeholder="e.g. Toyota" :value="old('brand')" required />
                            <x-input-error class="mt-2" :messages="$errors->get('brand')" />
                        </div>

                        {{-- Model --}}
                        <div>
                            <x-input-label for="model" :value="__('Model')" />
                            <x-text-input id="model" name="model" type="text" class="mt-1 block w-full" placeholder="e.g. Vios" :value="old('model')" required />
                            <x-input-error class="mt-2" :messages="$errors->get('model')" />
                        </div>

                        {{-- Year --}}
                        <div>
                            <x-input-label for="year" :value="__('Year')" />
                            <x-text-input id="year" name="year" type="number" class="mt-1 block w-full" placeholder="2024" :value="old('year')" required />
                            <x-input-error class="mt-2" :messages="$errors->get('year')" />
                        </div>

                        {{-- Color --}}
                        <div>
                            <x-input-label for="color" :value="__('Color')" />
                            <x-text-input id="color" name="color" type="text" class="mt-1 block w-full" placeholder="e.g. White" :value="old('color')" required />
                            <x-input-error class="mt-2" :messages="$errors->get('color')" />
                        </div>
                    </div>

                    <div class="flex items-center gap-4 pt-4">
                        <x-primary-button>{{ __('Save Vehicle') }}</x-primary-button>
                        <a href="{{ route('vehicles.index') }}" class="text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 underline">
                            Cancel
                        </a>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
