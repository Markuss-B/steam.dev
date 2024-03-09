<x-app-layout title="{{ $game->name }}" :basiclayout='true'>
    <x-slot name="header">
        <div class="flex ">
        {{-- icon --}}
        <img src="{{ $game->icon }}" alt="{{ $game->name }} icon" class="w-10 rounded-lg shadow-lg">
        {{-- name --}}
        <h2 class="text-2xl font-semibold text-gray-800 leading-tight ml-4">
            {{ $game->name }}
        </h2>
        </div>
    </x-slot>
    @auth
        @hasrole('admin')
            <a href="{{ route('games.edit', $game->id) }}">
                <x-primary-button class="mb-4">
                    {{ __('Edit Game') }}
                </x-primary-button>
            </a>
            <form action="{{ route('games.destroy', $game->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <x-primary-button class="mb-4">
                    {{ __('Delete Game') }}
                </x-primary-button>
            </form>
        @endhasrole
        @hasrole('developer')
            @foreach (Auth::user()->developers as $developer)
                @if ($developer->isDeveloperOf($game))
                    <a href="{{ route('developers.games.edit', ['developer' => $developer->id, 'game' => $game->id]) }}">
                        <x-primary-button class="mb-4">
                            {{ __('Edit Game as') }} {{ $developer->name }}
                        </x-primary-button>
                    </a>
                @endif
            @endforeach
        @endhasrole
    @endauth

    <img src="{{ $game->header }}" alt="{{ $game->name }} header" class="h-64 w-auto">
    <h2 class="text-xl">{{ $game->name }}</h2>
    <p>Release Date: {{ $game->release_date }}</p>
    <p>Developers:
        @foreach ($game->developers as $developer)
            <a href="{{ route('developers.show', ['developer' => $developer->id]) }}" class="underline hover:text-blue-500">
                {{ $developer->name }}</a>@if (!$loop->last), @endif
        @endforeach
    </p>
    {{-- <p>Publishers:
        @foreach ($game->publishers as $publisher)
            {{ $publisher->name }}@if (!$loop->last), @endif
        @endforeach
    </p> --}}
    <p>Tags:
        @foreach ($game->tags as $tag)
            <a href="{{ route('tags.show', ['tag' => $tag->id]) }}" class="underline hover:text-blue-500">
                {{ $tag->name }}</a>@if (!$loop->last), @endif
        @endforeach
    </p>
    {{-- purchase --}}
    @if ($game->userOwnsGame())
        <x-primary-button disabled>
            {{ __('Owned') }}
        </x-primary-button>
    @else
        <p>Price: {{ $game->price / 100 }}</p>
        @if ($game->discount > 0)
            <p>Discount: -{{ $game->discount }}%</p>
            <p>Price without discount: {{ number_format($game->price / 100 * 100 / (100 - $game->discount), 2) }}</p>
        @endif

        <form action="{{ route('game.purchase', ['game' => $game->id]) }}" method="POST">
            @csrf
            <x-primary-button>
                {{ __('Purchase') }}
            </x-primary-button>
        </form>
    @endif

</x-app-layout>