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
    @if(isset($title))
    <title>{{ $title }} | Online Directory for {{ Config('settings.province') ?? "Project One"}}</title>
    @else
    <title>One {{ Config('settings.province') ?? "Project One"}} | Online Directory for {{ Config('settings.province') ?? "Project One"}}</title>
    @endif

    {{-- META TAGS --}}
    <meta name="description" content="{{ Config('settings.global_meta_description') }}">
    <meta name="keywords" content="{{ Config('settings.global_meta_tags') }}">
    <meta name="author" content="">
    <meta property="og:url" content="{{ env('APP_URL') }}" />
    <meta property="og:description" content="{{ Config('settings.global_meta_description') }}">
    <meta property="og:image" content="{{asset('v2/content/one/images/OnePampangaCover.png')}}">

    @if(isset($title))
    <meta name="twitter:title" content="{{ $title }} | Online Directory for {{ Config('settings.province') ?? 'Project One'}}">
    @else
    <meta name="twitter:title" content="One {{ Config('settings.province') ?? 'Project One'}} | Online Directory for {{ Config('settings.province') ?? 'Project One'}}">
    @endif
    <meta name="twitter:description" content="{{ Config('settings.global_meta_description') }}">
    <meta name="twitter:image" content="{{asset('v2/content/one/images/OnePampangaCover.png')}}">
    <meta name="twitter:card" content="{{asset('v2/content/one/images/OnePampangaCover.png')}}">

    <!-- Mobile Specific Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    @yield('before_styles')

    <!-- Favicons -->
    <link rel="shortcut icon" href="{{ asset('v2/images/favicon.ico') }}">
    
    <!-- FONT AWESOME KIT -->
    <script src="{{ asset('js/8e38ce13e4.js') }}" crossorigin="anonymous"></script>
    <!-- FONTS -->
    <!-- <link rel='stylesheet' href='http://fonts.googleapis.com/css?family=Roboto:100,300,400,400italic,700'>
    <link rel='stylesheet' href='http://fonts.googleapis.com/css?family=Patua+One:100,300,400,400italic,700'>
    <link rel='stylesheet' href='http://fonts.googleapis.com/css?family=Lato:400,400italic,700,700italic,900'>
    <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Montserrat:100,300,400,400italic,500,700,700italic'>
    <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Poppins:100,300,400,400italic,500,700,700italic'> -->

    <!-- FONT V2 -->
    <link rel='stylesheet' href='http://fonts.googleapis.com/css?family=Roboto+Slab:100,200,300,400,400italic,500,600,700,700italic,900'>
	<link rel='stylesheet' href='http://fonts.googleapis.com/css?family=Dosis:100,200,300,400,400italic,500,600,700,700italic,900'>
	<link rel='stylesheet' href='http://fonts.googleapis.com/css?family=Montserrat:100,200,300,400,400italic,500,600,700,700italic,900'>

    <!-- CSS -->
    <link rel='stylesheet' href="{{ asset('v2/css/global.css') }}">
    <link rel='stylesheet' href="{{ asset('v2/content/one/css/structure.css') }}">
    <link rel='stylesheet' href="{{ asset('v2/content/one/css/one.css') }}">
    <link rel='stylesheet' href="{{ asset('v2/content/one/css/custom.css') }}">

    <!-- Revolution Slider -->
    <link rel="stylesheet" href="{{ asset('v2/plugins/rs-plugin-5.3.1/css/settings.css') }}">

    @yield('after_styles')

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-157710972-1"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'UA-157710972-1');
    </script>
    <style>
        .preloader {
            align-items: center;
            background: #FFF;
            display: flex;
            height: 100vh;
            justify-content: center;
            left: 0;
            position: fixed;
            top: 0;
            transition: opacity 0.2s linear;
            width: 100%;
            z-index: 9999;
            opacity: 1;
            transform: opacity 1s linear;
        }
        .one-logo{
            animation: fadeIn 5s;
            transform: translateY(-10%);
            animation: floater 1.5s infinite;
            transition: ease 0.5s;
        }
        @keyframes fadeIn {
            0% { opacity: 0; }
            100% { opacity: 1; }
        }
        @keyframes floater {
            0%{transform: translateY(-10%);transition: ease 0.5s;}
            50%{transform: translateY(10%);transition: ease 0.5s;}
        }
    </style>

</head>
    
<div class="preloader">
        <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
        <p style="text-align:center;">
            <img class="one-logo"src="{{ asset('v2/content/one/images/one-logo.png') }}" style="margin-bottom:-180px;height:90px; position:relative;" alt="Logo">
            <lottie-player src="https://assets2.lottiefiles.com/temp/lf20_jIG9zu.json"  background="transparent"  speed="1"  style="width: 400px; height: 400px;"  loop  autoplay></lottie-player>
        </p>
       
</div>
<body class="@yield('body_class')" style="@yield('body_style')">

    <section id="app" style="background: #FABA0C !important;">
        @yield('content')
    </section>

    <div id="Side_slide" class="right dark" data-width="250">
        <div class="close-wrapper">
            <a href="#" class="close"><i class="icon-cancel-fine"></i></a>
        </div>
        <div class="menu_wrapper"></div>
        <div class="extras">
            <a id="get_listed" href="{{ asset('registration') }}" class="" target="_self">
                Get listed now <i class="icon-right-open"></i>
            </a>
        </div>
        <div class="extras-wrapper"></div>
    </div>

    <div id="body_overlay"></div>

    @yield('before_scripts')

    <!-- JS -->
    <script src="{{ asset('v2/js/jquery-2.1.4.min.js') }}"></script>

    <script src="{{ asset('v2/js/mfn.menu.js') }}"></script>
    <script src="{{ asset('v2/js/jquery.plugins.js') }}"></script>
    <script src="{{ asset('v2/js/jquery.jplayer.min.js') }}"></script>
    <script src="{{ asset('v2/js/animations/animations.js') }}"></script>
    <script src="{{ asset('v2/js/translate3d.js') }}"></script>
    <script src="{{ asset('v2/js/scripts.js') }}"></script>

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
    <!-- <script src="http://maps.google.com/maps/api/js?sensor=false&ver=5.9"></script> -->
    
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

        $(window).on('load', function () {
        setTimeout(function () {
            $(".preloader").fadeOut('slow');
            })
            
        });
    </script>
    <!--End of Tawk.to Script-->

    @yield('after_scripts')
    
</body>

</html>