<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $game->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">

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
        <x-secondary-button disabled>
            {{ __('Owned') }}
        </x-secondary-button>
    @else
        <p>Price: {{ $game->price / 100 }}</p>
        @if ($game->discount > 0)
            <p>Discount: {{ $game->discount }}</p>
            <p>Price with discount: {{ $game->price - ($game->price * $game->discount / 100) }}</p>
        @endif

        <form action="{{ route('game.purchase', ['game' => $game->id]) }}" method="POST">
            @csrf
            <x-primary-button>
                {{ __('Purchase') }}
            </x-primary-button>
        </form>
    @endif

</x-app-layout>