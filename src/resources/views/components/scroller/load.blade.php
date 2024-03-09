@include('components.scroller.' . $view, [$view => $data])

<div class="hidden">
    {{ $data->appends(request()->query())->links() }}
</div>
