<div class="flex flex-wrap justify-between mb-4">
    {{-- if games passed --}}
    @if (isset($games))
        @foreach ($games as $game)
            <x-user-game-info-card :game="$game" :user="$user" />
        @endforeach
    @else
        {{-- if no games passed --}}  
        @foreach ($user->games->sortByDesc('pivot.updated_at') as $game)
            <x-user-game-info-card :game="$game" :user="$user" />
        @endforeach
    @endif
</div>