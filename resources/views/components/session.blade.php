@if (session()->has('success'))
    <div class="notification w-full max-w-sm overflow-hidden bg-green-100 border border-green-300 rounded-s-lg shadow-lg fixed top-10 right-0" style="z-index: 9999">
        <div class="p-3">
            <div class="flex items-center justify-between">
                <svg class="flex-shrink-0 w-6 h-6 text-green-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <p class="ml-3 text-sm font-medium text-green-600"> {{ session('success') }} </p>

                <div class="flex pl-8 ml-auto">
                    <button class="close_notification inline-flex text-green-400 transition-all bg-green-100 rounded-md hover:text-green-600 focus:outline-none focus:ring-2 durarion-200 focus:text-green-600 focus:ring-offset-2 focus:ring-green-600 focus:ring-offset-green-100">
                        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>
@endif

@if (session()->has('error'))
    <div class="notification w-full max-w-sm overflow-hidden bg-red-100 border border-red-300 rounded-s-lg shadow-lg fixed top-10 right-0" style="z-index: 9999">
        <div class="p-3">
            <div class="flex items-center justify-between">
                <svg class="flex-shrink-0 w-6 h-6 text-red-600" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                    <path clip-rule="evenodd" fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-5a.75.75 0 01.75.75v4.5a.75.75 0 01-1.5 0v-4.5A.75.75 0 0110 5zm0 10a1 1 0 100-2 1 1 0 000 2z"></path>
                </svg>
                <p class="ml-3 text-sm font-medium text-red-600"> {{ session('error') }} </p>

                <div class="flex pl-8 ml-auto">
                    <button class="close_notification inline-flex text-red-400 transition-all bg-red-100 rounded-md hover:text-red-600 focus:outline-none focus:ring-2 durarion-200 focus:text-red-600 focus:ring-offset-2 focus:ring-red-600 focus:ring-offset-red-100">
                        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>
@endif

<script>
    const notification = document.querySelector('.notification');
    const close_notification = document.querySelector('.close_notification');

    close_notification.addEventListener('click', () => {
        notification.classList.add('hidden');
    });
</script>