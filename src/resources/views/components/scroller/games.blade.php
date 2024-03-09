@foreach ($games as $game)
    <x-game-card :game="$game" link="{{ route('games.show', ['game' => $game->id]) }}" showPrice="true" />
@endforeach