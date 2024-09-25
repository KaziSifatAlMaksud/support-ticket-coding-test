<x-app-layout>
    <x-slot name="header">
         <a href="{{ route('customer.dashboard') }}" class="text-indigo-600 hover:text-indigo-900">Go Back Dashboard</a>
    </x-slot>

    <div class="py-12">
         @if (session('success'))
            <div class="bg-green-500 text-white p-4 rounded-md mb-4">
                {{ session('success') }}
            </div>
        @endif
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <!-- Issue Form -->
                    <h2 class="text-lg font-semibold mb-4">Submit a New Ticket</h2>
                      <form action="{{ route('submit_issue') }}" method="POST">
                            @csrf
                            <div class="grid grid-cols-1 gap-4 mb-6">
                                <div>
                                    <label for="issueTitle" class="block text-sm font-medium text-gray-700">Issue Title</label>
                                    <input type="text" id="issueTitle" name="issueTitle" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                </div>
                                <div>
                                    <label for="issueDetail" class="block text-sm font-medium text-gray-700">Issue Detail</label>
                                    <textarea id="issueDetail" name="issueDetail" rows="4" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"></textarea>
                                </div>
                                <div>
                                    <label for="date" class="block text-sm font-medium text-gray-700">Date</label>
                                    <input type="date" id="date" name="date" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                </div>
                            </div>
                            <div>
                                <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    Submit
                                </button>
                            </div>
                       </form>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
