<script type="text/javascript">
    $(document).ready(function () {
        let container = $('#{{ $id }}-scroller');
        let nextPageUrl = '{{ $data->nextPageUrl() }}';
        console.log(nextPageUrl);
        let loadOnButtonPress = {{ $loadOnButtonPress ? 'true' : 'false' }};

        if (loadOnButtonPress) {
            $('#{{ $id }}-scroller-button').click(function () {
                if (nextPageUrl) {
                    console.log(nextPageUrl);
                    loadMoreData();
                }
            });
        } else {
            $(window).scroll(function () {
                if ($(window).scrollTop() + $(window).height() >= $(document).height() - 100) {
                    if (nextPageUrl) {
                        loadMoreData();
                    }
                }
            });
        }

        // clearScroller();
        // function clearScroller() {
        //     container.empty();
        //     loadMoreData();
        // }

        function loadMoreData() {
            $.ajax({
                url: nextPageUrl,
                type: 'get',
                beforeSend: function () {
                    nextPageUrl = '';
                    $('#{{ $id }}-scroller-button').html('Loading...');
                },
                success: function (data) {
                    nextPageUrl = data.nextPageUrl;
                    container.append(data.view);
                    if (!nextPageUrl) {
                        $('#{{ $id }}-scroller-button').remove();
                    } else {
                        $('#{{ $id }}-scroller-button').html('Load more');
                    }
                },
                error: function (xhr, status, error) {
                    console.error("Error loading more data:", error);
                    console.log(xhr.responseText);
                }
            });
        }
    });
</script>
