(function (window, $) {
    $.fn.progressiveDatePicker = function (value, options) {
        return this.each(function () {
            var el = $(this);
            if (!Modernizr.touch || !Modernizr.inputtypes || !Modernizr.inputtypes.date) {
                el.attr('type', 'text');
                el.val(value);
                el.datepicker(options);
            }
        });
    };
})(window, jQuery);