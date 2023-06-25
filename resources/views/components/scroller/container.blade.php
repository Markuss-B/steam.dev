<div id="{{ $id }}-scroller"
    class="jscroll w-full flex flex-wrap justify-around" 
    data-url="{{ $dataUrl ?? $data->nextPageUrl() }}">

    @include('components.scroller.load', ['view' => $view, 'data' => $data])

</div>
@if ($loadOnButtonPress)
    <button id="{{ $id }}-scroller-button" class="w-full bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold py-2 px-4 rounded-b">
        Load more
    </button>
@endif
@include('components.scroller.script')