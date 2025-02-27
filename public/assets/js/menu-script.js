$(document).ready(function (){
    $('.fechar-modal').on('click', function (){
        $('.modal-full, .tray-container, #trayResume, #deliveryPlace, #paymentStep, #btnBack, #btnLastBack, #btnAddressStep, #btnResumeStep, ' +
            '#btnSecondBack, #btnCheck').fadeOut();
        $('.step2, .step3, .step4').removeClass('active')
        $('.tray-container').html('');
        $(".btn-tray-side").fadeIn();
    });

    $('#btnOrderStep').on('click', function (){
        $(this).fadeOut();
        $('#trayItems').fadeOut();
        $('#deliveryPlace').removeAttr('hidden');
        $('#btnAddressStep, #deliveryPlace').fadeIn();
        $('#btnBack').fadeIn(2700);
        $('.step1').removeClass('active')
        $('.step2').addClass('active')
    });

    $('#btnLastBack').on('click', function (){
        $(this).fadeOut();
        $('#paymentStep').fadeIn();
        $('#btnCheck, #btnSecondBack').fadeIn();
        $('.step4').removeClass('active')
        $('.step3').addClass('active')
        $('#trayResume, #btnResumeStep').fadeOut();
    });

    $('#btnBack').on('click', function (){
        $('#trayItems, #btnOrderStep').fadeIn();
        $('#deliveryPlace, #btnBack, #btnAddressStep').fadeOut();
        $('.step2').removeClass('active')
        $('.step1').addClass('active')
    });

    $('#btnSecondBack').on('click', function (){
        $('#deliveryPlace').fadeIn();
        $('#btnBack, #btnAddressStep').fadeIn();
        $('#paymentStep').fadeOut();
        $('.step3').removeClass('active');
        $('.step2').addClass('active');
        $('#btnCheck, #btnSecondBack').fadeOut();
    });

    $('#btnCheck').on('click', function (){
        $('.step3').removeClass('active');
        $('.step4').addClass('active');
        $('#btnSecondBack, #paymentStep, #btnCheck').fadeOut();
        $('#trayResume').removeAttr('hidden')
        $('#btnLastBack, #btnResumeStep, #trayResume').fadeIn();
    });

    $(".btn-plus").on("click", function() {
        var card = $(this).closest(".card-item");
        var numberItems = card.find(".add-number-items");

        var currentValue = parseInt(numberItems.text());
        numberItems.text(currentValue + 1);
        $(".ammount").val(currentValue + 1)
    });

    $(".btn-less").on("click", function() {
        var card = $(this).closest(".card-item");
        var numberItems = card.find(".add-number-items");
        var currentValue = parseInt(numberItems.text());

        if (currentValue > 1) {
            numberItems.text(currentValue - 1);
            $(".ammount").val(currentValue - 1)
        }
    });

    //API de busca de cep.
    function buscarCep(){
        var cep = $('#txtCEP').val().trim().replace(/\D/g,'');

        if (cep != ""){
            var cepValidate = /^[0-9]{8}$/;

            if (cepValidate.test(cep)){
                $.getJSON("http://viacep.com.br/ws/" + cep + "/json/?callback=?", function (data){

                    if (!("erro" in data)){
                        $('#txtEndereco').val(data.logradouro);
                        $('#txtBairro').val(data.bairro);
                        $('#txtCity').val(data.localidade);
                        $('#txtNumero').focus();

                    }else{
                        //Toast de não conseguimos localizar este cep, preencha as informações manualmente
                        $('#txtEndereco').focus();
                    }
                })
            }else{
               //Tratar com toast de cep inválido
            }

        }else{
            $('#txtCEP').focus();
        }
    }

    $('.buscar-cep').on('click', function (){
        buscarCep();
    });

    $("#txtCEP").blur(function() {
        buscarCep();
    });

    $('#txtCEP').mask('00000-000');

    $('.btn-add').on('click', function(){
        setTimeout(function(){
            $('.ammount').val(1);
            $('.add-number-items').text(1);
        }, 1000);
    });

    $('.drinksBtn').on('click', function(){
        $('.burguersDiv, .dessertsDiv').fadeOut(800);
        $('.drinksDiv').removeAttr('hidden').fadeIn(300);
        $('.burguersBtn, .dessertsBtn').removeClass('active');
        $(this).addClass('active');
    });

    $('.dessertsBtn').on('click', function(){
        $('.burguersDiv, .drinksDiv').fadeOut(800);
        $('.dessertsDiv').removeAttr('hidden').fadeIn(600);
        $('.burguersBtn, .drinksBtn').removeClass('active');
        $(this).addClass('active');
    });

    $('.burguersBtn').on('click', function(){
        $('.dessertsDiv, .drinksDiv').fadeOut(800);
        $('.burguersDiv').removeAttr('hidden').fadeIn(600);
        $('.dessertsBtn, .drinksBtn').removeClass('active');
        $(this).addClass('active');
    });

    $('#pagamento').on('change', function (){
        if ($(this).val() != 'Dinheiro'){
            $('.valor-entregue').fadeOut();
        }else{
            $('.valor-entregue').fadeIn();
        }
    });

    $("#valorPagamento").keyup(function (){
       if ($(this).val() < parseFloat($('#lbl-totalValue').text())){
           $('.alerta-troco').fadeIn();
           $('.valor-troco').fadeOut();
       }else{
           let troco = $(this).val() - parseFloat($('#lbl-totalValue').text());
           $('.alerta-troco').fadeOut();
           $('.valor-troco').fadeIn();
           $('.valor-troco').html(`<b>Você receberá R$: ${troco} de troco</b>`)
       }
    });
});
