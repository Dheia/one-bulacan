<b>
<footer id="Footer" class="clearfix" style="margin-top: -10px;">
    <div class="footer_action" style="background:#E9F0F9; margin-top: -10px;">
            <div class="container">
                <div class="column one">
                    <div class="google_font" style="font-family:'Dosis',Arial,Tahoma,sans-serif;font-size:20px;line-height:20px;font-weight:700;letter-spacing:0px;color:#44056c;">
                        See and follow our profile @ <a href="{{Config('settings.facebook')}}" style="color:#4c7ff4;" target="_blank">Facebook</a>
                        {{-- , <a href="#" style="color:#ef3993;">Instagram</a> and <a href="#" style="color:#ff3030;">YouTube</a>  --}}
                    </div>
                </div>
            </div>
        </div>
        <div class="widgets_wrapper" style="background:#E9F0F9; margin-top: -10px;">
            <div class="container">
                    <div class="row">
                        <div class="col-md-3">
                            <img src="{{ asset('v2/content/one/images/one-logo-footer.png') }}" style="margin-top:30px;">
                        </div>
                        <div class="col-md-6">
                            <div class="text-center">
                                <h4>CONTACT WITH US</h4>
                                <hr class="no_line" style="margin:0 auto 40px; border-top:0px;">
                                <h5>
                                    <a style="color:#44056C;" href="mailto:{{Config('settings.contact_email')}}?Subject=Inquiry from One {{Config('settings.province')}}" target="_top">
                                    {{Config('settings.contact_email')}} 
                                    <span style="margin: 0 5px;">
                                        <i class="icon-record" style="color:#f3bb48"></i>
                                    </span>  
                                    @if(Config('settings.telephone'))
                                    <a style="color:#44056C; text-align:right;" href="tel:{{Config('settings.telephone')}}">{{Config('settings.telephone')}}</a>
                                    @endif
                                </h5>
                                <hr class="no_line" style="margin:0 auto 30px; border-top:0px;">
                                    <p class="padding-des">
                                        {{Config('settings.contact_address')}}
                                    </p>
                                <hr class="no_line" style="margin:0 auto 30px; border-top:0px;"> 
                                    <a class="get_btn_listed" href="{{ url('registration') }}" target="_blank">
                                        <span class="button_label">Get Listed!</span>
                                    </a> 
                            </div>
                        </div>
                        <div class="col-md-3">
                            <hr class="no_line" style="margin:0 auto 20px; border-top:0px;">
                            <ul>
                                <li style="margin-bottom:20px;"> 
                                    <i class="icon-record" style="color:#f3bb48"></i>
                                    <a href="{{ url('categories') }}">Categories</a> 
                                </li>
                                <li style="margin-bottom:20px;"> 
                                    <i class="icon-record" style="color:#f3bb48"></i>
                                    <a href="{{ url('about') }}">About Us</a> 
                                </li>
                                <li style="margin-bottom:20px;"> 
                                    <i class="icon-record" style="color:#f3bb48"></i>
                                    <a href="{{ url('privacy') }}">Privacy</a> 
                                </li>
                                <li style="margin-bottom:20px;"> 
                                    <i class="icon-record" style="color:#f3bb48"></i>
                                    <a href="{{ url('contact') }}">Contact Us</a> 
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer_copy" style="background:#E9F0F9;">
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
</b>