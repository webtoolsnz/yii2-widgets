(function (window, $) {
    $.fn.progressiveDatePicker = function (value, options) {
        return this.each(function () {
            var el = $(this);
            if (!Modernizr.touch || !Modernizr.inputtypes || !Modernizr.inputtypes.date) {
                try {
                    el.attr('type', 'text');
                } catch (e) {}
                el.val(value);
                el.datepicker(options);
            }
        });
    };
})(window, jQuery);
