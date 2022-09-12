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
                    <div class="section mcb-section mcb-section-1bda1711a equal-height-wrap" style="padding-top:120px;padding-bottom:0px;background-image:url({{ asset('../content/seo3/images/seo3-sectionbg8.png') }});background-repeat:no-repeat;background-position:center top;">
                        <div class="section_wrapper mcb-section-inner">
                            <div class="wrap mcb-wrap mcb-wrap-d064020b2 one-second valign-middle clearfix" style="padding:0 5% 0 0">
                                <div class="mcb-wrap-inner">
                                    <div class="column mcb-column mcb-item-gmx9mi9u2 one column_column">
                                        <div class="column_attr clearfix" style>
                                            <h6 class="seo3-heading">SERVICES</h6>
                                            <hr class="no_line" style="margin: 0 auto 15px;">
                                            <h1>A wide range of services</h1>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="wrap mcb-wrap mcb-wrap-ea14e5685 one-second valign-middle clearfix">
                                <div class="mcb-wrap-inner">
                                    <div class="column mcb-column mcb-item-60f5c6566 one column_image">
                                        <div class="image_frame image_item no_link scale-with-grid no_border">
                                            <div class="image_wrapper">
                                                <img class="scale-with-grid" src="{{ asset('../content/seo3/images/seo3-services-pic1.png') }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="section mcb-section mcb-section-vcrpjtiqd" style="padding-top:80px;padding-bottom:0px;background-color:">
                        <div class="section_wrapper mcb-section-inner">
                            <div class="wrap mcb-wrap mcb-wrap-5n1hdtdx9 one valign-top clearfix">
                                <div class="mcb-wrap-inner">
                                    <div class="column mcb-column mcb-item-9oqbhfh3p one column_column column-margin-30px">
                                        <div class="column_attr clearfix" style>
                                            <h2>Nunc id tellus finibus</h2>
                                        </div>
                                    </div>
                                    <div class="column mcb-column mcb-item-lr9yhnr99 two-third column_column">
                                        <div class="column_attr clearfix" style>
                                            <p>
                                                Ut ultricies imperdiet sodales. Aliquam fringilla aliquam ex sit amet elementum. Proin bibendum sollicitudin feugiat. Curabitur ut egestas justo, vitae molestie ante.
                                            </p>
                                        </div>
                                    </div>
                                    <div class="column mcb-column mcb-item-r5589t2k8 one-third column_button">
                                        <div class="button_align align_right">
                                            <a class="button button_size_2 button_dark button_js" href="faq.html"><span class="button_label">FAQ</span></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="section mcb-section mcb-section-8e8af3a2e bg-cover-ultrawide" style="padding-top:60px;padding-bottom:0px;background-image:url({{ asset('../content/seo3/images/seo3-sectionbg3.png') }});background-repeat:no-repeat;background-position:center;">
                        <div class="section_wrapper mcb-section-inner">
                            <div class="wrap mcb-wrap mcb-wrap-40dab7797 one column-margin-10px valign-top clearfix" style="padding:0 1%">
                                <div class="mcb-wrap-inner">
                                    <div class="column mcb-column mcb-item-ec5ae11c8 one-second column_column">
                                        <div class="column_attr clearfix" style="background-color:#fff;padding:50px 40px 25px;box-shadow: 0px 10px 30px rgba(55,43,125,.1); border-radius: 25px;">
                                            <div class="column one-fourth">
                                                <div class="image_frame image_item no_link scale-with-grid aligncenter no_border" style="margin-bottom:20px;">
                                                    <div class="image_wrapper">.
                                                        <img class="scale-with-grid" src="{{ asset('../content/seo3/images/seo3-services-icon1.png') }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="column three-fourth">
                                                <div style="margin-left: 10%;">
                                                    <h4>Design & Layout</h4>
                                                    <p>
                                                        Sed ultrices nisl velit, eu ornare est ullamcorper a. Nunc quis nibh magna. Proin risus erat, fringilla vel purus sit amet, mattis porta enim.
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="column mcb-column mcb-item-1650661d9 one-second column_column">
                                        <div class="column_attr clearfix" style="background-color:#fff;padding:50px 40px 25px;box-shadow: 0px 10px 30px rgba(55,43,125,.1); border-radius: 25px;">
                                            <div class="column one-fourth">
                                                <div class="image_frame image_item no_link scale-with-grid aligncenter no_border" style="margin-bottom:20px;">
                                                    <div class="image_wrapper">
                                                        <img class="scale-with-grid" src="{{ asset('../content/seo3/images/seo3-services-icon2.png') }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="column three-fourth">
                                                <div style="margin-left: 10%;">
                                                    <h4>Digital Marketing</h4>
                                                    <p>
                                                        Sed ultrices nisl velit, eu ornare est ullamcorper a. Nunc quis nibh magna. Proin risus erat, fringilla vel purus sit amet, mattis porta enim.
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="column mcb-column mcb-item-33949cc9e one column_divider">
                                        <hr class="no_line">
                                    </div>
                                    <div class="column mcb-column mcb-item-847ce05e3 one-second column_column">
                                        <div class="column_attr clearfix" style="background-color:#fff;padding:50px 40px 25px;box-shadow: 0px 10px 30px rgba(55,43,125,.1); border-radius: 25px;">
                                            <div class="column one-fourth">
                                                <div class="image_frame image_item no_link scale-with-grid aligncenter no_border" style="margin-bottom:20px;">
                                                    <div class="image_wrapper">
                                                        <img class="scale-with-grid" src="{{ asset('../content/seo3/images/seo3-services-icon3.png') }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="column three-fourth">
                                                <div style="margin-left: 10%;">
                                                    <h4>Google Ads</h4>
                                                    <p>
                                                        Sed ultrices nisl velit, eu ornare est ullamcorper a. Nunc quis nibh magna. Proin risus erat, fringilla vel purus sit amet, mattis porta enim.
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="column mcb-column mcb-item-37a3ec530 one-second column_column">
                                        <div class="column_attr clearfix" style="background-color:#fff;padding:50px 40px 25px;box-shadow: 0px 10px 30px rgba(55,43,125,.1); border-radius: 25px;">
                                            <div class="column one-fourth">
                                                <div class="image_frame image_item no_link scale-with-grid aligncenter no_border" style="margin-bottom:20px;">
                                                    <div class="image_wrapper">
                                                        <img class="scale-with-grid" src="{{ asset('../content/seo3/images/seo3-services-icon4.png') }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="column three-fourth">
                                                <div style="margin-left: 10%;">
                                                    <h4>Social Media Marketing</h4>
                                                    <p>
                                                        Sed ultrices nisl velit, eu ornare est ullamcorper a. Nunc quis nibh magna. Proin risus erat, fringilla vel purus sit amet, mattis porta enim.
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="column mcb-column mcb-item-526d0d27a one column_divider">
                                        <hr class="no_line">
                                    </div>
                                    <div class="column mcb-column mcb-item-35d855af9 one-second column_column">
                                        <div class="column_attr clearfix" style="background-color:#fff;padding:50px 40px 25px;box-shadow: 0px 10px 30px rgba(55,43,125,.1); border-radius: 25px;">
                                            <div class="column one-fourth">
                                                <div class="image_frame image_item no_link scale-with-grid aligncenter no_border" style="margin-bottom:20px;">
                                                    <div class="image_wrapper">
                                                        <img class="scale-with-grid" src="{{ asset('../content/seo3/images/seo3-services-icon5.png') }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="column three-fourth">
                                                <div style="margin-left: 10%;">
                                                    <h4>Marketing Analysis</h4>
                                                    <p>
                                                        Sed ultrices nisl velit, eu ornare est ullamcorper a. Nunc quis nibh magna. Proin risus erat, fringilla vel purus sit amet, mattis porta enim.
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="column mcb-column mcb-item-66c05af1b one-second column_column">
                                        <div class="column_attr clearfix" style="background-color:#fff;padding:50px 40px 25px;box-shadow: 0px 10px 30px rgba(55,43,125,.1); border-radius: 25px;">
                                            <div class="column one-fourth">
                                                <div class="image_frame image_item no_link scale-with-grid aligncenter no_border" style="margin-bottom:20px;">
                                                    <div class="image_wrapper">
                                                        <img class="scale-with-grid" src="{{ asset('../content/seo3/images/seo3-services-icon6.png') }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="column three-fourth">
                                                <div style="margin-left: 10%;">
                                                    <h4>Content Marketing</h4>
                                                    <p>
                                                        Sed ultrices nisl velit, eu ornare est ullamcorper a. Nunc quis nibh magna. Proin risus erat, fringilla vel purus sit amet, mattis porta enim.
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="column mcb-column mcb-item-8naxdil2f one column_divider">
                                        <hr class="no_line">
                                    </div>
                                    <div class="column mcb-column mcb-item-doc0o9vdq one-second column_column">
                                        <div class="column_attr clearfix" style="background-color:#fff;padding:50px 40px 25px;box-shadow: 0px 10px 30px rgba(55,43,125,.1); border-radius: 25px;">
                                            <div class="column one-fourth">
                                                <div class="image_frame image_item no_link scale-with-grid aligncenter no_border" style="margin-bottom:20px;">
                                                    <div class="image_wrapper">
                                                        <img class="scale-with-grid" src="{{ asset('../content/seo3/images/seo3-services-icon7.png') }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="column three-fourth">
                                                <div style="margin-left: 10%;">
                                                    <h4>Sales optimization</h4>
                                                    <p>
                                                        Sed ultrices nisl velit, eu ornare est ullamcorper a. Nunc quis nibh magna. Proin risus erat, fringilla vel purus sit amet, mattis porta enim.
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="column mcb-column mcb-item-a1vk1zaat one-second column_column">
                                        <div class="column_attr clearfix" style="background-color:#fff;padding:50px 40px 25px;box-shadow: 0px 10px 30px rgba(55,43,125,.1); border-radius: 25px;">
                                            <div class="column one-fourth">
                                                <div class="image_frame image_item no_link scale-with-grid aligncenter no_border" style="margin-bottom:20px;">
                                                    <div class="image_wrapper">
                                                        <img class="scale-with-grid" src="{{ asset('../content/seo3/images/seo3-services-icon8.png') }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="column three-fourth">
                                                <div style="margin-left: 10%;">
                                                    <h4>Friendly URL</h4>
                                                    <p>
                                                        Sed ultrices nisl velit, eu ornare est ullamcorper a. Nunc quis nibh magna. Proin risus erat, fringilla vel purus sit amet, mattis porta enim.
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="column mcb-column mcb-item-et5e12oli one column_divider">
                                        <hr class="no_line">
                                    </div>
                                    <div class="column mcb-column mcb-item-7819bwfv6 one-second column_column">
                                        <div class="column_attr clearfix" style="background-color:#fff;padding:50px 40px 25px;box-shadow: 0px 10px 30px rgba(55,43,125,.1); border-radius: 25px;">
                                            <div class="column one-fourth">
                                                <div class="image_frame image_item no_link scale-with-grid aligncenter no_border" style="margin-bottom:20px;">
                                                    <div class="image_wrapper">
                                                        <img class="scale-with-grid" src="{{ asset('../content/seo3/images/seo3-services-icon9.png') }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="column three-fourth">
                                                <div style="margin-left: 10%;">
                                                    <h4>Startups</h4>
                                                    <p>
                                                        Sed ultrices nisl velit, eu ornare est ullamcorper a. Nunc quis nibh magna. Proin risus erat, fringilla vel purus sit amet, mattis porta enim.
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="column mcb-column mcb-item-sdu2gsxrz one-second column_column">
                                        <div class="column_attr clearfix" style="background-color:#fff;padding:50px 40px 25px;box-shadow: 0px 10px 30px rgba(55,43,125,.1); border-radius: 25px;">
                                            <div class="column one-fourth">
                                                <div class="image_frame image_item no_link scale-with-grid aligncenter no_border" style="margin-bottom:20px;">
                                                    <div class="image_wrapper">
                                                        <img class="scale-with-grid" src="{{ asset('../content/seo3/images/seo3-services-icon10.png') }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="column three-fourth">
                                                <div style="margin-left: 10%;">
                                                    <h4>Wireframes</h4>
                                                    <p>
                                                        Sed ultrices nisl velit, eu ornare est ullamcorper a. Nunc quis nibh magna. Proin risus erat, fringilla vel purus sit amet, mattis porta enim.
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="section mcb-section mcb-section-a8c0ef3ed bg-cover-ultrawide" style="padding-top:150px;padding-bottom:0px;background-image:url({{ asset('../content/seo3/images/seo3-sectionbg4.png') }});background-repeat:no-repeat;background-position:center;">
                        <div class="section_wrapper mcb-section-inner">
                            <div class="wrap mcb-wrap mcb-wrap-87ae5d366 one-second valign-top clearfix" style="padding:0 7% 0 0">
                                <div class="mcb-wrap-inner">
                                    <div class="column mcb-column mcb-item-4ee93d89d one column_column column-margin-20px">
                                        <div class="column_attr clearfix" style>
                                            <h6 class="seo3-heading">OUR WORK</h6>
                                            <hr class="no_line" style="margin: 0 auto 15px;">
                                            <h2>Why customers loves us?</h2>
                                            <hr class="no_line" style="margin: 0 auto 15px;">
                                            <p>
                                                Ut ultricies imperdiet sodales. Aliquam fringilla aliquam ex sit amet elementum. Proin bibendum sollicitudin feugiat. Curabitur ut egestas justo, vitae molestie ante.
                                            </p>
                                        </div>
                                    </div>
                                    <div class="column mcb-column mcb-item-5de94908a one column_column column-margin-10px">
                                        <div class="column_attr clearfix" style="background-image:url({{ asset('../content/seo3/images/seo3-home-icon4.png') }});background-repeat:no-repeat;background-position:left top;padding:16px 0 0 80px;">
                                            <h5>Vivamus in diam turpis</h5>
                                        </div>
                                    </div>
                                    <div class="column mcb-column mcb-item-47b53f7dd one column_column">
                                        <div class="column_attr clearfix" style="background-image:url({{ asset('../content/seo3/images/seo3-home-icon5.png') }});background-repeat:no-repeat;background-position:left top;padding:16px 0 0 80px;">
                                            <h5>Curabitur ut egestas justo</h5>
                                        </div>
                                    </div>
                                    <div class="column mcb-column mcb-item-9a5281da6 one column_button">
                                        <a class="button button_size_2 button_dark button_js" href="contact.html"><span class="button_label">About us</span></a>
                                    </div>
                                </div>
                            </div>
                            <div class="wrap mcb-wrap mcb-wrap-b8f1da6e1 one-second valign-top clearfix">
                                <div class="mcb-wrap-inner">
                                    <div class="column mcb-column mcb-item-9ddab6183 one column_image">
                                        <div class="image_frame image_item no_link scale-with-grid no_border">
                                            <div class="image_wrapper"><img class="scale-with-grid" src="{{ asset('../content/seo3/images/seo3-home-pic2.png') }}">
                                            </div>
                                        </div>
                                    </div>
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
