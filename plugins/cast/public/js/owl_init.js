// initiate owl
jQuery(document).ready(function($) {
    jQuery('.owl-carousel2').owlCarousel({
        loop: true,
        center: true,
        margin: 0,
         autoplay:true,
        autoplayTimeout:5000,
        autoplayHoverPause:true,
        responsiveClass: true,
        navigation : true,
        navText:["<div class='nav-btn prev-slide'><span aria-label='Previous'>‹</span></div>","<div class='nav-btn next-slide'><span aria-label='Next'>›</span></div>"], 
    smartSpeed: 1000,
        nav: true,
         responsive: {
            0: {
              items: 1,
             nav: true
            },
            600: {
              items: 3,
              nav: true
            },
            767: {
              items: 3,
              nav: true
            },
            1000: {
              items: 3,
              nav: true
            }
          }
    });
    
    
});