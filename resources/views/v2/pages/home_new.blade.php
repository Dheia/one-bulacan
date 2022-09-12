@extends('v2.layouts.app2')

@section('after_styles')
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}"> 
    <link rel="stylesheet" href="{{asset('css/splide-2.4.14.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/splide-default-2.4.14.min.css')}}">
    <style>  
        .splide__slide img {
            width : 100%;
            height: auto;
        }

        .splide__list li:hover .splide__box-content{
            display: block !important;
        }

        .business-info a,
        .business-info p
        {
            font-family: "Dosis", Helvetica, Arial, sans-serif;
            line-height: 24px;
            font-size: 18px; 
            font-weight:400;
            color: #44056C;
            margin-bottom:3px !important;
        }
        
        a .t{
            background-color: white !important;
        }

        .tags,
        .tags i
        {
            font-family: "Dosis", Helvetica, Arial, sans-serif;
            letter-spacing: 0;
            line-height: 25px;
            font-size: 11px;
            color: #666; 

        }
        .tags i{
            margin-right: 10px; 
        }

        .tags a{ 
            text-decoration: underline;
        }
        .circle {
            width: 40px;
            height: 40px;
            line-height: 40px;
            border-radius: 50%;
            font-size: 25px;
            color: #fff;
            text-align: center;
            background: #44056C;
        }
        .splide__arrow--next{
            display:none;
        }
        .splide__arrow--prev{
            display:none;
        }
        .tp-fullwidth-forcer{
            height:1000px !important;
        }
        .category_slide:hover{
            transform: translateY(-30px);
            transition-duration: 0.5s;
        }
        .category_slide{
            margin-top:20px;
        }

    </style> 
@endsection

@section('body_class', "template-slider color-custom style-simple button-flat layout-full-width header-split minimalist-header-no sticky-header sticky-tb-color ab-hide subheader-both-center menu-link-color menuo-no-borders mobile-tb-center mobile-side-slide mobile-mini-mr-ll tablet-sticky mobile-header-mini mobile-sticky tr-header tr-menu tr-content be-reg-209621")

