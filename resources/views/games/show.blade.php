<x-app-layout title="{{ $game->name }}" :basiclayout='true'>

    <h2 class="text-xl">{{ $game->name }}</h2>
    <p>Release Date: {{ $game->release_date }}</p>
    <p>Developers:
        @foreach ($game->developers as $developer)
            <a href="{{ route('developers.show', ['developer' => $developer->id]) }}">
                {{ $developer->name }}</a>@if (!$loop->last), @endif
        @endforeach
    </p>
    <p>Publishers:
        @foreach ($game->publishers as $publisher)
            {{ $publisher->name }}@if (!$loop->last), @endif
        @endforeach
    </p>
    <p>Tags:
        @foreach ($game->tags as $tag)
            {{ $tag->name }}@if (!$loop->last), @endif
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