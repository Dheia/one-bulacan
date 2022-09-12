@extends('layouts.businesses_layout')

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
                                <li class="label">
                                    Filter by
                                </li>
                                <li class="categories">
                                    <a class="open" href="#"><i class="icon-tag"></i>@if($selected_category){{$selected_category->slug}}@else All Categories @endif<i class="icon-down-dir"></i></a>
                                </li>
                                <li class="tags">
                                    <a class="open" href="#"><i class="icon-location"></i>@if($selected_municipality){{$selected_municipality->name}}@else Municipality/City @endif<i class="icon-down-dir"></i></a>
                                </li>
                                <li class="authors">
                                    <a class="open" href="#"><i class="icon-location"></i>@if($selected_baranggay){{$selected_baranggay->name}}@else Baranggay @endif<i class="icon-down-dir"></i></a>
                                </li>
                                <li class="reset">
                                    <a class="close" data-rel="*" href="{{url()->current()}}"><i class="icon-cancel"></i>Show all</a>
                                </li>
                            </ul>
                            <div class="filters_wrapper">
                                @if(count($related_categories)>0)
                                    <ul class="categories">
                                        @if($selected_category)
                                            <li class="reset-inner">
                                                <a data-rel="*" class="active" href="{{ asset('businesses/'.$selected_category->slug) }}">{{$selected_category->name}}</a>
                                            </li>
                                        @endif
                                        @foreach($related_categories as $related_category)
                                            <li>
                                                <a data-rel=".category-hot-news" href="{{ asset('businesses/'.$related_category->slug) }}">{{ Str::limit($related_category->name, 17) }}</a>
                                            </li>
                                        @endforeach
                                        <li class="close">
                                            <a href="#"><i class="icon-cancel"></i></a>
                                        </li>
                                    </ul>
                                @endif
                                @if(count($municipalities)>0)
                                    <ul class="tags">
                                        <li class="reset-inner">
                                            <a @if(!(Request::get('municipality_id'))) class="active" @endif data-rel="*" href="{{ asset('businesses/'.$selected_category->slug) }}">All</a>
                                        </li>
                                        @foreach($municipalities as $municipality)
                                            @if($selected_category)
                                                <li>
                                                    <a @if(Request::get('municipality_id') == $municipality->id) class="active" @endif data-rel=".tag-design" href="{{ asset('businesses/'.$selected_category->slug.'?municipality_id='.$municipality->id) }}">{{$municipality->name}}</a>
                                                </li>
                                            @else
                                                <li>
                                                    <a @if(Request::get('municipality_id') == $municipality->id) class="active" @endif data-rel=".tag-design" href="{{ asset('businesses?municipality_id='.$municipality->id) }}">{{$municipality->name}}</a>
                                                </li>
                                            @endif
                                        @endforeach
                                        <li class="close">
                                            <a href="#"><i class="icon-cancel"></i></a>
                                        </li>
                                    </ul>
                                @endif
                                <ul class="authors">
                                    <li class="reset-inner">
                                        <a @if(!(Request::get('baranggay_id'))) class="active" @endif data-rel="*" href="{{ asset('businesses/'.$selected_category->slug.'?municipality_id='.Request::get('municipality_id')) }}">All</a>
                                    </li>
                                    @if($baranggays)
                                        @foreach($baranggays as $baranggay)
                                            @if($selected_category)
                                                <li>
                                                    <a @if(Request::get('baranggay_id') == $baranggay->id) class="active"@endif data-rel=".author-admin" href="{{ asset('businesses/'.$selected_category->slug.'?municipality_id='.Request::get('municipality_id').'&baranggay_id='.$baranggay->id) }}">{{$baranggay->name}}</a>
                                                </li>
                                            @else
                                                <li>
                                                    <a @if(Request::get('baranggay_id') == $baranggay->id) class="active"@endif data-rel=".author-admin" href="{{ asset('businesses?municipality_id='.Request::get('municipality_id').'&baranggay_id='.$baranggay->id) }}">{{$baranggay->name}}</a>
                                                </li>
                                            @endif
                                        @endforeach
                                    @endif
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
                                <div class="posts_group lm_wrapper classic col-3">
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
                                                                @if($selected_category)
                                                                    <a href="{{ asset(''.$selected_category->slug.'/'.$business->slug)}}">
                                                                        <div class="mask"></div>
                                                                        @if ($business->logo)
                                                                            <img style="min-height: 120px;" width="960" height="750" src="{{asset($business->logo)}}" class="scale-with-grid wp-post-image" alt="" itemprop="image" />
                                                                        @else
                                                                            <img style="min-height: 120px;" width="960" height="750" src="{{ asset('images/default_image.png') }}" class="scale-with-grid wp-post-image" alt="" itemprop="image" />
                                                                        @endif
                                                                    </a>
                                                                @else
                                                                    <a href="{{ asset(''.$business->slug.'?category_id='.$business->category_id)}}">
                                                                        <div class="mask"></div>
                                                                        @if ($business->logo)
                                                                            <img style="min-height: 120px;" width="960" height="750" src="{{asset($business->logo)}}" class="scale-with-grid wp-post-image" alt="home_blogger2_lifestyle1" itemprop="image" />
                                                                        @else
                                                                            <img style="min-height: 120px;" width="960" height="750" src="{{ asset('images/default_image.png') }}" class="scale-with-grid wp-post-image" alt="home_blogger2_lifestyle1" itemprop="image" />
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
                                                                        @if($selected_category)
                                                                            <a href="{{asset(''.$selected_category->slug.'/'.$business->slug)}}">
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
                                                                        <i class="icon-location"></i>{{$business->address1}}, {{$business->baranggay_name}}, {{$business->location_name}}<br>
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
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Sidebar area-->
            <div class="sidebar sidebar-2 four columns">
                <div class="widget-area clearfix " style="margin-top:0px; margin-right:0px;">
                    <!-- Categories Area -->
                    <aside id="categories-2" class="widget widget_categories">
                        <h3>Related Categories</h3>
                        <ul>
                            @if(count($related_categories)>0)
                                @if($selected_category)
                                    <li class="cat-item cat-item-4">
                                        <a href="{{ asset('categories#'.$selected_category->parent_slug) }}">All Related Categories</a>
                                    </li>
                                @else
                                    <li class="cat-item cat-item-4">
                                        <a href="{{ asset('categories') }}">All Categories</a>
                                    </li>
                                @endif
                                @foreach($related_categories as $related_category)
                                    <li class="cat-item cat-item-4">
                                        <a href="{{ asset('businesses/'.$related_category->slug) }}">{{$related_category->name}}</a>
                                    </li>
                                @endforeach
                            @endif
                        </ul>
                    </aside>
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
                                                        @if($selected_category)
                                                            <a href="{{ asset(''.$selected_category->slug.'/'.$featured_business->slug) }}">
                                                                <img style="min-height: 120px;" width="250" height="180" src="{{asset($featured_business->logo)}}" class="scale-with-grid wp-post-image" alt="" />
                                                            </a>
                                                        @else
                                                            <a href="{{ asset(''.$featured_business->slug) }}">
                                                                <img style="min-height: 120px;" width="250" height="180" src="{{asset($featured_business->logo)}}" class="scale-with-grid wp-post-image" alt="" />
                                                            </a>
                                                        @endif
                                                    @else
                                                        @if($selected_category)
                                                            <a href="{{ asset(''.$selected_category->slug.'/'.$featured_business->slug) }}">
                                                                <img width="250" height="180" src="{{ asset('images/default_image.png') }}" class="scale-with-grid wp-post-image" alt="home_blogger2_lifestyle1" />
                                                            </a>
                                                        @else
                                                            <a href="{{ asset(''.$business->slug) }}">
                                                                <img width="250" height="180" src="{{ asset('images/default_image.png') }}" class="scale-with-grid wp-post-image" alt="home_blogger2_lifestyle1" />
                                                            </a>
                                                        @endif
                                                    @endif
                                                </div>
                                                <li class="post " style="margin-right=0;">
                                                    @if($selected_category)
                                                        <a href="{{ asset(''.$selected_category->slug.'/'.$featured_business->slug) }}" style="margin-right=0;">
                                                            <div class="desc" style="margin-right=0;">
                                                                <h6>{{$featured_business->name}}</h6>
                                                                <span class="date"><i class="icon-location"></i>{{$featured_business->address1}}, {{$featured_business->baranggay_name}}, {{$featured_business->location_name}}</span><br>
                                                                <span class="date"><i class="icon-mobile"></i>{{$featured_business->mobile}}</span>
                                                            </div>
                                                        </a>
                                                    @else
                                                        <a href="{{ asset(''.$featured_business->slug) }}" style="margin-right=0;">
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
    $(document).ready(function () {
        $('li[id=categories_menu]').addClass("current-menu-item")
    });
    
</script>
@endsection
