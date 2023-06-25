<x-app-layout title="Store" :basiclayout='false'>
    <x-slot name="header">
        @include('layouts.store-navbar')
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <form action="{{ route('games.search') }}" method="GET">
                <x-search-bar />
            </form>
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-fill">
                    {{-- Discounted games --}}
                    <h2 class="text-2xl font-semibold mb-4">Discounted games</h2>
                    <x-scroller.container id="discountedGames" :data="$discountedGames" view="games" :loadOnButtonPress="true" 
                        data-url="{{ route('get.store.discounts', ['perPage' => 5]) }}" />
                    {{-- New games --}}
                    <h2 class="text-2xl font-semibold mb-4">New games</h2>
                    <x-scroller.container id="newGames" :data="$newGames" view="games" :loadOnButtonPress="true" 
                        data-url="{{ route('get.store.new', ['perPage' => 5]) }}" />
                    {{-- Top sellers --}}
                    <h2 class="text-2xl font-semibold mb-4">Top sellers</h2>
                    <x-scroller.container id="topSellers" :data="$topSellers" view="games" :loadOnButtonPress="true" 
                        data-url="{{ route('get.store.top', ['perPage' => 5]) }}" />
                </div>
            </div>
        </div>
    </div>
</x-app-layout>