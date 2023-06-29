<tr>
    <td>
        <a href="{{ route('games.show', ['game' => $game->id]) }}">
            <img src="{{ $game->header }}" alt="{{ $game->name }}" class="w-24">
        </a>
    </td>
    <td>
        <a href="{{ route('games.show', ['game' => $game->id]) }}" class="underline hover:text-blue-500">
            {{ $game->name }}
        </a>
    </td>
    <td>€{{ $game->price / 100 }}</td>
    <td>{{ $game->discount }}%</td>
    <td>{{ $game->release_date }}</td>
    <td>
        @foreach ($game->developers as $developer)
            <a href="{{ route('developers.show', ['developer' => $developer->id]) }}" class="underline hover:text-blue-500">
                {{ $developer->name }}</a>@if (!$loop->last), @endif
        @endforeach
    </td>
    {{-- <td>
        @foreach ($game->publishers as $publisher)
            {{ $publisher->name }}
        @endforeach
    </td> --}}
    @hasrole('admin')
    <td>
        {{-- edit game --}}
        <a href="{{ route('games.edit', ['game' => $game->id]) }}">Edit</a>
        {{-- delete game --}}
        <form action="{{ route('games.destroy', ['game' => $game->id]) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit">Delete</button>
        </form>
    </td>
    @endhasrole
</tr>