@section('content')
<div id="Wrapper">
    <div id="Header_wrapper">
        @include('v2.partials.header')
    </div>
        <div id="Content">
            <div class="content_wrapper clearfix">
                <div class="sections_group">
                    <div class="entry-content">
                    <div class="section mcb-section">
                        <!-- <img src="{{ asset('v2/content/one/images/bg-sectionbg-yellow-white.jpg') }}" style="width: 100%;">   
                    </div>  -->

                        <!-- CATEGORIES SLIDER -->
                        <div class="section mcb-section mcb-section-0v432r1ip bg-cover-ultrawide" style="background-image:url('v2/content/one/images/bg-sectionbg6.png'); padding-bottom:100px; background-color: #fff;">
                            <div class="section_wrapper mcb-section-inner">
                                    <div class="text-center">
                                        <h2 style="font-size:60px;"><b>WANT TO EXPLORE?</h2>
                                        <h4 style="font-size:30px; padding-bottom:50px;">Scroll through different categories</h4>
                                    </div>

                                <div id="secondary-slider-2" class="splide">
                                    <div class="splide__track">
                                        <ul class="splide__list">
                                            @foreach($categories as $index => $category)
                                                <li class="splide__slide category_slide">

                                                    <div style="background-image:url('v2/content/one/images/one-bg-icon.png'); background-repeat: no-repeat; background-size:230px auto; height:310px; width:260px;" >
                                                        <div style="display:flex; justify-content: center; padding-top:55px; width:240px;">
                                                            <div style="height:100px; width:100px; display:flex; justify-content: center;">
                                                                <a href="{{ url('businesses/' . $category->slug) }}">
                                                                <img src="{{ asset($category->image) }}" style="width:100%; height:auto;">
                                                                </a>
                                                            </div>
                                                        </div>
                                                        
                                                        <div style="position:absolute; bottom:0; width:100%; height:150px; margin-left:30px; ">
                                                            <!-- CIRCLE INDEX  -->
                                                            <div class="circle">
                                                                {{$index+1 }}
                                                            </div>
                                                            <!-- CATEGORIES NAME -->
                                                            <a style="color: #532f17;" href="{{ url('businesses/' . $category->slug) }}">
                                                                <h3 style="font-weight:700;">{{$category->name }}</h3>
                                                            </a>
                                                        </div>
                                                    </div>

                                                </li>
                                            @endforeach 
                                        </ul>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                        <!-- END OF CATEGORIES SLIDER -->

                        <div class="section mcb-section">
                            <img src="{{ asset('v2/content/one/images/bg-sectionbg8.png') }}">   
                        </div> 
                        
                        <div class="section mcb-section" style="padding-top:105px; padding-bottom:0px; background-color:#713896; margin-top:-2px;">
                            <div class="section_wrapper mcb-section-inner">
                                <div class="text-center">
                                    <img class="scale-with-grid" src="{{ asset('v2/content/one/images/here_icon.png') }}" style="margin-top: -200px;"> 
                                    <h2 style="color:#F7D2C5; font-weight:500; text-transform: uppercase;">Finding something new?
                                    <br><b style="font-size:40px;"> Check out these businesses</b></h2>
                                </div>
                                @if(count($featured_businesses)>0)
                                <div id="secondary-slider" class="splide">
                                    <div class="splide__track">
                                        <ul class="splide__list">   
                                        @foreach($featured_businesses as $featured_business)
                                            <li class="splide__slide">
                                                <div style="width:270px; padding-top:20px;" class="text-center">
                                                    <div style="width:270px;">
                                                        <a href="{{ url($featured_business->category_slug.'/'.$featured_business->slug) }}">
                                                            <div style="display: flex; justify-content: center; align-items: center; height: 190px; width: 270px;">
                                                                <div style="display: flex; justify-content: center; align-items: center; 
                                                                    height: 190px; width: 190px; background: #fff; border-radius: 5px;">
                                                                    <img src="{{ asset($featured_business->logo ? $featured_business->logo : 'v2/content/one/images/logo1.png') }}" 
                                                                        style="max-width:190px; max-height: 190px; border-radius: 5px;" >
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </div>
                                                    <h3 style="padding-top:20px;">
                                                        <b><a href="{{ url($featured_business->category_slug.'/'.$featured_business->slug) }}" style="color:#fff; font-size:40px;">{{ $featured_business->name }}</a></b>
                                                    </h3>
                                                    <div class="image_wrapper">
                                                        <img class="scale-with-grid" src="{{ asset('v2/content/one/images/one-divider-red.png') }}">
                                                    </div>
                                                    <h3>
                                                        <b><a href="" style="color:#fff; font-size:25px;">{{ $featured_business->category_name }} </a> </b>
                                                    </h3>
                                                </div>
                                            </li>
                                        @endforeach
                                        </ul>
                                    </div>
                                </div>
                                @endif
                                                     
                            </div>
                            <div class="section mcb-section">
                                <img src="{{ asset('v2/content/one/images/bg-sectionbg3.jpg') }}">   
                            </div> 
                        </div>   
                        

                        <div class="section mcb-section" style="margin-top:-2px; background-color:#F7D2C5;">
                            <div class="section_wrapper mcb-section-inner">
                            <div class="wrap mcb-wrap mcb-wrap-s3kydcxqf one-second valign-middle clearfix" style="padding:70px 5% 40px 7%;">
                                    <div class="mcb-wrap-inner">
                                        <div class="column mcb-column mcb-item-piwa4nuz0 one column_column">
                                            <div class="column_attr clearfix" style>
                                                <h3 style="color: #EE2C2C; text-transform: uppercase; font-size:34px; font-weight: 700;">Make One {{ ucfirst(Config('settings.province')) }} a part of you!</h3>
                                                <p style="color: #44056C;">
                                                Download the app today! 
                                                </p>
                                            </div>
                                       
                                        <div class="container" style="padding-left:0px;">
                                             <!-- APPSTORE -->
                                            <div class="column one-third">
                                                <a href="https://apps.apple.com/app/id1567166518?fbclid=IwAR20VK3pYq-MAgDmG12pzTO_UnVvW5scLsdw5-5GvdCVK5r6I93OC2CAEE4" target="_blank">
                                                    <img src="{{ asset('v2/content/one/images/download_appstore.png') }}">  
                                                </a>
                                            </div>

                                            <!-- PLAYSTORE -->
                                            <div class="column one-third">
                                            <a href="https://play.google.com/store/apps/details?id=com.tigernethost.one_pampanga&hl=gsw" target="_blank">
                                                    <img src="{{ asset('v2/content/one/images/download_playstore.png') }}">  
                                                </a>
                                            </div>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- <div class="wrap mcb-wrap mcb-wrap-1ivrwesy4 one-second column-margin-0px valign-bottom bg-contain clearfix" style="padding:0 4%;;">
                                    <div class="mcb-wrap-inner">
                                        <div class="column mcb-column mcb-item-r2do0rv3b one column_image">
                                            <div class="image_frame image_item no_link scale-with-grid aligncenter no_border" style="margin-top:-100px;">
                                                <div class="image_wrapper"><img class="scale-with-grid" src="{{ asset('v2/content/one/images/one-pampane-mobile.png') }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div> -->
                                <div class="wrap mcb-wrap mcb-wrap-1ivrwesy4 one-second column-margin-0px valign-bottom bg-contain clearfix mobile-app" style="padding:0 4%;;">
                                    <div class="td-cards td-cards--v4">
                                        <div class="td-cards__inner">
                                            <div class="td-cards__card">
                                            <img src="{{ asset('v2/content/one/images/one-pampane-mobile.png') }}" alt="Image description">
                                            </div>

                                            <div class="td-cards__shadow" aria-hidden="true"></div>
                                        </div>
                                    </div>
                                </div>
                            </div> 
                            <img src="{{ asset('v2/content/one/images/bg-sectionbg4.png') }}">   
                        </div>
                        
                        @include('v2.partials.footer_search')
                        @include('v2.partials.footer_v2')
                    </div>
                </div>
            </div>
        </div>

      
    </div>
