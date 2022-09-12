@extends('v2.layouts.app2')

@section('body_class', "color-custom style-simple button-flat layout-full-width no-content-padding header-split minimalist-header-no sticky-header sticky-tb-color ab-hide subheader-both-center menu-link-color menuo-no-borders mobile-tb-center mobile-side-slide mobile-mini-mr-ll tablet-sticky mobile-header-mini mobile-sticky tr-header tr-menu tr-content be-reg-209621")

@section('after_styles')
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}"> 
    <style type="text/css">

        .bg-primary {
            background-color: #2d3a4c !important;
        }

        .text-decoration-underline {
            text-decoration: underline;
        }

        .text-primary {
            color: #fca70b !important;
        }

        .text-brown {
            color: #532f17 !important;
        }

        .text-dark {
            color: #343a40 !important;
        }

        .text-white {
            color: #fff !important;
        }

        .text-center {
            text-align: center;
        }

        .text-left {
            text-align: left;
        }

        .text-right {
            text-align: right;
        }

        .d-block {
            display: block;
        }

        .m-0 {
            margin: 0;
            margin-bottom: 4px;
        }

        .m-l-1 {
            margin-left: 10pxl
        }

        .m-r-1 {
            margin-right: 10pxl
        }

        .table {
            width: 100%;
            /*border: 1px solid #ccc;*/
            padding: 10px;
        }

        .table td {
            font-size: 13px;
            vertical-align: top;
        }

        .items {
            background: #f4f6f7;
            margin-top: 30px;
        }
        
        .items table td {
            font-size: 14px;
            padding-top: 3px;
            padding-bottom: 3px;
        }

        .body {
            background: #FFF;
        }

        .footer {
            /*position: absolute;*/
            background: #FFF;
            padding: 20px;
            width: 100%;
        }

        .m-t-0 {
            margin-top: 0 !important;
        }

        .m-b-0 {
            margin-bottom: 0 !important;
        }

        pre {
            overflow: hidden; 
            white-space: break-spaces; 
            word-break: break-word;
            padding-left: 50px;
            padding-right: 50px;
        }

        table td {
            border-width: 0 !important;
        }

        pre {
            background: #fff;
        }
    </style>
