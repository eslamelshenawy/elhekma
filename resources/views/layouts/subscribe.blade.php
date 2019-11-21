<!-- Subscribe Section Start -->
<div class="subscribe-section section bg-gray pt-55 pb-55">
    <div class="container">
        <div class="row align-items-center">

            <!-- Mailchimp Subscribe Content Start -->
            <div class="col-lg-6 col-12 mb-15 mt-15">
                <div class="subscribe-content">
                    <h2>@lang('trans.subscribe') <span>@lang('trans.subscribe_desc')
                </div>
            </div><!-- Mailchimp Subscribe Content End -->

            <!-- Mailchimp Subscribe Form Start -->
            <div class="col-lg-6 col-12 mb-15 mt-15">

				<form class="subscribe-form">
					<input type="email" name="email_address" id="subscribe_form_email" autocomplete="off" placeholder="@lang('trans.email')" />
					<button class="btn-submit">@lang('trans.subscribe')</button>
				</form>
             
                <p class=" alert alert-info" id="response_email" style="display: none;"></p>
             

				<!-- mailchimp-alerts Start -->
				<div class="mailchimp-alerts text-centre">
					<div class="mailchimp-submitting"></div><!-- mailchimp-submitting end -->
					<div class="mailchimp-success"></div><!-- mailchimp-success end -->
					<div class="mailchimp-error"></div><!-- mailchimp-error end -->
				</div><!-- mailchimp-alerts end -->

            </div><!-- Mailchimp Subscribe Form End -->

        </div>
    </div>
</div><!-- Subscribe Section End -->
<script type="text/javascript">
    $.ajaxSetup({

        headers: {

            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

        }

    });


    $(".btn-submit").on('click',function(e){
        e.preventDefault();
        var email = document.getElementById('subscribe_form_email').value;
        $.ajax({

           type:'POST',

           url:"{{ route('subscribe.email')}}",

           data: {email_address: email},

           success:function(data){
            document.getElementById("response_email").innerHTML = data;
            document.getElementById("response_email").style.display = "block";
            
           }

        });


  });


</script>