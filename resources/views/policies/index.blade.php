<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Insurance Policy Management') }}
            </h2>

            {{-- ADMIN ONLY: ADD BUTTON --}}
            @if(auth()->user()->role === 'admin')
                <a href="{{ route('policies.create') }}"
                   class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    + Add Policy
                </a>
            @endif
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="mb-6 bg-green-50 border-l-4 border-green-500 p-4 rounded-md shadow-sm">
                    <div class="flex text-green-800 text-sm font-medium">
                        {{ session('success') }}
                    </div>
                </div>
            @endif

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm text-gray-600 dark:text-gray-300">
                        <thead class="bg-gray-50 dark:bg-gray-700 border-b border-gray-200 dark:border-gray-600 text-xs uppercase text-gray-500 dark:text-gray-400">
                            <tr>
                                <th class="px-6 py-4 font-semibold tracking-wider">Policy Number</th>
                                <th class="px-6 py-4 font-semibold tracking-wider">Coverage</th>
                                <th class="px-6 py-4 font-semibold tracking-wider text-center">Status</th>
                                <th class="px-6 py-4 font-semibold tracking-wider text-right">Actions</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                            @forelse($policies as $policy)
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors duration-200">

                                    <td class="px-6 py-4 whitespace-nowrap font-medium text-gray-900 dark:text-gray-100">
                                        {{ $policy->policy_number }}
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ $policy->start_date }} - {{ $policy->end_date }}
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap text-center">
                                        <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full
                                            {{ $policy->status === 'active' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                            {{ ucfirst($policy->status) }}
                                        </span>
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap text-right flex justify-end gap-4">

                                        {{-- ADMIN ONLY ACTIONS --}}
                                        @if(auth()->user()->role === 'admin')
                                            <a href="{{ route('policies.edit', $policy) }}"
                                               class="text-blue-600 dark:text-blue-400 hover:underline">
                                                Edit
                                            </a>

                                            <form action="{{ route('policies.destroy', $policy) }}" method="POST" class="inline">
                                                @csrf @method('DELETE')
                                                <button class="text-red-600 dark:text-red-400 hover:underline"
                                                        onclick="return confirm('Delete policy?')">
                                                    Delete
                                                </button>
                                            </form>
                                        @else
                                            <span class="text-gray-400 italic text-sm">View Only</span>
                                        @endif

                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center py-6 text-gray-500">
                                        No policies found.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>

                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
