
var windowWidth = $(document).width();
var windowHeight = $(document).height();
var windowHeightb = $(window).height();
var sidebarStatus = 0;

$(document).ready(function() {

    $("#section1").css({"height" : windowHeightb});
    $("#map").css({"height" : windowHeight});
    $("#sidebar").css({"height" : windowHeight});
    $("#bloc-register").hide();
    $("#register").click(function() { $("#bloc-register").slideToggle(400);});
    $("#register-after").click(function() { $("#bloc-register").slideToggle(400);});
    $("#index-register").click(function() { $("#bloc-register").slideToggle(400);});
    $(".close").click(function() {$("#bloc-register").hide(500);});
    $("#bloc-connect").hide();
    $("#connect").click(function() {$("#bloc-connect").slideToggle(400);});
    $("#connect").click(function() {$("#bloc-register").hide();});
    $("#register").click(function() {$("#bloc-connect").hide();});
    $(".close").click(function() {$("#bloc-connect").hide(500);});
    $("#submit-home").click(function() {$('html, body').animate(300);});

    $(".close-message").click(function() {
        $("#search-nav-mobile-bloc").hide(300);
    });

    $(window).scroll(function(slow){
        if ($(this).scrollTop() > 780) {
            $('.backtotop').fadeIn();
        } else {
            $('.backtotop').fadeOut();
        }
    });

    $('.backtotop').click(function(){
        $('html, body').animate({scrollTop : 0},800);
        return false;

    });

    $('.scrollToTop').click(function(){
        $('html, body').animate({scrollTop : 0},800);
        return false;
    });

    $('#down').click(function () {
        $('html, body').animate({scrollTop: $("#map-home").offset().top}, 'slow');
        return false;
    });

    $('.delete-user').on('click', function(){
        return confirm('Voulez-vous vraiment supprimer votre compte ?');
    });

    setTimeout(function(){
        $('div[class^="alert"]').fadeOut('slow', function() {});
    }, 3000);
    
});

$(document).on('click', '#display-sidebar-announce-open', function(event) {
    event.preventDefault();
    var effect = 'slide';
    var options = { direction: $('#announce').css('left') };
    var duration = 500;
    $('#info-announce').toggle(effect, options, duration);
});

$(document).on('click', '#display-sidebar-announce-close', function(event) {
    event.preventDefault();
    var effect = 'slide';
    var options = { direction: $('#announce').css('right') };
    var duration = 500;
    $('#info-announce').toggle(effect, options, duration);
});

$(document).on('resize', window, function(event) {
    event.preventDefault();
    $("#info-announce").css({
        "height" : $(window).height()
    });
});

$("#display-sidebar").click(function () {
    if (sidebarStatus == 0) {
        $("#sidebar").css({
            left : '0px',
            transition : '0.3s'
        });
        $('#display-sidebar').css({
            left : '70px',
            transition : '0.3s'
        });
        sidebarStatus = 1;
    } else {
        $("#sidebar").css({
            left : '-70px',
            transition : '0.3s'
        });
        $('#display-sidebar').css({
            left : '0',
            transition : '0.3s'
        });
        sidebarStatus = 0;
    }
});

$("#info-pics").click(function(){
    $("#popup-pics").toggle(300);
});

$("#badge-btn").click(function(){
    $("#badge").toggle(400);
});