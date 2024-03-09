@foreach($developers as $developer)
    <x-dev-card :dev="$developer"/>
@endforeach

<div class="hidden">
    {{ $developers->appends(request()->query())->links() }}
</div>