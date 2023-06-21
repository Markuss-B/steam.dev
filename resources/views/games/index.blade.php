<x-app-layout title="Games" :basiclayout='true'>
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
            @endforeach
        </tbody>
    </table>
</x-app-layout>