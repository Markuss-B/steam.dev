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
            <a href="{{ route('developers.show', ['developer' => $developer->id]) }}">
                {{ $developer->name }}</a>@if (!$loop->last), @endif
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