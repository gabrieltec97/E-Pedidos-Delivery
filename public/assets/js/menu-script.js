$(document).ready(function (){
    $('#btnOrderStep').on('click', function (){
        $(this).fadeOut();
        $('#trayItems').fadeOut();
        $('#deliveryPlace').removeAttr('hidden');
        $('#btnAddressStep').fadeIn(2700);
        $('.step1').removeClass('active')
        $('.step2').addClass('active')
    });

    $('#btnAddressStep').on('click', function (){
        $(this).fadeOut();
        $('#deliveryPlace').fadeOut();
        $('#trayResume').removeAttr('hidden');
        $('#btnResumeStep').fadeIn(2700);
        $('#btnBack').fadeIn(2700);
        $('.step2').removeClass('active')
        $('.step3').addClass('active')
    });

    $('.fechar-modal').on('click', function (){
        $('#modalTray').fadeOut();
    });
});
