<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Games</title>
</head>
<body>
    <h1>Games</h1>
    {{-- create new game --}}
    <a href="{{ route('games.create') }}">Create new game</a>
    {{-- list of games --}}
    <table>
        <thead>
            <tr>
                <th>Game</th>
                <th>Price</th>
                <th>Discount</th>
                <th>Release Date</th>
                <th>Developer</th>
                <th>Publisher</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($games as $game)
                <tr>
                    <td>
                        <a href="{{ route('games.show', ['game' => $game->id]) }}">
                            {{ $game->name }}
                        </a>
                    </td>
                    <td>€{{ $game->price / 100 }}</td>
                    <td>{{ $game->discount }}%</td>
                    <td>{{ $game->release_date }}</td>
                    <td>
                        @foreach ($game->developers as $developer)
                            {{ $developer->name }}@if (!$loop->last), @endif
                        @endforeach
                    </td>
                    <td>
                        @foreach ($game->publishers as $publisher)
                            {{ $publisher->name }}
                        @endforeach
                    </td>
                    <td>
                        {{-- edit game --}}
                        <a href="{{ route('games.edit', ['game' => $game->id]) }}">Edit</a>
                        {{-- delete game --}}
                        <form action="{{ route('games.destroy', ['game' => $game->id]) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Delete</button>
                        </form>
                </tr>
            @endforeach
</body>
</html>