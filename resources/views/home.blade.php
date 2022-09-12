@extends('layouts.app2')

@section('before_styles')
    <style>
    #Top_bar .onload .menu>li>a, #Top_bar #menu ul li.submenu .menu-toggle {
            color: #fff;
        }
        #Top_bar .scroll .menu>li>a, #Top_bar #menu ul li.submenu .menu-toggle{
            color: #222228;
        }
    </style>
@endsection

@section('body_class', "page-template-default page template-slider color-custom style-simple button-round layout-full-width no-content-padding no-shadows header-transparent header-fw minimalist-header-no sticky-header sticky-tb-color ab-hide subheader-both-center menu-link-color menuo-right menuo-no-borders mobile-tb-center mobile-side-slide mobile-mini-mr-ll tablet-sticky mobile-header-mini mobile-sticky ")

@section('content')
    <div id="Wrapper">
        
        @include('partials.header')
        
        <div id="Content">
            <div class="content_wrapper clearfix">
                <div class="sections_group">
                    <div class="entry-content">
                        <div class="section mcb-section" style="background-color:#fff" data-parallax="3d">
                            <img class="mfn-parallax" src="{{ asset('content/seo3/images/seo3-slider-bg.png') }}"  alt="parallax background" />
                                <div class="mfn-main-slider" id="mfn-rev-slider" data-parallax="3d">
                                    <p class="rs-p-wp-fix"></p>
                                    <rs-module-wrap id="rev_slider_1_1_wrapper" data-source="gallery" style="background:transparent;padding:0;margin:0px auto;margin-top:0;margin-bottom:0;">
                                        <rs-module id="rev_slider_1_1" style="display:none;" data-version="6.1.2">
                                            <rs-slides>
                                                <rs-slide data-key="rs-1" data-anim="ei:d;eo:d;s:1000;r:0;t:fade;sl:0;">
                                                    <img  class="rev-slidebg" data-no-retina alt="parallax background">
                                                    <rs-layer id="slider-1-slide-1-layer-0" data-type="text" data-color="#e73827" data-rsp_ch="on" data-xy="x:100px;y:343px;" data-text="w:normal;s:75;l:75;fw:700;" data-frame_0="x:50;" data-frame_1="st:200;sp:1000;" data-frame_999="o:0;st:w;sR:7900;" style="z-index:8;font-family:Archivo;">
                                                        Find BEST places in 
                                                        <br>PAMPANGA
                                                        <br>Search now!
                                                    </rs-layer>
                                                    <rs-layer id="slider-1-slide-1-layer-1" data-type="text" data-color="#fca80f" data-rsp_ch="on" data-xy="x:100px;y:280px;" data-text="w:normal;s:14;l:26;fw:700;" data-padding="t:2;r:15;b:2;l:15;" data-border="bor:15px,15px,15px,15px;" data-frame_0="x:50;"
                                                        data-frame_1="st:400;sp:1000;" data-frame_999="o:0;st:w;sR:7800;" style="z-index:9;background-color:rgba(252,168,15,0.13);font-family:Archivo;">
                                                        WELCOME TO ONE PAMPANGA
                                                    </rs-layer>
                                                    <rs-layer id="slider-1-slide-1-layer-2" data-type="text" data-color="#fff" data-rsp_ch="on" data-xy="x:105px;y:656px;" data-text="w:normal;s:20;l:32;" data-frame_0="x:50;" data-frame_1="st:600;sp:1000;" data-frame_999="o:0;st:w;sR:7700;" style="z-index:10;font-family:Archivo;">
                                                        Find exactly what you are looking for!
                                                        <br>
                                                    </rs-layer>
                                                    <a id="slider-1-slide-1-layer-4" class="rs-layer rev-btn" href="{{ asset('categories') }}" target="_self" rel="nofollow" data-type="button" data-color="#ffffff"
                                                        data-rsp_ch="on" data-xy="x:102px;y:738px;" data-text="w:normal;s:20;l:50;fw:500;" data-dim="minh:0px;" data-padding="r:40;l:40;" data-border="bor:30px,30px,30px,30px;" data-frame_0="x:50;" data-frame_1="st:800;sp:1000;"
                                                        data-frame_999="o:0;st:w;sR:7600;" data-frame_hover="bgc:#CE2B0C;bor:30px,30px,30px,30px;sp:100;e:Power1.easeInOut;bri:120%;" style="z-index:11;background-color:#f85032;font-family:Archivo;">
                                                            Check out places!
                                                    </a>
                                                </rs-slide>
                                                <rs-slide data-key="rs-2" data-anim="ei:d;eo:d;s:1000;r:0;t:fade;sl:0;">
                                                    <img  class="rev-slidebg" data-no-retina alt="parallax background">
                                                    <rs-layer id="slider-1-slide-2-layer-0" data-type="text" data-color="#e73827" data-rsp_ch="on" data-xy="x:100px;y:343px;" data-text="w:normal;s:75;l:75;fw:700;" data-frame_0="x:50;" data-frame_1="st:200;sp:1000;" data-frame_999="o:0;st:w;sR:7900;" style="z-index:8;font-family:Archivo;">
                                                        Gain More Customers!
                                                        <br>Be visible online for 
                                                        <br> as low as 
                                                        <br><span>&#8369;</span>20.00/month
                                                    </rs-layer>
                                                    <rs-layer id="slider-1-slide-2-layer-1" data-type="text" data-color="#fca80f" data-rsp_ch="on" data-xy="x:100px;y:280px;" data-text="w:normal;s:14;l:26;fw:700;" data-padding="t:2;r:15;b:2;l:15;" data-border="bor:15px,15px,15px,15px;" data-frame_0="x:50;"
                                                        data-frame_1="st:400;sp:1000;" data-frame_999="o:0;st:w;sR:7800;" style="z-index:9;background-color:rgba(252,168,15,0.13);font-family:Archivo;">
                                                        WELCOME TO ONE PAMPANGA
                                                    </rs-layer>
                                                    <rs-layer id="slider-1-slide-2-layer-2" data-type="text" data-color="#fff" data-rsp_ch="on" data-xy="x:105px;y:656px;" data-text="w:normal;s:20;l:32;" data-frame_0="x:50;" data-frame_1="st:600;sp:1000;" data-frame_999="o:0;st:w;sR:7700;" style="z-index:10;font-family:Archivo;">
                                                        We help Businesses and Individuals gain online presence.
                                                        <br>Get listed now!
                                                    </rs-layer>
                                                    <a id="slider-1-slide-2-layer-4" class="rs-layer rev-btn" href="{{ asset('registration') }}" target="_self" rel="nofollow" data-type="button" data-color="#ffffff"
                                                        data-rsp_ch="on" data-xy="x:102px;y:738px;" data-text="w:normal;s:20;l:50;fw:500;" data-dim="minh:0px;" data-padding="r:40;l:40;" data-border="bor:30px,30px,30px,30px;" data-frame_0="x:50;" data-frame_1="st:800;sp:1000;"
                                                        data-frame_999="o:0;st:w;sR:7600;" data-frame_hover="bgc:#CE2B0C;bor:30px,30px,30px,30px;sp:100;e:Power1.easeInOut;bri:120%;" style="z-index:11;background-color:#f85032;font-family:Archivo;">
                                                            Register now!
                                                    </a>
                                                </rs-slide>
                                            </rs-slides>
                                            <rs-progress class="rs-bottom" style="visibility: hidden !important;"></rs-progress>
                                        </rs-module>
                                    </rs-module-wrap>
                                </div>
                            </div>
                            <div class="section mcb-section mcb-section-0v432r1ip bg-cover-ultrawide" style="padding-top:110px;padding-bottom:40px;background-image:url({{ asset('content/seo3/images/seo3-sectionbg1.png') }});background-repeat:no-repeat;background-position:center bottom;">
                                <div class="section_wrapper mcb-section-inner">
                                    <div class="wrap mcb-wrap mcb-wrap-kixi6eaga one valign-top clearfix">
                                        <div class="mcb-wrap-inner">
                                            <div class="column mcb-column mcb-item-tzz8n3h7j one column_column">
                                                <div class="column_attr clearfix align_center" style="padding:0 10%;">
                                                    <h6 class="seo3-heading">FEATURED</h6>
                                                    <hr class="no_line" style="margin: 0 auto 15px;">
                                                    <h2>Featured Businesses</h2>
                                                    <hr class="no_line" style="margin: 0 auto 15px;">
                                                    <p class="big">
                                                        We help businesses and entrepreneurs in Pampanga to gain online presence without breaking the bank. Our goal is help them get more customers and earn more profit.
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="column mcb-column mcb-item-3s7tu8hef one column_divider">
                                                <hr class="no_line" style="margin: 0 auto 30px;">
                                            </div>
                                        </div>
                                    </div>
                                    @if($featured_businesses ?? '')
                                        <div class="section section-post-related">
                                            <div class="section_wrapper clearfix">
                                                <div class="section-related-adjustment">
                                                    <div class="section-related-ul col-3">
                                                        @foreach($featured_businesses as $featured_business)
                                                            @if($featured_business)
                                                                <div class="column post-related post-2277 post  format-standard has-post-thumbnail  category-lifestyle tag-video ">
                                                                    <div class="image_frame scale-with-grid">
                                                                        <div class="photo">
                                                                            <a href="{{ asset(''.$featured_business->category_slug.'/'.$featured_business->slug) }}">
                                                                                <div class="mask"></div>
                                                                                @if($featured_business->logo ?? '')
                                                                                    <img style="min-height: 250px; max-height: 250px;" width="960" height="750" src="{{asset($featured_business->logo)}}" class="scale-with-grid wp-post-image" alt="" itemprop="image" />
                                                                                @else
                                                                                    <img style="min-height: 250px; max-height: 250px" width="960" height="750" src="{{ asset('images/default_image.png') }}" class="scale-with-grid wp-post-image" alt="" itemprop="image" />
                                                                                @endif
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                    <div class="desc " style="text-align: center;">
                                                                        <h5><a href="{{ asset(''.$featured_business->category_slug.'/'.$featured_business->slug) }}">{{$featured_business->name}}</a></h5>
                                                                        <p>
                                                                            @if($featured_business->mobile)
                                                                                <i class="icon-mobile"></i>{{$featured_business->mobile}}
                                                                                @if($featured_business->telephone)
                                                                                -<i class="icon-phone"></i>{{$featured_business->telephone}}
                                                                                @endif
                                                                                <br>
                                                                            @endif
                                                                            <i class="icon-location"></i>
                                                                            {{$featured_business->address1}},
                                                                            @if($featured_business->address2 ?? '')
                                                                            {{$featured_business->address2}},
                                                                            @endif
                                                                            {{$featured_business->baranggay_name}},
                                                                            {{$featured_business->location_name}}
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                            @endif
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                    {{-- <div class="wrap mcb-wrap mcb-wrap-dne5fitzv one-third valign-top clearfix" style="padding:0 3%">
                                        <div class="mcb-wrap-inner">
                                            <div class="column mcb-column mcb-item-0se6me1ed one column_image">
                                                <div class="image_frame image_item no_link scale-with-grid aligncenter no_border">
                                                    <div class="image_wrapper"><img class="scale-with-grid" src="{{ asset('content/seo3/images/seo3-home-icon1.png') }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="column mcb-column mcb-item-bz66bz8od one column_column">
                                                <div class="column_attr clearfix align_center" style="">
                                                    <h4>Gain More Customers</h4>
                                                    <hr class="no_line" style="margin: 0 auto 10px;">
                                                    <p>
                                                        We spent thousands in Google Ads so you will be the first in Google search! 
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="wrap mcb-wrap mcb-wrap-dgl7y608d one-third valign-top clearfix" style="padding:0 3%">
                                        <div class="mcb-wrap-inner">
                                            <div class="column mcb-column mcb-item-y9et8qyy3 one column_image">
                                                <div class="image_frame image_item no_link scale-with-grid aligncenter no_border">
                                                    <div class="image_wrapper"><img class="scale-with-grid" src="{{ asset('content/seo3/images/seo3-home-icon3.png') }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="column mcb-column mcb-item-ilslzosgz one column_column">
                                                <div class="column_attr clearfix align_center" style="">
                                                    <h4>You Are Rated</h4>
                                                    <hr class="no_line" style="margin: 0 auto 10px;">
                                                    <p>
                                                        Customers can rate your services or products
                                                        these can help others to review
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="wrap mcb-wrap mcb-wrap-pqvp6hfrf one-third valign-top clearfix" style="padding:0 3%">
                                        <div class="mcb-wrap-inner">
                                            <div class="column mcb-column mcb-item-yl7ueo3pm one column_image">
                                                <div class="image_frame image_item no_link scale-with-grid aligncenter no_border">
                                                    <div class="image_wrapper"><img class="scale-with-grid" src="{{ asset('content/seo3/images/seo3-home-icon2.png') }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="column mcb-column mcb-item-ikcy844di one column_column">
                                                <div class="column_attr clearfix align_center" style="">
                                                    <h4>Be Online Present</h4>
                                                    <hr class="no_line" style="margin: 0 auto 10px;">
                                                    <p>
                                                        Whether you are an individual, small businesses or enterprise, you will be there!
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div> --}}
                                    </div>
                                </div>
                            </div>
                        </div>
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
        $('li[id=home_menu]').addClass("current-menu-item")
    });
    
