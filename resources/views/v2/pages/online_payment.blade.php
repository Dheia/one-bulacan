@extends('v2.layouts.online_payment_layout')

@section('after_styles')
<link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/custom.css') }}"> 
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
<style>

    @media only screen and (min-width: 768px) {
        .jconfirm-holder {
            padding-top: 50px !important;
        }
    }

    .w-200
    {
        max-width: 700px !important;
        margin-left: auto;
        margin-right: auto;
    }
    .jconfirm-box-container {
        max-width: 700px !important;
        margin-left: auto;
        margin-right: auto;
    }

    .jconfirm .jconfirm-cell {
        vertical-align: baseline !important;
    }

    .jconfirm-title-c {
        text-align: center !important;
    }

    .jconfirm-title {
        padding: 0 20px !important;
    }

    .jconfirm-buttons {
        padding: 0 20px 20px 20px !important;
    }

    .form-control {
        display: block !important;
        width: 100% !important;
        padding: 0.375rem 0.75rem !important;
        font-size: 1rem !important;
        line-height: 1.5 !important;
        color: #495057 !important;
        background-color: #fff !important;
        background-clip: padding-box !important;
        border: 1px solid #ced4da !important;
        border-radius: 0.25rem !important;
        transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out !important;
        margin-bottom: 0 !important;
    }

    .has_error {
        border: 1px solid red!important;
    }

    .error {
        color: red;
    }

</style>
@endsection

@section('body_class', "color-custom style-simple button-flat layout-full-width no-content-padding header-split minimalist-header-no sticky-header sticky-tb-color ab-hide subheader-both-center menu-link-color menuo-no-borders mobile-tb-center mobile-side-slide mobile-mini-mr-ll tablet-sticky mobile-header-mini mobile-sticky tr-header tr-menu tr-content be-reg-209621")

