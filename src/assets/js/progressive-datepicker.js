(function (window, $) {
    $.fn.progressiveDatePicker = function (value, options) {
        return this.each(function () {
            var el = $(this);
            if (!Modernizr.touch || !Modernizr.inputtypes || !Modernizr.inputtypes.date) {
                el.val(value);
                el.attr('type', 'text');
                el.datepicker(options);
            }
        });
    };
})(window, jQuery);