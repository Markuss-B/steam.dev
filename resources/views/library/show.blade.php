<x-app-layout title="Library" basiclayout="true">
    <h1>{{ $game->name }}</h1>
    <p>Play time: {{ $game->pivot->play_time }}</p>
    <p>Acquired: {{ $game->pivot->acquisition_date }}</p>
    <p>Favorite: {{ $game->pivot->is_favorite }}</p>
    @if ($game->pivot->is_favorite)
        <form action="{{ route('library.unfavorite', ['game' => $game->id]) }}" method="POST">
            @csrf
            <input type="hidden" name="is_favourite" value="0">
            <x-primary-button type="submit">
                {{ __('Unmark as favorite') }}
            </x-primary-button>
        </form>
    @else
        <form action="{{ route('library.favorite', ['game' => $game->id]) }}" method="POST">
            @csrf
            <input type="hidden" name="is_favourite" value="1">
            <x-primary-button type="submit">
                {{ __('Mark as favorite') }}
            </x-primary-button>
        </form>
    @endif

</x-app-layout>