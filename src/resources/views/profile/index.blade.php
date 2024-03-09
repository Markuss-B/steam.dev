<x-app-layout title="All users" :basiclayout='true'>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
        <form action="{{ route('users.index') }}" method="GET">
            <x-search-bar />
        </form>
        </div>
    @foreach ($users as $user)
        <x-user-card :user="$user"/>
    @endforeach
</x-app-layout>