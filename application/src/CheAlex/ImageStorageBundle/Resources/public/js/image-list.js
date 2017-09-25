(function ($, undefined) {
    $(function () {
        var trackViewUrl = $(document.head).find('meta[name="image_track_url"]').attr('content');

        $('#images img').click(function () {
            var imageId  = $(this).data('id');
            var imageUrl = $(this).attr('src');

            $.get(trackViewUrl, {
                'imageId': imageId
            });

            window.open(imageUrl, 'bigwin', 'width=600,height=600,status=yes,resizable=yes');
        });
    });
})(jQuery);
