<x-app-layout>
    <x-slot name="header">
      

        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Welcome To Customer Dashboard') }}
        </h2>
    </x-slot>

   <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mb-4">
            <div class="flex justify-end">
                <a href="{{ route('create_ticket') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 my-4 rounded inline-block">
                    Create Ticket +
                </a>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <table class="table-auto w-full border border-gray-300">
                        <thead>
                            <tr>
                                <th class="border px-4 py-2">#SI</th>
                                <th class="border px-4 py-2">Issue id</th>
                                <th class="border px-4 py-2">Tiket Tittle</th>
                                <th class="border px-4 py-2">Date</th>
                                <th class="border px-4 py-2">Status</th>
                                <th class="border px-4 py-2">View</th>
                            </tr>
                        </thead>
                        <tbody>
                           <?php $i = 1; // Initialize counter variable ?>
                            @foreach($tickets as $ticket)
                            <tr>
                                <td class="border px-4 py-2">{{ $i++ }}</td> <!-- Increment and display row number -->
                                <td class="border px-4 py-2">{{ $ticket->ticket_title }}</td> <!-- Dynamic data -->
                                <td class="border px-4 py-2">{{ $ticket->issue_details }}</td> <!-- Dynamic data -->
                                <td class="border px-4 py-2">{{ \Carbon\Carbon::parse($ticket->date)->format('d M Y') }}</td> <!-- Format date -->
                                <td class="border px-4 py-2" align="center"> 
                                @if ($ticket->status == 0)
                                    <span class="inline-block bg-green-200 text-green-800 px-2 py-1 text-xs font-semibold rounded-full">Open</span>
                                @else
                                        <span class="inline-block bg-red-200 text-red-800 px-2 py-1 text-xs font-semibold rounded-full">Closed</span>
                                @endif
                                </td>
                                <td class="border px-4 py-2 text-center">
                                    {{-- <a href="{{ route('ticket.show', $ticket->id) }}" class="text-indigo-600 hover:text-indigo-900">View</a> --}}
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
