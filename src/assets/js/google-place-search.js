(function ($) {

    $.googlePlaceSearchDefaults = {
        'placeChanged' : $.noop,
        'map' : {
            'selector' : null,

        },
        'autocomplete' : {
            'types' : ['geocode']
        }

    };

    $.fn.googlePlaceSearch = function (options) {
        options = $.extend($.googlePlaceSearchDefaults, options);
        return this.each(function () {
            var el = $(this);
            var autocomplete = new google.maps.places.Autocomplete(this, options['autocomplete']);
            var $map = $(options['map']['selector']);
            var map;
            var marker;

            google.maps.event.addListener(autocomplete, 'place_changed', function() {
                var place = autocomplete.getPlace();

                options['placeChanged'].apply(el, [place]);

                if (map) {
                    if (!marker) {
                        marker = new google.maps.Marker({position: place.geometry.location});
                        marker.setMap(map);
                    } else {
                        marker.setPosition(place.geometry.location);
                    }

                    map.setCenter(place.geometry.location);
                    map.setZoom(15);
                }
            });

            el.data('autocomplete', autocomplete);

            el.on('keypress', function (e) {
                if ((e.keyCode || e.which || e.charCode || 0) == 13) {
                    e.preventDefault();
                }
            });

            if ($map.get(0)) {

                var myOptions = {
                    zoom: $.googlePlaceSearchCountries['au'].zoom,
                    center: $.googlePlaceSearchCountries['au'].center,
                    mapTypeControl: false,
                    panControl: false,
                    zoomControl: false,
                    streetViewControl: false
                };

                map = new google.maps.Map($map.get(0), myOptions);

                el.data('map', map);
            }
        });
    };


    $.googlePlaceSearchCountries = {
        'au': {
            center: new google.maps.LatLng(-25.3, 133.8),
            zoom: 4
        },
        'br': {
            center: new google.maps.LatLng(-14.2, -51.9),
            zoom: 3
        },
        'ca': {
            center: new google.maps.LatLng(62, -110.0),
            zoom: 3
        },
        'fr': {
            center: new google.maps.LatLng(46.2, 2.2),
            zoom: 5
        },
        'de': {
            center: new google.maps.LatLng(51.2, 10.4),
            zoom: 5
        },
        'mx': {
            center: new google.maps.LatLng(23.6, -102.5),
            zoom: 4
        },
        'nz': {
            center: new google.maps.LatLng(-40.9, 174.9),
            zoom: 5
        },
        'it': {
            center: new google.maps.LatLng(41.9, 12.6),
            zoom: 5
        },
        'za': {
            center: new google.maps.LatLng(-30.6, 22.9),
            zoom: 5
        },
        'es': {
            center: new google.maps.LatLng(40.5, -3.7),
            zoom: 5
        },
        'pt': {
            center: new google.maps.LatLng(39.4, -8.2),
            zoom: 6
        },
        'us': {
            center: new google.maps.LatLng(37.1, -95.7),
            zoom: 3
        },
        'uk': {
            center: new google.maps.LatLng(54.8, -4.6),
            zoom: 5
        }
    };

})($);

