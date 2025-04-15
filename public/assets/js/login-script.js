$(document).ready(function() {
    $(".change-pass").prop("disabled", true);

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

    $(".pass1, .pass2").on('keyup', function (){

        if($(".pass2").val() != $(".pass1").val()){
            $(".change-pass").prop("disabled", true);
        }else{
            $(".change-pass").prop("disabled", false);

        }
    });
});