@section('content')
    <div id="Wrapper">
        <div id="Header_wrapper">
            <header id="Header">
                @include('v2.partials.top_bar')
            </header>
        </div>

        <!-- TOPBAR BACKGROUND IMAGE -->
        <div class="section mcb-section bg-cover" style="padding-top:15px; padding-bottom:15px; background-image:url({{ url('v2/content/one/images/bg-sectionbg5.jpg')}}); background-repeat:no-repeat; background-position:center top; min-height:110px;">
        </div>
        <!-- END OF TOPBAR BACKGROUND IMAGE -->

        <div id="Content" style="display: none;">
            <div class="content_wrapper clearfix">
                <div class="sections_group">
                    <div class="entry-content">
                        
                        <!-- CONTENT -->
                        <div id="payment-section" class="section mcb-section" style="padding-top:0px; padding-bottom:50px; {{--background-color:#060f18 --}}">
                            <div class="section_wrapper mcb-section-inner">

                                <!-- BUSINESS INFO -->
                                <div class="wrap mcb-wrap one-fifth valign-middle move-up clearfix" style="padding-top:25px;" data-mobile="no-up">
                                    <div class="column one">
                                        <div class="image_wrapper aligncenter" style="width:150px; height:150px; margin-bottom:20px; display:flex; align-items: center; justify-content: center;">
                                            <img class="scale-with-grid business-logo-free" src="{{ asset($business->logo) }}" style="max-width:150px; max-height:150px;">
                                        </div>                  
                                    </div>
                                    <div class="column one column-margin-10px" >
                                        <div class="column_attr clearfix business-feature" style="padding-left: 20px;">
                                            <p style="margin-bottom: 0;">
                                                <i  class="icon-pinboard"></i>
                                                {{$business->address1}}, {{$business->baranggay_name}}, {{$business->location_name}}
                                            </p>
                                            <p style="margin-bottom: 0;">
                                                <i  class="icon-mobile"></i>
                                                <a href="tel:{{$business->mobile}}"> {{$business->mobile}}</a>
                                            </p>
                                            @if($business->telephone)
                                            <p style="margin-bottom: 0;">
                                                <i class="icon-phone" ></i>
                                                <a href="tel:{{$business->telephone}}"> {{$business->telephone}}</a>
                                            </p>
                                            @endif
                                            <p style="margin-bottom: 0;">
                                                <i class="icon-mail"></i>
                                                <a href="mailto:{{$business->email}}?Subject=Inquiry from One Pampanga" target="_top"> {{$business->email}}</a>
                                            </p> 

                                        </div>

                                        
                                    </div> 
                                </div>
                                <!-- BUSINESS INFO END -->

                                <!-- PAYMENT METHOD LIST -->
                                <div class="wrap mcb-wrap four-fifth valign-middle move-up clearfix" style="padding-top:25px;" data-mobile="no-up">
                                    
                                    <h3 style="color:#FCA70B" class="aligncenter">
                                        <b> Online Payment </b>
                                    </h3>

                                    @foreach ( $paymentCategories as $paymentCategory )
                                        <div class="wrap mcb-wrap column one valign-top clearfix">
                                            <div class="mcb-wrap-inner">
                                                <!-- PAYMENT CATETGORY -->
                                                <h4 style="color:#FCA70B">
                                                    {{$paymentCategory->name}}
                                                </h4>

                                                <div class="row">

                                                    <!-- PAYMENT METHOD -->
                                                    @foreach ( $paymentCategory->paymentMethods as $paymentMethod )
                                                        @if($paymentMethod->active)
                                                        <div class="col-md-3" style="padding-top: 25px;">
                                                            <a href="javascript:void(0)" class="payment-gateway"
                                                                id="btn-pm-{{ $paymentMethod->id }}"
                                                                data-id="{{ $paymentMethod->id }}" 
                                                                data-name="{{ $paymentMethod->name }}"
                                                                disabled='false'>
                                                                <img src="{{ asset($paymentMethod->logo) }}" alt="{{ $paymentMethod->name }}">
                                                            </a>
                                                        </div>
                                                        @endif
                                                    @endforeach
                                                </div>

                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <!-- END OF PAYMENT METHODS LIST -->
                            </div>
                        </div>

                    </div>

                    <!-- BEFORE FOOTER DESIGN -->
                    <div class="section mcb-section">
                        <img src="{{ asset('v2/content/one/images/bg-sectionbg4.png') }}">   
                    </div>   
                    <!-- END OF BEFORE FOOTER DESIGN -->
                    
                    <div class="section mcb-section">
                        @include('v2.partials.footer_search')
                        @include('v2.partials.footer_v2')
                    </div>
                </div>
            </div>
            
        </div>
    </div>
@endsection

