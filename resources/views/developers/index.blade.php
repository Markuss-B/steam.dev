<x-app-layout title="Developers" :basiclayout='true'>
    {{-- create new developer --}}
    @auth
        @if (Auth::user()->hasPermissionTo('developers.create'))
        <a href="{{ route('developers.create') }}">
            <x-primary-button class="mb-4">
                {{ __('Create New Developer') }}
            </x-primary-button>
        </a>
        @endif
        @hasrole('developer')
            <h2 class="text-2xl font-semibold text-black">
                {{ __('You are a developer of') }}
            </h2>
            @foreach (Auth::user()->developers as $developer)
                <div class="flex flex-row flex-wrap">
                    <x-dev-card :dev="$developer" />
                </div>
            @endforeach
        @endhasrole
    @endauth
    {{-- list of developers --}}
    <h2 class="text-2xl font-semibold text-black">
        {{ __('Developers') }}
    </h2>
    <x-scroller.container :view="'developers'" :data="$developers" />
</x-app-layout>