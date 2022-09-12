<!DOCTYPE html>
<!--[if lt IE 7]><html class="no-js lt-ie10 lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]><html class="no-js lt-ie10 lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]><html class="no-js lt-ie10 lt-ie9"> <![endif]-->
<!--[if IE 9]><html class="no-js lt-ie10"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js">
<!--<![endif]-->

<head>

    <!-- Basic Page Needs -->
    <meta charset="utf-8">
    <title>{{ Config('settings.province') ?? "Project One"}}</title>
    <meta name="description" content="{{ Config('settings.global_meta_description') }}">
    <!-- <meta name="keywords" content="{{ Config('settings.global_meta_tags') }}"> -->

    <!-- Mobile Specific Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- Favicons -->
    <link rel="shortcut icon" href="content/seo3/images/seo31_low.png">

    <!-- FONTS -->
    <link rel='stylesheet' href='http://fonts.googleapis.com/css?family=Roboto:100,300,400,400italic,700'>
    <link rel='stylesheet' href='http://fonts.googleapis.com/css?family=Patua+One:100,300,400,400italic,700'>
    <link rel='stylesheet' href='http://fonts.googleapis.com/css?family=Lato:400,400italic,700,700italic,900'>
    <link rel='stylesheet' href='http://fonts.googleapis.com/css?family=Archivo:400,400italic,500,700,700italic,900'>

    <!-- CSS -->
    <link rel='stylesheet' href="{{ asset('css/global.css') }}">
    <link rel='stylesheet' href="{{ asset('content/seo3/css/structure.css') }}">
    <link rel='stylesheet' href="{{ asset('content/seo3/css/seo3.css') }}">
    <link rel='stylesheet' href="{{ asset('content/seo3/css/custom.css') }}">

    <!-- Revolution Slider -->
    <link rel="stylesheet" href="{{ asset('plugins/rs-plugin-6.custom/css/rs6.css') }}">

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-157710972-1"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'UA-157710972-1');
    </script>

</head>

<body class="home page-template-default page template-slider color-custom style-simple button-round layout-full-width no-content-padding no-shadows header-transparent header-fw minimalist-header-no sticky-header sticky-tb-color ab-hide subheader-both-center menu-link-color menuo-right menuo-no-borders mobile-tb-center mobile-side-slide mobile-mini-mr-ll tablet-sticky mobile-header-mini mobile-sticky ">