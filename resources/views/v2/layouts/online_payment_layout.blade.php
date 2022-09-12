<!DOCTYPE html>
<!--[if lt IE 7]><html class="no-js lt-ie10 lt-ie9 lt-ie8 lt-ie7 "> <![endif]-->
<!--[if IE 7]><html class="no-js lt-ie10 lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]><html class="no-js lt-ie10 lt-ie9"> <![endif]-->
<!--[if IE 9]><html class="no-js lt-ie10"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang="en" style="@yield('html_style')">
<!--<![endif]-->

    <head>

        <!-- Basic Page Needs -->
        <meta charset="utf-8">
        <!-- Mobile Specific Metas -->
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

        @if($business->description ?? '')<meta name="description" content="{!!strip_tags($business->description)!!}">
        @else
        <meta name="description" content="{{ Config('settings.global_meta_description') }}">
        @endif
@if($meta_keywords ?? '')<meta name="keywords" content="{!!$meta_keywords!!}">
@else
        <meta name="keywords" content="{!!$business->category_name!!}, {{ Config('settings.global_meta_tags') }}">@endif
        <meta name="author" content="">
        <meta property="og:url" content="{{url()->current()}}" />
        @if($business->description ?? '')<meta name="og:description" content="{!!strip_tags($business->description)!!}">
    @else
    <meta name="og:description" content="{{ Config('settings.global_meta_description') }}">
    @endif
        
        @if($business->logo ?? '')<meta property="og:image" content="{{asset($business->logo )}}">

        @else
        <meta property="og:image" content="{{asset('v2/content/one/images/OnePampangaCover.png')}}">
        @endif
        <meta name="og:title" content="{!!$business->name!!} - One {{ config('settings.province') ?? 'Project One' }}"/>
        <meta name="twitter:title" content="{!!$business->name!!} - One {{ config('settings.province') ?? 'Project One' }}">
        @if($business->description ?? '')<meta name="twitter:description" content="{!!strip_tags($business->description)!!}">
    @else
    <meta name="twitter:description" content="{{ Config('settings.global_meta_description') }}">
    @endif

         @if($business->logo ?? '')<meta property="twitter:image" content="{{asset($business->logo )}}">

        @else
        <meta property="twitter:image" content="{{asset('v2/content/one/images/OnePampangaCover.png')}}">
        @endif
        
        <meta name="twitter:card" content="{{asset('v2/content/one/images/OnePampangaCover.png')}}">

        <meta property="fb:app_id" content="920655518349251"/>

        <title>{!!$business->name!!} - One {{ Config('settings.province') ?? "Project One"}}</title>

        @yield('before_styles')

        <!-- Favicons -->
        <link rel="shortcut icon" href="{{ asset('v2/images/favicon.ico') }}">
        
        <!-- FONT AWESOME KIT -->
        <script src="{{ asset('js/8e38ce13e4.js') }}" crossorigin="anonymous"></script>
        <!-- FONTS -->
        <link rel='stylesheet' href='http://fonts.googleapis.com/css?family=Roboto:100,300,400,400italic,700'>
        <link rel='stylesheet' href='http://fonts.googleapis.com/css?family=Patua+One:100,300,400,400italic,700'>
        <link rel='stylesheet' href='http://fonts.googleapis.com/css?family=Lato:400,400italic,700,700italic,900'>
        <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Montserrat:100,300,400,400italic,500,700,700italic'>
        <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Poppins:100,300,400,400italic,500,700,700italic'>

        <!-- CSS -->
        <link rel='stylesheet' href="{{ asset('v2/css/global.css') }}">
        <link rel='stylesheet' href="{{ asset('v2/content/one/css/structure.css') }}">
        <link rel='stylesheet' href="{{ asset('v2/content/one/css/one.css') }}">
        <link rel='stylesheet' href="{{ asset('v2/content/one/css/custom.css') }}">

        @yield('after_styles')

    </head>

    <body class="@yield('body_class')" style="@yield('body_style')">

        @yield('before_scripts')

        @yield('content')

        <div id="Side_slide" class="right dark" data-width="250">
            <div class="close-wrapper">
                <a href="#" class="close"><i class="icon-cancel-fine"></i></a>
            </div>
            <div class="menu_wrapper"></div>
            <div class="extras">
                <a id="get_listed" href="{{ asset('registration') }}" class="" target="_self">Get listed now <i class="icon-right-open"></i></a>
            </div>
            <div class="extras-wrapper"></div>
        </div>

        <div id="body_overlay"></div>

        @stack('before_scripts')

        <!-- JS -->
        <script src="{{ asset('v2/js/jquery-2.1.4.min.js') }}"></script>

        <script src="{{ asset('v2/js/mfn.menu.js') }}"></script>
        <script src="{{ asset('v2/js/jquery.plugins.js') }}"></script>
        <script src="{{ asset('v2/js/jquery.jplayer.min.js') }}"></script>
        <script src="{{ asset('v2/js/animations/animations.js') }}"></script>
        <script src="{{ asset('v2/js/translate3d.js') }}"></script>
        <script src="{{ asset('v2/js/scripts.js') }}"></script>

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

        @yield('after_scripts')
        
    </body>

</html>