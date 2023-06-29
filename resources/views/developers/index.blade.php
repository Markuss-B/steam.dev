<x-app-layout title="Developers" :basiclayout='true'>
    @hasrole('admin')
        <x-slot name="header">
            <div class="flex justify-between">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('Developers') }}
                </h2>
                <a href="{{ route('developers.create') }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                    {{ __('Create New Developer') }}
                </a>
            </div>
        </x-slot>
    @endhasrole
    {{-- create new developer --}}
    @auth
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
    <x-scroller.container :view="'developers'" :data="$developers" :id="'developers'" :loadOnButtonPress="false" />
</x-app-layout>