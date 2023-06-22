<x-app-layout title="Developers" :basiclayout='true'>
    {{-- create new developer --}}
    <a href="{{ route('developers.create') }}">Create new developer</a>
    <div class="w-full flex flex-wrap justify-around">
        @foreach ($developers as $developer)
            <x-dev-card :dev="$developer"/>
        @endforeach
    </div>
</x-app-layout>