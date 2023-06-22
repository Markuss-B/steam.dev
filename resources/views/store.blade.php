<x-app-layout title="Store" :basiclayout='true'>
    <x-slot name="header">
        @include('layouts.store-navbar')
    </x-slot>
    <div class="w-full flex flex-wrap justify-between">
        @foreach ($games as $game)
            <x-game-card :game="$game" link="{{ route('games.show', ['game' => $game->id]) }}" showPrice="true" />
        @endforeach
    </div>
</x-app-layout>