<x-app-layout title="Admin panel" :basiclayout='true'>
    @foreach ($models as $model => $actions)
        <h2 class="text-2xl font-semibold text-gray-800">{{ $model }}</h2>
        <ul>
        @foreach ($actions as $action => $route)
            {{ $route }}
        @endforeach
        </ul>
    @endforeach
</x-app-layout>