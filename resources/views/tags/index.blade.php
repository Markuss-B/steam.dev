<x-app-layout title="Tags" :basiclayout='true'>
    {{-- create new tag --}}
    <a href="{{ route('tags.create') }}">Create new tag</a>
    <ul>
        @foreach ($tags as $tag)
            <li>
                <a href="{{ route('tags.show', ['tag' => $tag->id]) }}">
                    {{ $tag->name }}
                </a>
            </li>
        @endforeach
    </ul>
</x-app-layout>