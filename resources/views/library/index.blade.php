<x-app-layout title="Library" basiclayout="true">
    {{-- check if has games --}}
    @if (!$games)
        <p>No games in library</p>
    @else
        <p>Games in library:</p>
        <div class="w-full flex flex-wrap justify-between">
        @foreach ($games as $game)
            <x-game-card :game="$game" link="{{ route('library.show', ['game' => $game->id]) }}" />
        @endforeach
        </div>
    @endif
</x-app-layout>