@endsection

@section('after_scripts')
    <!-- GIF SITE LOADER -->
    <script src="{{ asset('js/splide.min.js') }}"></script>
    <script src="{{ asset('plugins/splide-3.2.1/dist/js/splide.min.js') }}"></script>
     <script src="{{ asset('v2/plugins/rs-plugin-5.3.1/js/jquery.themepunch.tools.min.js') }}"></script>
    <script src="{{ asset('v2/plugins/rs-plugin-5.3.1/js/jquery.themepunch.revolution.min.js') }}"></script>

    <script src="{{ asset('v2/plugins/rs-plugin-5.3.1/js/extensions/revolution.extension.video.min.js') }}"></script>
    <script src="{{ asset('v2/plugins/rs-plugin-5.3.1/js/extensions/revolution.extension.slideanims.min.js') }}"></script>
    <script src="{{ asset('v2/plugins/rs-plugin-5.3.1/js/extensions/revolution.extension.actions.min.js') }}"></script>
    <script src="{{ asset('v2/plugins/rs-plugin-5.3.1/js/extensions/revolution.extension.layeranimation.min.js') }}"></script>
    <script src="{{ asset('v2/plugins/rs-plugin-5.3.1/js/extensions/revolution.extension.kenburn.min.js') }}"></script>
    <script src="{{ asset('v2/plugins/rs-plugin-5.3.1/js/extensions/revolution.extension.navigation.min.js') }}"></script>
    <script src="{{ asset('v2/plugins/rs-plugin-5.3.1/js/extensions/revolution.extension.migration.min.js') }}"></script>
    <script src="{{ asset('v2/plugins/rs-plugin-5.3.1/js/extensions/revolution.extension.parallax.min.js') }}"></script>
    <script>
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
        $(document).ready(function(){
            
            $("#nextPage").click(function(e) {
                e.preventDefault();
                pageNumber +=1;
                $.ajax({
                    type : 'GET',
                    data : {
                            page: pageNumber,
                            _token:"{{csrf_token()}}"
                        },
                    url: 'home',
                    success : function(data){
                        $("#featuredBusinesses").empty();
                        if(data.length == 0){
                            console.log("data length 0");
                        }else{
                            $('#featuredBusinesses').html(data.html);
                        }
                    },error: function(data){
                         console.log("The request failed");
                         console.log(data);
                    },
                })
            });
            $("#prevPage").click(function(e) {
                e.preventDefault();
                pageNumber -=1;
                $.ajax({
                    type : 'GET',
                    data : {
                            page: pageNumber,
                            _token:"{{csrf_token()}}"
                        },
                    url: 'home',
                    success : function(data){
                            $("#featuredBusinesses").empty();
                            if(data.length == 0){
                                console.log("data length 0");
                            }else{
                                $('#featuredBusinesses').html(data.html);
                            }
                    },error: function(data){
                         console.log("The request failed");
                         console.log(data);
                    },
                })
            });
            
            $('li[id=home_menu]').addClass("current-menu-item");
            $('.customer-logos').slick({
                slidesToShow: 5,
                slidesToScroll: 5,
                autoplaySpeed: 3000,
                arrows: false,
                dots: false,
                    pauseOnHover: true,
                    responsive: [{
                    breakpoint: 768,
                    settings: {
                        slidesToShow: 3
                    }
                }],
                lazyLoad: 'ondemand',
            });
            $('.customer-logos').show();
        });
    </script>
    <script>
        
        window.addEventListener( "load", function () {
                var splide = new Splide( '#secondary-slider', {
                    type       : 'loop',
                    perPage    : 3,
                    fixedWidth : 250,
                    height     : 500,
                    gap        : 185,
                    rewind     : true,
                    cover      : true,
                    pagination : false,
                    autoplay: true,
                    slideFocus : true
                } );

                splide.on( 'mounted', function () {
                    $('#secondary-slider').css("visibility", "visible");
                } );
                
                splide.mount();
            } );

            window.addEventListener( "load", function () {
                var splide1 = new Splide( '#secondary-slider-2', {
                    type       : 'loop',
                    perPage    : 3,
                    fixedWidth : 250,
                    height     : 300,
                    gap        : 55,
                    rewind     : true,
                    cover      : true,
                    pagination : false,
                    autoplay: true,
                    slideFocus : true
                } );

                splide1.on( 'mounted', function () {
                    $('#secondary-slider-2').css("visibility", "visible");
                } );
                
                splide1.mount();
            } );
    </script>
    
@endsection
