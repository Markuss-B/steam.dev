<script type="text/javascript">
    $(document).ready(function () {
        let container = $('.jscroll');
        let nextPageUrl = container.data('url'); // Retrieve the URL from data attribute
        $(window).scroll(function () {
            if ($(window).scrollTop() + $(window).height() >= $(document).height() - 100) {
                if (nextPageUrl) {
                    loadMoreData();
                }
            }
        });
        function loadMoreData() {
            $.ajax({
                url: nextPageUrl,
                type: 'get',
                beforeSend: function () {
                    nextPageUrl = '';
                },
                success: function (data) {
                    nextPageUrl = data.nextPageUrl;
                    container.append(data.view);
                },
                error: function (xhr, status, error) {
                    console.error("Error loading more data:", error);
                    console.log(xhr.responseText);
                }
            });
        }
    });
</script>
