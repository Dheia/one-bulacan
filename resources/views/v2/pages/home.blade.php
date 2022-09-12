@extends('v2.layouts.app2')

@section('after_styles')
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
@endsection

@section('body_class', "template-slider color-custom style-simple button-flat layout-full-width header-split minimalist-header-no sticky-header sticky-tb-color ab-hide subheader-both-center menu-link-color menuo-no-borders mobile-tb-center mobile-side-slide mobile-mini-mr-ll tablet-sticky mobile-header-mini mobile-sticky tr-header tr-menu tr-content be-reg-209621")

@section('content')
    <div id="Wrapper">
        <div id="Header_wrapper">
            @include('v2.partials.header')
        </div>

        <div id="Content" style="display: none;">
            <div class="content_wrapper clearfix">
                <div class="sections_group">
                    <div class="entry-content">
                        <div class="section mcb-section bg-cover" style="padding-top:150px; padding-bottom:125px; background-image:url(v2/content/one/images/section2_bg2.jpg); background-repeat:no-repeat; background-position:left bottom">
                            <div class="section_wrapper mcb-section-inner">
                                <div class="wrap mcb-wrap one-second valign-top clearfix">
                                    <div class="mcb-wrap-inner">
                                        <div class="column mcb-column one column_column">
                                            <div class="column_attr clearfix">
                                                <h5>WELCOME TO ONE {{ strtoupper(Config('settings.province')) }}!</h5>
                                                <h2>Find the <b>BEST</b> 
                                                <br>
                                                places here.

                                                </h2>

                                                {{-- <hr class="no_line" style="margin:0 auto 10px"> --}}
                                                <!-- <p class="big">
                                                    Quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo continuer. dolor in reprehenderit in voluptate
                                                </p> -->
                                                <form action="search" method="POST" >
                                                    @csrf
                                                    <input name="searchkey" style="width: 100%; outline: none;" class="searchbox" type="textbox" placeholder="Looking for...">
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="section mcb-section no-margin-h no-margin-v equal-height-wrap full-width" style="padding-top:0px; padding-bottom:0px">
                            <div class="section_wrapper mcb-section-inner">
                                <div class="wrap mcb-wrap one-second valign-middle move-up clearfix" style="margin-top:-30px" data-mobile="no-up">
                                    <div class="mcb-wrap-inner">
                                        <div class="column mcb-column one column_image burger2-shadow">
                                            <div class="image_frame image_item no_link scale-with-grid no_border">
                                                <div class="image_wrapper">
                                                    <img class="scale-with-grid" src="{{ asset('v2/content/one/images/home-slider-slide1.jpg')}}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="wrap mcb-wrap one-second valign-middle clearfix" style="padding:40px 4%">
                                    <div class="mcb-wrap-inner">
                                        <div class="column mcb-column four-fifth column_column">
                                            <div class="column_attr clearfix">
                                                <h5>WANT TO EXPLORE?</h5>
                                                <h2>Scroll through 
                                                    <br> different categories</h2>
                                            </div>
                                        </div>
                                        <div class="column mcb-column one column_image">
                                            <div class="image_frame image_item no_link scale-with-grid no_border" style="margin-top:30px;margin-bottom:30px">
                                                <!-- <div class="image_wrapper">

                                                    
                                                    <img class="scale-with-grid" src="content/one/images/home-ingredients.png">
                                                </div> -->
                                                
                                                @if(count($categories)>0)
                                                <div class="customer-logos" style="display: none;">
                                                    @foreach($categories as $category)
                                                    <div class="slide">
                                                        @if($category->image)
                                                            <a href="{{ url('businesses/' . $category->slug) }}">
                                                                <img src="{{ asset($category->image)}}" >
                                                            </a>
                                                        @endif
                                                        @if(!$category->image)
                                                            <h1><i class="{{$category->icon}}"></i></h1>
                                                        @endif
                                                        <span><a style="color: #532f17;" href="{{ url('businesses/' . $category->slug) }}">{{ $category->name }}</a></span>
                                                    </div>
                                                    @endforeach

                                                </div>
                                                @endif

                                                
                                            </div>
                                        </div>
                                        <div class="column mcb-column five-sixth column_column">
                                            <div class="column_attr clearfix">
                                                <p class="small">
                                                    <a href="{{ url('categories') }}">
                                                        See all here
                                                    </a>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="section mcb-section" style="padding-top:75px; padding-bottom:50px">
                            <div class="section_wrapper mcb-section-inner">
                                <div class="wrap mcb-wrap one valign-top clearfix">
                                    <div class="mcb-wrap-inner">
                                        <div class="column mcb-column one column_image">
                                            <div class="image_frame image_item no_link scale-with-grid aligncenter no_border">
                                                <div class="image_wrapper" style="overflow:visible">
                                                    <img class="scale-with-grid" src="{{ asset('v2/content/one/images/here_icon.png') }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="column mcb-column one-sixth column_placeholder">
                                            <div class="placeholder">
                                                &nbsp;
                                            </div>
                                        </div>
                                        <div class="column mcb-column two-third column_column">
                                            <div class="column_attr clearfix align_center">
                                                <h2>Finding something new?
                                                <br> Check out these <b>businesses</b></h2>
                                            </div>
                                        </div>
                                        {{-- <div class="column mcb-column one column_divider ">
                                            <hr class="no_line" style="margin:0 auto 50px">
                                        </div> --}}
                                    </div>
                                </div>
                                <div id="featuredBusinesses">
                                    @if(count($featured_businesses)>0)
                                        <div id="pagination" class="column one aligncenter" style="margin: 0px;">
                                            @if($featured_businesses->currentPage() > 1 && $featured_businesses->currentPage() <= $featured_businesses->lastPage())
                                                @php $featured_businesses->prevPage = $featured_businesses->currentPage()-1; @endphp
                                            <button id="prevPage" class="button button_js slider_prev"><span class="button_icon"><i class="icon-left-open-big"></i></span></button>
                                            @endif
                                            @if($featured_businesses->currentPage() < $featured_businesses->lastPage())
                                            @php $featured_businesses->nextPage = $featured_businesses->currentPage()+1; @endphp
                                            <button id="nextPage" class="button button_js slider_next"><span class="button_icon"><i class="icon-right-open-big"></i></span></button>
                                            @endif
                                        </div>
                                        @foreach($featured_businesses as $featured_business)
                                            <div class="wrap mcb-wrap one-third valign-top clearfix featured-business">
                                                <div class="mcb-wrap-inner" style="">
                                                    <div class="column mcb-column one column_image" style="display: inline-block;">
                                                        <div class="image_frame image_item no_link scale-with-grid aligncenter no_border">
                                                            <div class="image_wrapper business-logo" style="height: 330px;">
                                                                <a href="{{ asset($featured_business->logo ? $featured_business->logo : 'v2/content/one/images/logo1.png') }}" class="zoom" rel="prettyphoto">
                                                                    {{-- <div class="mask" style="height:300px;"></div> --}}
                                                                    <img class="scale-with-grid"  style= "width:65%; margin-top:30px; border-radius: 100%; max-height: 190px; max-width: 190px; min-height: 190px; min-width: 190px;" src="{{ asset($featured_business->logo ? $featured_business->logo : 'v2/content/one/images/logo1.png') }}">
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="column mcb-column one column_column">
                                                        <div class="column_attr clearfix align_center" style=" padding:0 5%;">
                                                            <h3><b><a href="{{ url($featured_business->category_slug.'/'.$featured_business->slug) }}">{{ $featured_business->name }}</a></b></h3>
                                                            <div class="image_frame image_item no_link scale-with-grid aligncenter no_border" style="margin-bottom:20px;">
                                                                <div class="image_wrapper">
                                                                    <img class="scale-with-grid" src="{{ asset('v2/content/one/images/home-divider.png') }}">
                                                                </div>
                                                            </div>
                                                            <p>
                                                                <b> {{ $featured_business->category_name }} </b>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Play Store -->
                        <div class="section mcb-section mcb-section-9ih3t0gv1 equal-height-wrap" id="app" style="padding-top:100px;padding-bottom:0px;background-color:;">
                            <div class="section_wrapper mcb-section-inner">
                                <div class="wrap mcb-wrap mcb-wrap-s3kydcxqf one-second valign-middle clearfix" style="padding:70px 5% 40px 7%;background-color:#ffd266">
                                    <div class="mcb-wrap-inner">
                                        <div class="column mcb-column mcb-item-piwa4nuz0 one column_column">
                                            <div class="column_attr clearfix" style>
                                                <h6 style="color: #ffeab8;">Our app</h6>
                                                <h3 style="color: #333;">Make One {{ ucfirst(Config('settings.province')) }} a part of you!</h3>
                                                <p style="color: #333;">
                                                    Download the application on Google Store! 
                                                </p>
                                            </div>
                                        </div>
                                        <!-- Play Store Download Link -->
                                        <div class="column mcb-column mcb-item-dhi6r7q0c one-second column_button">
                                            <a class="button button_right button_size_2 button_js" style="background-color:#000000!important;color:#fff;" href="{{ Config('settings.playstore') ? Config('settings.playstore') : '#' }}" target="_blank">
                                                <span class="button_icon">
                                                    <i class="icon-right-open" style="color:#ffffff!important;"></i>
                                                </span>
                                                <span class="button_label">Download</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="wrap mcb-wrap mcb-wrap-1ivrwesy4 one-second column-margin-0px valign-bottom bg-contain clearfix" style="padding:0 4%;background-color:#ffd266;background-image:url(v2/content/one/images/taxi2-wrapbg5.png);background-repeat:no-repeat;background-position:right top;">
                                    <div class="mcb-wrap-inner">
                                        <div class="column mcb-column mcb-item-r2do0rv3b one column_image">
                                            <div class="image_frame image_item no_link scale-with-grid aligncenter no_border" style="margin-top:-100px;">
                                                <div class="image_wrapper"><img class="scale-with-grid" src="{{ asset('v2/content/one/images/taxi2-pic1.png') }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Play Store -->
                        <div class="section mcb-section" style="padding-top:50px; padding-bottom:150px">
                            <!-- <div class="section_wrapper mcb-section-inner">
                                <div class="wrap mcb-wrap one valign-top clearfix">
                                    <div class="mcb-wrap-inner">
                                        <div class="column mcb-column one column_image">
                                            <div class="image_frame image_item no_link scale-with-grid no_border">
                                                <div class="image_wrapper">
                                                    <img class="scale-with-grid" src="content/one/images/home-promotion-larger.png">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> -->
                            <div class="section-decoration bottom" style="background-image:url(v2/content/one/images/footer-top-bg.png);height:109px"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @include('v2.partials.footer_search')
        @include('v2.partials.footer')
    </div>
@endsection

@section('after_scripts')
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
                autoplay: true,
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
        $(document).ready(function () {
            $("#Content").show();
        });
    </script>
@endsection




