<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{$game->name}}</title>
</head>
<body>
    <h1>{{ $game->name }}</h1>
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
</body>
</html>