<x-app-layout title="Developers" :basiclayout='true'>
    {{-- create new developer --}}
    <a href="{{ route('developers.create') }}">Create new developer</a>
    <div id="developers-container" class="jscroll w-full flex flex-wrap justify-around">
        @include('developers.load')
    </div>
</x-app-layout>

<script type="text/javascript">
    $(document).ready(function () {
        let nextPageUrl = '{{ $developers->nextPageUrl() }}';
        $(window).scroll(function () {
            if ($(window).scrollTop() + $(window).height() >= $(document).height() - 100) {
                if (nextPageUrl) {
                    loadMoreDevelopers();
                }
            }
        });
        function loadMoreDevelopers() {
            $.ajax({
                url: nextPageUrl,
                type: 'get',
                beforeSend: function () {
                    nextPageUrl = '';
                },
                success: function (data) {
                    nextPageUrl = data.nextPageUrl;
                    $('#developers-container').append(data.view);
                },
                error: function (xhr, status, error) {
                    console.error("Error loading more developers:", error);
                }
            });
        }
    });
</script>