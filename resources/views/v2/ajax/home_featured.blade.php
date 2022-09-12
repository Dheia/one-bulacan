 @if(count($featured_businesses)>0)
    <div id="pagination" class="column one aligncenter" style="margin: 0px;">
        @if($featured_businesses->currentPage() > 1 && $featured_businesses->currentPage() <= $featured_businesses->lastPage())
            @php $featured_businesses->prevPage = $featured_businesses->currentPage()-1; @endphp
        <button id="prevPage" class="button button_js slider_prev" data-page="{{$featured_businesses->prevPage}}"><span class="button_icon"><i class="icon-left-open-big"></i></span></button>
        @endif
        @if($featured_businesses->currentPage() < $featured_businesses->lastPage())
        @php $featured_businesses->nextPage = $featured_businesses->currentPage()+1; @endphp
        <button id="nextPage" class="button button_js slider_next" data-page="{{$featured_businesses->nextPage}}"><span class="button_icon"><i class="icon-right-open-big"></i></span></button>
        @endif
    </div>
    @foreach($featured_businesses as $featured_business)
        <div class="wrap mcb-wrap one-third valign-top clearfix featured-business">
            <div class="mcb-wrap-inner" style="">
                <div class="column mcb-column one column_image" style="display: inline-block;">
                    <div class="image_frame image_item no_link scale-with-grid aligncenter no_border">
                        <div class="image_wrapper business-logo" style="height: 330px;">
                            <a href="{{ asset($featured_business->logo ? $featured_business->logo : 'v2/content/one/images/logo1.png') }}" class="zoom" rel="prettyphoto">
                                {{-- <div class="mask" style="height:300px;"></div> --}}
                                <img class="scale-with-grid"  style= "width:65%; margin-top:30px; border-radius: 50%; min-height: 180px; min-height: 180px;" src="{{ asset($featured_business->logo ? $featured_business->logo : 'v2/content/one/images/logo1.png') }}">
                            </a>
                        </div>
                    </div>
                </div>
                <div class="column mcb-column one column_column">
                    <div class="column_attr clearfix align_center" style=" padding:0 5%;">
                        <h3><b><a href="{{ url($featured_business->category_slug.'/'.$featured_business->slug) }}">{{ $featured_business->name }}</a></b></h3>
                        <div class="image_frame image_item no_link scale-with-grid aligncenter no_border" style="margin-bottom:20px;">
                            <div class="image_wrapper">
                                <img class="scale-with-grid" src="{{ asset('v2/content/one/images/home-divider.png') }}">
                            </div>
                        </div>
                        <p>
                            <b> {{ $featured_business->category_name }} </b>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

@endif