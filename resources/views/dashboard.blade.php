<x-app-layout title="Admin panel" :basiclayout='true'>
    @foreach ($models as $model => $actions)
        <h2 class="text-2xl font-semibold text-gray-800">{{ Str::ucfirst($model) }}</h2>
        {{-- model index link--}}
        <a href="{{ route($model.'.index') }}">
            <x-secondary-button>View {{ $model }}</x-secondary-button>
        </a>
        @foreach ($actions as $action => $route)
            @if ($action == 'create')
                <a href="{{ route($route) }}">
                    <x-secondary-button>{{ $action }}</x-secondary-button>
                </a>
            @endif
        @endforeach
    @endforeach
</x-app-layout>