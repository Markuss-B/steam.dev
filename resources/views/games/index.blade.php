<x-app-layout title="Games" :basiclayout='true'>
    {{-- create new game --}}
    <a href="{{ route('games.create') }}">Create new game</a>
    {{-- list of games --}}
    <x-scroller.container :view="'games'" :data="$games" />
</x-app-layout>
