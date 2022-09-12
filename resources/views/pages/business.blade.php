@extends('layouts.single')

<!-- @section('body_class', "single single-post single-format-standard with_aside aside_right color-custom style-simple button-round layout-full-width no-content-padding no-shadows header-transparent header-fw minimalist-header-no sticky-header sticky-tb-color ab-hide subheader-both-left menu-link-color menuo-right menuo-no-borders mobile-tb-center mobile-side-slide mobile-mini-mr-ll tablet-sticky mobile-header-mini mobile-sticky") -->
@section('body_class', "blog layout-full-width button-round with_aside aside_right subheader-both-left menu-line-below-80-1 menuo-right menuo-no-borders mobile-tb-center mobile-side-slide mobile-mini-mr-ll tablet-sticky mobile-header-mini mobile-sticky header-classic minimalist-header-no header-fw sticky-header")

@section('content')
<div id="Wrapper">
    <div id="Header_wrapper">
        @include('partials.header')
        <!--Subheader area - only for certain pages -->
        <div id="Subheader" style="padding:10% 0 50px; margin-left:0px;">
            <div class="container">
                <div class="column two-third">
                    <div class="column one-third" style="text-align: center;">
                        <div class="photo">
                            @if($business->logo)
                                <img style="min-height: 190px;"  width="100%" height="100%" src="{{asset($business->logo)}}" class="scale-with-grid wp-post-image" alt="" itemprop="image" />
                            @else
                                <img width="100%" height="100%" src="{{ asset('images/default_image.png') }}" class="scale-with-grid wp-post-image" alt="" itemprop="image" />
                            @endif
                        </div>
                        @if($business->website)
                            <a href="{{$business->website}}" target="_blank" class="icon_bar icon_bar_globe icon_bar_small">
                                <span class="t"><i class="icon-globe"></i></span>
                                <span class="b"><i class="icon-globe"></i></span>
                            </a>
                        @endif
                        @if($business->facebook)
                            <a href="{{$business->facebook}}" target="_blank" class="icon_bar icon_bar_facebook icon_bar_small">
                                <span class="t"><i class="icon-facebook"></i></span>
                                <span class="b"><i class="icon-facebook"></i></span>
                            </a>
                        @endif
                        @if($business->twitter)
                            <a href="http://twitter.com/{{$business->twitter}}" target="_blank" class="icon_bar icon_bar_twitter icon_bar_small">
                                <span class="t"><i class="icon-twitter"></i></span>
                                <span class="b"><i class="icon-twitter"></i></span>
                            </a>
                        @endif
                        @if($business->instagram)
                            <a href="http://instagram.com/{{$business->instagram}}" target="_blank" class="icon_bar icon_bar_instagram icon_bar_small">
                                <span class="t"><i class="icon-instagram"></i></span>
                                <span class="b"><i class="icon-instagram"></i></span>
                            </a>
                        @endif
                    </div>
                    <div class="column two-third" >
                        <h2 class="title">
                            <strong>{{$business->name}}</strong>
                        </h2>
                        <p class="big">
                            <i class="icon-location"></i>{{$business->address1}}, {{$business->baranggay_name}}, {{$business->location_name}}<br>
                            <i class="icon-mobile"></i><a href="tel:{{$business->mobile}}"> {{$business->mobile}}</a> <br>
                            @if($business->telephone) <i class="icon-phone" style="font-size: 20px;"></i><a href="tel:{{$business->telephone}}"> {{$business->telephone}}</a> <br> @endif
                            <i class="icon-mail" style="font-size: 20px;"></i><a href="mailto:{{$business->email}}?Subject=Inquiry from One Pampanga" target="_top"> {{$business->email}}</a><br>
                            @if($business->dti)
                            <img width="25" height="25" src="{{ asset('images/DTI_LOGO.png') }}" class="scale-with-grid" alt="" itemprop="image" />
                            @endif
                        </p>
                    </div>
                    <div class="column one">
                        <p style="font-size: 18px;">
                            @if(count($tag_categories)>0)
                                <i style="font-size: 20px;" class="icon-tag"></i>
                                @foreach($tag_categories as $tag_category)
                                    @if($loop->last)
                                    <a href="{{ asset('businesses/'.$tag_category->category_slug) }}">{{$tag_category->category_name}}</a>
                                    @else
                                    <a href="{{ asset('businesses/'.$tag_category->category_slug) }}">{{$tag_category->category_name}}</a>,
                                    @endif
                                @endforeach
                            @endif
                        </p>
                    </div>
                </div>
                <div class="column one-third column_map">
                    <!-- Google map area -->
                    <div class="google-map-wrapper no_border">
                        <div class="google-map" id="google-map-area-5520585af0ed4" style="width:100%; height:300px;">
                            &nbsp;
                        </div>
                    </div>
                </div>
               
            </div>
        </div>
    </div>
    <div id="Content">
        <div class="content_wrapper clearfix">
            <div class="sections_group">
                
                <div class="jq-tabs tabs_wrapper tabs_horizontal ui-tabs ui-widget ui-widget-content ui-corner-all" id="tabs">
                    <ul class="ui-tabs-nav ui-helper-reset ui-helper-clearfix ui-widget-header ui-corner-all">
                        @if($business->about || $business->product_services || $business->description || $business->branches || 
                            $business->image_gallery || $business->history || $business->mission || $business->vission || $business->purpose
                            || $business->core_values || $business->goals)
                            <li id="li-tab-company-details" class="ui-state-default ui-corner-top" >
                                <a class="ui-tabs-anchor" href="#company-details" id="ui-id-2" >Company Details</a>
                            </li>
                        @endif
                        @if(!$jobs->isEmpty())
                            <li  id="li-tab-job-info" class="ui-state-default ui-corner-top">
                            <a class="ui-tabs-anchor" href="#job-info" id="ui-id-3" >Jobs</a>
                            </li>
                        @endif
                    </ul>
                    
                    <div class="ui-tabs-panel ui-widget-content ui-corner-bottom" id="company-details">
                        <div id="post-2281" class="no-title no-share post-2281 post  format-standard has-post-thumbnail  category-lifestyle ">
                            <div class="section section-post-header">
                                <div class="section_wrapper clearfix">
                                    <!-- Posts Navigation -->
                                    <!-- One full width row-->
                                    <div class="column one post-nav">
                                    </div>
                                    <!-- Post Header-->
                                    <!-- Post Featured Element (image / video / gallery)-->
                                    <!-- One full width row-->
                                    <blockquote>
                                        @if($business->about)
                                            <h3>About</h3>
                                            <p class="big">
                                                {!!$business->about!!}
                                            </p>
                                        @endif
                                        @if($business->product_services)
                                            <h3>Product and Services</h3>
                                            <p>{!!$business->product_services!!}</p>
                                            <hr class="no_line" style="margin: 0 auto 30px;" />
                                        @endif
                                        @if($business->branches)
                                            <h3>Branches</h3>
                                            <p>{!!$business->branches!!}</p>
                                            <hr class="no_line" style="margin: 0 auto 30px;" />
                                        @endif
                                    </blockquote>
                                    
                                    <div class="column one single-photo-wrapper image">
                                        @if($business->image_gallery)
                                            @foreach($business->image_gallery as $picture)
                                                <div  class="column one-fourth">
                                                    <div class="image_frame scale-with-grid ">
                                                        <div class="image_wrapper">
                                                            <a href="{{asset('uploads/'.$picture)}}" class="zoom" rel="prettyphoto">
                                                                <div class="mask"></div>
                                                                <img style="padding: 5%; min-height: 150px;" id="274" width="100%" height="100%"  src="{{asset('uploads/'.$picture)}}" class="scale-with-grid wp-post-image" alt="home_blogger2_lifestyle3" itemprop="image" />
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <!-- Post Content-->
                            <div class="post-wrapper-content">
                                <div class="section the_content has_content">
                                    <div class="section_wrapper">
                                        <div class="the_content_wrapper">
                                            @if($business->description)
                                                <h3>Description</h3>
                                                <p>{!!$business->description!!}</p>
                                                <hr class="no_line" style="margin: 0 auto 30px;" />
                                            @endif
                                            @if($business->history)
                                                <h3>History</h3>
                                                <p class="big">
                                                    {!!$business->history!!}
                                                </p>
                                            @endif
                                            @if($business->mission && $business->vission)
                                            <div class="column one">
                                                <!-- <h3 style="text-align: center;">Mission and Vision</h3> -->
                                                <div class="column one-second">
                                                    <div class="blockquote">
                                                        <h4>Mission</h4>
                                                        <blockquote>
                                                            {!!$business->mission!!}
                                                        </blockquote>
                                                    </div>
                                                </div>
                                                <div class="column one-second">
                                                    <div class="blockquote">
                                                        <h4>Vission</h4>
                                                        <blockquote>
                                                            {!!$business->vission!!}
                                                        </blockquote>
                                                    </div>
                                                </div>
                                            </div>
                                            @endif
                                            @if($business->purpose)
                                                <h3>Purpose</h3>
                                                <p class="big">
                                                    {!!$business->purpose!!}
                                                </p>
                                            @endif
                                            @if($business->core_values)
                                                <h3>Core Values</h3>
                                                <p class="big">
                                                    {!!$business->core_values!!}
                                                </p>
                                            @endif
                                            @if($business->goals)
                                                <h3>Company Goal</h3>
                                                <p class="big">
                                                    {!!$business->goals!!}
                                                </p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @if(!$jobs->isEmpty())
                        <div class="ui-tabs-panel ui-widget-content ui-corner-bottom" id="job-info">
                            @foreach($jobs as $job)
                                <!-- Post Content-->
                                <div class="post-wrapper-content">
                                    <div class="section the_content has_content">
                                        <div class="section_wrapper">
                                            <div class="the_content_wrapper" style="text-align: center;">
                                                <img src="{{ asset('images/now_hiring.png') }}"  alt="" itemprop="image" />
                                                <hr class="no_line" style="margin: 0 auto 30px;" />
                                                <h1 style="text-align: center;">{{$job->position}}</h1>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="post-wrapper-content">
                                    <div class="section the_content has_content">
                                        <div class="section_wrapper">
                                            <div class="the_content_wrapper">
                                                @if($job->description)
                                                    <h3>Job Description</h3>
                                                    <p>{!!$job->description!!}</p>
                                                    <hr class="no_line" style="margin: 0 auto 30px;" />
                                                @endif
                                                @if($job->description)
                                                    <h3>Requirements</h3>
                                                    <p>{!!$job->requirement!!}</p>
                                                    <hr class="no_line" style="margin: 0 auto 30px;" />
                                                @endif
                                                @if($job->qualification)
                                                    <h3>Qualifications</h3>
                                                    <p>{!!$job->qualification!!}</p>
                                                    <hr class="no_line" style="margin: 0 auto 30px;" />
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                    
                        <!-- Related posts area-->
                        @if($related_businesses)
                            <div class="section section-post-related">
                                <div class="section_wrapper clearfix">
                                    <div class="section-related-adjustment">
                                        <h4>Related Businesses</h4>
                                        <div class="section-related-ul col-3">
                                            @foreach($related_businesses as $related_business)
                                                @if($related_business)
                                                    <div class="column post-related post-2277 post  format-standard has-post-thumbnail  category-lifestyle tag-video ">
                                                        <div class="image_frame scale-with-grid">
                                                            <div class="image_wrapper">
                                                                <a href="{{ asset(''.$selected_category->slug.'/'.$related_business->slug) }}">
                                                                    <div class="mask"></div>
                                                                    @if($related_business->logo ?? '')
                                                                        <img style="min-height: 250px;" width="960" height="750" src="{{asset($related_business->logo)}}" class="scale-with-grid wp-post-image" alt="" itemprop="image" />
                                                                    @else
                                                                        <img style="min-height: 250px;" width="960" height="750" src="{{asset('images/default_image.png')}}" class="scale-with-grid wp-post-image" alt="" itemprop="image" />
                                                                    @endif
                                                            </a>
                                                                <div class="image_links double">
                                                                    @if($related_business->logo ?? '')
                                                                        <a href="{{asset($related_business->logo)}}" class="zoom" rel="prettyphoto">
                                                                            <i class="icon-search"></i>
                                                                        </a>
                                                                    @else
                                                                        <a href="{{asset('images/default_image.png')}}" class="zoom" rel="prettyphoto">
                                                                            <i class="icon-search"></i>
                                                                        </a>
                                                                    @endif
                                                                    <a href="{{ asset(''.$selected_category->slug.'/'.$related_business->slug) }}" class="link">
                                                                        <i class="icon-link"></i>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="date_label">
                                                            @if($related_business->dti)
                                                                <img width="25" height="25" src="{{ asset('images/DTI_LOGO.png') }}" class="scale-with-grid" alt="" itemprop="image" />
                                                            @endif
                                                        </div>
                                                        <div class="desc">
                                                            <h5><a href="{{ asset(''.$selected_category->slug.'/'.$related_business->slug) }}">{!!$related_business->name!!}</a></h5>
                                                            <hr class="hr_color" />
                                                            <a href="{{ asset(''.$selected_category->slug.'/'.$related_business->slug) }}" class="button button_left button_js"><span class="button_icon"><i class="icon-layout"></i></span><span class="button_label">Read more</span></a>
                                                        </div>
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                </div>
            </div>
            <!-- Sidebar area-->
            <div class="sidebar sidebar-1 four columns">
                <div class="widget-area clearfix " style="margin-top:0px;">
                    <aside id="categories-2" class="widget widget_categories">
                        <h3>Related Categories</h3>
                        <ul>
                            @if(count($related_categories)>0)
                                <li class="cat-item cat-item-4">
                                    <a href="{{ asset('categories#'.$business->category_slug)}}">All Related Categories</a>
                                </li>
                                @foreach($related_categories as $related_category)
                                    <li class="cat-item cat-item-4">
                                        <a href="{{ asset('businesses/'.$related_category->slug)}}">{{$related_category->name}}</a>
                                    </li>
                                @endforeach
                            @endif
                        </ul>
                    </aside>
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
        $('li[id=categories_menu]').addClass("current-menu-item");
        
    });
    
