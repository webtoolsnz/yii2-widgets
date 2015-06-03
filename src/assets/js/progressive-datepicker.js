(function (window, $) {
    $.fn.progressiveDatePicker = function (options) {
        return this.each(function () {
            var el = $(this);
            if (!Modernizr.inputtypes || !Modernizr.inputtypes.date) {
                el.datepicker(options);
            }
        });
    };
})(window, jQuery);