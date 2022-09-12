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
                        
                        <!-- BUSINESS ONLINE PAYMENT VUE -->
                        <div id="online_payment_app">
                            <business-online-payment :business_slug="'{{ $business->slug }}'"></business-online-payment>
                        </div>
                        <!-- END OF BUSINESS ONLINE PAYMENT VUE -->

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

@push('before_scripts')

    <!-- Vue JS Online Payment Mix -->
    <script src="{{ mix('js/onlinepayment.js') }}"></script>
    
@endpush