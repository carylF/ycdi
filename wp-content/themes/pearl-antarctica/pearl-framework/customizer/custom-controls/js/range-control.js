(function ($) {
    $(document).ready(function ($) {

        // range control value
        $('input[data-input-type]').on('input change', function () {
            var val = $(this).val();
            $(this).prev('.pearl-range-value').html(val);
            $(this).val(val);
        });
    })
})(jQuery);