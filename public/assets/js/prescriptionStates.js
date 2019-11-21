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



$('#clear_form').on('click', function(){
    $('input[name="address"]').val('');

    $('#govern').val('-');
    $('#place').val('-');
    $('#govern').niceSelect('update');
    $('#place').attr('disabled', 'disabled');
    $('#place').niceSelect('update');


    return false;
});