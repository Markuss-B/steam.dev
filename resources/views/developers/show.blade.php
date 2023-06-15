<x-layout title="{{ $developer->name }}">
    <a href="{{ route('developers.index') }}">Back to developers</a>
    <a href="{{ route('developers.edit', $developer->id) }}">Edit</a>
    <form action="{{ route('developers.destroy', $developer->id) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit">Delete</button>
    </form>
    <ul>
        <li>Name: {{ $developer->name }}</li>
        <li>Foundation Date: {{ $developer->founded_at }}</li>
        <li>Games:
            <table>
                <thead>
                    <tr>
                        <th>Game</th>
                        <th>Price</th>
                        <th>Discount</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($developer->games as $game)
                        <x-game-card :game="$game" />
                    @endforeach
                </tbody>
            </table>
        </li>
    </ul>
</x-layout>