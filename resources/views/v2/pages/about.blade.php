@extends('v2.layouts.app2')

{{-- @section('html_style', 'background-image: none;') --}}

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
@endsection

@section('body_class', "color-custom style-simple button-flat layout-full-width no-content-padding header-split minimalist-header-no sticky-header sticky-tb-color ab-hide subheader-both-center menu-link-color menuo-no-borders mobile-tb-center mobile-side-slide mobile-mini-mr-ll tablet-sticky mobile-header-mini mobile-sticky tr-header tr-menu tr-content be-reg-209621")

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
                                <img src="{{ asset('v2/content/one/images/bg-sectionbg1.jpg') }}" data-bg="p:center bottom;" class="rev-slidebg fullscreen-container">
                                   
                                    <div class="tp-caption   tp-resizeme rs-parallaxlevel-2" id="slide-2-layer-1" data-x="center" data-hoffset="" data-y="center" data-voffset="-80" data-width="['none','none','none','none']" data-height="['none','none','none','none']" data-type="image" data-responsive_offset="on"
                                        data-frames='[{"delay":10,"speed":2000,"frame":"0","from":"opacity:0;","to":"o:1;","ease":"Power4.easeOut"},{"delay":"wait","speed":310,"frame":"999","to":"opacity:0;","ease":"Power3.easeInOut"}]' data-textAlign="['inherit','inherit','inherit','inherit']"
                                        data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]" style="z-index: 10;">
                                            <!-- FULLSCREEN BANNER -->
                                            <div class="text-center">
                                                <h1 style="color: white; font-size: 50px; font-weight:700; ">About Project One</h1>
                                                <h1 style="color:#44056C; font-size: 70px; font-weight: bold; line-height: 60px;">Intelligent searching has <br>never been this easy.</h1>
                                            </div>  
                                            <!-- END OF FULLSCREEN BANNER -->

                                            <!-- LOGO -->
                                            <!-- <div class="section mcb-section" style="padding-top:0px; padding-bottom:50px">
                                                <div class="section_wrapper mcb-section-inner">
                                                    <div class="wrap mcb-wrap one valign-top move-up clearfix" style="margin-top:-70px !important;" data-mobile="no-up">
                                                        <div class="mcb-wrap-inner">
                                                            <div class="column mcb-column one column_image">
                                                                <div class="image_frame image_item no_link scale-with-grid aligncenter no_border">
                                                                    <div class="image_wrapper">
                                                                        <img class="scale-with-grid" src="{{ asset('v2/content/one/images/here_icon.png') }}">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> -->
                                            <!-- END OFLOGO -->
                                    </div>
                                    <div class="tp-caption   tp-resizeme rs-parallaxlevel-2" id="slide-2-layer-1" data-x="center" data-hoffset="" data-y="center" data-voffset="300%" data-width="['none','none','none','none']" data-height="['none','none','none','none']" data-type="image" data-responsive_offset="on"
                                        data-frames='[{"delay":10,"speed":2000,"frame":"0","from":"opacity:0;","to":"o:1;","ease":"Power4.easeOut"},{"delay":"wait","speed":310,"frame":"999","to":"opacity:0;","ease":"Power3.easeInOut"}]' data-textAlign="['inherit','inherit','inherit','inherit']"
                                        data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]" style="z-index: 10;">
                                        <img class="scale-with-grid" src="{{ asset('v2/content/one/images/here_icon.png') }}">
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
                        
                        <div class="section mcb-section" style="padding-top:80px;/*background-image:url({{ asset('../content/seo3/images/seo3-sectionbg1.png') }});*/background-repeat:no-repeat;background-position:center;">
                            <div class="section_wrapper mcb-section-inner">
                                <div class="wrap mcb-wrap mcb-wrap-j3it3pb94 one valign-top clearfix">
                                    <div class="mcb-wrap-inner">
                                        <div class="column mcb-column mcb-item-u4wcjveg6 one-second column_column">
                                            <div class="column_attr clearfix" style="padding:0 8% 0 0;">
                                                <h2>Online presence for all.</h2>
                                                <hr class="no_line" style="margin: 0 auto 15px;">
                                                <p>
                                                    Tigernet Hosting and IT Services would like to extend his help to all small to medium sized businesses to be searchable in the internet with a very affordable cost. 
                                                    We spend thousands just for your business to be searched in Google and Facebook.
                                                </p>
                                                <p>
                                                    Do don't need to spend thousands for your business to be listed and have presence online. All you need to do is get listed at One {{ Config('settings.province') }} at a very minimum cost (More cheap than a Starbucks drink).
                                                </p>
                                            </div>
                                        </div>
                                        <div class="column mcb-column mcb-item-ooo13kgad one-second column_column">
                                            <div class="column_attr clearfix" style>
                                                <p>
                                                    Once you get listed, your business information will be visible right away.
                                                </p>
                                                <hr class="no_line" style="margin: 0 auto 15px;">
                                                <ul class="list_check">
                                                    <li>
                                                        Easy registration.
                                                    </li>
                                                    <li>
                                                        Affordable.
                                                    </li>
                                                    <li>
                                                        No management needed.
                                                    </li>
                                                    <li>
                                                        SEO Optimized
                                                    </li>
                                                    <li>
                                                        24/7 Support
                                                    </li>
                                                    <li>
                                                        No contract
                                                    </li>
                                                    <li>
                                                        No website needed
                                                    </li>
                                                </ul>
                                                
                                            </div>
                                        </div>
                                        <div class="column mcb-column mcb-item-oqzvon80m one column_divider">
                                            <hr class="no_line" style="margin: 0 auto 60px;">
                                        </div>
                                    </div>
                                </div>
                                <!-- START OF STATISTICS -->
                                {{-- <div class="wrap mcb-wrap mcb-wrap-5751a4d04 one seo3-wrap column-margin-20px valign-top clearfix" style="border-radius:25px; padding:40px 40px 20px ;background-color: #2d3a4c;">
                                    <div class="mcb-wrap-inner">
                                        <div class="column mcb-column mcb-item-833a761a8 one-fourth column_quick_fact dark">
                                            <div class="quick_fact align_ animate-math">
                                                <div class="number-wrapper">
                                                    <span class="number" data-to="{{ $totalBusinesses }}">{{ $totalBusinesses }}</span>
                                                </div>
                                                <h3 class="title">Business Listed</h3>
                                                <hr class="hr_narrow">
                                                <div class="desc"></div>
                                            </div>
                                        </div>
                                        <div class="column mcb-column mcb-item-108e30e1f one-fourth column_quick_fact dark">
                                            <div class="quick_fact align_ animate-math">
                                                <div class="number-wrapper">
                                                    <span class="number" data-to="{{ $dtiRegistered }}">{{ $dtiRegistered }}</span>
                                                </div>
                                                <h3 class="title">Total DTI Registered</h3>
                                                <hr class="hr_narrow">
                                                <div class="desc"></div>
                                            </div>
                                        </div>
                                        <div class="column mcb-column mcb-item-5b362abb9 one-fourth column_quick_fact dark">
                                            <div class="quick_fact align_ animate-math">
                                                <div class="number-wrapper">
                                                    <span class="number" data-to="{{ $uniqueVisitors }}">{{ $uniqueVisitors }}</span>
                                                </div>
                                                <h3 class="title">Unique Visitors</h3>
                                                <hr class="hr_narrow">
                                                <div class="desc"></div>
                                            </div>
                                        </div>
                                        <div class="column mcb-column mcb-item-b46580449 one-fourth column_quick_fact dark">
                                            <div class="quick_fact align_ animate-math">
                                                <div class="number-wrapper">
                                                    <span class="number" data-to="{{ $totalVisits }}">{{ $totalVisits }}</span><span class="label postfix">k</span>
                                                </div>
                                                <h3 class="title">Total Visits</h3>
                                                <hr class="hr_narrow">
                                                <div class="desc"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div> --}}
                                <!-- END OF STATISTICS -->
                            </div>
                        </div>

                        <div class="section mcb-section" style="padding-top:0;padding-bottom:50px;/*background-image:url({{ asset('../content/seo3/images/seo3-sectionbg1.png') }});*/background-repeat:no-repeat;background-position:center;">
                            <div class="section_wrapper mcb-section-inner">
                                <div class="wrap mcb-wrap mcb-wrap-fa5xwrykg one valign-top clearfix" style="padding:0 10%">
                                    <div class="mcb-wrap-inner">
                                        <div class="column mcb-column mcb-item-z7l5k9pib one-third column_column">
                                        </div>
                                        <div class="column mcb-column mcb-item-z7l5k9pib one-third column_column">
                                            <div class="column_attr clearfix" style="background-color:#FEC842;padding:70px;box-shadow: 0px 10px 30px rgba(55,43,125,.2); border-radius: 25px; ">
                                                <h2 class="themecolor">How it works?</h2>
                                                <hr class="no_line" style="margin: 0 auto 15px;">
                                                <p style="color: #fff;">
                                                    It is easy. Fill up the form get verified by a call and we will do all the heavy lifting. 
                                                </p>
                                                <hr class="no_line" style="margin: 0 auto 15px;">
                                                <div class="image_frame image_item scale-with-grid no_border hover-disable">
                                                    <div class="image_wrapper">
                                                        <a href="" rel="prettyphoto">
                                                            <div class="mask"></div>
                                                            <img class="scale-with-grid" src="{{ asset('../content/seo3/images/seo3-about-icon1.png') }}">
                                                        </a>
                                                        <div class="image_links ">
                                                            <a href="" class="zoom" rel="prettyphoto"><i class="icon-search"></i></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    
                        <!-- BEFORE FOOTER DECORATION  -->
                        <img src="{{ asset('v2/content/one/images/bg-sectionbg4.png') }}">  
                    </div>
                </div>
            @include('v2.partials.footer_search')
            @include('v2.partials.footer_v2')
            </div>
        </div>
    </div>
@endsection
 
@section('after_scripts')

    <script type="text/javascript">

        $(document).ready(function () {
            var menu = $('#menu');
            // $('#' + indexValue).addClass("selectedQuestion");
            $('li[id=about_menu]').addClass("current-menu-item");
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