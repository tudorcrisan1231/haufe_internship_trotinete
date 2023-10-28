<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Haufe intership</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css"
    integrity="sha256-kLaT2GOSpHechhsozzB+flnD+zUyjE2LlfWPgU04xyI="
    crossorigin=""/>
    <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"
    integrity="sha256-WBkoXOwTeyKclOHuWtc+i2uENFpDZ9YPdf5Hf+D7ewM="
    crossorigin=""></script>
    @vite('resources/css/app.css')
    @livewireStyles
</head>
<body>
    @include('components.session')
    <header class="relative">
        <div class="bg-white border-b border-gray-200">
            <div class="px-4 mx-auto sm:px-6 lg:px-8 max-w-7xl">
                <div class="flex justify-between items-center gap-6 h-16 lg:h-[72px]">
                    <div class="flex items-center">
                        <a href="{{route('home')}}" title="" class="flex">
                            <span> Ecomobility  </span>
                        </a>
                    </div>
    
                    <div class="flex justify-start gap-6">    
                        <a href="#" title="" class="inline-flex items-center font-sans text-sm font-medium text-gray-900 transition-all duration-200 border-b-2 border-transparent xl:text-base @if(Route::currentRouteName() == 'users') border-gray-900 @endif hover:border-gray-900 focus:outline-none focus:border-gray-900"> Users </a>
                        <a href="#" title="" class="inline-flex items-center font-sans text-sm font-medium text-gray-900 transition-all duration-200 border-b-2 border-transparent xl:text-base @if(Route::currentRouteName() == 'dashboard') border-gray-900 @endif hover:border-gray-900 focus:outline-none focus:border-gray-900"> Location </a>
                    </div>
    
                    <div class="flex items-center justify-end ml-auto space-x-6">
                        <a href="{{route('signout')}}" type="button" class="relative inline-flex items-center justify-center text-white transition-all duration-200 bg-gray-900 rounded-full w-9 h-9 md:w-12 md:h-12 hover:bg-gray-700">
                            <svg class="w-5 h-5 md:w-6 md:h-6" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M4 12a.5.5 0 0 0 .5.5h8.793l-2.647 2.646a.5.5 0 1 0 .707.708l3.5-3.5a.5.5 0 0 0 0-.707l-3.5-3.5a.5.5 0 0 0-.707.707l2.647 2.646H4.5a.5.5 0 0 0-.5.5zM17.5 2h-11A2.502 2.502 0 0 0 4 4.5v4a.5.5 0 0 0 1 0v-4A1.5 1.5 0 0 1 6.5 3h11A1.5 1.5 0 0 1 19 4.5v15a1.5 1.5 0 0 1-1.5 1.5h-11A1.5 1.5 0 0 1 5 19.5v-4a.5.5 0 0 0-1 0v4A2.502 2.502 0 0 0 6.5 22h11a2.502 2.502 0 0 0 2.5-2.5v-15A2.502 2.502 0 0 0 17.5 2z"/></svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <div class="px-4 mx-auto sm:px-6 lg:px-8 max-w-7xl py-10">
        @yield('content')
    </div>
    @livewireScripts
</body>
</html>