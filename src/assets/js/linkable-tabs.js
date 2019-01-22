jQuery(function () {
    // Javascript to enable link to tab
    var url = document.location.toString();
    if (url.match('#')) {
        $('.wt-tabs.nav-tabs a[href="#'+url.split('#')[1]+'"]').tab('show') ;
    }

    // Change hash for page-reload
    $('.wt-tabs.nav-tabs a').on('shown.bs.tab', function (e) {
        var scrollPos = $('body').scrollTop();
        window.location.hash = e.target.hash;
        if (scrollPos !== 0) {
           $('html,body').scrollTop(scrollPos);
        }
    });

    // Append Tab hash to any forms that reside within a tab.
    $('.tab-content .tab-pane form').each(function () {
        var action = $(this).attr('action'),
            hash = $(this).parents('.tab-pane').attr('id');

        if (!action.match('#')) {
            $(this).attr('action', action+'#'+hash);
        }
    });
});
