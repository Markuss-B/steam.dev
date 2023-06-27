<x-app-layout title="Your profile" :basiclayout='true'>
    <x-profile-header :user="$user" />

    <div class="mt-8 mb-4">
        <h2 class="text-2xl font-semibold">Your games</h2>
    </div>
    <x-user-games-info :user="$user" />
</x-app-layout>