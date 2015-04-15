(function (window, $) {
    $.fn.radioButtonGroup = function (options) {
        return this.each(function () {
            var el = $(this),
                input = $(el.data('field'));

            options = $.extend({
                'activeState' :  'btn btn-success active',
                'defaultState' : 'btn btn-default',
                'change' : $.noop,
                'buttons' : {}
            }, options);

            input.on('change', options.change).trigger('change');

            el.find('button').on('click', function () {
                var value = $(this).data('value'),
                    buttonOptions = options.buttons[value],
                    activeState = buttonOptions && buttonOptions['activeState'] ? buttonOptions['activeState'] : options['activeState'],
                    defaultState = buttonOptions && buttonOptions['defaultState'] ? buttonOptions['defaultState'] : options['defaultState'];

                input.val(value).trigger('change');
                $(this).attr('class', activeState).siblings().each(function () {
                    var buttonOptions = options.buttons[$(this).data('value')],
                        defaultState = buttonOptions && buttonOptions['defaultState'] ? buttonOptions['defaultState'] : options['defaultState'];
                    $(this).attr('class', defaultState);
                });
            });
        });
    };
})(window, jQuery);