<div class="flex flex-wrap justify-between mb-4">
    @foreach ($user->games->sortByDesc('pivot.updated_at') as $game)
        <x-user-game-info-card :game="$game" :user="$user" />
    @endforeach
</div>