/*--
	Add To Cart Animation
------------------------*/

// click on add/remove from homepage products and medicine page and single pro page
$('.add-to-cart').on('click', function(e){
    e.preventDefault();

    var product = $(this);

    var request_type = '';
    if($(this).hasClass('added')){
        request_type = 'remove';
    } else{
        request_type = 'add';
    }

    var product_id = product.attr('data-id');

    var quanity = $('.qtybtn').parent().find('input').val();
    if(!quanity){
        quanity = 1;
    }

    var url = '/cart/'+request_type;

    var data = new FormData();
    data.append('product_id', product_id);
    data.append('quantity', quanity);

    $.ajax({
        url: url,
        data: data,
        cache: false,
        contentType: false,
        processData: false,
        type: 'POST',
        success: function(data){
            console.log(data);
            if(data.success){
                if(request_type == 'add'){
                    if(lang == 'en'){
                        product.addClass('added').find('i').addClass('ti-check').removeClass('ti-shopping-cart').siblings('span').text('added');
                    }else{
                        product.addClass('added').find('i').addClass('ti-check').removeClass('ti-shopping-cart').siblings('span').text('تم الاضافة');
                    }
                }else{
                    if(lang == 'en'){
                        product.removeClass('added').find('i').removeClass('ti-check').addClass('ti-shopping-cart').siblings('span').text('add to cart');
                    }else{
                        product.removeClass('added').find('i').removeClass('ti-check').addClass('ti-shopping-cart').siblings('span').text('أضف الى العربة');
                        
                    }
                }
                $('.header-cart .number').html(data.cart_count);
                $('#cart_content').html(data.view);
                $('.qtybtn').parent().find('input').attr('data-id', product_id);
            }else{
            }
        },
        error: function(xhr, textStatus, errorThrown){
            console.log(xhr);
        }
    });


});


//click on remove from sidebar cart
$(document).on("click", ".cart_item .remove", function (e) {
    e.preventDefault();

    var product = $(this);

    var request_type = 'remove';

    var product_id = product.attr('data-id');
    // product_id = "1";//remove this

    var url = '/cart/'+request_type;

    var data = new FormData();
    data.append('product_id', product_id);
    data.append('quantity', 1);

    $.ajax({
        url: url,
        data: data,
        cache: false,
        contentType: false,
        processData: false,
        type: 'POST',
        success: function(data){
            console.log(data);
            if(data.success){
                //
                //search for the product in the page and update it's class
                //

                // product.removeClass('added').find('i').removeClass('ti-check').addClass('ti-shopping-cart').siblings('span').text('add to cart');
                $('.header-cart .number').html(data.cart_count);
                $('#cart_content').html(data.view);

                $('.cart_row[data-id="'+product_id+'"]').remove();
                $('#sub_total').html(data.total_price);
                $('#grand_total').html(data.total_price+data.shipping_cost);
                if(data.cart_count == 0){
                    if (lang == 'en') {
                        $('.cart-table').html('<h3 class="text-center">Empty Cart</h3>');
                    } else {
                        $('.cart-table').html('<h3 class="text-center">العربة الفارغة</h3>');
                    }
                   
                }
                if (lang == 'en') {
                $('.add-to-cart[data-id="'+product_id+'"]').removeClass('added').find('i').removeClass('ti-check').addClass('ti-shopping-cart').siblings('span').text('add to cart');
                    
                } else {
                $('.add-to-cart[data-id="'+product_id+'"]').removeClass('added').find('i').removeClass('ti-check').addClass('ti-shopping-cart').siblings('span').text('أضف الى العربة');
                    
                }

                //if removed from sidebar in checkout page
                //update hints
                if(window.location.pathname.includes('checkout')){
                    updateHints();
                }
            }else{
            }
        },
        error: function(xhr, textStatus, errorThrown){
            console.log(xhr);
        }
    });


});


//click on remove from cart page
$(".cart_row .pro-remove").on('click', function(e){
    e.preventDefault();

    var product = $(this);

    var request_type = 'remove';

    var product_id = product.attr('data-id');
    // product_id = "1";//remove this

    var url = '/cart/'+request_type;

    var data = new FormData();
    data.append('product_id', product_id);
    data.append('quantity', 1);

    $.ajax({
        url: url,
        data: data,
        cache: false,
        contentType: false,
        processData: false,
        type: 'POST',
        success: function(data){
            console.log(data);
            if(data.success){
                $('.header-cart .number').html(data.cart_count);
                $('#cart_content').html(data.view);
                product.parent().remove();
                $('#sub_total').html(data.total_price);
                $('#grand_total').html(data.total_price+data.shipping_cost);
                if(data.cart_count == 0){
                    if (lang == 'en') {
                    $('.cart-table').html('<h3 class="text-center">Empty Cart</h3>');
                        
                    } else {
                    $('.cart-table').html('<h3 class="text-center">العربة  فارغة</h3>');
                        
                    }
                }
            }else{
            }
        },
        error: function(xhr, textStatus, errorThrown){
            console.log(xhr);
        }
    });


});


//change quantity from cart page
$('.qtybtn').on('click', function() {
    var $button = $(this);
    var oldValue = $button.parent().find('input').val();
    if ($button.hasClass('inc')) {
        var newVal = parseFloat(oldValue) + 1;
    } else {
        // Don't allow decrementing below 1
        if (oldValue > 1) {
            var newVal = parseFloat(oldValue) - 1;
        }else{
            var newVal = 1;
        }
    }
    $button.parent().find('input').val(newVal);
    var product_id = $button.parent().find('input').attr('data-id');
    if(product_id && newVal != oldValue){
        changeQuantity(product_id, newVal);
    }
});

$('.qty-input').on('change', function(){
    var input = $(this);
    var newVal = input.val();
    var product_id = input.attr('data-id');
    if(newVal < 1){
        newVal = 1;
        input.val(newVal);
    }
    if(product_id){
        changeQuantity(product_id, newVal);
    }
});


function changeQuantity(product_id, quantity){

    var request_type = 'quantity';

    var url = '/cart/'+request_type;

    var data = new FormData();
    data.append('product_id', product_id);
    data.append('quantity', quantity);

    $.ajax({
        url: url,
        data: data,
        cache: false,
        contentType: false,
        processData: false,
        type: 'POST',
        success: function(data){
            console.log(data);
            if(data.success){
                $('.header-cart .number').html(data.cart_count);
                $('#cart_content').html(data.view);
                $('#sub_total').html(data.total_price);
                $('#grand_total').html(data.total_price+data.shipping_cost);
                $('.cart_row[data-id="'+product_id+'"] .pro-subtotal span').html(data.cart[product_id].quantity_price);
            }else{
            }
        },
        error: function(xhr, textStatus, errorThrown){
            console.log(xhr);
        }
    });

}