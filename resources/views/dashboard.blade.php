<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ auth()->user()->role === 'admin' ? 'System Overview' : 'My Insurance Summary' }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- STATS SECTION --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">

                @if(auth()->user()->role === 'admin')

                    {{-- ADMIN VIEW --}}
                    <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-sm border-l-4 border-blue-500">
                        <p class="text-sm text-gray-500 dark:text-gray-400 uppercase">Total Customers</p>
                        <p class="text-3xl font-bold">{{ \App\Models\Customer::count() }}</p>
                    </div>

                    <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-sm border-l-4 border-green-500">
                        <p class="text-sm text-gray-500 dark:text-gray-400 uppercase">Total Vehicles</p>
                        <p class="text-3xl font-bold">{{ \App\Models\Vehicle::count() }}</p>
                    </div>

                    <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-sm border-l-4 border-purple-500">
                        <p class="text-sm text-gray-500 dark:text-gray-400 uppercase">Total Policies</p>
                        <p class="text-3xl font-bold">{{ \App\Models\Policy::count() }}</p>
                    </div>

                    <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-sm border-l-4 border-red-500">
                        <p class="text-sm text-gray-500 dark:text-gray-400 uppercase">Registered Users</p>
                        <p class="text-3xl font-bold">{{ \App\Models\User::count() }}</p>
                    </div>

                @else

                    {{-- USER VIEW --}}
                    @php
                        $customer = auth()->user()->customer;
                    @endphp

                    <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-sm border-l-4 border-blue-500 lg:col-span-2">
                        <p class="text-sm text-gray-500 dark:text-gray-400 uppercase">My Registered Vehicles</p>
                        <p class="text-3xl font-bold">
                            {{ $customer ? $customer->vehicles->count() : 0 }}
                        </p>
                    </div>

                    <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-sm border-l-4 border-purple-500 lg:col-span-2">
                        <p class="text-sm text-gray-500 dark:text-gray-400 uppercase">My Active Policies</p>
                        <p class="text-3xl font-bold">
                            {{ $customer ? $customer->policies->count() : 0 }}
                        </p>
                    </div>

                @endif
            </div>

            {{-- CONTENT CARD --}}
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">

                    <h3 class="text-lg font-bold mb-4">
                        {{ auth()->user()->role === 'admin' ? 'Recent Policies Issued' : 'Current Insurance Status' }}
                    </h3>

                    <div class="border-t border-gray-100 dark:border-gray-700 pt-4">

                        @if(auth()->user()->role === 'admin')

                            <ul class="divide-y divide-gray-100 dark:divide-gray-700">
                                @forelse(\App\Models\Policy::latest()->take(5)->get() as $policy)
                                    <li class="py-3 flex justify-between">
                                        <span class="text-gray-600">{{ $policy->policy_number }}</span>
                                        <span class="font-medium">
                                            {{ $policy->customer ? $policy->customer->name : 'No Customer' }}
                                        </span>
                                    </li>
                                @empty
                                    <p class="text-sm text-gray-500 text-center py-4">
                                        No recent policies found.
                                    </p>
                                @endforelse
                            </ul>

                        @else

                            <div class="text-gray-600 dark:text-gray-400">
                                <p>Welcome back, <strong>{{ auth()->user()->name }}</strong>!</p>
                                <p class="mt-2 text-sm">
                                    You can manage your vehicles and view your policies using the navigation menu.
                                </p>

                                <div class="mt-6">
                                    <a href="{{ route('policies.index') }}"
                                       class="text-indigo-600 hover:underline font-medium">
                                        View my policies →
                                    </a>
                                </div>
                            </div>

                        @endif

                    </div>

                </div>
            </div>

        </div>
    </div>
</x-app-layout>
