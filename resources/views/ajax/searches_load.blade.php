@if($businesses)
    @if(count($businesses)>0)
        @foreach($businesses as $business)
            @if($business)
                <div  id="grid" class="post-item isotope-item clearfix post-2277 post  format-standard has-post-thumbnail  category-lifestyle  tag-video">
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

@if($load_more == 1)
    <form method="POST" id="form">
        @csrf
         <button style="width: 100%" type="button" onclick="load()" id="load_more">
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