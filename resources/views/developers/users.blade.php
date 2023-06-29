<x-app-layout title="Add developer for {{ $developer->name }}" :basiclayout='true'>
    <h2 class="text-2xl font-semibold text-black">
        {{ __('Developers for') }}: {{ $developer->name }}
    </h2>
    @forelse ($developer->users as $user)
        <x-user-card :user="$user">
                <form action="{{ route('developers.remove-user', ['developer' => $developer, 'user' => $user]) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <x-secondary-button type="submit" class="bg-red-500 hover:bg-red-700">
                        {{ __('Remove') }}
                    </x-secondary-button>
                </form>
        </x-user-card>
    @empty
        <p class="text-xl font-semibold text-black">
            {{ __('No users found') }}
        </p>
    @endforelse

    <h2 class="text-2xl font-semibold text-black">
        {{ __('Add developers for') }}: {{ $developer->name }}
    </h2>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
        <form action="{{ route('users.index') }}" method="GET">
            <x-search-bar />
        </form>
        </div>
    @foreach ($users as $user)
        <x-user-card :user="$user">
            @if ($developer->users->contains($user))
                <form action="{{ route('developers.remove-user', ['developer' => $developer, 'user' => $user]) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <x-secondary-button class="bg-red-500 hover:bg-red-700">
                        {{ __('Remove') }}
                    </x-secondary-button>
                </form>
            @else
                <form action="{{ route('developers.add-user', ['developer' => $developer, 'user' => $user]) }}" method="POST">
                    @csrf
                    @method('post')
                    <x-secondary-button type="submit" class="bg-green-500 hover:bg-green-700">
                        {{ __('Add') }}
                    </x-secondary-button>
                </form>
            @endif
        </x-user-card>
    @endforeach
</x-app-layout>