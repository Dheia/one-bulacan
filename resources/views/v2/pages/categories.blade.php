@extends('v2.layouts.app2')

@section('after_styles')
    <!-- BOOTSTRAP CSS -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    
    <style type="text/css">
        .search_key{
            height: 36px;
        }
        .searchButton {
            height: 36px;
        }
        @media only screen and (max-width: 768px) {
            .search_key {
                height: 51px;
            }
            .searchButton {
                height: 51px;
            }
        }

        .main-category i{
            font-size: 30px;
        }
    </style>
<link rel="stylesheet" href="{{ asset('v2/content/one/css/footer_search.css') }}">
@endsection

@section('body_class', "color-custom style-simple button-flat layout-full-width no-content-padding header-split minimalist-header-no sticky-header sticky-tb-color ab-hide subheader-both-center menu-link-color menuo-no-borders mobile-tb-center mobile-side-slide mobile-mini-mr-ll tablet-sticky mobile-header-mini mobile-sticky tr-header tr-menu tr-content be-reg-209621")

@section('content')
    <div id="Wrapper">
        <div id="Header_wrapper">
            <header id="Header">
                @include('v2.partials.top_bar')
            </header>
        </div>
        <div id="Content" style="display:none;">
            <div class="content_wrapper clearfix">
                <div class="sections_group">
                    <div class="entry-content">
                        <div class="section mcb-section bg-cover" style="padding-top:15px; padding-bottom:15px; background-image:url({{ url('v2/content/one/images/bg-sectionbg5.jpg')}}); background-repeat:no-repeat; background-position:center top; min-height:110px;">
                        </div>

                        <div class="section mcb-section mcb-section-cj2za4c54 bg-cover-ultrawide" style="padding-top:50px; padding-bottom:50px; background-image:url({{ asset('../content/seo3/images/seo3-sectionbg1.png') }});">
                            <div class="container" style="padding-top:50px; padding-bottom:50px; background-image:url({{ asset('../content/seo3/images/seo3-sectionbg5.png') }});">

                                @if(count($subcategories)>0)
                                    <div class="col-lg-12 col-md-12" style="margin-bottom: 20px;">
                                        <div class="row">
                                            <search-category></search-category>
                                        </div>
                                    </div>
                                    @foreach($subcategories as $k => $subcategory)
                                        @if ($subcategory->children->count())
                                            <div class="col-lg-12 col-md-12 col-sm-12 categories">
                                                <div class="row ">
                                                    
                                                    <div class="col-lg-2 col-md-2 col-sm-12 col-12 main-category">
                                                        @if($subcategory->image)
                                                            <img src="{{ asset($subcategory->image)}}" >
                                                        @endif
                                                        @if(!$subcategory->image)
                                                            <i class="{{$subcategory->icon}}"></i>
                                                        @endif
                                                            <h4>{{$subcategory->name}}</h4>
                                                    </div>
                                                    <div class="col-lg-10 col-md-10 col-sm-12 col-12 subcategory text-center" >
                                                        @if ($subcategory->children->count())

                                                            <div class="row pt-3">
                                                                @foreach($subcategory->children as $i => $subcategory_item)
                                                                    <div class="col-md-3 col-lg-3 col-sm-6 col-6 pb-3">
                                                                        {{-- <img src="{{ asset('v2/IconSet/01_accomodations.png')}}" > --}}
                                                                        <a href="/businesses/{{$subcategory_item->slug}}" >
                                                                            <span>{{$subcategory_item->name}}</span>
                                                                        </a>
                                                                    </div>                                                    
                                                                @endforeach
                                                            </div>

                                                        @endif
                                                    </div>
                                                    <hr>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    
                        <img src="{{ asset('v2/content/one/images/bg-sectionbg4.png') }}">  
                    </div>
                </div>
                @include('v2.partials.footer_search')
                @include('v2.partials.footer_v2')
            </div>
        </div>
    </div>
@endsection

@section('after_scripts')

    <script type="text/javascript">

        $(document).ready(function () {
            var menu = $('#menu');
            // $('#' + indexValue).addClass("selectedQuestion");
            $('li[id=categories_menu]').addClass("current-menu-item");
        });
    
    </script>
     <script>
        $(document).ready(function () {
            $("#Content").show();
        });
    </script>
@endsection