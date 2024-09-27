<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
           <a href="{{ route('admin.dashboard') }}" class="text-indigo-600 hover:text-indigo-900">Go Back Admin Dashboard</a>
        </h2>
    </x-slot>

            
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mb-4">

                <div class="flex justify-end">
                <a href="{{ route('stop_ticket', ['id' => $ticket->id]) }}" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 my-4 rounded inline-block">
                    Stop Ticket +
                </a>

            </div>


                <div class="bg-white shadow rounded-lg p-6 mb-6">
                    <h2 class="text-xl font-semibold text-gray-900 mb-4">User Information</h2>
                    <div class="flex items-center">
                        <div class="w-16 h-16 bg-gray-200 rounded-full flex items-center justify-center text-gray-600 text-2xl">
                            <!-- Placeholder for user avatar or initials -->
                            <span>{{ strtoupper(substr($user->name, 0, 1)) }}</span>
                        </div>
                        <div class="ml-4">
                            <p class="text-lg font-medium text-gray-900">{{ $user->name }}</p>
                            <p class="text-sm text-gray-600">{{ $user->email }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-4">
                    <div class="p-6 text-gray-900">
                        <h2 class="text-xl font-semibold text-gray-900 mb-6">Ticket Detail Information</h2>
                        <div class="space-y-4">
                            <div class="flex items-center">
                                <span class="font-medium text-gray-700 w-40">Ticket ID:</span>
                                <span class="text-gray-900">{{ $ticket->id }}</span>
                            </div>
                            <div class="flex items-center">
                                <span class="font-medium text-gray-700 w-40">Ticket Title:</span>
                                <span class="text-gray-900">{{ $ticket->ticket_title }}</span>
                            </div>
                            <div class="flex items-center">
                                <span class="font-medium text-gray-700 w-40">Issue Details:</span>
                                <span class="text-gray-900">{{ $ticket->issue_details }}</span>
                            </div>
                            <div class="flex items-center">
                                <span class="font-medium text-gray-700 w-40">Date:</span>
                                <span class="text-gray-900">{{ $ticket->date }}</span>
                            </div>
                            <div class="flex items-center">
                                <span class="font-medium text-gray-700 w-40">Status:</span>
                                <span class="text-gray-900">{{ $ticket->status }}</span>
                            </div>
                            <div class="flex items-center">
                                <span class="font-medium text-gray-700 w-40">Email Status:</span>
                                <span class="text-gray-900">{{ $ticket->email_status }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-4">
                    <div class="p-6 text-gray-900">
                        <h2 class="text-xl font-semibold text-gray-900 mb-6">Response From Admin: </h2>
                       @php
                             $i = 1;
                       @endphp
                      
                    @foreach($responses as $key => $response)

                        <div class="space-y-4 mb-4">
                            <div class="flex items-center">
                                <span class="font-medium text-gray-700 w-40">#SI:</span>
                                <span class="text-gray-900">{{ $i++ }}</span>
                            </div>
                            <div class="flex items-center">
                                <span class="font-medium text-gray-700 w-40">Admin Response:</span>
                                <span class="text-gray-900">{{ $response->response }}</span>
                            </div>
                            <div class="flex items-center">
                                <span class="font-medium text-gray-700 w-40">Response Time:</span>
                                <span class="text-gray-900">{{ $response->created_at }}</span>
                            </div>    
                            <hr>                
                        </div>
                   
                    @endforeach
                    </div>
                </div>


                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        @if (session('success'))
                            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                                <strong class="font-bold">Success!</strong>
                                <span class="block sm:inline">{{ session('success') }}</span>
                            </div>
                        @endif

                        <!-- Issue Form -->
                        <h2 class="text-lg font-semibold mb-4">Make Response to Customer</h2>
                        <form action="{{ route('submit_response') }}" method="POST">
                            @csrf
                            <div class="grid grid-cols-1 gap-4 mb-6">
                               
                                <input type="number" id="ticket_id" name="ticket_id"  hidden value="{{ $ticket->id }}">
                                <input type="number" hidden id="user_id" name="user_id" value="{{ auth()->user()->id }}">
                                <input type="number" id="email_status" name="email_status" hidden value="">

                                <!-- Response Detail Field -->
                                <div>
                                    <label for="response" class="block text-sm font-medium text-gray-700">Response Detail</label>
                                    <textarea id="response" name="response" rows="4" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"></textarea>
                                </div>
                            </div>
                            <div>
                                <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    Reply
                                </button>
                            </div>
                        </form>

                    </div>
                </div>

            </div>
        </div>
</x-app-layout>
