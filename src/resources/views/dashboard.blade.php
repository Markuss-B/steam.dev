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
    @hasrole('developer')
        <h2 class="text-2xl font-semibold text-gray-800">You are developer of</h2>
        @foreach (Auth::user()->developers as $developer)
            <x-dev-card :dev="$developer" />
        @endforeach
    @endhasrole
</x-app-layout>