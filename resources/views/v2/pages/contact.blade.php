@extends('v2.layouts.app2')

@section('after_styles')
<!-- BOOTSTRAP CSS -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    
    <style type="text/css"> 
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
        }

        .main-category i{
            font-size: 30px;
        }
    </style>
    <link rel="stylesheet" href="{{ asset('v2/content/one/css/footer_search.css') }}">

    <style>
        @media only screen and (max-width: 768px) {
            /* #mfn-rev-slider {
                display: none;
            } */
            .wrap-bg {
                height: 400px !important;
            }
            .tp-fullwidth-forcer {
                height: 400px !important;
            }
        }
    </style>
@endsection

@section('body_class', "color-custom style-simple button-flat layout-full-width no-content-padding header-split minimalist-header-no sticky-header sticky-tb-color ab-hide subheader-both-center menu-link-color menuo-no-borders mobile-tb-center mobile-side-slide mobile-mini-mr-ll tablet-sticky mobile-header-mini mobile-sticky tr-header tr-menu tr-content be-reg-209621")

@section('before_scripts')
    <!-- JS FOR REGISTRATION -->
    <script src="{{asset('js/jquery-3.1.0.min.js')}}"></script>
@endsection

@section('content')
<div id="Wrapper">
    <div id="Header_wrapper">
        <header id="Header">
            @include('v2.partials.top_bar')
            <div class="mfn-main-slider" id="mfn-rev-slider">
                <div class="wrap-bg" style="background:#FEC842;padding:0px;">
                    <div id="rev_slider_1_1" class="rev_slider fullscreenbanner" style="display:none;" data-version="5.4.8">
                        <ul>
                            <li data-index="rs-2" data-transition="fade" data-slotamount="default" data-hideafterloop="0" data-hideslideonmobile="off" data-easein="Power4.easeOut" data-easeout="default" data-masterspeed="2000" data-rotate="0" data-saveperformance="off" data-title="Slide"
                            data-param1="" data-param2="" data-param3="" data-param4="" data-param5="" data-param6="" data-param7="" data-param8="" data-param9="" data-param10="" data-description="">
                            <img src="{{ asset('v2/content/one/images/bg-sectionbg7.jpg') }}" data-bg="p:center bottom;" class="rev-slidebg fullscreen-container">
                                
                                <div class="tp-caption   tp-resizeme rs-parallaxlevel-2" id="slide-2-layer-1" data-x="center" data-hoffset="" data-y="center" data-voffset="-180" data-width="['none','none','none','none']" data-height="['none','none','none','none']" data-type="image" data-responsive_offset="on"
                                    data-frames='[{"delay":10,"speed":2000,"frame":"0","from":"opacity:0;","to":"o:1;","ease":"Power4.easeOut"},{"delay":"wait","speed":310,"frame":"999","to":"opacity:0;","ease":"Power3.easeInOut"}]' data-textAlign="['inherit','inherit','inherit','inherit']"
                                    data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]" style="z-index: 10;">
                                        <!-- FULLSCREEN BANNER -->
                                        <div class="text-center">
                                            <h1 style="color:#44056C; font-size: 75px; font-weight: bold;">CONTACT US</h1>
                                            <h1 style="color:#44056C; font-size: 30px; font-weight: bold; line-height: 40px;">Feel free to contact us</h1>
                                        </div>  
                                        <!-- END OF FULLSCREEN BANNER -->
                                </div>
                                <!-- ICON -->
                                <div class="tp-caption   tp-resizeme rs-parallaxlevel-3" id="slide-2-layer-2" data-x="center" data-hoffset="-210" data-y="center" data-voffset="250" data-width="['none','none','none','none']" data-height="['none','none','none','none']" data-type="image"
                                    data-responsive_offset="on" data-frames='[{"delay":1310,"speed":1610,"frame":"0","from":"x:20px;y:20px;opacity:0;","to":"o:1;","ease":"Power3.easeOut"},{"delay":"wait","speed":300,"frame":"999","to":"opacity:0;","ease":"Power3.easeOut"}]'
                                    data-textAlign="['inherit','inherit','inherit','inherit']" data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]" style="z-index: 5;">
                                    <img src="{{ asset('v2/content/one/images/letters/here_icon.png') }}" data-ww="60px" data-hh="60px" width="126" height="139" data-no-retina>
                                </div>

                                <!-- B -->
                                <div class="tp-caption   tp-resizeme rs-parallaxlevel-3" id="slide-2-layer-3" data-x="center" data-hoffset="-150" data-y="center" data-voffset="253" data-width="['none','none','none','none']" data-height="['none','none','none','none']" data-type="image"
                                    data-responsive_offset="on" data-frames='[{"delay":1350,"speed":1830,"frame":"0","from":"y:20px;opacity:0;","to":"o:1;","ease":"Power3.easeOut"},{"delay":"wait","speed":300,"frame":"999","to":"opacity:0;","ease":"Power3.easeInOut"}]'
                                    data-textAlign="['inherit','inherit','inherit','inherit']" data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]" style="z-index: 6;">
                                    <img src="{{ asset('v2/content/one/images/letters/b1-v2.png') }}" data-ww="60px" data-hh="60px" width="124" height="135" data-no-retina>
                                </div>

                                <!-- U -->
                                <div class="tp-caption   tp-resizeme rs-parallaxlevel-3" id="slide-2-layer-4" data-x="center" data-hoffset="-80" data-y="center" data-voffset="256" data-width="['none','none','none','none']" data-height="['none','none','none','none']" data-type="image"
                                    data-responsive_offset="on" data-frames='[{"delay":1430,"speed":2190,"frame":"0","from":"x:-20px;y:20px;opacity:0;","to":"o:1;","ease":"Power3.easeOut"},{"delay":"wait","speed":300,"frame":"999","to":"opacity:0;","ease":"Power3.easeInOut"}]'
                                    data-textAlign="['inherit','inherit','inherit','inherit']" data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]" style="z-index: 7;">
                                    <img src="{{ asset('v2/content/one/images/letters/u1-v2.png') }}" data-ww="60px" data-hh="60px" width="155" height="182" data-no-retina>
                                </div>

                                <!-- L -->
                                <div class="tp-caption   tp-resizeme rs-parallaxlevel-3" id="slide-2-layer-4" data-x="center" data-hoffset="-10" data-y="center" data-voffset="259" data-width="['none','none','none','none']" data-height="['none','none','none','none']" data-type="image"
                                    data-responsive_offset="on" data-frames='[{"delay":1430,"speed":2190,"frame":"0","from":"x:-20px;y:20px;opacity:0;","to":"o:1;","ease":"Power3.easeOut"},{"delay":"wait","speed":300,"frame":"999","to":"opacity:0;","ease":"Power3.easeInOut"}]'
                                    data-textAlign="['inherit','inherit','inherit','inherit']" data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]" style="z-index: 7;">
                                    <img src="{{ asset('v2/content/one/images/letters/l1-v2.png') }}" data-ww="60px" data-hh="60px" width="155" height="182" data-no-retina>
                                </div>
                            
                                <!-- A -->
                                <div class="tp-caption   tp-resizeme rs-parallaxlevel-3" id="slide-2-layer-5" data-x="center" data-hoffset="50" data-y="center" data-voffset="259" data-width="['none','none','none','none']" data-height="['none','none','none','none']" data-type="image"
                                    data-responsive_offset="on" data-frames='[{"delay":1560,"speed":2210,"frame":"0","from":"x:20px;y:-20px;opacity:0;","to":"o:1;","ease":"Power3.easeOut"},{"delay":"wait","speed":300,"frame":"999","to":"opacity:0;","ease":"Power3.easeInOut"}]'
                                    data-textAlign="['inherit','inherit','inherit','inherit']" data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]" style="z-index: 8;">
                                    <img src="{{ asset('v2/content/one/images/letters/a1-v2.png') }}" data-ww="60px" data-hh="60px" width="170" height="170" data-no-retina>
                                </div>

                                <!-- C -->
                                <div class="tp-caption   tp-resizeme rs-parallaxlevel-3" id="slide-2-layer-5" data-x="center" data-hoffset="120" data-y="center" data-voffset="256" data-width="['none','none','none','none']" data-height="['none','none','none','none']" data-type="image"
                                    data-responsive_offset="on" data-frames='[{"delay":1560,"speed":2210,"frame":"0","from":"x:20px;y:-20px;opacity:0;","to":"o:1;","ease":"Power3.easeOut"},{"delay":"wait","speed":300,"frame":"999","to":"opacity:0;","ease":"Power3.easeInOut"}]'
                                    data-textAlign="['inherit','inherit','inherit','inherit']" data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]" style="z-index: 8;">
                                    <img src="{{ asset('v2/content/one/images/letters/c1-v2.png') }}" data-ww="60px" data-hh="60px" width="170" height="170" data-no-retina>
                                </div>


                                <!-- A -->
                                <div class="tp-caption   tp-resizeme rs-parallaxlevel-3" id="slide-2-layer-7" data-x="center" data-hoffset="190" data-y="center" data-voffset="253" data-width="['none','none','none','none']" data-height="['none','none','none','none']" data-type="image"
                                    data-responsive_offset="on" data-frames='[{"delay":1820,"speed":2280,"frame":"0","from":"x:-20px;y:-20px;opacity:0;","to":"o:1;","ease":"Power3.easeOut"},{"delay":"wait","speed":300,"frame":"999","to":"opacity:0;","ease":"Power3.easeInOut"}]'
                                    data-textAlign="['inherit','inherit','inherit','inherit']" data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]" style="z-index: 9;">
                                    <img src="{{ asset('v2/content/one/images/letters/a2-v2.png') }}" data-ww="60px" data-hh="60px" width="129" height="137" data-no-retina>
                                </div>

                                <!-- N -->
                                <div class="tp-caption   tp-resizeme rs-parallaxlevel-3" id="slide-2-layer-7" data-x="center" data-hoffset="255" data-y="center" data-voffset="250" data-width="['none','none','none','none']" data-height="['none','none','none','none']" data-type="image"
                                    data-responsive_offset="on" data-frames='[{"delay":1820,"speed":2280,"frame":"0","from":"x:-20px;y:-20px;opacity:0;","to":"o:1;","ease":"Power3.easeOut"},{"delay":"wait","speed":300,"frame":"999","to":"opacity:0;","ease":"Power3.easeInOut"}]'
                                    data-textAlign="['inherit','inherit','inherit','inherit']" data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]" style="z-index: 9;">
                                    <img src="{{ asset('v2/content/one/images/letters/n1-v2.png') }}" data-ww="60px" data-hh="60px" width="129" height="137" data-no-retina>
                                </div>
                                <!-- MAP -->
                                <div class="tp-caption   tp-resizeme rs-parallaxlevel-2" id="slide-2-layer-1" data-x="center" data-hoffset="" data-y="center" data-voffset="60" data-width="['none','none','none','none']" data-height="['none','none','none','none']" data-type="image" data-responsive_offset="on"
                                    data-frames='[{"delay":10,"speed":2000,"frame":"0","from":"opacity:0;","to":"o:1;","ease":"Power4.easeOut"},{"delay":"wait","speed":310,"frame":"999","to":"opacity:0;","ease":"Power3.easeInOut"}]' data-textAlign="['inherit','inherit','inherit','inherit']"
                                    data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]" style="z-index: 10;">
                                    <img src="{{ asset('v2/content/one/images/op-logo-v2-letter.png') }}" data-ww="1000px" data-hh="379px" width="567" height="416" data-no-retina>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </header>
    </div>
    <div id="Content" style="display: none;">
        <div class="content_wrapper clearfix">
            <div class="sections_group">
                <div class="entry-content">
                    @if(!session()->has('success'))
                        <div class="section mcb-section" style="background:#FEC842;">
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
                                <div class="wrap mcb-wrap two-third valign-top move-up clearfix" style="border-radius:20px; padding:30px 30px 10px; background:#FFCE4E;" data-mobile="no-up">
                                    <div class="mcb-wrap-inner">
                                        <div class="column mcb-column one column_column">
                                            <div class="column_attr clearfix">
                                                <h4 style="color:#44056C; font-weight:700;">Contact Form</h4><br>
                                                <div id="contactWrapper">
                                                   <form id="contactform" method="POST" action="{{url('send_message')}}">
                                                        @csrf
                                                        {{ csrf_field() }}
                                                        <!-- One Second (1/2) Column -->
                                                        <div class="column one-second">
                                                            <input class="v2-input" value="{{old('name')}}" placeholder="Your name" type="text" name="name" id="name" size="40" aria-required="true" aria-invalid="false" />
                                                            @if($errors->has('name'))
                                                                <div class="error"><strong>{{ $errors->first('name') }}</strong></div>
                                                            @endif
                                                        </div>
                                                        <!-- One Second (1/2) Column -->
                                                        <div class="column one-second">
                                                            <input class="v2-input" value="{{old('email')}}" placeholder="Your e-mail" type="email" name="email" id="email" size="40" aria-required="true" aria-invalid="false" />
                                                            @if($errors->has('email'))
                                                                <div class="error"><strong>{{ $errors->first('email') }}</strong></div>
                                                            @endif
                                                        </div>
                                                        <div class="column one">
                                                            <input class="v2-input" value="{{old('subject')}}" placeholder="Subject" type="text" name="subject" id="subject" size="40" aria-invalid="false" />
                                                            @if($errors->has('subject'))
                                                                <div class="error"><strong>{{ $errors->first('subject') }}</strong></div>
                                                            @endif
                                                        </div>
                                                        <div class="column one">
                                                            <textarea class="v2-textarea" placeholder="Message" name="body" id="body" style="width:100%;" rows="10" aria-invalid="false">{{old('body')}}</textarea>
                                                            @if($errors->has('body'))
                                                                <div class="error"><strong>{{ $errors->first('body') }}</strong></div>
                                                            @endif
                                                        </div>
                                                        <div class="column one-second" st>
                                                            {!! Captcha::display( [
                                                                'data-theme' => 'light',
                                                                'data-type' =>  'select',
                                                            ]) !!}
                                                        </div>
                                                        <div class="column one">
                                                            <button style="border-radius:20px; width:100%; background:#EE2C2C;" id="sendMessage" name="sendMessage" type="submit" class="btn btn-success">Send A Message</button>
                                                        </div>
                                                    </form>
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
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        @if(session()->get('success') === true)
                            <div class="section mcb-section aligncenter" style="padding-top:50px; background-repeat:no-repeat; background-position:center top; background-size: cover;">
                                <div class="section_wrapper mcb-section-inner">
                                    <div class="wrap mcb-wrap one  valign-top clearfix">
                                        <div class="mcb-wrap-inner">
                                            <div class="column mcb-column one column_placeholder">
                                                <div class="placeholder">
                                                    <i class="fas fa-check-circle fa-7x" style="color: #532f17"></i>
                                                    <h2>
                                                        <b>{!! session()->get('message') !!}</b>
                                                    </h2>
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
                                                <div class="placeholder">
                                                    <i class="fas fa-window-close fa-7x" style="color: red;"></i>
                                                    <h2>
                                                        <b>{!! session()->get('message') !!}</b>
                                                    </h2>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endif

                    <!-- BEFORE FOOTER DECORATION  -->
                    <img src="{{ asset('v2/content/one/images/bg-sectionbg4.png') }}" style="background: #FEC842; margin-top: -5px;">  
                    <!-- END OF BEFORE FOOTER DECORATION  -->
                    @include('v2.partials.footer_search')
                    @include('v2.partials.footer_v2')
                </div>
            </div>
        </div>
    </div>
   
