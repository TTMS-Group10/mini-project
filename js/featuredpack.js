$(document).ready(function () {

    $("#owl-demo").owlCarousel({

        autoPlay: 2000, //Set AutoPlay to 2 seconds
        navigation: false,
        pagination: true,
        rewindNav: true,
        scrollPerPage: false,
        autoHeight: true,
        stopOnHover: true,
        items: 3,
        itemsDesktop: [1199, 3],
        itemsDesktopSmall: [979, 3]

    });

});
