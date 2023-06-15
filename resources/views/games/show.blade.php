<x-layout title="{{ $game->name }}">
    <a href="{{ route('games.index') }}">Back to games</a>
    {{-- edit game --}}
    <a href="{{ route('games.edit', ['game' => $game->id]) }}">Edit</a>
    {{-- delete game --}}
    <form action="{{ route('games.destroy', ['game' => $game->id]) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit">Delete</button>
    </form>
    <p>Price: €{{ $game->price / 100 }}</p>
    <p>Discount: {{ $game->discount }}%</p>
    <p>Release Date: {{ $game->release_date }}</p>
    <p>Developers:
        @foreach ($game->developers as $developer)
            <a href="{{ route('developers.show', ['developer' => $developer->id]) }}">
                {{ $developer->name }}</a>@if (!$loop->last), @endif
        @endforeach
    </p>
    <p>Publishers:
        @foreach ($game->publishers as $publisher)
            {{ $publisher->name }}@if (!$loop->last), @endif
        @endforeach
    </p>
    <p>Tags:
        @foreach ($game->tags as $tag)
            {{ $tag->name }}@if (!$loop->last), @endif
        @endforeach
    </p>
</x-layout>