</div>
{{-- <script>
    $("#sub_category_id").select2();
</script> --}}
@endsection

@section('after_scripts')
  
    <script>
        $(document).ready(function () {
            var menu = $('#menu');
            $('li[id=contact_menu]').addClass("current-menu-item");
        });
        var pageNumber = 1;
        var revapi1, tpj;
        ( function() {
                if (!/loaded|interactive|complete/.test(document.readyState))
                    document.addEventListener("DOMContentLoaded", onLoad);
                else
                    onLoad();
                function onLoad() {
                    if (tpj === undefined) {
                        tpj = jQuery;
                        if ("off" == "on")
                            tpj.noConflict();
                    }
                    if (tpj("#rev_slider_1_1").revolution == undefined) {
                        revslider_showDoubleJqueryError("#rev_slider_1_1");
                    } else {
                        revapi1 = tpj("#rev_slider_1_1").show().revolution({
                            sliderType : "standard",
                            sliderLayout : "fullscreen",
                            dottedOverlay : "none",
                            delay : 9000,
                            navigation : {
                                onHoverStop : "off",
                            },
                            visibilityLevels : [1240, 1024, 778, 480],
                            gridwidth : 1240,
                            gridheight : 800,
                            lazyType : "none",
                            parallax : {
                                type : "mouse",
                                origo : "slidercenter",
                                speed : 3000,
                                speedbg : 0,
                                speedls : 3000,
                                levels : [2, 4, 6, 20, 25, 30, 35, 40, 45, 46, 47, 48, 49, 50, 51, 55],
                            },
                            shadow : 0,
                            spinner : "spinner2",
                            stopLoop : "on",
                            stopAfterLoops : 0,
                            stopAtSlide : 2,
                            shuffle : "off",
                            autoHeight : "off",
                            fullScreenAutoWidth : "off",
                            fullScreenAlignForce : "off",
                            fullScreenOffsetContainer : "",
                            fullScreenOffset : "",
                            disableProgressBar : "on",
                            hideThumbsOnMobile : "off",
                            hideSliderAtLimit : 0,
                            hideCaptionAtLimit : 0,
                            hideAllCaptionAtLilmit : 0,
                            debugMode : false,
                            fallbacks : {
                                simplifyAll : "off",
                                nextSlideOnWindowFocus : "off",
                                disableFocusListener : false,
                            }
                        });
                    };
                };
            }());
    </script>
    <script>
        $(document).ready(function () {
            $("#Content").show();
        });
    </script>
@endsection