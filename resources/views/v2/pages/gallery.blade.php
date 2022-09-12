@extends('v2.layouts.app2')

@section('body_class', "color-custom style-simple button-flat layout-full-width no-content-padding header-split minimalist-header-no sticky-header sticky-tb-color ab-hide subheader-both-center menu-link-color menuo-no-borders mobile-tb-center mobile-side-slide mobile-mini-mr-ll tablet-sticky mobile-header-mini mobile-sticky tr-header tr-menu tr-content be-reg-209621")

@section('content')
    <div id="Wrapper">
        <div id="Header_wrapper">
            <header id="Header">
                @include('v2.partials.top_bar')
            </header>
        </div>
        <div id="Content">
            <div class="content_wrapper clearfix">
                <div class="sections_group">
                    <div class="entry-content">
                        <div class="section mcb-section bg-cover" style="padding-top:15px; padding-bottom:15px; background-image:url(v2/content/one/images/menu-mainbg.jpg); background-repeat:no-repeat; background-position:center top; min-height:60px;">

                        </div>
                        <div class="section mcb-section" style="padding-top:0px; padding-bottom:50px">

                        </div>
                        <div class="section mcb-section " style="padding-top:0px; padding-bottom:0px">
                            <div class="section_wrapper mcb-section-inner">
                                <div class="wrap mcb-wrap one valign-top clearfix">
                                    <div class="mcb-wrap-inner">
                                        <div class="column mcb-column one-third column_placeholder">
                                            <div class="placeholder">
                                                <div class="image_wrapper">
                                                    <img class="scale-with-grid" src="{{ asset('v2/content/one/images/logo1.png') }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="column mcb-column two-third column_column column-margin-10px">
                                            <div class="column_attr clearfix" style="margin-left:15px;">
                                                <h3><b>Tigernet Hosting and IT Services</b></h3>
                                                    <h5><small>Fast and Reliable.</small></h5>
                                                <hr class="no_line" style="margin:0 auto 5px">
                                                <p style="line-height: 15px;font-size: 11px; margin-bottom: 0;">322 San Roque Guagua, Pampanga</p>
                                                <p style="line-height: 15px;font-size: 11px; margin-bottom: 0;">09000000000</p>
                                                <p style="line-height: 15px;font-size: 11px; margin-bottom: 0;">4090000</p>
                                                <p style="line-height: 15px;font-size: 11px; margin-bottom: 0;">info@tigernethost.com</p>
                                                <p style="line-height: 15px;font-size: 11px; margin-bottom: 0;">tigernethost.com</p>

                                                <hr class="no_line" style="margin:0 auto 10px">

                                                <p style="line-height: 15px;font-size: 11px; margin-bottom: 0;">Information Technology</p>

                                            </div>
                                        </div>                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="section mcb-section" style="padding-top:0px; padding-bottom:0px">
                            <div class="section_wrapper mcb-section-inner">
                                <div class="wrap mcb-wrap one valign-top clearfix">
                                    <div class="mcb-wrap-inner">
                                        <div class="column mcb-column one column_image">
                                            <div class="image_frame image_item no_link scale-with-grid stretch no_border" style="background-image: url('v2/content/one/images/menu-promotion.jpg'); min-height: 200px; background-repeat: no-repeat;">
                                                <div class="image_wrapper">
                                                    <!-- <img class="scale-with-grid" src="images/logo1.png"> -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="section mcb-section no-margin-v" style="padding-top:0px; padding-bottom:0px">
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
                                <div class="wrap mcb-wrap two-third valign-top clearfix" style="padding:20px 0 0 0">
                                    <div class="mcb-wrap-inner">
                                        <div class="column mcb-column one-second column_column">
                                            <div class="column_attr clearfix mobile_align_center">
                                                <h4>Lorem ipsum Burger</h4>
                                            </div>
                                        </div>
                                        <div class="column mcb-column one-second column_column">
                                            <div class="column_attr clearfix align_right mobile_align_center">
                                                <h4 class="themecolor">$23</h4>
                                            </div>
                                        </div>
                                        <div class="column mcb-column one column_column">
                                            <div class="column_attr clearfix align_left mobile_align_center" style="border-bottom:1px solid #d4ceca;">
                                                <p>
                                                    Aliquam ac dui vel dui vulputate consectetur. Mauris accumsan, massa non consectetur condim, diam arcu tristique nibh, nec egestas diam elit at nulla.
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="section mcb-section no-margin-v" style="padding-top:0px; padding-bottom:0px">
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
                                <div class="wrap mcb-wrap two-third valign-top clearfix" style="padding:20px 0 0 0">
                                    <div class="mcb-wrap-inner">
                                        <div class="column mcb-column one-second column_column">
                                            <div class="column_attr clearfix mobile_align_center">
                                                <h4>Qurioto de la passum Burger</h4>
                                            </div>
                                        </div>
                                        <div class="column mcb-column one-second column_column">
                                            <div class="column_attr clearfix align_right mobile_align_center">
                                                <h4 class="themecolor">$26</h4>
                                            </div>
                                        </div>
                                        <div class="column mcb-column one column_column">
                                            <div class="column_attr clearfix align_left mobile_align_center" style=" border-bottom:1px solid #d4ceca;">
                                                <p>
                                                    Aliquam ac dui vel dui vulputate consectetur. Mauris accumsan, massa non consectetur condim, diam arcu tristique nibh, nec egestas diam elit at nulla.
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="section mcb-section no-margin-v  " style="padding-top:0px; padding-bottom:0px">
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
                                <div class="wrap mcb-wrap two-third valign-top clearfix" style="padding:20px 0 0 0">
                                    <div class="mcb-wrap-inner">
                                        <div class="column mcb-column one-second column_column">
                                            <div class="column_attr clearfix mobile_align_center">
                                                <h4>Postre ventenoro Burger</h4>
                                            </div>
                                        </div>
                                        <div class="column mcb-column one-second column_column">
                                            <div class="column_attr clearfix align_right mobile_align_center">
                                                <h4 class="themecolor">$32</h4>
                                            </div>
                                        </div>
                                        <div class="column mcb-column one column_column">
                                            <div class="column_attr clearfix align_left mobile_align_center" style=" border-bottom:1px solid #d4ceca;">
                                                <p>
                                                    Aliquam ac dui vel dui vulputate consectetur. Mauris accumsan, massa non consectetur condim, diam arcu tristique nibh, nec egestas diam elit at nulla.
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="section mcb-section no-margin-v  " style="padding-top:0px; padding-bottom:0px">
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
                                <div class="wrap mcb-wrap two-third valign-top clearfix" style="padding:20px 0 0 0">
                                    <div class="mcb-wrap-inner">
                                        <div class="column mcb-column one-second column_column">
                                            <div class="column_attr clearfix mobile_align_center">
                                                <h4>Quantum es omnia Burger</h4>
                                            </div>
                                        </div>
                                        <div class="column mcb-column one-second column_column">
                                            <div class="column_attr clearfix align_right mobile_align_center">
                                                <h4 class="themecolor">$24</h4>
                                            </div>
                                        </div>
                                        <div class="column mcb-column one column_column">
                                            <div class="column_attr clearfix align_left mobile_align_center" style=" border-bottom:1px solid #d4ceca;">
                                                <p>
                                                    Aliquam ac dui vel dui vulputate consectetur. Mauris accumsan, massa non consectetur condim, diam arcu tristique nibh, nec egestas diam elit at nulla.
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="section mcb-section" style="padding-top:125px; padding-bottom:0px">
                            <div class="section_wrapper mcb-section-inner">
                                <div class="wrap mcb-wrap one valign-top clearfix">
                                    <div class="mcb-wrap-inner">
                                        <div class="column mcb-column one column_column  column-margin-10px">
                                            <div class="column_attr clearfix align_center">
                                                <h6>SANDWICHES</h6>
                                            </div>
                                        </div>
                                        <div class="column mcb-column one column_image">
                                            <div class="image_frame image_item no_link scale-with-grid aligncenter no_border">
                                                <div class="image_wrapper">
                                                    <img class="scale-with-grid" src="{{ asset('v2/content/one/images/menu-sandwich.png') }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="section mcb-section no-margin-v" style="padding-top:0px; padding-bottom:0px">
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
                                <div class="wrap mcb-wrap two-third valign-top clearfix" style="padding:20px 0 0 0">
                                    <div class="mcb-wrap-inner">
                                        <div class="column mcb-column one-second column_column">
                                            <div class="column_attr clearfix mobile_align_center">
                                                <h4>Praesent porta tortor</h4>
                                            </div>
                                        </div>
                                        <div class="column mcb-column one-second column_column">
                                            <div class="column_attr clearfix align_right mobile_align_center">
                                                <h4 class="themecolor">$27</h4>
                                            </div>
                                        </div>
                                        <div class="column mcb-column one column_column">
                                            <div class="column_attr clearfix align_left mobile_align_center" style=" border-bottom:1px solid #d4ceca;">
                                                <p>
                                                    Aliquam ac dui vel dui vulputate consectetur. Mauris accumsan, massa non consectetur condim, diam arcu tristique nibh, nec egestas diam elit at nulla.
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="section mcb-section no-margin-v" style="padding-top:0px; padding-bottom:0px">
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
                                <div class="wrap mcb-wrap two-third valign-top clearfix" style="padding:20px 0 0 0">
                                    <div class="mcb-wrap-inner">
                                        <div class="column mcb-column one-second column_column">
                                            <div class="column_attr clearfix mobile_align_center">
                                                <h4>Donec lacinia velit ac</h4>
                                            </div>
                                        </div>
                                        <div class="column mcb-column one-second column_column">
                                            <div class="column_attr clearfix align_right mobile_align_center">
                                                <h4 class="themecolor">$14</h4>
                                            </div>
                                        </div>
                                        <div class="column mcb-column one column_column">
                                            <div class="column_attr clearfix align_left mobile_align_center" style=" border-bottom:1px solid #d4ceca;">
                                                <p>
                                                    Aliquam ac dui vel dui vulputate consectetur. Mauris accumsan, massa non consectetur condim, diam arcu tristique nibh, nec egestas diam elit at nulla.
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="section mcb-section no-margin-v" style="padding-top:0px; padding-bottom:0px">
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
                                <div class="wrap mcb-wrap two-third valign-top clearfix" style="padding:20px 0 0 0">
                                    <div class="mcb-wrap-inner">
                                        <div class="column mcb-column one-second column_column">
                                            <div class="column_attr clearfix mobile_align_center">
                                                <h4>Maecenas ac eros</h4>
                                            </div>
                                        </div>
                                        <div class="column mcb-column one-second column_column">
                                            <div class="column_attr clearfix align_right mobile_align_center">
                                                <h4 class="themecolor">$19</h4>
                                            </div>
                                        </div>
                                        <div class="column mcb-column one column_column">
                                            <div class="column_attr clearfix align_left mobile_align_center" style=" border-bottom:1px solid #d4ceca;">
                                                <p>
                                                    Aliquam ac dui vel dui vulputate consectetur. Mauris accumsan, massa non consectetur condim, diam arcu tristique nibh, nec egestas diam elit at nulla.
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="section mcb-section no-margin-v  " style="padding-top:0px; padding-bottom:0px">
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
                                <div class="wrap mcb-wrap two-third valign-top clearfix" style="padding:20px 0 0 0">
                                    <div class="mcb-wrap-inner">
                                        <div class="column mcb-column one-second column_column">
                                            <div class="column_attr clearfix mobile_align_center">
                                                <h4>Sed et justo id urna</h4>
                                            </div>
                                        </div>
                                        <div class="column mcb-column one-second column_column">
                                            <div class="column_attr clearfix align_right mobile_align_center">
                                                <h4 class="themecolor">$25</h4>
                                            </div>
                                        </div>
                                        <div class="column mcb-column one column_column">
                                            <div class="column_attr clearfix align_left mobile_align_center" style=" border-bottom:1px solid #d4ceca;">
                                                <p>
                                                    Aliquam ac dui vel dui vulputate consectetur. Mauris accumsan, massa non consectetur condim, diam arcu tristique nibh, nec egestas diam elit at nulla.
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="section mcb-section" style="padding-top:125px; padding-bottom:0px">
                            <div class="section_wrapper mcb-section-inner">
                                <div class="wrap mcb-wrap one valign-top clearfix">
                                    <div class="mcb-wrap-inner">
                                        <div class="column mcb-column one column_column  column-margin-10px">
                                            <div class="column_attr clearfix align_center">
                                                <h6>DRINKS</h6>
                                            </div>
                                        </div>
                                        <div class="column mcb-column one column_image">
                                            <div class="image_frame image_item no_link scale-with-grid aligncenter no_border">
                                                <div class="image_wrapper">
                                                    <img class="scale-with-grid" src="{{ asset('v2/content/one/images/menu-beer.png') }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="section mcb-section no-margin-v" style="padding-top:0px; padding-bottom:0px">
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
                                <div class="wrap mcb-wrap two-third valign-top clearfix" style="padding:20px 0 0 0">
                                    <div class="mcb-wrap-inner">
                                        <div class="column mcb-column one-second column_column">
                                            <div class="column_attr clearfix mobile_align_center">
                                                <h4>Pellentesque feugiat</h4>
                                            </div>
                                        </div>
                                        <div class="column mcb-column one-second column_column">
                                            <div class="column_attr clearfix align_right mobile_align_center">
                                                <h4 class="themecolor">$11</h4>
                                            </div>
                                        </div>
                                        <div class="column mcb-column one column_column">
                                            <div class="column_attr clearfix align_left mobile_align_center" style=" border-bottom:1px solid #d4ceca;">
                                                <p>
                                                    Aliquam ac dui vel dui vulputate consectetur. Mauris accumsan, massa non consectetur condim, diam arcu tristique nibh, nec egestas diam elit at nulla.
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="section mcb-section no-margin-v" style="padding-top:0px; padding-bottom:0px">
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
                                <div class="wrap mcb-wrap two-third valign-top clearfix" style="padding:20px 0 0 0">
                                    <div class="mcb-wrap-inner">
                                        <div class="column mcb-column one-second column_column">
                                            <div class="column_attr clearfix mobile_align_center">
                                                <h4>Maecenas convallis</h4>
                                            </div>
                                        </div>
                                        <div class="column mcb-column one-second column_column">
                                            <div class="column_attr clearfix align_right mobile_align_center">
                                                <h4 class="themecolor">$9</h4>
                                            </div>
                                        </div>
                                        <div class="column mcb-column one column_column">
                                            <div class="column_attr clearfix align_left mobile_align_center" style=" border-bottom:1px solid #d4ceca;">
                                                <p>
                                                    Aliquam ac dui vel dui vulputate consectetur. Mauris accumsan, massa non consectetur condim, diam arcu tristique nibh, nec egestas diam elit at nulla.
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="section mcb-section no-margin-v" style="padding-top:0px; padding-bottom:0px">
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
                                <div class="wrap mcb-wrap two-third valign-top clearfix" style="padding:20px 0 0 0">
                                    <div class="mcb-wrap-inner">
                                        <div class="column mcb-column one-second column_column">
                                            <div class="column_attr clearfix mobile_align_center">
                                                <h4>Vestibulum laoreet</h4>
                                            </div>
                                        </div>
                                        <div class="column mcb-column one-second column_column">
                                            <div class="column_attr clearfix align_right mobile_align_center">
                                                <h4 class="themecolor">$6</h4>
                                            </div>
                                        </div>
                                        <div class="column mcb-column one column_column">
                                            <div class="column_attr clearfix align_left mobile_align_center" style=" border-bottom:1px solid #d4ceca;">
                                                <p>
                                                    Aliquam ac dui vel dui vulputate consectetur. Mauris accumsan, massa non consectetur condim, diam arcu tristique nibh, nec egestas diam elit at nulla.
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="section mcb-section no-margin-v" style="padding-top:0px; padding-bottom:200px">
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
                                <div class="wrap mcb-wrap two-third valign-top clearfix" style="padding:20px 0 0 0">
                                    <div class="mcb-wrap-inner">
                                        <div class="column mcb-column one-second column_column">
                                            <div class="column_attr clearfix mobile_align_center">
                                                <h4>Nulla volutpat orci</h4>
                                            </div>
                                        </div>
                                        <div class="column mcb-column one-second column_column">
                                            <div class="column_attr clearfix align_right mobile_align_center">
                                                <h4 class="themecolor">$5</h4>
                                            </div>
                                        </div>
                                        <div class="column mcb-column one column_column">
                                            <div class="column_attr clearfix align_left mobile_align_center" style=" border-bottom:1px solid #d4ceca;">
                                                <p>
                                                    Aliquam ac dui vel dui vulputate consectetur. Mauris accumsan, massa non consectetur condim, diam arcu tristique nibh, nec egestas diam elit at nulla.
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
  
    <script>
        $(document).ready(function () {
            var menu = $('#menu');
            // $('#' + indexValue).addClass("selectedQuestion");
            $('li[id=faq_menu]').addClass("current-menu-item")
            
        });
    
    </script>
@endsection


