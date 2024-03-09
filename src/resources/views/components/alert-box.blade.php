<div {{ $attributes->merge(['class' => 'alert-box p-4 rounded-md']) }}>
    <button onclick="this.parentElement.style.display='none';">&times;</button>
    @if ($type === 'success')
        <div class="flex items-center justify-between">
            <div class="flex items-center">
                <svg class="h-6 w-6 text-green-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
                <span class="ml-2 text-green-700">{{ $slot }}</span>
            </div>
            {{-- close box --}}
        </div>
    @elseif ($type === 'error')
        <div class="flex items-center justify-between">
            <div class="flex items-center">
                <svg class="h-6 w-6 text-red-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
                <span class="ml-2 text-red-700">{{ $slot }}</span>
            </div>
        </div>
    @elseif ($type === 'info')
        <div class="flex items-center justify-between">
            <div class="flex items-center">
                <svg class="h-6 w-6 text-blue-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 3a7 7 0 100 14 7 7 0 000-14zM8 9a1 1 0 112 0v4a1 1 0 11-2 0V9zm2-5a1 1 0 100 2 1 1 0 000-2z" clip-rule="evenodd"></path>
                </svg>
                <span class="ml-2 text-blue-700">{{ $slot }}</span>
            </div>
        </div>
    @endif
        

</div>