<x-app-layout title="Tag: {{ $tag->name }}" :basiclayout='true'>
    {{-- back to tags --}}
    <a href="{{ route('tags.index') }}">Back to tags</a>
    {{-- edit tag --}}
    <a href="{{ route('tags.edit', ['tag' => $tag->id]) }}">Edit</a>
    {{-- delete tag --}}
    <form action="{{ route('tags.destroy', ['tag' => $tag->id]) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit">Delete</button>
    </form>
    {{-- list of games --}}
    <div class="w-full flex flex-wrap justify-between">
        @foreach ($tag->games as $game)
            <x-game-card :game="$game" link="{{ route('games.show', ['game' => $game->id]) }}" showPrice="true" />
        @endforeach
    </div>
</x-app-layout>