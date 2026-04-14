<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Edit Policy</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 shadow-sm sm:rounded-lg">
                <form action="{{ route('policies.update', $policy) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Policy Number:</label>
                        <input type="text" name="policy_number" value="{{ $policy->policy_number }}" class="w-full border-gray-300 rounded-md shadow-sm" required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Status:</label>
                        <select name="status" class="w-full border-gray-300 rounded-md shadow-sm">
                            <option value="active" {{ $policy->status == 'active' ? 'selected' : '' }}>Active</option>
                            <option value="pending" {{ $policy->status == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="expired" {{ $policy->status == 'expired' ? 'selected' : '' }}>Expired</option>
                        </select>
                    </div>

                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Update Policy
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
