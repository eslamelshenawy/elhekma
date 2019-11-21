$(".add_to_favorite").on("click", function(e){  
        e.preventDefault();
        var product = $(this);
        var product_id = product.attr('data-id');
        var url = '/add_favorite';

        $.ajax({
           url: url,
           method: "get",
           data: {product_id: product_id},
           success: function (data) {
            console.log(data);
            $('.header-wishlist .number').html(data.fav_count);           
            console.log(response);
        }
        });
});

        
$(".added").on("click", function(e){  
        e.preventDefault();
        var product = $(this);
        var product_id = product.attr('data-id');
        var url = '/add_favorite';

        $.ajax({
           url: url,
           method: "get",
           data: {product_id: product_id},
           success: function (data) {
            $('.header-wishlist .number').html(data.fav_count);
            $(".delete_product_" + product_id).fadeOut('slow');

        },
        error: function(xhr, textStatus, errorThrown){
            console.log(xhr);
        }
        });
});

    $(".favorite_icon").on("click", function(e){  

      e.preventDefault();
      var login_url =  $(this).data('href');
    Swal.fire({
      type: 'error',
      title: 'Oops...',
      text: 'Login Required ',
      
    }).then(
          function (isConfirm) {
            if (isConfirm) {
               window.location.href = login_url;
            }
          }
        );
    }); 
/////////////////// product not buy in single product page
//display review box and cant add review
    $(".product_not_buy").on("click", function(e){  

      e.preventDefault();
    
    Swal.fire({
      type: 'error',
      title: 'Oops...',
      text: 'Buy Product First',
      
    });
    });
    