</script>
@endsection

@section('after_scripts')
    <script src="{{ asset('plugins/rs-plugin-6.custom/js/revolution.tools.min.js') }}"></script>
    <script src="{{ asset('plugins/rs-plugin-6.custom/js/rs6.min.js') }}"></script>
    <script>
        var revapi1, tpj;
        jQuery(function() {
            tpj = jQuery;
            if (tpj("#rev_slider_1_1").revolution == undefined) {
                revslider_showDoubleJqueryError("#rev_slider_1_1");
            } else {
                revapi1 = tpj("#rev_slider_1_1").show().revolution({
                    sliderType : "standard",
                    visibilityLevels : "1240,1024,1000,1000",
                    gridwidth : 1920,
                    gridheight : 950,
                    minHeight : "",
                    spinner : "spinner7",
                    spinnerclr : "#473288",
                    editorheight : "950,768,960,720",
                    responsiveLevels : "1240,1024,778,480",
                    disableProgressBar : "on",
                    navigation : {
                        onHoverStop : false
                    },
                    fallbacks : {
                        allowHTML5AutoPlayOnAndroid : true
                    },
                });
            }
        });
    </script>
    <script>
        window.onload = () => {
            const nav = document.querySelector('#menu');
            nav.className = 'onload';
        };
        window.onscroll = () => {
            const nav = document.querySelector('#menu');
            if(this.scrollY <= 10) 
                nav.className = 'onload'; 
            else 
                nav.className = 'scroll';
        };
    </script>
@endsection




