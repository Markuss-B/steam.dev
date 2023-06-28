<!-- You must be the change you wish to see in the world. - Mahatma Gandhi -->
<div class="game-card group w-64 mb-12 ms-4 cursor-pointer bg-gray-100 rounded-lg overflow-hidden shadow-md relative"
    onclick="window.location.href='{{ $link }}'">
    {{-- <div class="game-card-image">
        <img src="https://picsum.photos/500/500" alt="Placeholder Image" class="object-cover rounded-t-lg">
    </div> --}}
    <div class="game-card-image">
        <img src="{{ $game->getHeaderAttribute() }}" alt="{{ $game->id}} header image" class="object-cover rounded-t-lg">
    </div>
    <div class="flex justify-between w-full bg-black bg-opacity-80 p-4 h-full group-hover:bg-blue-950 group-hover:bg-opacity-100 transition-colors duration-300">
        <h3 class="text-l text-white">{{ $game->name }}</h3>
        @if ($showPrice)
            <div class="price ml-1">
                @if ($game->discount == 0)
                    <p class="text-white">€{{ $game->price / 100 }}</p>
                @else
                    <p class="text-green-600">-{{ $game->discount }}%</p>
                    <p class="text-white text-xs line-through">€{{ number_format($game->price / 100 * 100 / (100 - $game->discount), 2) }}</p>
                    <p class="text-white">€{{ $game->price / 100 }}</p>
                @endif
            </div>
        @endif
    </div>
</div>
