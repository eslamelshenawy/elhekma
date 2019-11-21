<div class="box ">
    <!-- /.box-header -->
    <!-- form start -->
    {!! $form->open(['class' => "form-horizontal", 'id'=>"addProductsToPrescForm"]) !!}

        <div class="box-body" id="addProductsToPresc">

            @if(!$tabObj->isEmpty())
                @include('admin::form.tab', compact('tabObj'))
            @else
                <div id="products_container">
                    <div class="fields-group clone " style="display:none; border: 1px solid #eaeaea;padding: 10px;margin-bottom: 5px;">

                        <div class="form-group  ">
                            <div class="col-sm-2">
                                <a href="#" class="removeProduct" style="color:red;float:right;font-weight: bold;">Remove</a>
                            </div>
                        </div>
                        <div class="form-group  ">

                            <label for="product_id" class="col-sm-2 asterisk control-label">Product</label>

                            <div class="col-sm-8">
                                <select class="form-control product_id" name="product_id" required >
                                </select>
                                <h5 class="hint" style="display:none;"></h5>
                            </div>
                        </div>

                        <div class="form-group  ">

                            <label for="quantity" class="col-sm-2 asterisk control-label">Quantity</label>

                            <div class="col-sm-8">
                                <input type="number" min="1" class="form-control quantity" name="quantity" required>
                            </div>
                        </div>



                    </div>
                </div>
            @endif
            <button class="btn btn-warning" id="addNewProductToPresc">New Product</button>


        </div>
        <!-- /.box-body -->

        {!! $form->renderFooter() !!}

        @foreach($form->getHiddenFields() as $field)
            {!! $field->render() !!}
        @endforeach


        <!-- /.box-footer -->
    {!! $form->close() !!}
</div>


