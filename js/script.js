// paralax slide in for boxes

//for package boxes

$(window).scroll(function () {

    var wScroll1 = $(this).scrollTop();

    if (wScroll1 > $('.boxp').offset().top - ($(window).height() / 1.1)) {

        $('.boxp').each(function (i) {


            setTimeout(function () {
                $('.boxp').eq(i).addClass('slide_in');

            }, 150 * (i + 1));

        });
    }
});

//for travel agency boxes

$(window).scroll(function () {

    var wScroll2 = $(this).scrollTop();

    if (wScroll2 > $('.boxt').offset().top - ($(window).height() / 1.1)) {

        $('.boxt').each(function (i) {


            setTimeout(function () {
                $('.boxt').eq(i).addClass('slide_in');

            }, 150 * (i + 1));

        });
    }
});


//   Adding Smooth Scroll with JQuery.......................................................

var marginY = 0;
var destination = 0;
var speed = 7;
var scroller = null;

function initScroll(elementId) {
    destination = document.getElementById(elementId).offsetTop;

    scroller = setTimeout(function () {
        initScroll(elementId);
    }, 1);

    marginY = marginY + speed;

    if (marginY >= destination) {
        clearTimeout(scroller);
    }

    window.scroll(0, marginY);


}

window.onscroll = function () {
    marginY = this.pageYOffset;
};

function toTop() {
    scroller = setTimeout(function () {
        toTop();
    }, 1);

    marginY = marginY - speed;

    if (marginY <= 0) {
        clearTimeout(scroller);
    }

    window.scroll(0, marginY);
}

//  ...........................................................................................


// toggling menu bar

$(document).ready(function () {
    $("#menu_toggle").on("click", function () {
        $(".nav").toggleClass("show_menu");
        $(".hide").toggleClass("hide_active");

    });


});

// toggling notications


function toggle_visibility(id) {
    var e = document.getElementById(id);
    if (e.style.display == 'block')
        e.style.display = 'none';
    else
        e.style.display = 'block';
}
