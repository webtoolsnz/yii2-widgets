jQuery(function () {
    // Javascript to enable link to tab
    var url = document.location.toString();
    if (url.match('#')) {
        $('.wt-tabs.nav-tabs a[href=#'+url.split('#')[1]+']').tab('show') ;
    }

    // Change hash for page-reload
    $('.wt-tabs.nav-tabs a').on('shown.bs.tab', function (e) {
        var scrollPos = $('body').scrollTop();
        window.location.hash = e.target.hash;
        $('html,body').scrollTop(scrollPos);
    });
});
