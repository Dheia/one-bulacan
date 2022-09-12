@extends('layouts.app2')

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
                            {{-- <a href="{{ asset($job->category_slug.'/'.$job->slug)}}"> --}}
                            @if($job->logo)
                                <img style="min-height: 190px;"  width="100%" height="100%" src="{{asset($job->logo)}}" class="scale-with-grid wp-post-image" alt="" itemprop="image" />
                            @else
                                <img width="100%" height="100%" src="{{ asset('images/default_image.png') }}" class="scale-with-grid wp-post-image" alt="" itemprop="image" />
                            @endif
                            {{-- </a> --}}
                        </div>
                        @if($job->website)
                                <a href="{{$job->website}}" target="_blank" class="icon_bar icon_bar_globe icon_bar_small">
                                    <span class="t"><i class="icon-globe"></i></span>
                                    <span class="b"><i class="icon-globe"></i></span>
                                </a>
                            @endif
                            @if($job->facebook)
                                <a href="{{$job->facebook}}" target="_blank" class="icon_bar icon_bar_facebook icon_bar_small">
                                    <span class="t"><i class="icon-facebook"></i></span>
                                    <span class="b"><i class="icon-facebook"></i></span>
                                </a>
                            @endif
                            @if($job->twitter)
                                <a href="http://twitter.com/{{$job->twitter}}" target="_blank" class="icon_bar icon_bar_twitter icon_bar_small">
                                    <span class="t"><i class="icon-twitter"></i></span>
                                    <span class="b"><i class="icon-twitter"></i></span>
                                </a>
                            @endif
                            @if($job->instagram)
                                <a href="http://instagram.com/{{$job->instagram}}" target="_blank" class="icon_bar icon_bar_instagram icon_bar_small">
                                    <span class="t"><i class="icon-instagram"></i></span>
                                    <span class="b"><i class="icon-instagram"></i></span>
                                </a>
                            @endif
                    </div>
                    <div class="column two-third" >
                        <h2 class="title">
                            <strong>{{$job->name}}</strong>
                        </h2>
                        <p class="big" style="font-size: 14px;">
                            <i style="font-size: 20px;" class="icon-location"></i>{{$job->address1}}, {{$job->baranggay_name}}, {{$job->location_name}}<br>
                            <i style="font-size: 20px;" class="icon-mobile"></i><a href="tel:{{$job->mobile}}"> {{$job->mobile}}</a> <br>
                            @if($job->telephone) <i class="icon-phone" style="font-size: 20px;"></i><a href="tel:{{$job->telephone}}"> {{$job->telephone}}</a> <br> @endif
                            <i class="icon-mail" style="font-size: 20px;"></i><a href="mailto:{{$job->email}}?Subject=Inquiry from One Pampanga" target="_top"> {{$job->email}}</a><br>
                            <a style="font-size: 14px;" href="{{ asset($job->category_slug.'/'.$job->slug)}}" class="button button_left button_js kill_the_icon">
                                <span class="button_icon"><i class="icon-layout"></i></span>
                                <span class="button_label">View Company Info</span>
                            </a>
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
                                @if($job->about)
                                    <h3>About</h3>
                                    <p class="big">
                                        {!!$job->about!!}
                                    </p>
                                @endif
                            </blockquote>
                        </div>
                    </div>
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

                    <!-- RELATED JOBS area-->
                    @if($related_jobs)
                        <div class="section section-post-related">
                            <div class="section_wrapper clearfix">
                                <div class="section-related-adjustment">
                                    <h4>Related Jobs</h4>
                                    <div class="section-related-ul col-3">
                                        @foreach($related_jobs as $related_job)
                                            @if($related_job)
                                                <div class="column post-related post-2277 post  format-standard has-post-thumbnail  category-lifestyle tag-video ">
                                                    <div class="image_frame scale-with-grid">
                                                        <div class="image_wrapper">
                                                            <a href="{{ asset($related_job->slug.'/'.$related_job->id.'/hiring') }}">
                                                                <div class="mask"></div>
                                                                @if($related_job->logo ?? '')
                                                                    <img style="min-height: 200px;" width="960" height="750" src="{{asset($related_job->logo)}}" class="scale-with-grid wp-post-image" alt="" itemprop="image" />
                                                                @else
                                                                <img style="min-height: 200px;" width="960" height="750" src="{{asset('images/default_image.png')}}" class="scale-with-grid wp-post-image" alt="" itemprop="image" />
                                                                @endif
                                                            </a>
                                                            <div class="image_links double">
                                                                @if($related_job->logo ?? '')
                                                                    <a href="{{asset($related_job->logo)}}" class="zoom" rel="prettyphoto">
                                                                        <i class="icon-search"></i>
                                                                    </a>
                                                                @else
                                                                    <a href="{{asset('images/default_image.png')}}" class="zoom" rel="prettyphoto">
                                                                        <i class="icon-search"></i>
                                                                    </a>
                                                                @endif
                                                                <a href="{{ asset($related_job->slug.'/'.$related_job->id.'/hiring') }}" class="link">
                                                                    <i class="icon-link"></i>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="date_label">
                                                        @if($job->verified)
                                                            <img width="25" height="25" src="{{ asset('images/DTI_LOGO.png') }}" class="scale-with-grid" alt="" itemprop="image" />
                                                        @endif
                                                    </div>
                                                    <div class="desc">
                                                        <h4><a href="{{ asset($related_job->slug.'/'.$related_job->id.'/hiring') }}">{!!$related_job->position!!}</a></h4>
                                                        <p>{!!$related_job->name!!}</p>
                                                        <hr class="hr_color" />
                                                        <a href="{{ asset($related_job->slug.'/'.$related_job->id.'/hiring') }}" class="button button_left button_js"><span class="button_icon"><i class="icon-layout"></i></span><span class="button_label">Read more</span></a>
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
                        <h3>Job Categories</h3>
                        <ul>
                            @if(count($job_categories)>0)
                                <li class="cat-item cat-item-4">
                                    <a href="{{ asset('jobs')}}">All Job Categories</a>
                                </li>
                                @foreach($job_categories as $job_category)
                                    <li class="cat-item cat-item-4">
                                        <a href="{{ asset('jobs/'.$job_category->id)}}">{{$job_category->name}}</a>
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
        // $('#' + indexValue).addClass("selectedQuestion");
        $('li[id=jobs]').addClass("current-menu-item")
    });
    
</script>
@endsection

@section('after_scripts')
    <script>
        function google_maps_5520585af0ed4() {
           
            if("{{$job->latitude}}" != '' && "{{$job->longitude}}" != ''){
                var latlng = new google.maps.LatLng("{{$job->latitude}}", "{{$job->longitude}}");
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