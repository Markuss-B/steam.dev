<div class="flex flex-wrap justify-between mb-4">
    {{-- if games passed --}}
    @if (isset($games))
        @forelse ($games as $game)
            <x-user-game-info-card :game="$game" :user="$user" />
        @empty
            <p>no games</p>
        @endforelse
    @else
        {{-- if no games passed --}}  
        @forelse ($user->games->sortByDesc('pivot.updated_at') as $game)
            <x-user-game-info-card :game="$game" :user="$user" />
        @empty
            <p>no games</p>
        @endforelse
    @endif
</div>