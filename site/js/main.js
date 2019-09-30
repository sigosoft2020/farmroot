$(document).ready(function () {
    // Hide Header on on scroll down
    var didScroll;
    var lastScrollTop = 0;
    var delta = 5;
    var navbarHeight = $('header').outerHeight();
    $(window).scroll(function (event) {
        didScroll = true;
    });
    setInterval(function () {
        if (didScroll) {
            hasScrolled();
            didScroll = false;
        }
    }, 150);
    function hasScrolled() {
        var st = $(this).scrollTop();
        // Make sure they scroll more than delta
        if (Math.abs(lastScrollTop - st) <= delta)
            return;
        // If they scrolled down and are past the navbar, add class .nav-up.
        // This is necessary so you never see what is "behind" the navbar.
        if (st > lastScrollTop && st > navbarHeight) {
            // Scroll Down
            $('header').removeClass('header-show').addClass('nav-hide ');
        } else {
            // Scroll Up
            if (st + $(window).height() < $(document).height()) {
                $('header').removeClass('nav-hide ').addClass('header-show');
            }
        }
        lastScrollTop = st;
    }
    var path = window.location.pathname.split("/").pop();
    if (path == '') {
        path = 'index.php';
    }
    var target = $('.nav li a[href="' + path + '"]');
    target.addClass('active');
    // Dropdown
    $("li").click(function () {
        $('li > ul').not($(this).children("ul")).hide();
        $(this).children("ul").toggle();
    });
}); //ready function end
//popup
function closeForm() {
    $('body').addClass('overflow-active').removeClass('overflow-stop');
    $('.cd-popup').removeClass('is-visible');
}
$(document).ready(function ($) {
    $('.pop').on('click', function (event) {
        event.preventDefault();
        $('.contact').addClass('is-visible');
        $('body').addClass('overflow-stop').removeClass('overflow-active');
    });
    $('.cd-popup').on('click', function (event) {
        if ($(event.target).is('.cd-popup-close') || $(event.target).is('.cd-popup')) {
            event.preventDefault();
            $(this).removeClass('is-visible');
            $('body').addClass('overflow-active').removeClass('overflow-stop');
        }
    });
});
