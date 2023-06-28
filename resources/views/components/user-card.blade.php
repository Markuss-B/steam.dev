<div {{$attributes->merge(['class' => "flex flex-row items-center justify-between p-2 border-b border-gray-200 cursor-pointer hover:bg-gray-100"])}}
    onclick="window.location='{{ route('user.show', $user) }}'">
    <div class="flex flex-row items-center">
        <div class="flex-shrink-0 mr-2">
            <img class="w-10 h-10 rounded-full" src="{{ $avatar }}" alt="{{ $name }}">
        </div>
        <div class="flex flex-col">
            <div class="text-sm font-medium text-gray-900">
                {{ $name }}
            </div>
            @if (isset($activeGame))
                <div class="text-sm text-gray-500">
                    Playing {{ $activeGame->name }}
                </div>
            @endif
        </div>
    </div>
    <div class="flex flex-row items-center">
        {{ $slot }}
    </div>
</div>