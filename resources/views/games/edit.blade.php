<x-app-layout title="Edit Game {{ $game->name }}" basiclayout='true'>
    <a href="{{ route('games.index') }}" class="underline text-blue-500">Back to games</a>
    <br>
    <a href="{{ route('games.show', $game->id) }}" class="underline text-blue-500">Back to {{ $game->name }}</a>

    <form action="{{ route('games.update', $game->id) }}" method="POST" class="mt-6 space-y-6" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="space-y-4">
            <div>
                <x-input-label for="icon" :value="__('Icon')" />
                <x-file-input id="icon" name="icon" class="mt-1 block w-full"  />
                <x-input-error class="mt-2" :messages="$errors->get('icon')" />
            </div>

            <div>
                <x-input-label for="library_hero" :value="__('Library Hero')" />
                <x-file-input id="library_hero" name="library_hero" class="mt-1 block w-full"  />
                <x-input-error class="mt-2" :messages="$errors->get('library_hero')" />
            </div>

            <div>
                <x-input-label for="header" :value="__('Header')" />
                <x-file-input id="header" name="header" class="mt-1 block w-full"  />
                <x-input-error class="mt-2" :messages="$errors->get('header')" />
            </div>
            <div>
                <x-input-label for="name" :value="__('Name')" />
                <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="$game->name" required autofocus autocomplete="name" />
                <x-input-error class="mt-2" :messages="$errors->get('name')" />
            </div>

            <div>
                <x-input-label for="price" :value="__('Price')" />
                <x-text-input id="price" name="price" type="number" class="mt-1 block " :value="$game->price" required />
                <x-input-error class="mt-2" :messages="$errors->get('price')" />
            </div>

            <div>
                <x-input-label for="discount" :value="__('Discount')" />
                <x-text-input id="discount" name="discount" type="number" class="mt-1 block " :value="$game->discount" required />
                <x-input-error class="mt-2" :messages="$errors->get('discount')" />
            </div>

            <div>
                <x-input-label for="release_date" :value="__('Release Date')" />
                <x-text-input id="release_date" name="release_date" type="date" class="mt-1 block " :value="$game->release_date" required />
                <x-input-error class="mt-2" :messages="$errors->get('release_date')" />
            </div>

            <div>
                <x-input-label for="developers" :value="__('Developers')" />
                <x-select-input id="developers" name="developers[]" multiple class="mt-1 block resize">
                    @foreach ($developers as $developer)
                        <option value="{{ $developer->id }}"
                            @if ($game->developers->contains($developer->id)) selected @endif>
                            {{ $developer->name }}
                        </option>
                    @endforeach
                </x-select-input>
                <x-input-error class="mt-2" :messages="$errors->get('developers')" />
            </div>

            <div>
                <x-input-label for="tags" :value="__('Tags')" />
                <x-select-input id="tags" name="tags[]" multiple class="mt-1 block resize">
                    @foreach ($tags as $tag)
                        <option value="{{ $tag->id }}"
                            @if ($game->tags->contains($tag->id)) selected @endif>
                            {{ $tag->name }}
                        </option>
                    @endforeach
                </x-select-input>
                <x-input-error class="mt-2" :messages="$errors->get('tags')" />
            </div>
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>
        </div>
    </form>
</x-app-layout>
