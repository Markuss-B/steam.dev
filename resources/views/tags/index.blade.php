<x-app-layout title="Tags" :basiclayout='true'>
    {{-- create new tag --}}
    @auth
        @hasrole('admin')
            <a href="{{ route('tags.create') }}">
                <x-primary-button class="mb-4">
                    {{ __('Create new tag') }}
                </x-primary-button>
            </a>
        @endhasrole
    @endauth
    <ul>
        @foreach ($tags as $tag)
            <li>
                <a href="{{ route('tags.show', ['tag' => $tag->id]) }}">
                    <x-secondary-button class="mb-4">
                        {{ $tag->name }}
                    </x-secondary-button>
                </a>
            </li>
        @endforeach
    </ul>
</x-app-layout>