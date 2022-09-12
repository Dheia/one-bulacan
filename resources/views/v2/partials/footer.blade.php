<footer id="Footer" class="clearfix">
    <div class="widgets_wrapper" style="padding:40px 0 80px">
        <div class="container">
            <div class="column one-third">
                <aside class="widget_text widget widget_custom_html">
                    <div class="textwidget custom-html-widget">
                        <h4 class="themecolor">Find us here</h4>
                        <p>
                            @if(Config('settings.facebook'))
                                <a href="{{Config('settings.facebook')}}" target="_blank"><i class="icon-facebook"></i></a>
                            @endif
                            @if(Config('settings.twitter'))
                                <a href="{{ Config('settings.twitter') }}"><i class="icon-twitter"></i></a>
                            @endif
                            @if(Config('settings.instagram'))
                                <a href="{{ Config('settings.instagram') }}"><i class="icon-instagram"></i></a>
                            @endif
                            @if(Config('settings.youtube'))
                                <a href="{{ Config('settings.youtube') }}"><i class="icon-youtube"></i></a>
                            @endif
                            @if(Config('settings.pinterest'))
                                <a href="{{ Config('settings.pinterest') }}"><i class="icon-pinterest"></i></a>
                            @endif
                            @if(Config('settings.linkedin'))
                                <a href="{{ Config('settings.linkedin') }}"><i class="icon-linkedin"></i></a>
                            @endif
                        </p>
                    </div>
                </aside>
            </div>
            <div class="column one-third">
                <aside class="widget_text widget widget_custom_html">
                    <div class="textwidget custom-html-widget">
                        <h4 class="themecolor">Contact us</h4>
                        <p>
                            @if(Config('settings.telephone'))
                                <a href="tel:{{Config('settings.telephone')}}">{{Config('settings.telephone')}}</a>
                            @endif
                            @if(Config('settings.mobile'))
                                <br>
                                <a href="tel:{{Config('settings.mobile')}}">{{Config('settings.mobile')}}</a>
                            @endif
                            <br>
                            <a href="mailto:{{Config('settings.contact_email')}}?Subject=Inquiry from One {{Config('settings.province')}}" target="_top">
                                {{Config('settings.contact_email')}}
                            </a>
                        </p>
                    </div>
                </aside>
            </div>
            <div class="column one-third">
                <aside class="widget_text widget widget_custom_html">
                    <div class="textwidget custom-html-widget">
                        <h4 class="themecolor"> Office Address</h4>
                        <div class="column two-third">
                            <p>
                                {{Config('settings.contact_address')}}
                            </p>
                        </div>
                    </div>
                </aside>
            </div>
        </div>
    </div>
    <div class="footer_copy">
        <div class="container">
            <div class="column one themecolor ">
                <a id="back_to_top" class="button button_js" href="#"><i class="icon-up-open-big"></i></a>
                <div class="copyright">
                    &copy; 2019 Project One <a class="themecolor" target="_blank" rel="nofollow" href="https://tigernethost.com">Tigernet Hosting and IT Services</a>
                </div>
            </div>
        </div>
    </div>
</footer>