<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $developer->name }}</title>
</head>
<body>
    <h1>{{ $developer->name }}</h1>
    <a href="{{ route('developers.index') }}">Back to developers</a>
    <ul>
        <li>Name: {{ $developer->name }}</li>
        <li>Foundation Date: {{ $developer->founded_at }}</li>
        <li>Games:
            <ul>
                @foreach ($developer->games as $game)
                    <li>
                        <a href="{{ route('games.show', $game->id) }}">
                            {{ $game->name }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </li>
    </ul>
</body>
</html>