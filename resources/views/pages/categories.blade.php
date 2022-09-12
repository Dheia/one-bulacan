<!DOCTYPE html>
<!--[if lt IE 7]><html class="no-js lt-ie10 lt-ie9 lt-ie8 lt-ie7 "> <![endif]-->
<!--[if IE 7]><html class="no-js lt-ie10 lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]><html class="no-js lt-ie10 lt-ie9"> <![endif]-->
<!--[if IE 9]><html class="no-js lt-ie10"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" style="background-image: url({{ asset('content/seo3/images/thriller-category-bg1.png') }}); background-attachment: fixed;">
<!--<![endif]-->

<head>

    <!-- Basic Page Needs -->
    <meta charset="utf-8">
    <title>{{ env("LOCATION") ?? "Project One"}}</title>
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Mobile Specific Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- Favicons -->
    <link rel="shortcut icon" href="{{ asset('images/favicon.ico') }}">
    {{-- Footer Search --}}
    
    <!-- BOOTSTRAP CSS -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">

    <!-- FONT AWESOME KIT -->
    <script src="{{ asset('js/8e38ce13e4.js') }}" crossorigin="anonymous"></script>


    <!-- FONTS -->
    <link rel='stylesheet' href="{{ asset('css/fonts/roboto.css') }}">
    <link rel='stylesheet' href="{{ asset('css/fonts/patua.css')}}">
    <link rel='stylesheet' href="{{ asset('css/fonts/lato.css')}}">
    <link rel='stylesheet' href='http://fonts.googleapis.com/css?family=PT+Serif:100,200,300,400,400italic,500,600,700,700italic'>
    <link rel='stylesheet' href='http://fonts.googleapis.com/css?family=Poppins:100,200,300,400,400italic,500,600,700,700italic'>
    <link rel='stylesheet' href='http://fonts.googleapis.com/css?family=Oswald:100,200,300,400,400italic,500,600,700,700italic'>

    <!-- CSS -->
    <link rel='stylesheet' href="{{ asset('css/global.css') }}">
    <link rel='stylesheet' href="{{ asset('content/thriller/css/structure.css') }}">
    <link rel='stylesheet' href="{{ asset('content/thriller/css/thriller.css') }}">
    <link rel='stylesheet' href="{{ asset('content/thriller/css/custom.css') }}">
    
    <style> 
    @media only screen and (min-width: 1240px) {
        #menu {
            position: fixed;
            width: 16%;
            margin-top:150px;
            margin-bottom: 50px;
            overflow-y: scroll;
            overflow-x: hidden;
            top: 0;
            bottom: 0;
        }          
        #menu::-webkit-scrollbar {
            display: none;
        }               
    }      
                                                                                                                                                                                                                                                  
    </style>

</head>

