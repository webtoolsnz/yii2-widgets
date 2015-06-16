(function (window, $) {
    $.fn.progressiveDatePicker = function (value, options) {
        return this.each(function () {
            var el = $(this);
            if (!Modernizr.inputtypes || !Modernizr.inputtypes.date) {
                el.val(value);
                el.datepicker(options);
            }
        });
    };
})(window, jQuery);