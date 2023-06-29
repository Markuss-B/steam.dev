<x-app-layout title="Tags" :basiclayout='true'>
    @hasrole('admin')
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Tags') }}
            </h2>
            <a href="{{ route('tags.create') }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                {{ __('Create New Tag') }}
            </a>
        </div>
    </x-slot>
    @endhasrole
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