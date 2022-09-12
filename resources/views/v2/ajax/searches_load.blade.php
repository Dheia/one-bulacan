@if(count($businesses)>0)
    @foreach($businesses as $business)
        <div class="section mcb-section " style="padding-top:0px; padding-bottom:0px">
            <div class="section_wrapper mcb-section-inner search-results">
                <div class="wrap mcb-wrap one valign-top clearfix">
                    <div class="mcb-wrap-inner">
                        <div class="column one-fourth" style="padding-top: 20px;">
                            <div class="image_wrapper">
                                <a href="{{ url($business->category_slug.'/'.$business->slug) }}">                                                
                                    <img class="scale-with-grid" src="{{ asset($business->logo ? $business->logo : 'images/default_image.png') }}">
                                </a>
                            </div>
                        </div>
                        <div class="column mcb-column three-fourth column_column column-margin-5px business_list_info" style="padding-top: 20px; margin-bottom: 15px;">
                            <div class="column_attr clearfix" style="margin-left:15px;">
                                <a href="{{ url($business->category_slug.'/'.$business->slug) }}">
                                    <h4><b>{{ $business->name }}</b></h4>
                                </a>
                                <p >
                                    {{$business->address1}}, {{$business->baranggay_name}}, {{$business->location_name}}
                                </p>
                                <p >
                                    <i class="icon-mobile"></i>
                                    <a href="tel:{{$business->mobile}}"> {{$business->mobile}}</a>
                                </p>
                                @if($business->telephone)
                                <p>
                                    <i class="icon-phone" ></i>
                                    <a href="tel:{{$business->telephone}}"> {{$business->telephone}}</a>
                                </p>
                                @endif
                                <p>
                                    <i class="icon-mail"></i>
                                    <a href="mailto:{{$business->email}}?Subject=Inquiry from One Pampanga" target="_top"> {{$business->email}}</a>
                                </p>

                                <h6 class="searchtag"><i class="icon-tag"></i>{{ $business->category_name }}</h6>

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
                        </div> 
                        <hr>                                          
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endif

@if($load_more == 1)
    <form method="POST" id="form" class="loadmore">
        @csrf
         <button  type="button" onclick="load()" id="load_more" >
                Load More
        </button>
    </form>
@else
    <div class="column one aligncenter">
        <button type="button" id="nomore_data" disabled>
                No More Data
        </button>
    </div>

@endif
