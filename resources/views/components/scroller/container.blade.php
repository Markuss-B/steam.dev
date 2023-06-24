{{ $view }}
<div
    class="jscroll w-full flex flex-wrap justify-around" 
    data-url="{{ $data->nextPageUrl() }}">

    @include('components.scroller.load', ['view' => $view, 'data' => $data])
</div>
@include('components.scroller.script')
