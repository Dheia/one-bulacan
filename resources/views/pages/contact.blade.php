@extends('layouts.app2')

@section('body_class', "page-template-default page color-custom style-simple button-round layout-full-width no-content-padding no-shadows header-transparent header-fw minimalist-header-no sticky-header sticky-tb-color ab-hide subheader-both-center menu-link-color menuo-right menuo-no-borders mobile-tb-center mobile-side-slide mobile-mini-mr-ll tablet-sticky mobile-header-mini mobile-sticky")

@section('content')
<div id="Wrapper">
    <div id="Header_wrapper">
        @include('partials.header')
    </div>
    <div id="Content">
        <div class="content_wrapper clearfix">
            <div class="sections_group">
                <div class="entry-content">
                    <div class="section mcb-section mcb-section-hgghelh7q equal-height-wrap" style="padding-top:120px;padding-bottom:0px;background-image:url({{ asset('../content/seo3/images/seo3-sectionbg8.png') }});background-repeat:no-repeat;background-position:center top;">
                        <div class="section_wrapper mcb-section-inner">
                            <div class="wrap mcb-wrap mcb-wrap-doduw8rzm one-second valign-middle clearfix" style="padding:0 5% 0 0">
                                <div class="mcb-wrap-inner">
                                    <div class="column mcb-column mcb-item-9skr72l7j one column_column">
                                        <div class="column_attr clearfix" style>
                                            <h6 class="seo3-heading">CONTACT US</h6>
                                            <hr class="no_line" style="margin: 0 auto 15px;">
                                            <h1>Feel free to contact us</h1>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="wrap mcb-wrap mcb-wrap-sn368u1p6 one-second valign-middle clearfix">
                                <div class="mcb-wrap-inner">
                                    <div class="column mcb-column mcb-item-m6k423o0x one column_image">
                                        <div class="image_frame image_item no_link scale-with-grid no_border">
                                            <div class="image_wrapper">
                                                <img class="scale-with-grid" src="{{ asset('../content/seo3/images/seo3-contact-pic1.png') }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="section mcb-section mcb-section-23bpmgj2d" style="padding-top:60px;padding-bottom:70px;background-color:">
                        <div class="section_wrapper mcb-section-inner">
                            <div class="wrap mcb-wrap mcb-wrap-i1qfky6h8 two-third valign-top clearfix">
                                <div class="mcb-wrap-inner">
                                    <div class="column mcb-column mcb-item-jmx1qxi3c one column_column">
                                        <div class="column_attr clearfix" style>
                                            <h2>Our office</h2>
                                        </div>
                                    </div>
                                    <div class="column mcb-column mcb-item-f5m0u0qif one-second column_column">
                                        <div class="column_attr clearfix" style="background-image:url({{ asset('../content/seo3/images/seo3-contact-icon1.png') }});background-repeat:no-repeat;background-position:left top;padding:7px 0 0 70px;">
                                            <p>
                                                322 San Roque
                                                <br> Guagua, Pampanga
                                                <br> Philippines
                                            </p>
                                        </div>
                                    </div>
                                    <div class="column mcb-column mcb-item-84gldyicl one-second column_column">
                                        <div class="column_attr clearfix" style="background-image:url({{ asset('../content/seo3/images/seo3-contact-icon2.png') }});background-repeat:no-repeat;background-position:left top;padding:7px 0 0 70px;">
                                            <p>
                                                Phone: +63 45 409 8336
                                                <br> Fax: +61 (0) 383 766 284
                                            </p>
                                        </div>
                                    </div>
                                    <div class="column mcb-column mcb-item-om56bxtof one column_divider">
                                        <hr class="no_line">
                                    </div>
                                    <div class="column mcb-column mcb-item-yr9cocm8j one-second column_column">
                                        <div class="column_attr clearfix" style="padding:7px 0 0 70px;">
                                            <p>
                                                24/7 Live Chat Support
                                                <br>
                                                Office Hours: Monday - Saturday
                                                <br> 9:00AM - 6:00PM
                                            </p>
                                        </div>
                                    </div>
                                    <div class="column mcb-column mcb-item-2w8dwudxg one-second column_column">
                                        <div class="column_attr clearfix" style="background-image:url({{ asset('../content/seo3/images/seo3-contact-icon3.png') }});background-repeat:no-repeat;background-position:left top;padding:7px 0 0 70px;">
                                            <p>
                                                <a href="mailto:info@onepampanga.com?Subject=Inquiry from One Pampanga">info@onepampanga.com</a>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="wrap mcb-wrap mcb-wrap-z05rs02xt one-third valign-top clearfix">
                                <div class="mcb-wrap-inner">
                                    <div class="column mcb-column mcb-item-y1bmkuk75 one column_column">
                                        <div class="column_attr clearfix" style>
                                            <h2>Find us on</h2>
                                        </div>
                                    </div>
                                    <div class="column mcb-column mcb-item-5el7ix1ab one column_column">
                                        <div class="column_attr clearfix" style>
                                            <p style="font-size: 30px;">
                                                <a href="#">
                                                    <i class="icon-twitter-circled"></i>
                                                </a>
                                                <a href="https://facebook.com/onepampanga1" target="_blank">
                                                    <i class="icon-facebook-circled"></i>
                                                </a>
                                                <a href="#">
                                                    <i class="icon-skype-circled"></i>
                                                </a>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @if(session()->has('success'))
                        <div id="Success" class="section mcb-section mcb-section-uqnjs4egm" style="padding-top:0px;padding-bottom:0px;background-color:">
                            <div class="section_wrapper mcb-section-inner">
                                <div class="wrap mcb-wrap mcb-wrap-fisa74pn3 one valign-top clearfix">
                                    <div class="mcb-wrap-inner">
                                        <div class="column mcb-column mcb-item-eyf6kgam2 one column_column">
                                            <div class="column_attr clearfix align_center" style="background-color:#e73827;padding:70px;box-shadow: 0px 10px 30px rgba(55,43,125,.2); border-radius: 25px; ">
                                                <h2 class="themecolor">Message Sent!</h2>
                                                <hr class="no_line" style="margin: 0 auto 20px;">
                                                <div id="contactWrapper">
                                                    <div class="alert alert-success">
                                                        <i class="fas fa-check-circle fa-5x"></i>
                                                        <br>
                                                    </div>
                                                </div>
                                                <h2 style="color: #fff;">{{ session()->get('success') }}</h2>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="section mcb-section mcb-section-uqnjs4egm" style="padding-top:0px;padding-bottom:0px;background-color:">
                            <div class="section_wrapper mcb-section-inner">
                                <div class="wrap mcb-wrap mcb-wrap-fisa74pn3 one valign-top clearfix">
                                    <div class="mcb-wrap-inner">
                                        <div class="column mcb-column mcb-item-eyf6kgam2 one column_column">
                                            <div class="column_attr clearfix align_center" style="background-color:#e73827;padding:70px;box-shadow: 0px 10px 30px rgba(55,43,125,.2); border-radius: 25px; ">
                                                <h2 class="themecolor">Contact form</h2>
                                                <hr class="no_line" style="margin: 0 auto 20px;">
                                                <div id="contactWrapper">
                                                    <form id="contactform" method="POST" action="{{url('send_message')}}">
                                                        @csrf
                                                        {{ csrf_field() }}
                                                        <!-- One Second (1/2) Column -->
                                                        <div class="column one-second">
                                                            <input value="{{old('name')}}" placeholder="Your name" type="text" name="name" id="name" size="40" aria-required="true" aria-invalid="false" />
                                                            @if($errors->has('name'))
                                                                <div class="error"><strong>{{ $errors->first('name') }}</strong></div>
                                                            @endif
                                                        </div>
                                                        <!-- One Second (1/2) Column -->
                                                        <div class="column one-second">
                                                            <input value="{{old('email')}}" placeholder="Your e-mail" type="email" name="email" id="email" size="40" aria-required="true" aria-invalid="false" />
                                                            @if($errors->has('email'))
                                                                <div class="error"><strong>{{ $errors->first('email') }}</strong></div>
                                                            @endif
                                                        </div>
                                                        <div class="column one">
                                                            <input value="{{old('subject')}}" placeholder="Subject" type="text" name="subject" id="subject" size="40" aria-invalid="false" />
                                                            @if($errors->has('subject'))
                                                                <div class="error"><strong>{{ $errors->first('subject') }}</strong></div>
                                                            @endif
                                                        </div>
                                                        <div class="column one">
                                                            <textarea placeholder="Message" name="body" id="body" style="width:100%;" rows="10" aria-invalid="false">{{old('body')}}</textarea>
                                                            @if($errors->has('body'))
                                                                <div class="error"><strong>{{ $errors->first('body') }}</strong></div>
                                                            @endif
                                                        </div>
                                                        <div class="column one-second">
                                                            <div class="captcha column one-third">
                                                                <span>{!!captcha_img('flat');!!}</span>
                                                            </div>
                                                            <div class="column one-third">
                                                                <button id="refresh_captcha" name="refresh_caotcha" type="button"><i class="fa fa-refresh">Refresh</i></button>
                                                            </div>
                                                        </div>
                                                        <div class="column one">
                                                            <input placeholder="Enter captcha" type="text" name="captcha" id="captcha" size="40" aria-required="true" aria-invalid="false" />
                                                            @if($errors->has('captcha'))
                                                                <div class="error"><strong>{{ $errors->first('captcha') }}</strong></div>
                                                            @endif
                                                        </div>
                                                        <div class="column one">
                                                            <button id="sendMessage" name="sendMessage" type="submit" class="btn btn-success">Send A Message</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                    @include('partials.newsletter')
                </div>
            </div>
        </div>
    </div>
    @include('partials.footer_search')
    @include('partials.footer')
</div>
@endsection

@section('before_scripts')
<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
<script>
    $(document).ready(function () {
        // $('#' + indexValue).addClass("selectedQuestion");
        $('li[id=contact_menu]').addClass("current-menu-item");
    });
    
</script>
@endsection