<body  style="background: transparent;"  class="color-custom style-simple  layout-full-width one-page if-zoom if-border-hide no-content-padding no-shadows header-creative header-open minimalist-header-no sticky-header sticky-tb-color ab-hide subheader-both-center menu-link-color mobile-tb-center mobile-side-slide mobile-mini-mr-ll tablet-sticky mobile-header-mini mobile-sticky mobile-tr-header tr-header tr-menu tr-content be-reg-2091">
    <div id="Header_creative" style="background: transparent;">
        <a href="#" class="creative-menu-toggle"><i class="icon-menu-fine"></i></a>
        <div class="creative-social">
            <ul class="social">
                <li class="facebook">
                    <a href="https://facebook.com/onepampanga1" title="Facebook"><i class="icon-facebook"></i></a>
                </li>
                <li class="googleplus">
                    <a href="#" title="Google+"><i class="icon-gplus"></i></a>
                </li>
                <li class="youtube">
                    <a href="#" title="YouTube"><i class="icon-play"></i></a>
                </li>
                <li class="instagram">
                    <a href="#" title="Instagram"><i class="icon-instagram"></i></a>
                </li>
            </ul>
        </div>
        <div class="creative-wrapper" style="background: transparent;">
            <div class="header_placeholder"></div>
            <div id="Top_bar" style="background: transparent;">
                <div class="one-fourth clearfix">
                    <div class="top_bar_left">
                        <div class="logo" style="background: transparent;">
                            <a id="logo" href="/" title="BeThriller - BeTheme" data-height="60">
                                <img class="logo-main scale-with-grid" src="{{ asset('content/seo3/images/logo.png') }}" data-retina="{{ asset('content/seo3/images/logo.png') }}" data-height="31" alt="">
                                <img class="logo-sticky scale-with-grid" src="{{ asset('content/seo3/images/logo.png') }}" data-retina="{{ asset('content/seo3/images/logo.png') }}" data-height="31" alt="">
                                <img class="logo-mobile scale-with-grid" src="{{ asset('content/seo3/images/logo.png') }}" data-retina="{{ asset('content/seo3/images/logo.png') }}" data-height="31" alt="">
                                <img class="logo-mobile-sticky scale-with-grid" src="{{ asset('content/seo3/images/logo.png') }}" data-retina="{{ asset('content/seo3/images/logo.png') }}" data-height="31" alt="">
                            </a>
                        </div>
                        <div class="menu_wrapper" style="background: transparent;">
                            <nav id="menu" style="background: transparent;">
                                
                                <ul id="menu-menu" class="menu menu-main" style="text-align: left;">
                                    <li>
                                        <a><span><strong>Main Categories</strong></span></a>
                                    </li>
                                    @if(count($subcategories)>0)
                                        @foreach($subcategories as $key => $category)
                                            <li>
                                                <a href="#{{$category->slug}}"><span><i class="{{$category->icon}} fa-lg"></i> {{$category->name}}</span></a>
                                            </li>
                                        @endforeach
                                    @endif
                                </ul>
                            </nav>
                            <a class="responsive-menu-toggle" href="#"><i class="icon-menu-fine"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div id="Action_bar">
                <ul class="social">
                    <li class="facebook">
                        <a href="https://facebook.com/onepampanga1" title="Facebook"><i class="icon-facebook"></i></a>
                    </li>
                    <li class="googleplus">
                        <a href="#" title="Google+"><i class="icon-gplus"></i></a>
                    </li>
                    <li class="youtube">
                        <a href="#" title="YouTube"><i class="icon-play"></i></a>
                    </li>
                    <li class="instagram">
                        <a href="#" title="Instagram"><i class="icon-instagram"></i></a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div id="Wrapper">
        <div id="Content" style="background: transparent;">
            <div class="content_wrapper clearfix" style="background: transparent;">
                <div class="sections_group" style="background: transparent;">
                    <div class="entry-content" style="background: transparent;">
                        
                        @if(count($subcategories)>0)
                            @foreach($subcategories as $k => $subcategory)
                                <div class="section mcb-section"  id="{{$subcategory->slug}}" style="@if($k % 2 == 0)background-color:rgba(16,16,16,0.3)@else background-color:rgba(16,16,16,0.5) @endif">
                                    
                                    <div class="section_wrapper mcb-section-inner" style="padding-top:100px;">
                                        <div class="wrap mcb-wrap one valign-top clearfix">
                                            <div class="mcb-wrap-inner">
                                                <div class="column mcb-column one column_attr align_center">
                                                    <i class="{{$subcategory->icon}} fa-3x"></i>
                                                    <h1>{{$subcategory->name}}</h1>
                                                    <hr class="no_line" style="margin: 0 auto 15px;">
                                                    @if ($subcategory->children->count())
                                                        <div class="row">
                                                            @foreach($subcategory->children as $i => $subcategory_item)
                                                                @if ($subcategory_item->children->count())
                                                                    @foreach($subcategory_item->children as $i => $subcategory_item2)
                                                                        <div class="col-md-2 col-lg-2 col-sm-3 col-4 text-center p-3">
                                                                            <a style="font-size: 16px;" href="/businesses/{{$subcategory_item2->slug}}"><i class="fas fa-hotel fa-3x"></i><br>
                                                                            {{$subcategory_item2->name}}</a>
                                                                        </div>
                                                                    @endforeach
                                                                @endif
                                                                <div class="col-md-2 col-lg-2 col-sm-3 col-4 text-center p-3">
                                                                    <a style="font-size: 18px;" href="/businesses/{{$subcategory_item->slug}}" >
                                                                        {{$subcategory_item->name}}
                                                                    </a>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                  
                                </div>
                            @endforeach
                        @endif
                       
                        <div class="section mcb-section" style="padding-top:75px; padding-bottom:0px; background-color:rgba(16,16,16,0.5)">
                            <div class="section_wrapper mcb-section-inner">
                                <div class="wrap mcb-wrap one valign-top clearfix">
                                    <div class="mcb-wrap-inner">
                                        <div class="column mcb-column one column_image">
                                            <div class="image_frame image_item no_link scale-with-grid aligncenter no_border">
                                                <div class="image_wrapper">
                                                    <img class="scale-with-grid" src="{{ asset('content/seo3/images/logo.png') }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="column mcb-column one-fourth column_placeholder">
                                            <div class="placeholder">
                                                &nbsp;
                                            </div>
                                        </div>
                                        <div class="column mcb-column one-second column_image">
                                            <div class="image_frame image_item no_link scale-with-grid aligncenter no_border">
                                                <div class="image_wrapper">
                                                    <img class="scale-with-grid" src="{{ asset('content/thriller/images/thriller-sign.png') }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="section mcb-section" style="padding-top:50px; padding-bottom:75px; background-color:rgba(16,16,16,0.5)">
                            <div class="section_wrapper mcb-section-inner">
                                <div class="wrap mcb-wrap one-third valign-top clearfix">
                                    <div class="mcb-wrap-inner">
                                        <div class="column mcb-column one column_placeholder">
                                            <div class="placeholder">
                                                &nbsp;
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="wrap mcb-wrap one-second valign-top clearfix">
                                    <div class="mcb-wrap-inner">
                                        <div class="column mcb-column one-sixth column_image">
                                            <div class="image_frame image_item scale-with-grid aligncenter no_border">
                                                <div class="image_wrapper">
                                                    <a href="https://www.facebook.com/onepampanga1" target="_blank">
                                                        <div class="mask"></div>
                                                        <img class="scale-with-grid" src="{{ asset('content/thriller/images/thriller-like.png') }}">
                                                    </a>
                                                    <div class="image_links">
                                                        <a href="https://www.facebook.com/onepampanga1" class="link" target="_blank"><i class="icon-link"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="column mcb-column two-third column_column">
                                            <div class="column_attr clearfix align_center">
                                                <p>
                                                    Remember to like us on Facebook!
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        @include('partials.footer_search')
        @include('partials.footer')
        <style>
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
        </style>
    </div>

    <!-- side menu -->
    <div id="Side_slide" class="right dark" data-width="250">
        <div class="close-wrapper">
            <a href="#" class="close"><i class="icon-cancel-fine"></i></a>
        </div>
        <div class="menu_wrapper"></div>
        <ul class="social">
            <li class="facebook">
                <a href="https://facebook.com/onepampanga1" title="Facebook"><i class="icon-facebook"></i></a>
            </li>
            <li class="googleplus">
                <a href="#" title="Google+"><i class="icon-gplus"></i></a>
            </li>
            <li class="youtube">
                <a href="#" title="YouTube"><i class="icon-play"></i></a>
            </li>
            <li class="instagram">
                <a href="#" title="Instagram"><i class="icon-instagram"></i></a>
            </li>
        </ul>
    </div>
    <div id="body_overlay"></div>

    <!-- JS -->
    <script src="{{ asset('js/jquery-2.1.4.min.js') }}"></script>

    <script src="{{ asset('js/mfn.menu.js') }}"></script>
    <script src="{{ asset('js/jquery.plugins.js') }}"></script>
    <script src="{{ asset('js/jquery.jplayer.min.js') }}"></script>
    <script src="{{ asset('js/animations/animations.js') }}"></script>
    <script src="{{ asset('js/translate3d.js') }}"></script>
    <script src="{{ asset('js/scripts.js') }}"></script>

    <script src="{{ asset('js/ui/jquery.ui.accordion.js') }}"></script>
    <script src="{{ asset('js/ui/jquery.ui.core.js') }}"></script>
    <script src="{{ asset('js/ui/jquery.ui.tabs.js') }}"></script>
    <script src="{{ asset('js/ui/jquery.ui.widget.js') }}"></script>
    
     <!--Start of Tawk.to Script-->
     <script type="text/javascript">
        var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
        (function(){
            var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
            s1.async=true;
            s1.src='https://embed.tawk.to/5e175c2b27773e0d832cbaf2/default';
            s1.charset='UTF-8';
            s1.setAttribute('crossorigin','*');
            s0.parentNode.insertBefore(s1,s0);
        })();
    </script>
    <!--End of Tawk.to Script-->
</body>