// initiate owl
//jQuery(document).ready(function($) {
    jQuery("#episodecarousel").owlCarousel({
        loop: true,
        center: true,
        margin: 15,
        responsiveClass: true,
        navigation : true,
        dots: false,
        nav: true,
         responsive: {
            0: {
              items: 1,
             nav: true
            },
            600: {
              items: 1,
              nav: true
            },
            767: {
              items: 2,
              nav: true
            },
            1000: {
              items: 2,
              nav: true
            }
          }
    });

    
    
//});