<script>

    prescription_id = window.location.pathname.replace('/admin/prescriptions/', '');
    hints = [];

    $(document).ready(function(){
        $('button[type="reset"]').remove();
        $('button[type="submit"]').html('Order');
        $('button[type="submit"]').addClass('disabled');


        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        });

        loadProducts();
        products_loaded = false;


        function loadProducts(){
            $.ajax({
                url: '/admin/prescriptions/loadProducts',
                cache: false,
                contentType: false,
                processData: false,
                type: 'POST',
                success: function(data){
                    var select = $("#addProductsToPresc .fields-group.clone select");
                    var options = '<option value="">-</option>';
                    for (var i=0;i<data.length;i++){
                        options += '<option value="'+data[i].id+'">'+data[i].name_en+'</option>';
                    }
                    select.html(options);
                    products_loaded = true;
                    // select.select2();
                },
                error: function(xhr, textStatus, errorThrown){
                    console.log(xhr);
                }
            });
        }

        $(document).on("click", "#products_container a.removeProduct", function (e) {
            var container = $(this).parent().parent().parent();
            var product_id = $('select.product_id', container).val();

            for(var i=0; i<hints.length;i++){
                if(hints[i].product_id == product_id){
                    hints[i].error = false;
                }
            }
            container.remove();

            if(checkErrorExists()){
                $('button[type="submit"]').addClass('disabled');
            }else{
                $('button[type="submit"]').removeClass('disabled');
            }
            if(!countProducts()){
                $('button[type="submit"]').addClass('disabled');
            }
            return false;
        });

        $("#addNewProductToPresc").on('click', function(){
            if(products_loaded){
                var clone_div = $("#addProductsToPresc .fields-group.clone").clone();
                var container = $("#products_container");

                var new_product = clone_div;
                new_product.css('display', 'block');
                new_product.removeClass('clone');
                container.append(new_product);

                $('select', new_product).select2();

                return false;
            }
        });


        $('.form').on('submit', function() {
            addProductToPresc();
            return false;
        });

        $('button[type="submit"]').on('click', function() {
            addProductToPresc();
            return false;
        });


        function addProductToPresc(){
            data = [];
            $("#addProductsToPresc .fields-group").each(function(){
                if(!$(this).hasClass('clone')){
                    var product = $(this);
                    var product_id = $('select.product_id', product).val();
                    var quantity = $('input.quantity', product).val();
                    if(product && quantity > 0){
                        var product_data = {};
                        product_data.product_id = product_id;
                        product_data.quantity = quantity;
                        data.push(product_data);
                    }
                }
            });

            //send to server
            if(data.length){
                var error = false;
                for(var i=0; i<hints.length;i++){
                    if(hints[i].error === true){
                        error = true;
                    }
                }
                if(!error){
                    createOrder(data);
                }
            }
        }


        $(document).on("change", ".product_id", function (e){
            updateHints();
            var select = $(this);
            var container = select.parent().parent().parent();
            var quantity_input = $('.quantity', container);

            var product_data = {};
            product_data.product_id = select.val();
            product_data.quantity = quantity_input.val();

            if(product_data.product_id && product_data.quantity){
                console.log(product_data)
                checkOutlets(product_data, container);
            }
        });

        $(document).on("keyup", ".quantity", function (e){
            updateHints();
            var quantity_input = $(this);
            var container = quantity_input.parent().parent().parent();
            var select = $('.product_id', container);

            var product_data = {};
            product_data.product_id = select.val();
            product_data.quantity = quantity_input.val();

            if(product_data.product_id && product_data.quantity){
                console.log(product_data)
                checkOutlets(product_data, container);
            }
        });

        function checkOutlets(product_data, container){
            var found = false;
            for(var i=0; i<hints.length;i++){
                if(hints[i].product_id == product_data.product_id){
                    found = true;
                    hints[i].error = false;
                }
            }
            if(!found){
                hints.push({'product_id': product_data.product_id, 'error':false});
            }

            var data = new FormData();
            data.append('product_id', product_data.product_id);
            data.append('quantity', product_data.quantity);
            data.append('prescription_id', prescription_id);

            $.ajax({
                url: '/admin/prescriptions/checkOutlets',
                cache: false,
                data: data,
                contentType: false,
                processData: false,
                type: 'POST',
                success: function(data){
                    var h5 = $('h5.hint', container);
                    if(data[0]){
                        console.log(data[0].type);
                        if(data[0].type == 'unavailable'){
                            h5.css('color', 'red');
                            for(var i=0; i<hints.length;i++){
                                if(hints[i].product_id == product_data.product_id){
                                    hints[i].error = true;
                                }
                            }
                        }
                        h5.html(data[0].text);
                        h5.css('display', 'block');
                        console.log(data[0].text);
                    }else{
                        h5.html('');
                        h5.css('display', 'none');
                    }

                    if(checkErrorExists()){
                        $('button[type="submit"]').addClass('disabled');
                    }else{
                        $('button[type="submit"]').removeClass('disabled');
                    }
                },
                error: function(xhr, textStatus, errorThrown){
                    console.log(xhr);
                }
            });
        }

        function createOrder(items){
            $('button[type="submit"]').addClass('disabled');
            console.log(items);
            var data = new FormData();
            data.append('data', JSON.stringify(items));
            data.append('prescription_id', prescription_id);

            $.ajax({
                url: '/admin/prescriptions/order',
                cache: false,
                data: data,
                contentType: false,
                processData: false,
                type: 'POST',
                success: function(data){
                    console.log(data.status);
                    if(data.status){
                        window.location = '/admin/orders';
                        toastr.success('Ordered successfully');
                    }else{
                        toastr.error('Error!');
                        $('button[type="submit"]').removeClass('disabled');
                    }
                },
                error: function(xhr, textStatus, errorThrown){
                    console.log(xhr);
                    $('button[type="submit"]').removeClass('disabled');
                    toastr.error('Server Error');

                }
            });
        }

        function countProducts(){
            var i = 0;
            $("#addProductsToPresc .fields-group").each(function() {
                if (!$(this).hasClass('clone')) {
                    i++;
                }
            });
            return i;
        }

        function checkErrorExists(){
            var error = false;
            for(var i=0; i<hints.length;i++){
                if(hints[i].error === true){
                    error = true;
                }
            }
            return error;
        }

        function updateHints(){
            for(var i=0; i<hints.length;i++){
                var found = false;
                $("#addProductsToPresc .fields-group").each(function() {
                    if (!$(this).hasClass('clone')) {
                        var container = $(this);
                        var product_id = $('select.product_id', container).val();
                        if(hints[i].product_id == product_id){
                            found = i;
                        }
                    }
                });
                if(found === false){
                    hints[i].error = false;
                }
            }
        }
    });
</script>