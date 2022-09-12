@extends('v2.layouts.app2')

@section('after_styles')
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}"> 
    <!-- BUSINESS PORTAL CSS -->
    <link rel="stylesheet" href="{{ asset('css/business_login.css') }}">

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
                             <div id="login-container" class="container hidden">
                                <!-- LOGIN FORM -->
                                <div class="">
                                    <div class="col-md-4 mr-auto ml-auto">
                                        <div class="card" style="border-radius: 20px;">
                                            <div class="card-header text-center" style="border-radius: 20px 20px 0 0;">
                                                <h3>{{ __('Login') }}</h3>
                                            </div>

                                            <div class="card-body">
                                                <form role="form" method="POST" action="{{ route('business-portal.login.submit') }}" aria-label="{{ __('Login') }}">
                                                    @csrf

                                                    <div class="form-group row">
                                                        <div class="col-md-12">
                                                            <label for="email" class="col-form-label text-md-right">
                                                                Email
                                                            </label>

                                                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror w-100" name="email" value="{{ old('email') }}" required autocomplete="off" placeholder="Email">

                                                            @error('email')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">

                                                        <div class="col-md-12">
                                                            <label for="password" class="col-form-label text-md-right">
                                                                Password
                                                            </label>
                                                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror w-100" name="password" required autocomplete="current-password" placeholder="Password">

                                                            @error('password')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <!-- LOGIN BUTTON -->
                                                    <div class="form-group row mb-0">
                                                        <div class="col-md-12 text-center">
                                                            <button type="submit" class="btn btn-primary btn-login w-50">
                                                                {{ __('Login') }} 
                                                            </button>

                                                           {{--  @if (Route::has('password.request'))
                                                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                                                    {{ __('Forgot Your Password?') }}
                                                                </a>
                                                            @endif --}}
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- END OF LOGIN FORM -->
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

@section('after_scripts')
    {{-- <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <script src="{{ mix('js/app.js') }}"></script> --}}

    <script type="text/javascript">

        $(document).ready(function () {
            var menu = $('#menu');
            // $('#' + indexValue).addClass("selectedQuestion");
            $('li[id=faq_menu]').addClass("current-menu-item");
            $('li[id=faq_menu]').removeClass("hidden");
            $('#login-container').addClass("show");
        });
    
    </script>
@endsection


