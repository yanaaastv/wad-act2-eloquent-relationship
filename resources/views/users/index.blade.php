<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('User Management (Admin Only)') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <table class="min-w-full text-white">
                    <thead>
                        <tr class="border-b border-gray-700">
                            <th class="text-left p-2">Name</th>
                            <th class="text-left p-2">Email</th>
                            <th class="text-left p-2">Role</th>
                            <th class="text-right p-2">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                        <tr class="border-b border-gray-700">
                            <td class="p-2">{{ $user->name }}</td>
                            <td class="p-2">{{ $user->email }}</td>
                            <td class="p-2">
                                <span class="bg-gray-700 px-2 py-1 rounded text-xs">
                                    {{ $user->role }}
                                </span>
                            </td>
                            <td class="p-2 text-right">
                                {{-- Don't let Admin delete themselves in this list either --}}
                                @if($user->id !== auth()->id())
                                    <form action="{{ route('users.destroy', $user) }}" method="POST">
                                        @csrf @method('DELETE')
                                        <button class="text-red-500 hover:underline">Delete User</button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