</script>
@endsection

@section('after_scripts')
    <script>
        function google_maps_5520585af0ed4() {
           
            if("{{$business->latitude}}" != '' && "{{$business->longitude}}" != ''){
                var latlng = new google.maps.LatLng("{{$business->latitude}}", "{{$business->longitude}}");
            }
            else{
                var latlng = new google.maps.LatLng(-33.8710, 151.2039);
            }
            var myOptions = {
                zoom: 13,
                center: latlng,
                mapTypeId: google.maps.MapTypeId.ROADMAP,
                styles: [{
                    "featureType": "landscape",
                    "stylers": [{
                        "saturation": -100
                    }, {
                        "lightness": 60
                    }]
                }, {
                    "featureType": "road.local",
                    "stylers": [{
                        "saturation": -100
                    }, {
                        "lightness": 40
                    }, {
                        "visibility": "on"
                    }]
                }, {
                    "featureType": "transit",
                    "stylers": [{
                        "saturation": -100
                    }, {
                        "visibility": "simplified"
                    }]
                }, {
                    "featureType": "administrative.province",
                    "stylers": [{
                        "visibility": "off"
                    }]
                }, {
                    "featureType": "water",
                    "stylers": [{
                        "visibility": "on"
                    }, {
                        "lightness": 30
                    }]
                }, {
                    "featureType": "road.highway",
                    "elementType": "geometry.fill",
                    "stylers": [{
                        "color": "#ef8c25"
                    }, {
                        "lightness": 40
                    }]
                }, {
                    "featureType": "road.highway",
                    "elementType": "geometry.stroke",
                    "stylers": [{
                        "visibility": "off"
                    }]
                }, {
                    "featureType": "poi.park",
                    "elementType": "geometry.fill",
                    "stylers": [{
                        "color": "#b6c54c"
                    }, {
                        "lightness": 40
                    }, {
                        "saturation": -40
                    }]
                }, {}],
                zoomControl: true,
                mapTypeControl: false,
                streetViewControl: false,
                scrollwheel: false
            };
            var map = new google.maps.Map(document.getElementById("google-map-area-5520585af0ed4"), myOptions);
            var marker = new google.maps.Marker({
                position: latlng,
                icon: "{{ asset('../content/seo3/images/travel_pin.png') }}",
                map: map
            });
        }


        jQuery(document).ready(function($) {
            google_maps_5520585af0ed4();
        });
    </script>
@endsection