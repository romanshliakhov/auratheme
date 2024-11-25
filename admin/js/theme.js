var Admin = (function ($) {
    $(function () {
        Admin.init();
    });
    return {
        init: function () {
            var _self = this;
            _self.bindEvents();

        },
        bindEvents: function () {
            var self = this;

            jQuery('.musthave_js').closest('tr').find('input[type="checkbox"]').remove();

            /**
             * Show Module screenshot in admin panel
             */
            $(document).on('mouseover', '.acf-tooltip.acf-fc-popup a', function () {
                var $link = $(this);
                var name = $link.data('layout');
                var path = theme_js_params.theme_path + '/admin/acf-flex-preview/' + name + '.jpg';

                if($link.next('.acf-fc-popup__preview').length < 1){
                    var $insert = $('<div class="acf-fc-popup__preview"><img src="' + path + '" alt="' + name + '"/></div>');
                    $insert.insertAfter($link);
                }
            });

        }
    };
})(jQuery);



