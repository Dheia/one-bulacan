
<header id="Header">
    <div id="Top_bar">
        <div class="container">
            <div class="column one">
                <div class="top_bar_left clearfix">
                    <div class="logo">
                        <a id="logo" href="{{ url('home') }}" title="ONE PAMPANGA" data-height="60" data-padding="15">
                            <img class="logo-main scale-with-grid" src="{{ asset('content/seo3/images/seo31_low.png') }}" data-retina="{{ asset('content/seo3/images/logo.png') }}" data-height="23" alt="one_logo">
                            <img class="logo-sticky scale-with-grid" src="{{ asset('content/seo3/images/seo31_low.png') }}" data-retina="{{ asset('content/seo3/images/logo.png') }}" data-height="23" alt="one_logo">
                            <img class="logo-mobile scale-with-grid" src="{{ asset('content/seo3/images/seo31_low.png') }}" data-retina="{{ asset('content/seo3/images/logo.png') }}" data-height="23" alt="one_logo">
                            <img class="logo-mobile-sticky scale-with-grid" src="{{ asset('content/seo3/images/seo31_low.png') }}" data-retina="{{ asset('content/seo3/images/logo.png') }}" data-height="23" alt="one_logo">
                        </a>
                    </div>
                    <div class="menu_wrapper">
                        <nav id="menu">
                            <ul id="menu-menu-left" class="menu menu-main menu_left">
                                <li id="home_menu">
                                    <a href="{{ url('home') }}"><span>Home</span></a>
                                </li>
                                <li id="categories_menu">
                                    <a href="{{ url('categories') }}"><span>Categories</span></a>
                                </li>
                                {{-- <li id="gallery_menu">
                                    <a href="{{ url('gallery') }}"><span>Gallery</span></a>
                                </li> --}}
                                <li id="about_menu">
                                    <a href="{{ asset('about') }}"><span>About</span></a>
                                </li>
                            </ul>
                            <ul id="menu-menu-right" class="menu menu-main menu_right">
                                {{-- <li id="jobs">
                                    <a href="{{ url('jobs') }}"><span>Jobs</span></a>
                                </li> --}}
                                
                                <li id="privacy_menu">
                                    <a href="{{ asset('privacy') }}"><span>Privacy</span></a>
                                </li>
                                <li id="contact_menu">
                                    <a href="{{ asset('contact') }}"><span>Contact</span></a>
                                </li>
                                <li id="register_menu">
                                    <a href="{{ url('registration') }}"><span style="color:#EE2C2C">Get Listed</span></span></a>
                                </li>
                            </ul>
                        </nav>
                        <a class="responsive-menu-toggle" href="#" style="top:13px;">
                            <i class="icon-menu-fine"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>