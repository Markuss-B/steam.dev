<x-app-layout title="Edit Developer {{ $developer->name }}" basiclayout='true'>
    <section class="space-y-4">
        <div>
            <a href="{{ route('developers.index') }}" class="underline text-blue-500">{{ __('Back to developers') }}</a>
        </div>
        <div>
            <a href="{{ route('developers.show', $developer->id) }}" class="underline text-blue-500">{{ __('Back to') }} {{ $developer->name }}</a>
        </div>
    </section>

    <form action="{{ route('developers.update', $developer->id) }}" method="POST" class="mt-6 space-y-6">
        @csrf
        @method('PUT')

        <div class="space-y-4">
            <div>
                <x-input-label for="name" :value="__('Name')" />
                <x-text-input id="name" name="name" type="text" class="mt-1 block" :value="old('name', $developer->name)" required autofocus autocomplete="name" />
                <x-input-error class="mt-2" :messages="$errors->get('name')" />
            </div>

            <div>
                <x-input-label for="founded_at" :value="__('Founded At')" />
                <x-text-input id="founded_at" name="founded_at" type="date" class="mt-1 block" :value="old('founded_at', $developer->founded_at)" required />
                <x-input-error class="mt-2" :messages="$errors->get('founded_at')" />
            </div>

            <div>
                <x-input-label for="description" :value="__('Description')" />
                <x-text-area-input id="description" name="description" type="text" class="mt-1 block w-full resize" required>
                    {{ old('description', $developer->description) }}
                </x-text-area-input>
                <x-input-error class="mt-2" :messages="$errors->get('description')" />
            </div>
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Update') }}</x-primary-button>
        </div>
    </form>
</x-app-layout>
