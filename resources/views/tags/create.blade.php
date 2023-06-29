<x-app-layout title="Create New Tag" basiclayout='true'>
    <a href="{{ route('tags.index') }}" class="underline text-blue-500">Back to tags</a>

    <form action="{{ route('tags.store') }}" method="POST" class="mt-6 space-y-6">
        @csrf
        <div class="space-y-4">
            <div>
                <x-input-label for="name" :value="__('Name')" />
                <x-text-input id="name" name="name" type="text" class="mt-1 block" required autofocus autocomplete="name" />
                <x-input-error class="mt-2" :messages="$errors->get('name')" />
            </div>
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>
        </div>
    </form>
</x-app-layout>
