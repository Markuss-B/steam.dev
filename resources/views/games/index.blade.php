<x-app-layout title="Games" :basiclayout='true'>
    {{-- create new game --}}
    @hasrole('admin')
        <x-slot name="header">
            <div class="flex justify-between">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('Games') }}
                </h2>
                <a href="{{ route('games.create') }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                    {{ __('Create New Game') }}
                </a>
            </div>
        </x-slot>
    @endhasrole
    {{-- search games --}}
    <form action="{{ route('games.search') }}" method="GET">
        <x-search-bar />
    </form>
    {{-- list of games --}}
    <x-scroller.container :view="'games'" :data="$games" loadon/>
</x-app-layout>
