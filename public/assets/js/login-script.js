$(document).ready(function() {

    $(".pass-recover").on('click', function () {
        $(".div-login").fadeOut();
        $(".img-login").css({
            'margin-top': '-90px',
            'margin-bottom': '180px'
        });


        setTimeout(function () {
            $(".div-recover").fadeIn();
        }, 500);
    });

    $(".back-login").on('click', function () {
        $(".div-recover").fadeOut();

        setTimeout(function () {
            $(".div-login").fadeIn();
        }, 500);

    });
    



});
