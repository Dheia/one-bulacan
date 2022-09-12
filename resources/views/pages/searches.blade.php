@extends('layouts.app2')

@section('after_styles')
    <style>
        a.action_button {
            top: 40px;
            border-radius: 20px;
            padding: 11px 25px;
        }
    </style>
@endsection

@section('body_class', "blog layout-full-width button-round with_aside aside_right subheader-both-left menu-line-below-80-1 menuo-right menuo-no-borders mobile-tb-center mobile-side-slide mobile-mini-mr-ll tablet-sticky mobile-header-mini mobile-sticky header-classic minimalist-header-no header-fw sticky-header")

@section('content')
<div id="Wrapper" style="background-image: url({{ asset('content/seo3/images/seo3-slider-bg.png') }});">
    <div id="Header_wrapper" style="background-image:url({{ asset('../content/seo3/images/seo3-about-pic1.png') }});">
        @include('partials.header')
    </div>
    <div id="Content">
        <div class="content_wrapper clearfix">
            <div class="sections_group">
                <div class="extra_content">
                    <div class="section the_content no_content">
                        <div class="section_wrapper">
                            <div class="the_content_wrapper"></div>
                        </div>
                    </div>
                </div>
                <!-- Portfolio filters -->
                <div class="section section-filters">
                    <div class="section_wrapper clearfix">
                        <!--  Filter Area -->
                        <div id="Filters" class="column one ">
                            <ul class="filters_buttons">
                                @if(count($businesses)>0)
                                    Search results for "{{$keyword}}"
                                @else
                                    No matching records found for "{{$keyword}}"
                                @endif
                            </ul>
                            <div class="filters_wrapper">
                                <ul class="categories">
                                        <li class="reset-inner">
                                            <a data-rel="*" class="active" href="">Categpry Name</a>
                                        </li>
                            
                                        <li>
                                            <a data-rel=".category-hot-news" href="">News</a>
                                        </li>
                                    
                                    <li class="close">
                                        <a href="#"><i class="icon-cancel"></i></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="section">
                    <div class="section_wrapper clearfix">
                        <!-- One full width row-->
                        <div class="column one column_blog">
                            <div class="blog_wrapper isotope_wrapper">
                                <div class="posts_group lm_wrapper classic col-3" id="business_table">
                                    @if($businesses)
                                        @if(count($businesses)>0)
                                            @foreach($businesses as $business)
                                                @if($business)
                                                    <div class="post-item isotope-item clearfix post-2277 post  format-standard has-post-thumbnail  category-lifestyle  tag-video">
                                                        <div class="date_label">
                                                            May 8, 2014
                                                        </div>
                                                        <div class="image_frame post-photo-wrapper scale-with-grid">
                                                            <div class="photo">
                                                                @if($selected_category ?? '')
                                                                    <a href="{{ asset(''.$selected_category ?? ''->slug.'/'.$business->name)}}">
                                                                        {{-- <div class="mask"></div> --}}
                                                                        @if ($business->logo)
                                                                            <img style="padding:3px;"  width="960" height="750" src="{{asset($business->logo)}}" class="scale-with-grid wp-post-image" alt="home_blogger2_lifestyle1" itemprop="image" />
                                                                        @else
                                                                            <img width="960" height="750" src="{{ asset('images/home_blogger2_lifestyle1-960x750.jpg') }}" class="scale-with-grid wp-post-image" alt="home_blogger2_lifestyle1" itemprop="image" />
                                                                        @endif
                                                                    </a>
                                                                @else
                                                                    <a href="{{ asset(''.$business->category_slug.'/'.$business->slug)}}">
                                                                        <div class="mask"></div>
                                                                        @if ($business->logo)
                                                                            <img style="padding:3px;" width="960" height="750" src="{{asset($business->logo)}}" class="scale-with-grid wp-post-image" alt="home_blogger2_lifestyle1" itemprop="image" />
                                                                        @else
                                                                            <img width="960" height="750" src="{{ asset('images/default_image.png') }}" class="scale-with-grid wp-post-image" alt="home_blogger2_lifestyle1" itemprop="image" />
                                                                        @endif
                                                                    </a>
                                                                @endif
                                                                <!-- <div class="image_links">
                                                                    <a href="{{$business->logo}}" class="zoom" rel="prettyphoto">
                                                                        <i class="icon-search"></i>
                                                                    </a>
                                                                </div> -->
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="post-desc-wrapper">
                                                            <div class="post-desc">
                                                                <div class="post-title">
                                                                    <h4 class="entry-title" itemprop="headline">
                                                                        @if($selected_category ?? '')
                                                                            <a href="/single-business?category_id={{Request::get('category_id')}}&business_id={{$business->id}}">
                                                                                {{$business->name}}
                                                                            </a>
                                                                        @else
                                                                            <a href="{{ asset(''.$business->category_slug.'/'.$business->slug)}}">
                                                                                {{$business->name}}
                                                                            </a>
                                                                        @endif
                                                                        <br>
                                                                        @if($business->dti)
                                                                            <img width="40" height="40" src="{{ asset('images/DTI_LOGO.png') }}" class="scale-with-grid" alt="" itemprop="image" />
                                                                        @endif
                                                                    </h4>
                                                                </div>
                                                                <div class="post-excerpt">
                                                                    <p class="big">
                                                                        <i class="icon-location"></i>{{$business->address1 . " " . $business->address2 ?? $business->address2}}, {{$business->baranggay_name}}, {{$business->location_name}}<br>
                                                                        <i class="icon-mobile"></i><a href="tel:{{$business->mobile}}"> {{$business->mobile}}</a>  
                                                                        @if($business->telephone) <br> <i class="icon-phone"></i><a href="tel:{{$business->telephone}}"> {{$business->telephone}}</a> @endif<br>
                                                                        <i class="icon-mail"></i><a href="mailto:{{$business->email}}?Subject=Inquiry from One Pampanga" target="_top"> {{$business->email}}</a><br>
                                                                        @if($business->website)
                                                                            <!-- <a href="{{$business->website}}"><i style="font-size: 20px;" class="icon-globe"></i></a> -->
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
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                            @endforeach
                                        @endif
                                    @endif
                                </div>
                                @if($load_more == 1)
                                    <form method="POST" id="form">
                                        @csrf
                                         <button style="width: 100%" type="button" id="load_more">
                                                Load More
                                        </button>
                                    </form>
                                @else
                                    <form method="POST" id="form">
                                        @csrf
                                         <button style="width: 100%; color: gray;" type="button" id="load_more">
                                                No More Data
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Sidebar area-->
            <div class="sidebar sidebar-2 four columns">
                <div class="widget-area clearfix " style="margin-top:0px; margin-right:0px;">
                    <!-- Categories Area -->
                    {{-- <aside id="categories-2" class="widget widget_categories">
                        <h3>Related Categories</h3>
                        <ul>
                            @if(count($related_categories)>0)
                                @foreach($related_categories as $related_category)
                                    <li class="cat-item cat-item-4">
                                        <a href="{{ asset('businesses/'.$related_category->name) }}">{{$related_category->name}}</a>
                                    </li>
                                @endforeach
                            @endif
                        </ul>
                    </aside> --}}
                    <!-- Featured Businesses  -->
                    <aside class="widget widget_mfn_recent_posts">
                        <h3>Featured Businesses</h3>
                        <div class="Recent_posts">
                            <ul>
                                @if($featured_businesses)
                                    @if(count($featured_businesses)>0)
                                        @foreach($featured_businesses as $featured_business)
                                            @if($featured_business)
                                                <div class="photo">
                                                    @if($featured_business->logo)
                                                        @if($selected_category ?? '')
                                                            <a href="{{ asset('single-business?category_id='.$selected_category ?? ''->id.'&business_id='.$featured_business->id) }}">
                                                                <img width="250" height="180" src="{{asset($featured_business->logo)}}" class="scale-with-grid wp-post-image" alt="" />
                                                            </a>
                                                        @else
                                                            <a href="{{ asset(''.$featured_business->category_slug.'/'.$featured_business->slug)}}">
                                                                <img width="250" height="180" src="{{asset($featured_business->logo)}}" class="scale-with-grid wp-post-image" alt="" />
                                                            </a>
                                                        @endif
                                                    @else
                                                        @if($selected_category ?? '')
                                                            <a href="{{ asset('single-business?category_id='.$selected_category ?? ''->id.'&business_id='.$featured_business->id) }}">
                                                                <img width="250" height="180" src="{{ asset('images/default_image.png') }}" class="scale-with-grid wp-post-image" alt="home_blogger2_lifestyle1" />
                                                            </a>
                                                        @else
                                                            <a href="{{ asset(''.$featured_business->category_slug.'/'.$featured_business->slug)}}">
                                                                <img width="250" height="180" src="{{ asset('images/default_image.png') }}" class="scale-with-grid wp-post-image" alt="home_blogger2_lifestyle1" />
                                                            </a>
                                                        @endif
                                                    @endif
                                                </div>
                                                <li class="post " style="margin-right=0;">
                                                    @if($selected_category ?? '')
                                                        <a href="{{ asset('single-business?category_id='.$selected_category ?? ''->parent_slug.'&business_id='.$featured_business->id) }}" style="margin-right=0;">
                                                            <div class="desc" style="margin-right=0;">
                                                                <h6>{{$featured_business->name}}</h6>
                                                                <span class="date"><i class="icon-location"></i>{{$featured_business->address1}}, {{$featured_business->baranggay_name}}, {{$featured_business->location_name}}</span><br>
                                                                <span class="date"><i class="icon-mobile"></i>{{$featured_business->mobile}}</span>
                                                            </div>
                                                        </a>
                                                    @else
                                                        <a href="{{ asset(''.$featured_business->category_slug.'/'.$featured_business->slug)}}" style="margin-right=0;">
                                                            <div class="desc" style="margin-right=0;">
                                                                <h6>{{$featured_business->name}}</h6>
                                                                <span class="date"><i class="icon-location"></i>{{$featured_business->address1}}, {{$featured_business->baranggay_name}}, {{$featured_business->location_name}}</span><br>
                                                                <span class="date"><i class="icon-mobile"></i>{{$featured_business->mobile}}</span>
                                                            </div>
                                                        </a>
                                                    @endif
                                                </li>
                                            @endif
                                        @endforeach
                                    @endif
                                @endif
                            </ul>
                        </div>
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
        var pageNumber = 1;
        console.log(pageNumber);
        $(document).ready(function () {
            $('li[id=categories_menu]').addClass("current-menu-item");
        });
        
    </script>
@endsection

@section('after_scripts')
    <script type="text/javascript">
        
         $("#load_more").click(function(e) {
            e.preventDefault();
            pageNumber +=1;
            console.log('load more');
            $.ajax({
                type : 'POST',
                data : {
                        page: pageNumber,
                        _token:"{{csrf_token()}}"
                    },
                url: 'search/fetch_data',
                success : function(data){
                        $("#form").remove();
                        if(data.length == 0){
                            console.log("data length 0");
                        }else{
                            console.log("data length not 0");
                            $('#business_table').append(data.html);
                        }
                },error: function(data){
                     console.log("The request failed");
                },
            })
        });

        function load(){
            pageNumber +=1;
            console.log('load more function');
            $.ajax({
                type : 'POST',
                data : {
                        page: pageNumber,
                        _token:"{{csrf_token()}}"
                    },
                url: 'search/fetch_data',
                success : function(data){
                        $("#form").remove();
                        if(data.length == 0){
                            console.log("data length 0");
                        }else{
                            console.log("data length not 0");
                            $('#business_table').append(data.html);
                        }
                },error: function(data){
                     console.log("The request failed");
                },
            })
        }
    </script>

@endsection
