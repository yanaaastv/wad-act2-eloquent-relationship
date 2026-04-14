<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            {{-- Form: Update Name & Email --}}
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            {{-- Form: Update Password --}}
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            {{-- Logic: Only show Delete Account if the user is NOT an admin --}}
            {{-- This satisfies Task 3: Hide restricted actions --}}
            @if(auth()->user()->role !== 'admin')
                <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                    <div class="max-w-xl">
                        @include('profile.partials.delete-user-form')
                    </div>
                </div>
            @else
                <div class="p-4 sm:p-8 bg-blue-50 dark:bg-gray-700 shadow sm:rounded-lg">
                    <p class="text-sm text-blue-600 dark:text-blue-400">
                        <b>Note:</b> Admin accounts cannot be deleted from this panel.
                    </p>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
