@extends('layout.main')

@section('content')

<div id="map" class="h-screen w-screen"></div>

@if(auth()->check())
    <div class="fixed bottom-4 left-4" style="z-index: 999;">
        <img class="img_profile w-14 h-14 rounded-full cursor-pointer border-2 hover:border-blue-500" src="https://cdn.pixabay.com/photo/2016/08/08/09/17/avatar-1577909_1280.png" alt="profile">

        <div class="dropdown_profile absolute bottom-full left-0 bg-gray-100  flex flex-col hidden rounded overflow-hidden w-40" style="z-index: 999;">
            @if(auth()->user()->role_id == 1)
            <a href="{{route('dashboard')}}" class="text-gray-600 hover:text-gray-800 hover:bg-gray-200 p-2 flex items-center gap-2">
                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M13 9V3h8v6h-8ZM3 13V3h8v10H3Zm10 8V11h8v10h-8ZM3 21v-6h8v6H3Z"/></svg>
                <span>Dashbord</span>
            </a>
            @endif

            <a href="{{route('signout')}}" class="text-gray-600 hover:text-gray-800 hover:bg-gray-200 p-2 flex items-center gap-2">
                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M4 12a.5.5 0 0 0 .5.5h8.793l-2.647 2.646a.5.5 0 1 0 .707.708l3.5-3.5a.5.5 0 0 0 0-.707l-3.5-3.5a.5.5 0 0 0-.707.707l2.647 2.646H4.5a.5.5 0 0 0-.5.5zM17.5 2h-11A2.502 2.502 0 0 0 4 4.5v4a.5.5 0 0 0 1 0v-4A1.5 1.5 0 0 1 6.5 3h11A1.5 1.5 0 0 1 19 4.5v15a1.5 1.5 0 0 1-1.5 1.5h-11A1.5 1.5 0 0 1 5 19.5v-4a.5.5 0 0 0-1 0v4A2.502 2.502 0 0 0 6.5 22h11a2.502 2.502 0 0 0 2.5-2.5v-15A2.502 2.502 0 0 0 17.5 2z"/></svg>
                <span>Sign out</span>
            </a>
        </div>
    </div>
@endif

@livewire('scooters')

<script>
    const dropdown_profile = document.querySelector('.dropdown_profile');
    const img_profile = document.querySelector('.img_profile');

    if(dropdown_profile && img_profile) {
        img_profile.addEventListener('click', () => {
            dropdown_profile.classList.toggle('hidden');
        });
    }

    function getCurrentCoordinates() {
        return new Promise((resolve, reject) => {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(
                    (position) => {
                    const latitude = position.coords.latitude;
                    const longitude = position.coords.longitude;
                    resolve({ latitude, longitude });
                    },
                    (error) => {
                    reject(error);
                    }
                );
            } else {
                reject(new Error('Geolocation is not supported by this browser.'));
            }
        });
    }

    getCurrentCoordinates()
    .then((coordinates) => {
        const latitude = coordinates.latitude;
        const longitude = coordinates.longitude;

        var map = L.map('map').setView([latitude, longitude], 15);
        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        L.marker([latitude, longitude]).addTo(map)
            .bindPopup(L.popup({
                autoClose:false,
                closeOnClick: false,
                className: 'cur-popup',
            })
            ).setPopupContent('You are here!')
            .openPopup();
        map.setView([latitude,longitude]);
        
        @foreach ($scooters as $scooter)
            lat = {{$scooter->latitude}};
            lng = {{$scooter->longitude}};
            L.marker([lat, lng]).addTo(map)
            .bindPopup(L.popup({
                autoClose:false,
                closeOnClick: false,
                className: 'cur-popup',
            })
            )
            .setPopupContent('<div class="p-0 m-0 text-center flex flex-col justify-center items-center gap-1"><h3 class="font-bold">{{$scooter->name}} ({{$scooter->number}} left)</h3><div class="bg-blue-500 p-1 text-white rounded cursor-pointer" onclick="dispatchReservation({{$scooter->id}})">Take a scooter</div></div>')
            .openPopup();
        @endforeach


    }) //in caz ca nu merge locatia o pun eu hardcodata
    .catch((error) => {
        var map = L.map('map').setView([45.7458483, 21.2403663], 13);
        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        L.marker([45.7458483, 21.2403663]).addTo(map)
            .bindPopup('Complexul studentilor')
            .openPopup();
    });


    //every time page load save in cookie the current location
    function saveCurrentLocation() {
        getCurrentCoordinates()
        .then((coordinates) => {
            const latitude = coordinates.latitude;
            const longitude = coordinates.longitude;

            document.cookie = `latitude=${latitude}; expires=Thu, 18 Dec 2033 12:00:00 UTC; path=/`;
            document.cookie = `longitude=${longitude}; expires=Thu, 18 Dec 2033 12:00:00 UTC; path=/`;
        })
        .catch((error) => {
            console.log(error);
        });
    }

    saveCurrentLocation();
</script>
@endsection