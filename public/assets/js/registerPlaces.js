/*--
	Add To Cart Animation
------------------------*/

updateGovernsOutlets();

//change state and city in checkout page
$('#state').on('change', function(e){
    updateGovernsOutlets();
});

function updateGovernsOutlets(){
    var state_select = $('#state');
    var city_select = $('#city');
    var govern = state_select.val();
    if(govern == 'Your state here'){
        state_select.val('Your city here');
        city_select.attr('disabled', 'disabled');
        city_select.niceSelect('update');
    }else{
        city_select.val('Your city here');
        city_select.removeAttr('disabled');
        $('option[data-gov]').attr('disabled', 'disabled');
        $('option[data-gov="'+govern.toLowerCase()+'"]').removeAttr('disabled');
        city_select.niceSelect('update');
    }
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

