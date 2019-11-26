/**
 * Created by online2 on 12/07/2017.
 */

// $('#owl-carousel').owlCarousel({
//     loop:true,
//     margin:0,
//     items: 1,
//     nav:false,
//     dots: true,
//     center: true
// });

jQuery('.owl-carousel-produit').owlCarousel({
    loop:true,
    margin:0,
    items: 1,
    nav:false,
    dots: true,
    center: true,
    autoplay:true,
    autoplayTimeout:2000
});


jQuery('#owl-carousel-message').owlCarousel({
    loop:true,
    margin:0,
    items: 1,
    nav:false,
    dots: true,
    center: true,
    autoplay:true,
    autoplayTimeout:3000,
    autoplayHoverPause:true,
    smartSpeed: 5000
});



jQuery('#owl-carousel-product').owlCarousel({
    // loop:true,
    margin:0,
    // items: 4,
    nav:false,
    dots: true,
    // center: true,
    autoplay:true,
    autoplayTimeout:2000,
    responsive:{
        0:{
            items:1
        },
        1000:{
            items:4
        }
    }
});



jQuery('#owl-carousel-service').owlCarousel({
    loop:true,
    margin:10,
    nav:false,
    dots: true,
    autoplay:true,
    autoplayTimeout:3000,
    autoplayHoverPause:false,
    responsive:{
        0:{
            items:1
        },
        1000:{
            items:2
        }
    }
});

jQuery('#owl-carousel-pub').owlCarousel({
    loop:true,
    margin:10,
    items: 1,
    nav:false,
    dots: true,
    autoplay:true,
    autoplayTimeout:5000,
    autoplayHoverPause:true,
    smartSpeed: 3500
});

jQuery('#owl-carousel-actu').owlCarousel({
    loop:true,
    margin:10,
    items: 1,
    nav:false,
    dots: false,
    autoplay:true,
    autoplayTimeout:6000,
    autoplayHoverPause:false,
    smartSpeed: 3500
});

jQuery(document).ready(function() {
    jQuery(".dotdot").dotdotdot({
        //	configuration goes here
    });
});


jQuery('.modal').on('click', function(e){
    e.preventDefault();
    var url =  jQuery(this).attr('href');

    jQuery.ajax({
        method: "GET",
        url: url
    })
    .done(function( msg ) {
        jQuery('#modal .uk-body-custom').html(msg);
    });

});


jQuery('#modal').on('hide', function () {
    jQuery('#modal .uk-body-custom').html('<div class="uk-text-center uk-height-1-1 uk-flex-middle uk-padding"><div uk-spinner></div><h1 style="color: #000;" class="uk-margin-remove">Chargement</h1></div>');
});

jQuery('.counter').counterUp({
    delay: 10,
    time: 1000
});

jQuery("body").on('click', 'a', function () {
    window.onbeforeunload = null;
});

/* Run Hover Slider */
(function ($) {
    var hover_sliders = $('.cmsmasters_hover_slider');


    hover_sliders.each(function () {
        var slider = $(this),
            params = {};


        params.sliderBlock = '#' + slider.attr('id');

        if (slider.data('thumbWidth') !== undefined) {
            params.thumbWidth = Number(slider.data('thumbWidth'));
        }

        if (slider.data('thumbHeight') !== undefined) {
            params.thumbHeight = Number(slider.data('thumbHeight'));
        }

        if (slider.data('activeSlide') !== undefined) {
            params.activeSlide = Number(slider.data('activeSlide'));
        }

        if (slider.data('pauseTime') !== undefined) {
            params.pauseTime = Number(slider.data('pauseTime'));
        }

        if (slider.data('pauseOnHover') !== undefined) {
            params.pauseOnHover = Boolean(slider.data('pauseOnHover'));
        }


        $(params.sliderBlock).cmsmastersHoverSlider(params);
    } );
} )(jQuery);


UIkit.lightbox('body .lightbox', {
    animation: 'slide'
});