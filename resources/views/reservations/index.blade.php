<x-app-layout>


    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Reservations') }}
        </h2>
    </x-slot>


    <div class="py-12">


        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">


                <style>
                    .grid-container { display: grid; grid-template-columns: repeat(4, 1fr); gap: 15px; max-width: 600px; }
                    .slot-box { border: 2px solid #e2e8f0; border-radius: 8px; padding: 20px; text-align: center; cursor: pointer; transition: 0.3s; }
                    .slot-box input[type="radio"] { display: none; }
                    .slot-box:has(input:checked) { background-color: #4f46e5; color: white; border-color: #4f46e5; }
                </style>


                <form action="{{ route('reservations.store') }}" method="POST">
                    @csrf
                    <h3 class="text-center text-lg font-semibold mb-4">Select a Slot</h3>
                    <div class="grid-container mx-auto">
                        @foreach($slots as $slot)
                            <label class="slot-box">
                                <input type="radio" name="slot_number" value="{{ $slot }}" required>
                                <span>Slot {{ $slot }}</span>
                            </label>
                        @endforeach
                    </div>


                    <div class="mt-4 flex justify-center gap-4">
       
                        <input type="date" name="reservation_date" required class="border-gray-300 rounded-md shadow-sm">
                        <select name="duration_hours" required class="border-gray-300 rounded-md shadow-sm">
                            <option value="1">1 hour</option>
                            <option value="2">2 hours</option>
                            <option value="3">3 hours</option>
                            <option value="4">4 hours</option>
                            <option value="5">5 hours</option>
                        </select>
                        <x-primary-button>Confirm Booking</x-primary-button>
                    </div>
                </form>



                <div class="mt-96">
                    <br><h3 class="font-bold mb-4 text-center">Current Reservations</h3><br>
                    <table class="mx-auto divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Slot</th>
                                <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                                <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Duration</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($reservations as $res)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-center">Slot {{ $res->slot_number }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center">{{ $res->reservation_date }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center">{{ $res->duration_hours }} {{ $res->duration_hours == 1 ? 'hour' : 'hours' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>


            </div>
        </div>
    </div>
</x-app-layout>