@section('after_scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
    <script src="{{ asset('js/splide.min.js') }}"></script>

    <script>
        var status = 'ready';

        const minimum_amount  = {{ $business->paybizWallet ? $business->paybizWallet->minimum_amount : 0 }};
        let add_fee, min_fee, fee, total_amount = 0;
        var pmethod_id  = null;
        var firstname   = null; 
        var lastname    = null; 
        var address     = null; 
        var email       = null; 
        var mobile      = null;

        var has_error   = null;

        var firstname   = $('input[name=firstname]');
        var lastname    = $('input[name=lastname]');
        var address     = $('input[name=address]');
        var email       = $('input[name=email]');
        var mobile      = $('input[name=mobile]');
        var amount      = $('input[name=amount]');

        var form =  @include('v2.partials.payment_form');

        $(document).ready(function () {

            $("#Content").show();

            // Active In Navbar
            var menu = $('#menu');
            $('li[id=faq_menu]').addClass("current-menu-item");

            // Payment Methods On Click
            $('.payment-gateway').click(function(event){
                var data_id = $.parseJSON($(this).attr('data-id'));

                // Check Status For Double Clicking
                if(status === 'ready') {
                    paymentForm(data_id);
                } else {
                    return false;
                }
            });

            @if($errors->any())
                
                paymentForm({{old('payment_method_id')}});

                setTimeout(function (){
                    setOldValue();
                    getFee();
                    validateInput();
                }, 3000);
            @endif
        });
    
    </script>

    <script>
        // Show Payment Form
        function paymentForm(id)
        {
            status = 'loading';

            // Get Payment Method Form Data
            $.ajax({
                url: '/api/payment-method/' + id + '/get',
                success: function (response) {
                    pmethod_id = response.id;
                    fee     = response.fee;
                    add_fee = response.additional_fee;
                    min_fee = response.minimum_fee;

                    // Show Payment Form
                    var payment_modal = $.confirm({

                        title: '<img style="max-height: 100px; max-width: 400px;" src="/' + response.logo + '">',
                        content: form,
                        type: 'dark',
                        columnClass: 'w-200',
                        buttons: {
                            confirm: {
                                btnClass: 'btn-dark',
                                action: function(){
                                    // Get Entered Data
                                    $('#loading').show();
                                    $('#paymentContainer').hide();
                                    has_error = null;
                                    validateInput();

                                    if(has_error === null) {
                                        return false;
                                    } else if(has_error === false) {
                                        $('#paymentForm').submit();
                                        $('#loading').show();
                                        $('#processing').show();
                                        $('.jconfirm-buttons').hide();
                                        $('#paymentContainer').hide();
                                        return false;
                                    } else {
                                        return false;
                                    }
                                    
                                }
                            },
                            cancel: {
                                btnClass: 'btn-red',
                                action: function(){
                                    // $.alert('Cancelled!');
                                    status = 'ready';
                                }
                            },
                        }

                    });

                    setTimeout(function (){
                        // Assign Payment Method Id
                        $('input[name=payment_method_id]').val(pmethod_id);
                    }, 1000);
                },
                error: function (error) {
                    console.log(error);

                    $.alert({
                        title: 'Warning',
                        type: 'red',
                        icon: 'fa fa-warning',
                        content: 'Payment Not Available.',
                    });
                }
            });

        }

        // Get Fee and Total Amount
        function getFee()
        {
            amount = $('input[name=amount]');

            fee     = typeof fee === "undefined" ? 0 : parseFloat(fee);
			add_fee = typeof add_fee === "undefined" ? 0 : parseFloat(add_fee);
			min_fee = typeof min_fee === "undefined" ? 0 : parseFloat(min_fee);

            let fee_percent = parseFloat(fee) * (12/100); //.27
            let total_tax   = parseFloat(fee) + parseFloat(fee_percent); // 2.25 + .27 = 2.52

            let total_with_tax = -(parseFloat(total_tax) - 100);
			let total_fee   = ((parseFloat(amount.val()) / parseFloat(total_with_tax/100)) - parseFloat(amount.val()));

            total_fee = typeof total_fee === "undefined" ? 0 : parseFloat(total_fee);

            
			total_fee = total_fee > min_fee 
                ? total_fee 
                : ((parseFloat(min_fee) - parseFloat({{ env('TNH_MARKUP_FIXED') }})) * parseFloat(1.12)) + parseFloat({{ env('TNH_MARKUP_FIXED') }});
            total_with_fee = total_fee + parseFloat(amount.val());

            if(isNaN(total_with_fee)) {
                $('input[name=amount]').val( Intl.NumberFormat('en', {style: 'currency', currency: 'PHP'}).format( 0 ) );
                $('input[name=fee]').val( Intl.NumberFormat('en', {style: 'currency', currency: 'PHP'}).format( 0 ) );
			    $('input[name=total_amount]').val( Intl.NumberFormat('en', {style: 'currency', currency: 'PHP'}).format( 0 ));
			    return;
			}

			$('input[name=fee]').val( Intl.NumberFormat('en', {style: 'currency', currency: 'PHP'}).format( total_fee ) );
			$('input[name=total_amount]').val( Intl.NumberFormat('en', {style: 'currency', currency: 'PHP'}).format( total_with_fee ));
        }

        // Validate Inputs || Check If Input Data are Correct
        function validateInput()
        {
            has_error   = false;

            firstname   = $('input[name=firstname]');
            lastname    = $('input[name=lastname]');
            address     = $('input[name=address]');
            email       = $('input[name=email]');
            mobile      = $('input[name=mobile]');
            amount      = $('input[name=amount]');

            if(!firstname.val()) {
                firstname.addClass('has_error');
                $('#firstname').append('<div class="error">The firstname field is required.</div>');
                has_error = true;
            }
            if(!lastname.val()) {
                lastname.addClass('has_error');
                $('#lastname').append('<div class="error">The lastname field is required.</div>');
                has_error = true;
            }
            // if(!address.val()) {
            //     address.addClass('has_error');
            //     $('#address').append('<div class="error">The address field is required.</div>');
            //     has_error = true;
            // }
            if(!email.val()) {
                email.addClass('has_error');
                $('#email').append('<div class="error">The email field is required.</div>');
                has_error = true;
            } else {
                if (!validateEmail(email.val())) {
                    email.addClass('has_error');
                    $('#email').append('<div class="error">The email must be a valid email address.</div>');
                }
            }

            if(!mobile.val()) {
                mobile.addClass('has_error');
                $('#mobile').append('<div class="error">The mobile field is required.</div>');
                has_error = true;
            }
            if(!amount.val()) {
                amount.addClass('has_error');
                $('#amount').append('<div class="error">The amount field is required.</div>');
                has_error = true;
            } else {
                if(amount.val() < minimum_amount) {
                    amount.addClass('has_error');
                    $('#amount').append('<div class="error">The amount is less than the minimum amount required.</div>');
                    has_error = true;
                }
            }

            // Assign Payment Method Id
            if($('input[name=payment_method_id]').val() === "undefined" || ! $('input[name=payment_method_id]').val()) {
                $('input[name=payment_method_id]').val(pmethod_id);
            }

            $('#loading').hide();
            $('#paymentContainer').show();

        }

        function validateEmail(email) {
            const re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            return re.test(email);
        }

        function setOldValue()
        {
            firstname   = $('input[name=firstname]');
            lastname    = $('input[name=lastname]');
            address     = $('input[name=address]');
            email       = $('input[name=email]');
            mobile      = $('input[name=mobile]');
            description = $('input[name=description]');
            amount      = $('input[name=amount]');

            $('input[name=firstname]').val('{{ old('firstname') }}');
            $('input[name=lastname]').val('{{ old('lastname') }}');
            $('input[name=address]').val('{{ old('address') }}');
            $('input[name=email]').val('{{ old('email') }}');
            $('input[name=mobile]').val('{{ old('mobile') }}');
            $('input[name=description]').val('{{ old('description') }}');
            $('input[name=amount]').val('{{ old('amount') }}');

            @if($errors->has('firstname'))
                firstname.addClass('has_error');
                $('#firstname').append('<div class="error">{{ $errors->first('firstname') }}</div>');
            @endif

            @if($errors->has('lastname'))
                lastname.addClass('has_error');
                $('#lastname').append('<div class="error">{{ $errors->first('lastname') }}</div>');
            @endif

            @if($errors->has('address'))
                address.addClass('has_error');
                $('#address').append('<div class="error">{{ $errors->first('address') }}</div>');
            @endif

            @if($errors->has('email'))
                email.addClass('has_error');
                $('#email').append('<div class="error">{{ $errors->first('email') }}</div>');
            @endif

            @if($errors->has('mobile'))
                mobile.addClass('has_error');
                $('#mobile').append('<div class="error">{{ $errors->first('mobile') }}</div>');
            @endif
            
            @if($errors->has('description'))
                description.addClass('has_error');
                $('#description').append('<div class="error">{{ $errors->first('description') }}</div>');
            @endif

            @if($errors->has('amount'))
                amount.addClass('has_error');
                $('#amount').append('<div class="error">{{ $errors->first('amount') }}</div>');
            @endif
        }
    </script>

    
@endsection