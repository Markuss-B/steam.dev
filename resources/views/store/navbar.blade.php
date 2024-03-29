<nav>
    <div class="flex">
        <!-- Navigation Links -->
        <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
            <x-nav-link :href="route('developers.index')" :active="request()->routeIs('developers.index')">
                {{ __('Developers') }}
            </x-nav-link>
        </div>
        <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
            <x-nav-link :href="route('tags.index')" :active="request()->routeIs('tags.index')">
                {{ __('Tags') }}
            </x-nav-link>
        </div>
        <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
            <x-nav-link :href="route('balance')" :active="request()->routeIs('balance')">
                {{ __('Balance') }}
            </x-nav-link>
        </div>
        <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
            <x-nav-link :href="route('store.purchases')" :active="request()->routeIs('store.purchases')">
                {{ __('Purchases') }}
            </x-nav-link>
        </div>
    </div>
</nav>