<div>
    @if($scootersModal)
        <div class="w-full sm:w-1/2 lg:w-1/3 bg-white h-full fixed top-0 right-0 py-6 px-4 overflow-auto" style="z-index: 999;">
            <svg wire:click="closeScootersModal" class="w-10 h-10 cursor-pointer absolute top-6 right-2 p-1 rounded bg-gray-100 hover:bg-gray-200" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M18.3 5.71a.996.996 0 0 0-1.41 0L12 10.59L7.11 5.7A.996.996 0 1 0 5.7 7.11L10.59 12L5.7 16.89a.996.996 0 1 0 1.41 1.41L12 13.41l4.89 4.89a.996.996 0 1 0 1.41-1.41L13.41 12l4.89-4.89c.38-.38.38-1.02 0-1.4z"/></svg>
            <div class="font-bold text-2xl">
                @if(auth()->check())
                    Hello, {{auth()->user()->name}},
                @endif
                scooter group locations near you:
            </div>
            <div class="flex flex-col  gap-2 mt-10 w-full">
                @if($currentRide)
                    @php
                        $scooter = $currentRide->getScooter;
                    @endphp
                    <div class="flex flex-col sm:flex-row items-center bg-white border-2 border-blue-500 rounded-lg shadow w-full" >
                        <div class="w-full sm:w-44">
                            @if($scooter->image)
                                <img class="object-cover rounded-t-lg h-36 w-full sm:w-36 md:rounded-none md:rounded-l-lg" src="{{asset('storage/' . $scooter->image)}}" alt="">
                            @else
                                <img class="object-cover rounded-t-lg h-36 w-full sm:w-36 md:rounded-none md:rounded-l-lg" src="https://www.pulsecarshalton.co.uk/wp-content/uploads/2016/08/jk-placeholder-image.jpg" alt="">  
                            @endif
                        </div>

                        <div class="flex flex-col justify-between p-4 leading-normal w-full">
                            <h5 class="mb-1 text-xl font-bold tracking-tight text-gray-900 flex items-end justify-between gap-2">
                                {{$scooter->name}}
                                <button wire:click="leftScooterToggle" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-3 py-1 focus:outline-none">
                                    End ride
                                </button>
                            </h5>
                            <p class="mb-3 text-md font-normal text-gray-700">{{$scooter->location}}</p>
                            
                            <input type="hidden" value="{{$scooter->latitude}}" class="groups_latitude">
                            <input type="hidden" value="{{$scooter->longitude}}" class="groups_longitude">

                            <div class="flex items-center gap-2 justify-between text-sm">
                                <p>
                                    Taken at <span class="font-semibold">{{$currentRide->start_time}} ({{$scooter->price}} RON/h)</span>
                                </p>
                                <p></p>
                            </div>
                        </div>
                    </div>
                @endif

                @forelse ($scooters as $scooter)                    
                    <div class="flex flex-col sm:flex-row items-center bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 cursor-pointer w-full" wire:click="openReservationModal({{$scooter->id}})">
                        <div class="w-full sm:w-44">
                            @if($scooter->image)
                                <img class="object-cover rounded-t-lg h-36 w-full sm:w-36 md:rounded-none md:rounded-l-lg" src="{{asset('storage/' . $scooter->image)}}" alt="">
                            @else
                                <img class="object-cover rounded-t-lg h-36 w-full sm:w-36 md:rounded-none md:rounded-l-lg" src="https://www.pulsecarshalton.co.uk/wp-content/uploads/2016/08/jk-placeholder-image.jpg" alt="">  
                            @endif
                        </div>

                        <div class="flex flex-col justify-between p-4 leading-normal w-full">
                            <h5 class="mb-1 text-xl font-bold tracking-tight text-gray-900">{{$scooter->name}}</h5>
                            <p class="mb-3 text-md font-normal text-gray-700">{{$scooter->location}}</p>
                            
                            <input type="hidden" value="{{$scooter->latitude}}" class="groups_latitude">
                            <input type="hidden" value="{{$scooter->longitude}}" class="groups_longitude">

                            <div class="flex items-center gap-2 justify-between text-sm">
                                <p>{{$scooter->number}} left</p>
                                <p>{{$scooter->price}} RON/h</p>
                            </div>
                        </div>
                    </div>
        
                @empty
                    <p>Nothing found...</p>
                @endforelse
            </div>
        </div>
    @endif
    @if(!$scootersModal)
        <div class="w-10 bg-white h-full fixed top-0 right-0 py-6 px-2 flex items-center justify-center cursor-pointer" style="z-index: 999;" wire:click="openScootersModal">
            <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><g fill="none" fill-rule="evenodd"><path d="M24 0v24H0V0h24ZM12.593 23.258l-.011.002l-.071.035l-.02.004l-.014-.004l-.071-.035c-.01-.004-.019-.001-.024.005l-.004.01l-.017.428l.005.02l.01.013l.104.074l.015.004l.012-.004l.104-.074l.012-.016l.004-.017l-.017-.427c-.002-.01-.009-.017-.017-.018Zm.265-.113l-.013.002l-.185.093l-.01.01l-.003.011l.018.43l.005.012l.008.007l.201.093c.012.004.023 0 .029-.008l.004-.014l-.034-.614c-.003-.012-.01-.02-.02-.022Zm-.715.002a.023.023 0 0 0-.027.006l-.006.014l-.034.614c0 .012.007.02.017.024l.015-.002l.201-.093l.01-.008l.004-.011l.017-.43l-.003-.012l-.01-.01l-.184-.092Z"/><path fill="currentColor" d="M8.293 12.707a1 1 0 0 1 0-1.414l5.657-5.657a1 1 0 1 1 1.414 1.414L10.414 12l4.95 4.95a1 1 0 0 1-1.414 1.414l-5.657-5.657Z"/></g></svg>
        </div>
    @endif

    @if($reservationModal)
         <!-- Main modal -->
         <div class="fixed top-0 left-0 z-50 w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full flex items-center justify-center" style="z-index: 9999">
            <div class="relative w-full max-w-2xl max-h-full">
                <!-- Modal content -->
                <div class="relative bg-white rounded-lg shadow">
                    <!-- Modal header -->
                    <div class="flex items-start justify-between p-4 border-b rounded-t">
                        <h3 class="text-xl font-semibold text-gray-900">
                            Take a scooter from <span class="font-light">{{$location_details->name}}</span>
                        </h3>
                        <button type="button" wire:click="closeReservationModal" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <!-- Modal body -->
                    <div class="p-6 space-y-6">
                        @if($currentRide)
                            <div>
                                <p>You already have a ride in progress. Please finish it before taking another one.</p>
                            </div>
                        @else
                            <div class="flex items-center gap-6">
                                @if($location_details->image)
                                    <img class="object-cover rounded-lg h-36 w-full" src="{{asset('storage/' . $location_details->image)}}" alt="">
                                @else
                                    <img class="object-cover rounded-lg h-36 w-full" src="https://www.pulsecarshalton.co.uk/wp-content/uploads/2016/08/jk-placeholder-image.jpg" alt="">
                                @endif

                                <div>
                                    <p>You are about to take a scooter from <span class="font-semibold">{{$location_details->name}}</span> location. Please confirm your action.</p>
                                </div>
                            </div>
                            
                            <div class="mt-4">
                                Your connected as <span class="font-semibold">{{auth()->user()->name}}</span>, the invoice will be sent to this specific account data (<span class="font-semibold">{{auth()->user()->email}}</span>). The price is <span class="font-semibold">{{$location_details->price}} RON/h</span>.
                            </div>
                        @endif
                    </div>
                    <!-- Modal footer -->
                    <div class="flex items-center justify-end p-6 space-x-2 border-t border-gray-200 rounded-b">
                        @if(!$currentRide)
                            @if($location_details->number > 0)
                                <button wire:click="takeScooter" type="button" id="save_lang" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                                    Take
                                </button>
                            @else
                                <button type="button" id="save_lang2" class="text-white bg-blue-700 hover:bg-blue-800 opacity-70 cursor-default font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                                    No scooters available
                                </button>
                            @endif
                        @endif
                        <button wire:click="closeReservationModal" type="button" id="cancel_lang" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10">Cancel</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="fixed top-0 left-0 w-full h-full bg-black opacity-20 z-40" style="z-index: 9998"></div>
    @endif

    @if($endRideModal)
         <!-- Main modal -->
         <div class="fixed top-0 left-0 z-50 w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full flex items-center justify-center" style="z-index: 9999">
            <div class="relative w-full max-w-2xl max-h-full">
                <!-- Modal content -->
                <div class="relative bg-white rounded-lg shadow">
                    <!-- Modal header -->
                    <div class="flex items-start justify-between p-4 border-b rounded-t">
                        <h3 class="text-xl font-semibold text-gray-900">
                            End ride from: <span class="font-light">{{$currentRide->getScooter->name}}</span>?
                        </h3>
                        <button type="button" wire:click="leftScooterToggle" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <!-- Modal body -->
                    <div class="p-6 space-y-6">
                        <p>You want to end your ride from <span class="font-semibold">{{$currentRide->getScooter->name}}</span> location. Please confirm your action.</p>
                        <p>
                            Total to pay: <span class="font-semibold">{{$this->totalPayable}} RON</span>
                        </p>
                        <p>
                            Total time: <span class="font-semibold">~{{$this->totalTime}} hours ({{$currentRide->start_time}} - {{date('Y-m-d H:i:s')}})</span>
                        </p>

                        <div class="mt-5">
                            <label for="leave">
                                Leave scooter at:
                            </label>
                            
                            <select name="" id="leave" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" wire:model="endRideLocation" wire:change="verifyLocation">
                                <option value="" selected>Select location</option>
                                @foreach ($scooters as $scooter)
                                    <option value="{{$scooter->id}}">{{$scooter->name}} ({{$scooter->location}})</option>
                                @endforeach
                            </select>

                            @if($endRideDistance)
                                @if($endRideDistance < 0.4)
                                    <p class="text-green-500 text-xs mt-1">
                                        You are close to the location.
                                    </p>
                                @else
                                    <p class="text-red-500 text-xs mt-1">
                                        You are too far from the location.
                                    </p>
                                @endif
                            @endif

                            @error('endRideLocation')
                                <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                            @enderror
                        </div>
                    </div>
                    <!-- Modal footer -->
                    <div class="flex items-center justify-end p-6 space-x-2 border-t border-gray-200 rounded-b">
                        @if($endRideDistance && $endRideDistance < 0.4)
                        <button wire:click="endRide" type="button" id="save_lang" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                            Pay
                        </button>
                        @endif
                        
                        <button wire:click="leftScooterToggle" type="button" id="cancel_lang" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10">Cancel</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="fixed top-0 left-0 w-full h-full bg-black opacity-20 z-40" style="z-index: 9998"></div>
    @endif
</div>
