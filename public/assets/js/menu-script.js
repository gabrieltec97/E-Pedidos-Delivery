$(document).ready(function (){
    $('#btnOrderStep').on('click', function (){
        $(this).fadeOut();
        $('#trayItems').fadeOut();
        $('#deliveryPlace').removeAttr('hidden');
        $('#btnAddressStep, #deliveryPlace').fadeIn();
        $('#btnBack').fadeIn(2700);
        $('.step1').removeClass('active')
        $('.step2').addClass('active')
    });

    $('#btnAddressStep').on('click', function (){
        $('#deliveryPlace').fadeOut();
        $('#btnBack, #btnAddressStep').fadeOut();
        $('#trayResume').removeAttr('hidden')
        $('#btnResumeStep, #btnLastBack, #trayResume').fadeIn();
        $('.step2').removeClass('active')
        $('.step3').addClass('active')
    });

    $('#btnLastBack').on('click', function (){
        $(this).fadeOut();
        $('#deliveryPlace').fadeIn();
        $('#btnAddressStep, #btnBack').fadeIn();
        $('.step3').removeClass('active')
        $('.step2').addClass('active')
        $('#trayResume').fadeOut();
        $('#btnResumeStep').fadeOut();
    });

    $('#btnBack').on('click', function (){
        $('#trayItems, #btnOrderStep').fadeIn();
        $('#deliveryPlace, #btnBack, #btnAddressStep').fadeOut(200);
        $('.step2').removeClass('active')
        $('.step1').addClass('active')
    })

    $('.fechar-modal').on('click', function (){
        $('#modalTray').fadeOut();
    });
});
