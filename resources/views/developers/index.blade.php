<x-app-layout title="Developers" :basiclayout='true'>
    {{-- create new developer --}}
    <a href="{{ route('developers.create') }}">Create new developer</a>
    <x-scroller.container :view="'developers'" :data="$developers" />
</x-app-layout>