<div class="user-game-info-card flex mb-4 cursor-pointer bg-slate-300 rounded-lg hover:bg-slate-400 transition duration-300 ease-in-out"
    onclick="window.location='{{ route('games.show', $game) }}'">
    <!-- Simplicity is the ultimate sophistication. - Leonardo da Vinci -->
    <div class="user-game-card-img">
        @if ($game->image)
            <img src="{{ $game->image }}" alt="{{ $game->name }}"
                class="w-32 rounded-lg shadow-lg">
        @else
            <img src="https://picsum.photos/500/500" alt="Placeholder Image" class="w-32 rounded-lg shadow-lg">
        @endif
    </div>
    <div class="user-game-card-info m-4">
        <h5 class="mb-2 text-xl font-medium leading-tight">
            {{ $game->name }}
        </h5>
        <p>
            @if ($last_played)
                Last played: {{ $last_played }}
                </p>
                <p>
                    Playtime: @if ($play_time > 120)
                        {{ $play_time / 60 }} hours
                    @else
                        {{ $play_time }} minutes
                    @endif
                </p>
            @else
                Acquired: {{ $acquisition_date }}
                </p>
            @endif
    </div>
</div>