<x-layout title="{{ $tag->name }}">
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
    <p>Games:</p>
    <table>
        <thead>
            <tr>
                <th>Game</th>
                <th>Price</th>
                <th>Discount</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tag->games as $game)
                <x-game-card :game="$game" />
            @endforeach
        </tbody>
    </table>
</x-layout>