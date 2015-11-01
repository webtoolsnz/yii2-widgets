(function (window, $) {

    function resizeCanvas(canvas) {
        var ratio =  window.devicePixelRatio || 1;
        canvas.width = canvas.offsetWidth * ratio;
        canvas.height = canvas.offsetHeight * ratio;
        canvas.getContext("2d").scale(ratio, ratio);
    }

    $.fn.signatureWidget = function (options) {
        return this.each(function () {
            var input = $(this);
            var ts = Date.now();
            var data = input.val();
            var toggleContent = "<span class=\"sig-placeholder\">Click here to sign</span>";

            options = $.extend({
                'canvasClass' :  'signaturePad',
                'modal' : {
                    'title' : 'Sign Below',
                    'buttons' : [
                        '<button type="button" class="btn btn-default sig-clear">Clear</button>',
                        '<button type="button" class="btn btn-primary sig-save">Save</button>',
                    ]
                },
            }, options);

            var tpl = [
                "<a class=\"sig-toggle\" id=\""+ts+"_toggle\" href=\"#\" data-toggle=\"modal\" data-target=\"#"+ts+"_modal\">",
                (data !== '' && data.length > 0) ? '<img src="'+data+'">' : toggleContent,
                "</a>",
                "<div id=\""+ts+"_modal\" class=\"modal fade\">",
                "<div class=\"modal-dialog\">",
                "<div class=\"modal-content\">",
                "<div class=\"modal-header\">",
                "<button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button>",
                "<h4 class=\"modal-title\">"+options.modal.title+"</h4>",
                "</div>",
                "<div class=\"modal-body\">",
                "<canvas id=\""+ts+"_canvas\" class=\""+options.canvasClass+"\" />",
                "</div>",
                "<div class=\"modal-footer\">",
                options.modal.buttons.join(' '),
                "</div></div></div>"
            ];

            input.after(tpl.join(' '));

            var modal = $('#'+ts+'_modal');
            var canvas = modal.find('canvas').get(0);
            var signaturePad = new SignaturePad(canvas);
            var toggle = $('#'+ts+'_toggle');

            modal.data('initialized', false);
            /**
             * When modal is shown
             */
            modal.on('shown.bs.modal', function () {
                if (modal.data('initialized') == false) {
                    resizeCanvas(canvas);
                }
                var value = input.val();
                if (value && 0 < value.length) {
                    signaturePad.fromDataURL(input.val());
                }
            });

            /**
             * Click the save button
             */
            modal.delegate('.sig-save', 'click', function (e) {
                if (!signaturePad.isEmpty()) {
                    var data = signaturePad.toDataURL();
                    input.val(data);
                    toggle.html('<img src="'+data+'">');
                }


                modal.modal('hide');
            });

            /**
             * Click the clear button
             */
            modal.delegate('.sig-clear', 'click', function (e) {
                signaturePad.clear();
                input.val('');
                toggle.html(toggleContent);
            });

            modal.on('hide.bs.modal', function () {
                signaturePad.clear();
            });
        });
    };
})(window, jQuery);