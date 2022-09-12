@extends('v2.layouts.app2')

@section('after_styles')
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}"> 
    {{-- <link rel="stylesheet" href="{{ asset('v2/content/one/css/footer_search.css') }}"> --}}
    <!-- BUSINESS PORTAL CSS -->
    <link rel="stylesheet" href="{{ asset('css/business_login.css') }}">
    
    {{-- <style type="text/css">
        .search_key{
            height: 36px;
        }
        .searchButton {
            height: 36px;
        }
        @media only screen and (max-width: 768px) {
            .search_key {
                height: 51px;
            }
            .searchButton {
                height: 51px;
            }

            .portal-bg-cover {
                display: none;
            }
        }

        .main-category i{
            font-size: 30px;
        }

        
    </style> --}}

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

        <div id="Content">
            <div class="content_wrapper clearfix">
                <div class="sections_group">
                    <div class="entry-content">

                        <div class="section mcb-section login-section">
                             <div class="container">
                                <div class="row" style="text-align: center;">
                                    <div class="col-md-12 text-center">
                                        <div class="error_number text-center">
                                            <small>ERROR</small><br>
                                            {{ $error_number }}
                                            <hr>
                                        </div>
                                        <div class="error_title text-muted">
                                            @yield('title')
                                        </div>
                                        <div class="error_description text-muted">
                                            <small>
                                                @yield('description')
                                            </small>
                                        </div>
                                    </div>
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

    </div>
@endsection


