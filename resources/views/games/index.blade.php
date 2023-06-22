<x-app-layout title="Games" :basiclayout='true'>
    {{-- create new game --}}
    <a href="{{ route('games.create') }}">Create new game</a>
    {{-- list of games --}}
    <div class="w-full flex flex-wrap justify-between">
        @foreach ($games as $game)
            <x-game-card :game="$game" link="{{ route('games.show', ['game' => $game->id]) }}" showPrice="true" />
        @endforeach
    </div>
</x-app-layout>