@endsection

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

    <div id="Content">
        <div class="content_wrapper clearfix">
            <div class="sections_group">
                <div class="entry-content">
                    @if(!session()->has('success'))
                        <div class="section mcb-section" style="padding-top:0px; background-repeat:no-repeat; background-position:center top; background-size: cover;">
                            <div class="section_wrapper mcb-section-inner">
                                <div class="wrap mcb-wrap one-sixth  valign-top clearfix">
                                    <div class="mcb-wrap-inner">
                                        <div class="column mcb-column one column_placeholder">
                                            <div class="placeholder">
                                                &nbsp;
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="wrap mcb-wrap one valign-top move-up clearfix">
                                    <div class="mcb-wrap-inner">
                                        <div class="column mcb-column one column_column">
                                            <div class="column_attr clearfix">
                                                
                                                <div class="">

                                                    <!-- Business Information -->
                                                    <div class="header" style="padding: 20px; color: #FFF;">
                                                        <img src="{{ url($business->logo) }}" alt="business logo" width="100" style="display: block; margin: auto;">
                                                        <h3 style="text-align: center !important; color: #532f17 !important; margin-bottom: 0 !important;">
                                                            <b>{{ $business->name }}</b>
                                                        </h3>
                                                        <p style="text-align: center !important; color: #532f17 !important; margin-bottom: 0 !important; font-size: 12px;">
                                                            <b>{{ $business->complete_address }}</b>
                                                        </p>
                                                    </div>

                                                    <div style="padding: 20px 20px 40px 20px; background: #FFF; margin: 0; font-family: Arial, Helvetica, sans-serif;">

                                                        <!-- TRANSACTION MESSAGE -->
                                                        <div class="items" style="padding: 20px; background: #f4f6f7; margin-top: 30px;">
                                                            <table class="table" style=" width: 100% !important; padding: 10px; !important;">
                                                                <tbody>
                                                                    <tr>
                                                                        <td class="text-center text-brown" style="color: #532f17 !important; 
                                                                            font-size: 14px !important;
                                                                            padding-top: 3px !important;
                                                                            padding-bottom: 3px !important;">
                                                                                <b>{{ $paynamicsPayment->response_message }}</b>
                                                                                <br>
                                                                                Kindly check your inbox or spam folder in your email for additional copy
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>

                                                        <div class="items" style="padding: 20px; background: #f4f6f7; margin-top: 30px;">
                                                            <table class="table" style=" width: 100% !important; padding: 10px; !important;">
                                                                <tbody>
                                                                    <!-- DATE -->
                                                                    <tr>
                                                                        <td class="text-left text-brown" style="color: #532f17 !important; 
                                                                            font-size: 14px !important;
                                                                            padding-top: 3px !important;
                                                                            padding-bottom: 3px !important;">
                                                                                <b>Date :</b>
                                                                        </td>
                                                                        <td class="text-right text-brown"  style="text-align: right !important; color: #532f17 !important;
                                                                            font-size: 14px !important;
                                                                            padding-top: 3px !important;
                                                                            padding-bottom: 3px !important;">
                                                                            <b>{{ \Carbon\Carbon::parse($paynamicsPayment->timestamp)->format('F d, Y'); }}</b>
                                                                        </td>
                                                                    </tr>
                                                                    <!-- TIME -->
                                                                    <tr>
                                                                        <td class="text-left text-brown"  style="color: #532f17 !important;
                                                                            font-size: 14px !important;
                                                                            padding-top: 3px !important;
                                                                            padding-bottom: 3px !important;">
                                                                                <b>Time :</b>
                                                                        </td>
                                                                        <td style="text-align: right !important; color: #532f17 !important;">
                                                                            <b>{{ \Carbon\Carbon::parse($paynamicsPayment->timestamp)->format('h:i A'); }}</b>
                                                                        </td>
                                                                    </tr>
                                                                    <!-- EXPIRY -->
                                                                    <tr>
                                                                        <td class="text-left text-brown" style="color: #532f17 !important;
                                                                            font-size: 14px !important;
                                                                            padding-top: 3px !important;
                                                                            padding-bottom: 3px !important;">
                                                                                <b>Exipiry Limit :</b>
                                                                        </td>
                                                                        <td class="text-right text-brown" style="text-align: right !important; color: #532f17 !important;
                                                                            font-size: 14px !important;
                                                                            padding-top: 3px !important;
                                                                            padding-bottom: 3px !important;">
                                                                                <b>{{ \Carbon\Carbon::parse($paynamicsPayment->expiry_limit)->format('F d, Y - h:i A'); }}</b>
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>

                                                        <div class="items" style="padding: 20px; background: #f4f6f7; margin-top: 30px;">
                                                            <div class="container-fluid text-center" style="text-align: center !important;">

                                                                <img src="{{ asset($paymentMethod->logo) }}" alt="Payment Logo" style="max-height: 125px !important;">
                                                                <hr>

                                                                <table class="table" style=" width: 100% !important; padding: 10px; !important;">
                                                                    <tbody>
                                                                        <!-- REFERENCE NUMBER -->
                                                                        <tr>
                                                                            <td class="text-left text-brown" style="text-align: left !important; color: #532f17 !important;
                                                                                font-size: 14px !important;
                                                                                padding-top: 3px !important;
                                                                                padding-bottom: 3px !important;">
                                                                                    <b>Reference Number :</b>
                                                                            </td>
                                                                            <td class="text-right text-brown" style="text-align: right !important; color: #532f17 !important;
                                                                                font-size: 14px !important;
                                                                                padding-top: 3px !important;
                                                                                padding-bottom: 3px !important;">
                                                                                    <b> {{ $payment_instructions->pay_reference }} </b>
                                                                            </td>
                                                                        </tr>
                                                                        <!-- AMOUNT -->
                                                                        <tr>
                                                                            <td class="text-left text-brown" style="text-align: left !important; color: #532f17 !important;
                                                                                font-size: 14px !important;
                                                                                padding-top: 3px !important;
                                                                                padding-bottom: 3px !important;">
                                                                                <b>Amount :</b>
                                                                            </td>
                                                                            <td class="text-right text-brown" style="text-align: right !important; color: #532f17 !important;
                                                                                font-size: 14px !important;
                                                                                padding-top: 3px !important;
                                                                                padding-bottom: 3px !important;">
                                                                                <b> PHP {{ number_format($amount, 2, '.', ', ') }} </b>
                                                                            </td>
                                                                        </tr>
                                                                       
                                                                    </tbody>
                                                                </table>

                                                                <!-- INSTRUCTIONS -->
                                                                <div class="column one text-center text-brown" style="text-align: center !important; color: #532f17 !important;
                                                                    font-size: 14px !important;
                                                                    padding-top: 3px !important;
                                                                    padding-bottom: 3px !important;
                                                                    margin-bottom: 0 !important;">
                                                                        <b>PAYMENT INSTRUCTION</b>
                                                                </div>

                                                                <div class="text-left text-brown" style="text-align: left !important; color: #532f17 !important;
                                                                    font-size: 14px !important;
                                                                    padding-top: 3px !important;
                                                                    padding-bottom: 3px !important;">
                                                                        <pre class="text-brown"
                                                                            style="overflow: hidden !important; 
                                                                            white-space: break-spaces !important; 
                                                                            word-break: break-word !important;
                                                                            padding-left: 50px !important;
                                                                            padding-right: 50px !important;">
                                                                                {!! str_replace("PAYMENT INSTRUCTION", "", $payment_instructions->pay_instructions) !!}
                                                                        </pre>
                                                                </div>
                                                            </div>

                                                        </div>

                                                    </div>

                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="wrap mcb-wrap one valign-top clearfix">
                                    <div class="mcb-wrap-inner">
                                        <div class="column mcb-column one-fourth column_placeholder">
                                            <div class="placeholder">
                                                &nbsp;
                                            </div>
                                        </div>
                                        <div class="column mcb-column one-second column_column">
                                            <div class="column_attr clearfix">
                                                <hr class="no_line" style="margin:0 auto 40px">
                                                <p class="big">
                                                   {{--  To avail your  SINGLE-PAGE WEBSITE  --}}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="section mcb-section aligncenter" style="padding-top:50px; background-repeat:no-repeat; background-position:center top; background-size: cover;">
                            <div class="section_wrapper mcb-section-inner">
                                <div class="wrap mcb-wrap one  valign-top clearfix">
                                    <div class="mcb-wrap-inner">
                                        <div class="column mcb-column one column_placeholder">
                                            <i class="fas fa-check-circle fa-7x" style="color: #532f17"></i>
                                            <h2>
                                                <b>Registered Sucessfully!</b>
                                            </h2>
                                            {{-- <a href="{{ session('paymentUrl') }}" target="_blank">
                                                <img src="{{asset('images/pay-now-2.png')}}">
                                            </a> --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

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

</div>

@endsection

@section('after_scripts')
  
    <script>
        $(document).ready(function () {
            var menu = $('#menu');
            // $('li[id=faq_menu]').addClass("current-menu-item")
            // $("#get_listed").remove();
        });
    </script>
@endsection


