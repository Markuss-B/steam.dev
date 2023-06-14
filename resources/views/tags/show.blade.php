<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{$tag->name}}</title>
</head>
<body>
    <h1>{{ $tag->name }}</h1>
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
    <ul>
        @foreach ($tag->games as $game)
            <li>
                <a href="{{ route('games.show', ['game' => $game->id]) }}">
                    {{ $game->name }}
                </a>
            </li>
        @endforeach
    </ul>
</body>
</html>