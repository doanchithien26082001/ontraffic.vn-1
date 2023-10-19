$(document).ready(function() {
    //Fixed header mobile
    $(window).scroll(function() {
        // const heightTopSidebar = $('.top-sidebar').height();
        if ($(window).scrollTop() > 30) {
            $('.top-sidebar').addClass('sticky');
        } else {
            $('.top-sidebar').removeClass('sticky');
        }
    });
    //Hover menu
    $(".info-user ").hover(function() {
        $(".info-user .card ").show().addClass("animate__fadeInRight animate__faster ");
    }, function() {
        $(".info-user .card ").hide().removeClass("animate__fadeInRight animate__faster ");
    });
    //Show hide mobile menu
    function showMobileMenu() {
        $(".wp-moblie-menu").css('transform', 'translateX(0)')
        $(".overlay").show();
    }

    function hideMobileMenu() {
        $(".wp-moblie-menu").css('transform', 'translateX(-100%)')
        $(".overlay").hide();
    }
    $(".mobile-menu-icon").click(function(e) {
        showMobileMenu();
    });
    $(".overlay").click(function(e) {
        hideMobileMenu();
    });

    function toggleSubMenu(e) {
        e.preventDefault();
        var icon = $(this).find(".bi.arrow-01");
        icon.toggleClass('bi-caret-down-fill bi-caret-up-fill');
        $(this).next(".sub-nav").stop().slideToggle();
    }
    $(".list-nav-user li.has-sub-menu>a").click(toggleSubMenu);
    $(".moblie-menu li.has-sub-menu>a").click(toggleSubMenu);

    $('.spin-submit').click(function(e) {
        $(this).find('.handle').removeClass('d-none');
        $(this).find('.text-button').hide();
        setTimeout(() => {
            $(this).find('.handle').addClass('d-none');
            $(this).find('.text-button').show();
        }, 2000);
    });
});