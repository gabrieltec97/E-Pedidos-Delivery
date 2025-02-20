$(document).ready(function (){
    $('.fechar-modal').on('click', function (){
        $('#modalTray').fadeOut();
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
        $('#deliveryPlace, #btnBack, #btnAddressStep').fadeOut();
        $('.step2').removeClass('active')
        $('.step1').addClass('active')
    });

    $('.btn-plus').on('click', function (){
        let ammount = parseInt($(".add-number-items").html());
        ammount = ammount + 1
        $(".add-number-items").html(ammount)
        $(".ammount").val(ammount)
    });

    $('.btn-less').on('click', function (){
        let ammount = parseInt($(".add-number-items").html());

        ammount = ammount - 1;

        if (ammount > 0){
            $(".add-number-items").html(ammount)
            $(".ammount").val(ammount)
        }else{
            $(".add-number-items").html(0)
            $(".ammount").val(0)
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
                        $('#txtUf').val(data.uf);
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
});
