<x-app-layout title="{{ $developer->name }}" :basiclayout='true'>
    <a href="{{ route('developers.index') }}">Back to developers</a>
    <a href="{{ route('developers.edit', $developer->id) }}">Edit</a>
    <form action="{{ route('developers.destroy', $developer->id) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit">Delete</button>
    </form>
    <div class="w-full flex flex-wrap justify-around">
        @foreach ($developer->games as $game)
            <x-game-card :game="$game" link="{{ route('games.show', ['game' => $game->id]) }}" showPrice="true" />
        @endforeach
    </div>
</x-app-layout>