<x-app-layout title="Library" basiclayout="true">
<ul>
    {{-- check if has games --}}
    @if (!$games)
        <p>No games in library</p>
    @else
        <p>Games in library:</p>
        @foreach ($games as $game)
            <li>
                <a href="{{ route('library.show', ['game' => $game->id]) }}">
                    {{ $game->name }}
                </a>
            </li>
        @endforeach
    @endif
</ul>
</x-app-layout>