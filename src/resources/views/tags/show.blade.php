<x-app-layout title="Tag: {{ $tag->name }}" :basiclayout='true'>
    @auth
        @hasrole('admin')
            <a href="{{ route('tags.edit', $tag) }}">
                <x-primary-button class="mb-4">
                    {{ __('Edit Tag') }}
                </x-primary-button>
            </a>
            <form action="{{ route('tags.destroy', $tag->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <x-primary-button class="mb-4">
                    {{ __('Delete Tag') }}
                </x-primary-button>
            </form>
        @endhasrole
    @endauth
    {{-- list of games --}}
    <h2 class="text-xl">{{ $tag->name }} games</h2>
    <div class="w-full flex flex-wrap justify-between">
        @foreach ($tag->games as $game)
            <x-game-card :game="$game" link="{{ route('games.show', ['game' => $game->id]) }}" showPrice="true" />
        @endforeach
    </div>
</x-app-layout>