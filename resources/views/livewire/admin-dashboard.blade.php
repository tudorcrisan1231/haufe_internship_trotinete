<div>
    <div class="flex items-center justify-between gap-4">
        <div class="font-bold text-2xl">Scooter group locations:</div>
        <button wire:click="toggleScootersAdd" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 focus:outline-none">Add group</button>
    </div>
    
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-10">
        <table class="w-full text-sm text-left text-gray-500">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Image
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Name
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Location
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Lat / Long
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Number
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Price
                    </th>
                    <th scope="col" class="px-6 py-3">
                        <span class="sr-only">Edit</span>
                    </th>
                </tr>
            </thead>
            <tbody>
                @if($scootersAdd)
                    <tr class="bg-white border-b hover:bg-gray-50">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                            <input type="file" id="image" wire:model="image" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Image" required>
                        </th>
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                            <input type="text" id="name" wire:model="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Name" required>
                        </th>
                        <td class="px-6 py-4" colspan="2">
                            <input type="text" id="location" wire:model="location" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Location" required>

                        </td>
                        <td class="px-6 py-4">
                            <input type="text" id="number" wire:model="number" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Number" required>

                        </td>
                        <td class="px-6 py-4">
                            <input type="text" id="price" wire:model="price" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Price" required>

                        </td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex items-center justify-end gap-4">
                                <div wire:click="addScooter" class="font-medium text-blue-600 hover:underline cursor-pointer">Add</div>
                                <div wire:click="toggleScootersAdd" class="font-medium text-red-600 hover:underline cursor-pointer">Cancel</div>
                            </div>
                        </td>
                    </tr>
                @endif
                @forelse ($scooters as $scooter)
                    <tr class="bg-white border-b hover:bg-gray-50">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                            @if($scooter->image)
                                <a href="{{asset('storage/'.$scooter->image)}}" target="_blank">
                                    <img src="{{asset('storage/'.$scooter->image)}}" alt="" class="w-10 h-10 rounded-full">
                                </a>
                            @else
                                <img src="https://www.pulsecarshalton.co.uk/wp-content/uploads/2016/08/jk-placeholder-image.jpg" alt="" class="w-10 h-10 rounded-full">
                            @endif
                        </th>
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                            {{ $scooter->name }}
                        </th>
                        <td class="px-6 py-4">
                            {{ $scooter->location }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $scooter->latitude ?? '-' }} / {{ $scooter->longitude ?? '-' }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $scooter->number }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $scooter->price }}
                        </td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex items-center justify-end gap-4">
                                <div class="font-medium text-blue-600 hover:underline cursor-pointer">Edit</div>
                                <div class="font-medium text-red-600 hover:underline cursor-pointer">Delete</div>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr class="bg-white border-b hover:bg-gray-50">
                        <td class="px-6 py-4 text-center" colspan="7">
                            <p>Nothing found...</p>
                        </td>
                    </tr>
                @endforelse

            </tbody>
        </table>
    </div>

</div>
