(function (window, $) {
    $.fn.checkboxButtonGroup = function (options) {
        return this.each(function () {
            var el = $(this),
                input = $();

            options = $.extend({
                'activeState' :  'btn btn-success active',
                'defaultState' : 'btn btn-default',
                'change' : $.noop,
                'buttons' : {},
                'checkboxes' : {}
            }, options);
            input = $(options.checkboxes).find(':checkbox');
            input.on('change', options.change).trigger('change');

            el.find('button').on('click', function () {
                var value = $(this).data('value'),
                    btn = this,
                    buttonOptions = options.buttons[value],
                    activeState = buttonOptions && buttonOptions['activeState'] ? buttonOptions['activeState'] : options['activeState'],
                    defaultState = buttonOptions && buttonOptions['defaultState'] ? buttonOptions['defaultState'] : options['defaultState'];

                input.filter(function () {
                    return $(this).attr('value') == value;
                }).each(function () {
                    this.checked = !this.checked;
                    $(btn).attr('class', this.checked ? activeState : defaultState);
                });

            });
        });
    };
})(window, jQuery);
