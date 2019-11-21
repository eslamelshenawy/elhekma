/*--
	Add To Cart Animation
------------------------*/

updateGovernsOutlets();

//change state and city in checkout page
$('#govern').on('change', function(e){
    $('#place').val('-');
    updateGovernsOutlets();
});

function updateGovernsOutlets(){
    var govern_select = $('#govern');
    var place_select = $('#place');
    var govern = govern_select.val();
    if(govern == '-'){
        place_select.val('-');
        place_select.attr('disabled', 'disabled');
        place_select.niceSelect('update');
    }else{
        // outlet_select.val('-');
        $('.nice-select li.option').removeClass('d-none');
        place_select.removeAttr('disabled');
        $('option[data-gov]').addClass('d-none');
        $('option[data-gov]').attr('disabled', 'disabled');
        $('option[data-gov="'+govern.toLowerCase()+'"]').removeAttr('disabled');
        $('option[data-gov="'+govern.toLowerCase()+'"]').removeClass('d-none');
        place_select.niceSelect('update');
        $('.nice-select li.option.disabled').addClass('d-none');
    }
}

//change place
$('#place').on('change', function(e){
    updateHints();
});

function updateHints(){
    var govern_id = $('#govern').val();
    var place_id = $('#place').val();

    if(!place_id || place_id == '-'){
        return false;
    }

    var data = new FormData();
    data.append('govern_id', govern_id);
    data.append('place_id', place_id);

    $.ajax({
        url: '/checkout/checkOutlets',
        data: data,
        cache: false,
        contentType: false,
        processData: false,
        type: 'POST',
        success: function(data){
            console.log(data);
            $('#outlets_status').html('');
            if(data.outlets_status){
                var disabled_checkout = false;
                for (var i=0;i<data.outlets_status.length;i++){
                    var text = '<h5>- '+data.outlets_status[i].text;
                    if(data.outlets_status[i].type == 'unavailable'){
                        disabled_checkout = true;
                        text += ' <a style="text-decoration: underline" href="/cart">update cart</a>';
                    }
                    text += '</h5>';
                    $('#outlets_status').append(text);
                }
                if(disabled_checkout){
                    $('.place-order').addClass('ddisabled');
                    $('.place-order').attr('disabled', 'disabled');
                }else{
                    $('.place-order').removeClass('disabled');
                    $('.place-order').removeAttr('disabled');
                }
            }
        },
        error: function(xhr, textStatus, errorThrown){
            console.log(xhr);
        }
    });
}


$('#accept_terms').on('change', function(){
    if($(this).is(':checked')){
        // $('.place-order').removeAttr('disabled');
        // $('#terms_error').addClass('d-none');
    }else{
        // $('.place-order').attr('disabled', 'disabled');
    }
});


$('.place-order').on('click', function(){
    var error = false;
   if(!$("#accept_terms").is(':checked')){
       $('#terms_error').removeClass('d-none');
       error = true;
   }else{
       $('#terms_error').addClass('d-none');
   }
    if(!$('input[name="payment-method"]:checked').val()){
        $('#method_error').removeClass('d-none');
        error = true;
    }else{
        $('#method_error').addClass('d-none');
    }
    if(error){
       return false;
    }
});

$('.checkout-form').on('submit', function(){
    var error = false;
    if(!$("#accept_terms").is(':checked')){
        $('#terms_error').removeClass('d-none');
        error = true;
    }else{
        $('#terms_error').addClass('d-none');
    }
    if(!$('input[name="payment-method"]:checked').val()){
        $('#method_error').removeClass('d-none');
        error = true;
    }else{
        $('#method_error').addClass('d-none');
    }
    if(error){
        return false;
    }
});

$('#clear_form').on('click', function(){
    $('input[name="address"]').val('');

    $('#govern').val('-');
    $('#place').val('-');
    $('#govern').niceSelect('update');
    $('#place').attr('disabled', 'disabled');
    $('#place').niceSelect('update');


    $('#outlets_status').html('');

    return false;
});