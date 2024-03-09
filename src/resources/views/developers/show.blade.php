<x-app-layout title="{{ $developer->name }}" :basiclayout='true'>
    <a href="{{ route('developers.index') }}">
        <x-primary-button class="mb-4">
            {{ __('Back to Developers') }}
        </x-primary-button>
    </a>
    @auth
        @hasanyrole(['developer', 'admin'])
            @if (Auth::user()->developers->contains($developer) || Auth::user()->hasRole('admin'))
                <a href="{{ route('developers.games.create', $developer->id) }}">
                    <x-primary-button class="mb-4">
                        {{ __('Create New Game') }}
                    </x-primary-button>
                </a>
                <a href="{{ route('developers.edit', $developer->id) }}">
                    <x-primary-button class="mb-4">
                        {{ __('Edit Developer') }}
                    </x-primary-button>
                </a>
            @endif
        @endhasanyrole
        @hasrole('admin')
            <a href="{{ route('developers.users', $developer->id) }}">
                <x-primary-button class="mb-4">
                    {{ __('Manage Users') }}
                </x-primary-button>
            </a>
            <form action="{{ route('developers.destroy', $developer->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <x-primary-button class="mb-4">
                    {{ __('Delete Developer') }}
                </x-primary-button>
            </form>
        @endhasrole
    @endauth
    <h2 class="text-2xl font-semibold text-black">
        {{ __('Developer') }}: {{ $developer->name }}
    </h2>
    <p class="text-xl font-semibold text-black">
        {{ __('Founded') }}: {{ $developer->founded_at }}
    </p>
    @if ($developer->description)
        <p class="text-xl font-semibold text-black">
            {{ __('Description') }}: {{ $developer->description }}
        </p>
    @endif
    <h2 class="text-2xl font-semibold text-black">
        {{ __('Games') }}
    </h2>
    <div class="w-full flex flex-wrap justify-around">
        @foreach ($developer->games as $game)
            <x-game-card :game="$game" link="{{ route('games.show', ['game' => $game->id]) }}" showPrice="true" />
        @endforeach
    </div>
</x-app-layout>