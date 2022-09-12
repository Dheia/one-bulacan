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
                            {{-- <div class="the_content_wrapper"> 
                                <div class="section section-filters">
                                    <div class="section_wrapper clearfix">
                                        List of Jobs
                                    </div>
                                </div>
                            </div> --}}
                        </div>
                    </div>
                </div>
                <!-- Portfolio filters -->
                <div class="section section-filters">
                    <div class="section_wrapper clearfix">
                        
                        <!--  Filter Area -->
                        <div id="Filters" class="column one">
                            <ul class="filters_buttons">
                                <li class="label">
                                    Filter by
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
                                @if(count($municipalities)>0)
                                    <ul class="tags">
                                        <li class="reset-inner">
                                            <a @if(!(Request::get('municipality_id'))) class="active" @endif data-rel="*" href="{{ asset('jobs/') }}">All</a>
                                        </li>
                                        @foreach($municipalities as $municipality)
                                            <li>
                                                <a @if(Request::get('municipality_id') == $municipality->id) class="active" @endif data-rel=".tag-design" href="{{ asset(Request::url().'?municipality_id='.$municipality->id) }}">{{$municipality->name}}</a>
                                            </li>
                                        @endforeach
                                        <li class="close">
                                            <a href="#"><i class="icon-cancel"></i></a>
                                        </li>
                                    </ul>
                                @endif
                                <ul class="authors">
                                    <li class="reset-inner">
                                        <a @if(!(Request::get('baranggay_id'))) class="active" @endif data-rel="*" href="{{ asset(Request::url().'?municipality_id='.Request::get('municipality_id')) }}">All</a>
                                    </li>
                                    @if($baranggays)
                                        @foreach($baranggays as $baranggay)
                                                <li>
                                                    <a @if(Request::get('baranggay_id') == $baranggay->id) class="active"@endif data-rel=".author-admin" href="{{ asset(Request::url().'?municipality_id='.Request::get('municipality_id').'&baranggay_id='.$baranggay->id) }}">{{$baranggay->name}}</a>
                                                </li>
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
                                    <h4><a id="create_job" href="{{ asset('create-job') }}" class="" target="_self">Create Job now <i class="icon-right-open"></i></a></h4>
                                    @if($jobs)
                                        @if(count($jobs)>0)
                                            @foreach($jobs as $business)
                                                @if($business->business_id ?? '')
                                                    <div class="post-item isotope-item clearfix post-2277 post  format-standard has-post-thumbnail  category-lifestyle">
                                                        <div class="image_frame post-photo-wrapper scale-with-grid">
                                                            <div class="photo">
                                                                <a href="{{ asset($business->slug.'/'.$business->id.'/hiring') }}">
                                                                    @if ($business->logo)
                                                                        <img id="myBtn" style="min-height: 220px;" width="960" height="750" src="{{asset($business->logo)}}" class="trigger scale-with-grid wp-post-image" alt="home_blogger2_lifestyle1" itemprop="image" />
                                                                    @else
                                                                        <img id="myBtn" style="min-height: 220px;" width="960" height="750" src="{{ asset('images/default_image.png') }}" class="trigger scale-with-grid wp-post-image" alt="home_blogger2_lifestyle1" itemprop="image" />
                                                                    @endif
                                                                </a>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="post-desc-wrapper">
                                                            <div class="post-desc">
                                                                <div class="post-title">
                                                                    <h4 class="entry-title" itemprop="headline">
                                                                        <a href="{{ asset($business->slug.'/'.$business->id.'/hiring') }}">
                                                                            {{$business->position}}
                                                                        </a>
                                                                        <p class="big">
                                                                            {{$business->business_name}}
                                                                        </p>
                                                                    </h4>
                                                                </div>
                                                                <div class="post-excerpt">
                                                                    <p>
                                                                        <strong><i class="icon-location"></i></strong>{{$business->address}}<br>
                                                                        <strong><i class="icon-mobile"></i></strong><a href="tel:{{$business->mobile}}"> {{$business->mobile}}</a> <br>
                                                                        <strong><i class="icon-mail"></i></strong><a href="mailto:{{$business->email}}?Subject=Inquiry from One Pampanga" target="_top"> {{$business->email}}</a><br>
                                                                        <a href="{{ asset($business->slug.'/'.$business->id.'/hiring') }}" class="button button_left button_js kill_the_icon">
                                                                            <span class="button_icon"><i class="icon-layout"></i></span>
                                                                            <span class="button_label">View info</span>
                                                                        </a>
                                                                    </p>
                                                                </div>
                                                                
                                                            </div>
                                                        </div>
                                                    </div>
                                                @else
                                                    <div class="post-item isotope-item clearfix post-2277 post  format-standard has-post-thumbnail  category-lifestyle">
                                                        <div class="image_frame post-photo-wrapper scale-with-grid">
                                                            <div class="photo">
                                                                @if ($business->logo)
                                                                    <img id="myBtn" style="min-height: 220px;" width="960" height="750" src="{{asset($business->logo)}}" class="trigger scale-with-grid wp-post-image" alt="home_blogger2_lifestyle1" itemprop="image" />
                                                                @else
                                                                    <img id="myBtn" style="min-height: 220px;" width="960" height="750" src="{{ asset('images/default_image.png') }}" class="trigger scale-with-grid wp-post-image" alt="home_blogger2_lifestyle1" itemprop="image" />
                                                                @endif
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="post-desc-wrapper">
                                                            <div class="post-desc">
                                                                <div class="post-title">
                                                                    <h4 class="entry-title" itemprop="headline">
                                                                        {{$business->position}}
                                                                        <p class="big">
                                                                            {{$business->business_name}}
                                                                        </p>
                                                                    </h4>
                                                                </div>
                                                                <div class="post-excerpt">
                                                                    <p>
                                                                        @if($business->quantity ?? '')
                                                                        <strong> Quantity: </strong> {{$business->quantity}}<br>
                                                                        @endif
                                                                        <strong><i class="icon-mobile"></i></strong><a href="tel:{{$business->contact_number}}"> {{$business->contact_number}}</a> <br>
                                                                        <strong><i class="icon-user"></i></strong> {{$business->contact_person}}
                                                                        @if($business->local ?? '')
                                                                        @if($business->local == 1)
                                                                            <br><strong> Local/Overseas: </strong>Local
                                                                        @else
                                                                            <br><strong> Local/Overseas: </strong> Overseas
                                                                        @endif
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
                    {{-- CREATE JOB --}}
                    <aside id="categories-2" class="widget widget_categories">
                        <h3> <a id="create_job" href="{{ asset('create-job') }}" class="" target="">Create Job now <i class="icon-right-open"></i></a></h3>
                      
                    </aside>
                    <!-- Categories Area -->
                    <aside id="categories-2" class="widget widget_categories">
                        <h3>Job Categories</h3>
                        <ul>
                            @if(count($job_categories)>0)
                                @foreach($job_categories as $job_category)
                                    <li class="cat-item cat-item-4">
                                        <a href="{{ asset('jobs/'.$job_category->id) }}">{{$job_category->name}}</a>
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
        $('li[id=jobs]').addClass("current-menu-item")
    });
    
</script>
@endsection
