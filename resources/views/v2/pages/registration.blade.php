@extends('v2.layouts.app2')

@section('body_class', "color-custom style-simple button-flat layout-full-width no-content-padding header-split minimalist-header-no sticky-header sticky-tb-color ab-hide subheader-both-center menu-link-color menuo-no-borders mobile-tb-center mobile-side-slide mobile-mini-mr-ll tablet-sticky mobile-header-mini mobile-sticky tr-header tr-menu tr-content be-reg-209621")

@section('before_styles')
    <link rel='stylesheet' href="{{ asset('css/select2.css')}}">
@endsection

@section('after_styles')
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    <link rel="stylesheet" href="{{ asset('v2/content/one/css/footer_search.css') }}">

    
<style>
    @media only screen and (max-width: 768px) {
        /* #mfn-rev-slider {
            display: none;
        } */
        .wrap-bg {
            height: 400px !important;
        }
        .tp-fullwidth-forcer {
            height: 400px !important;
        }
    }
</style>
@endsection

@section('before_scripts')
    <!-- JS FOR REGISTRATION -->
    <script src="{{asset('js/jquery-3.1.0.min.js')}}"></script>
    <script src="{{asset('js/ckeditor.js')}}"></script>
    <script src="{{asset('js/select2.min.js')}}"></script>

    <script>
        $("#sub_category_id").select2();
    </script>
@endsection

@section('content')
<div id="Wrapper">
    <div id="Header_wrapper">
        <header id="Header">
            @include('v2.partials.top_bar')
            <div class="mfn-main-slider" id="mfn-rev-slider">
                <div class="wrap-bg" style="background:#FEC842;padding:0px;">
                    <div id="rev_slider_1_1" class="rev_slider fullscreenbanner" style="display:none;" data-version="5.4.8">
                        <ul>
                            <li data-index="rs-2" data-transition="fade" data-slotamount="default" data-hideafterloop="0" data-hideslideonmobile="off" data-easein="Power4.easeOut" data-easeout="default" data-masterspeed="2000" data-rotate="0" data-saveperformance="off" data-title="Slide"
                            data-param1="" data-param2="" data-param3="" data-param4="" data-param5="" data-param6="" data-param7="" data-param8="" data-param9="" data-param10="" data-description="">
                            <img src="{{ asset('v2/content/one/images/bg-sectionbg7.jpg') }}" data-bg="p:center bottom;" class="rev-slidebg fullscreen-container">
                                
                                <div class="tp-caption   tp-resizeme rs-parallaxlevel-2" id="slide-2-layer-1" data-x="center" data-hoffset="" data-y="center" data-voffset="-180" data-width="['none','none','none','none']" data-height="['none','none','none','none']" data-type="image" data-responsive_offset="on"
                                    data-frames='[{"delay":10,"speed":2000,"frame":"0","from":"opacity:0;","to":"o:1;","ease":"Power4.easeOut"},{"delay":"wait","speed":310,"frame":"999","to":"opacity:0;","ease":"Power3.easeInOut"}]' data-textAlign="['inherit','inherit','inherit','inherit']"
                                    data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]" style="z-index: 10;">
                                        <!-- FULLSCREEN BANNER -->
                                        <div class="text-center">
                                            <h1 style="color:#44056C; font-size: 75px; font-weight: bold;">Register now!</h1>
                                            <h1 style="color:#44056C; font-size: 30px; font-weight: bold; line-height: 40px;">Gain better online presence for FREE!</h1>
                                        </div>  
                                        <!-- END OF FULLSCREEN BANNER -->
                                </div>

                                <!-- ICON -->
                                <div class="tp-caption   tp-resizeme rs-parallaxlevel-3" id="slide-2-layer-2" data-x="center" data-hoffset="-210" data-y="center" data-voffset="250" data-width="['none','none','none','none']" data-height="['none','none','none','none']" data-type="image"
                                    data-responsive_offset="on" data-frames='[{"delay":1310,"speed":1610,"frame":"0","from":"x:20px;y:20px;opacity:0;","to":"o:1;","ease":"Power3.easeOut"},{"delay":"wait","speed":300,"frame":"999","to":"opacity:0;","ease":"Power3.easeOut"}]'
                                    data-textAlign="['inherit','inherit','inherit','inherit']" data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]" style="z-index: 5;">
                                    <img src="{{ asset('v2/content/one/images/letters/here_icon.png') }}" data-ww="60px" data-hh="60px" width="126" height="139" data-no-retina>
                                </div>

                                <!-- B -->
                                <div class="tp-caption   tp-resizeme rs-parallaxlevel-3" id="slide-2-layer-3" data-x="center" data-hoffset="-150" data-y="center" data-voffset="253" data-width="['none','none','none','none']" data-height="['none','none','none','none']" data-type="image"
                                    data-responsive_offset="on" data-frames='[{"delay":1350,"speed":1830,"frame":"0","from":"y:20px;opacity:0;","to":"o:1;","ease":"Power3.easeOut"},{"delay":"wait","speed":300,"frame":"999","to":"opacity:0;","ease":"Power3.easeInOut"}]'
                                    data-textAlign="['inherit','inherit','inherit','inherit']" data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]" style="z-index: 6;">
                                    <img src="{{ asset('v2/content/one/images/letters/b1-v2.png') }}" data-ww="60px" data-hh="60px" width="124" height="135" data-no-retina>
                                </div>

                                <!-- U -->
                                <div class="tp-caption   tp-resizeme rs-parallaxlevel-3" id="slide-2-layer-4" data-x="center" data-hoffset="-80" data-y="center" data-voffset="256" data-width="['none','none','none','none']" data-height="['none','none','none','none']" data-type="image"
                                    data-responsive_offset="on" data-frames='[{"delay":1430,"speed":2190,"frame":"0","from":"x:-20px;y:20px;opacity:0;","to":"o:1;","ease":"Power3.easeOut"},{"delay":"wait","speed":300,"frame":"999","to":"opacity:0;","ease":"Power3.easeInOut"}]'
                                    data-textAlign="['inherit','inherit','inherit','inherit']" data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]" style="z-index: 7;">
                                    <img src="{{ asset('v2/content/one/images/letters/u1-v2.png') }}" data-ww="60px" data-hh="60px" width="155" height="182" data-no-retina>
                                </div>

                                <!-- L -->
                                <div class="tp-caption   tp-resizeme rs-parallaxlevel-3" id="slide-2-layer-4" data-x="center" data-hoffset="-10" data-y="center" data-voffset="259" data-width="['none','none','none','none']" data-height="['none','none','none','none']" data-type="image"
                                    data-responsive_offset="on" data-frames='[{"delay":1430,"speed":2190,"frame":"0","from":"x:-20px;y:20px;opacity:0;","to":"o:1;","ease":"Power3.easeOut"},{"delay":"wait","speed":300,"frame":"999","to":"opacity:0;","ease":"Power3.easeInOut"}]'
                                    data-textAlign="['inherit','inherit','inherit','inherit']" data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]" style="z-index: 7;">
                                    <img src="{{ asset('v2/content/one/images/letters/l1-v2.png') }}" data-ww="60px" data-hh="60px" width="155" height="182" data-no-retina>
                                </div>
                            
                                <!-- A -->
                                <div class="tp-caption   tp-resizeme rs-parallaxlevel-3" id="slide-2-layer-5" data-x="center" data-hoffset="50" data-y="center" data-voffset="259" data-width="['none','none','none','none']" data-height="['none','none','none','none']" data-type="image"
                                    data-responsive_offset="on" data-frames='[{"delay":1560,"speed":2210,"frame":"0","from":"x:20px;y:-20px;opacity:0;","to":"o:1;","ease":"Power3.easeOut"},{"delay":"wait","speed":300,"frame":"999","to":"opacity:0;","ease":"Power3.easeInOut"}]'
                                    data-textAlign="['inherit','inherit','inherit','inherit']" data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]" style="z-index: 8;">
                                    <img src="{{ asset('v2/content/one/images/letters/a1-v2.png') }}" data-ww="60px" data-hh="60px" width="170" height="170" data-no-retina>
                                </div>

                                <!-- C -->
                                <div class="tp-caption   tp-resizeme rs-parallaxlevel-3" id="slide-2-layer-5" data-x="center" data-hoffset="120" data-y="center" data-voffset="256" data-width="['none','none','none','none']" data-height="['none','none','none','none']" data-type="image"
                                    data-responsive_offset="on" data-frames='[{"delay":1560,"speed":2210,"frame":"0","from":"x:20px;y:-20px;opacity:0;","to":"o:1;","ease":"Power3.easeOut"},{"delay":"wait","speed":300,"frame":"999","to":"opacity:0;","ease":"Power3.easeInOut"}]'
                                    data-textAlign="['inherit','inherit','inherit','inherit']" data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]" style="z-index: 8;">
                                    <img src="{{ asset('v2/content/one/images/letters/c1-v2.png') }}" data-ww="60px" data-hh="60px" width="170" height="170" data-no-retina>
                                </div>


                                <!-- A -->
                                <div class="tp-caption   tp-resizeme rs-parallaxlevel-3" id="slide-2-layer-7" data-x="center" data-hoffset="190" data-y="center" data-voffset="253" data-width="['none','none','none','none']" data-height="['none','none','none','none']" data-type="image"
                                    data-responsive_offset="on" data-frames='[{"delay":1820,"speed":2280,"frame":"0","from":"x:-20px;y:-20px;opacity:0;","to":"o:1;","ease":"Power3.easeOut"},{"delay":"wait","speed":300,"frame":"999","to":"opacity:0;","ease":"Power3.easeInOut"}]'
                                    data-textAlign="['inherit','inherit','inherit','inherit']" data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]" style="z-index: 9;">
                                    <img src="{{ asset('v2/content/one/images/letters/a2-v2.png') }}" data-ww="60px" data-hh="60px" width="129" height="137" data-no-retina>
                                </div>

                                <!-- N -->
                                <div class="tp-caption   tp-resizeme rs-parallaxlevel-3" id="slide-2-layer-7" data-x="center" data-hoffset="255" data-y="center" data-voffset="250" data-width="['none','none','none','none']" data-height="['none','none','none','none']" data-type="image"
                                    data-responsive_offset="on" data-frames='[{"delay":1820,"speed":2280,"frame":"0","from":"x:-20px;y:-20px;opacity:0;","to":"o:1;","ease":"Power3.easeOut"},{"delay":"wait","speed":300,"frame":"999","to":"opacity:0;","ease":"Power3.easeInOut"}]'
                                    data-textAlign="['inherit','inherit','inherit','inherit']" data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]" style="z-index: 9;">
                                    <img src="{{ asset('v2/content/one/images/letters/n1-v2.png') }}" data-ww="60px" data-hh="60px" width="129" height="137" data-no-retina>
                                </div>

                                <!-- MAP -->
                                <div class="tp-caption   tp-resizeme rs-parallaxlevel-2" id="slide-2-layer-1" data-x="center" data-hoffset="" data-y="center" data-voffset="60" data-width="['none','none','none','none']" data-height="['none','none','none','none']" data-type="image" data-responsive_offset="on"
                                    data-frames='[{"delay":10,"speed":2000,"frame":"0","from":"opacity:0;","to":"o:1;","ease":"Power4.easeOut"},{"delay":"wait","speed":310,"frame":"999","to":"opacity:0;","ease":"Power3.easeInOut"}]' data-textAlign="['inherit','inherit','inherit','inherit']"
                                    data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]" style="z-index: 10;">
                                    <img src="{{ asset('v2/content/one/images/op-logo-v2-letter.png') }}" data-ww="1000px" data-hh="379px" width="567" height="416" data-no-retina>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </header>
    </div>
    <div id="Content" style="display: none;">
        <div class="content_wrapper clearfix">
            <div class="sections_group">
                <div class="entry-content">
                    
                    @if(!session()->has('success'))
                        <div class="section mcb-section" style="background:#FEC842;">
                            <div class="section_wrapper mcb-section-inner">
                                <div class="wrap mcb-wrap one-sixth  valign-top clearfix">
                                    <div class="mcb-wrap-inner">
                                        <div class="column mcb-column one column_placeholder">
                                            <div class="placeholder">
                                                &nbsp;
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="wrap mcb-wrap two-third valign-top move-up clearfix" style="border-radius:20px; padding:30px 30px 10px; margin-top:30px; background:#FFCE4E;" data-mobile="no-up">
                                    <div class="mcb-wrap-inner">
                                        <div class="column mcb-column one column_column">
                                            <div class="column_attr clearfix">
                                                <h4 style="color:#44056C; font-weight:700;">BUSINESS DETAILS</h4>
                                                <hr class="no_line" style="margin:0 auto 15px">
                                                <div id="contactWrapper">
                                                    <form class="align_center" id="registration_form"  method="POST" action="{{url('submit_registration')}}{{request('refcode')  ? '?refcode=' . request('refcode') : ''}}" enctype="multipart/form-data">
                                                    @csrf
                                                        <div class="column one">
                                                            <!-- One Second (1/2) Column -->
                                                            <div class="column one-second">
                                                                <input class="v2-input" required placeholder="Business Name" type="text" name="name" id="name" size="40" aria-required="true" aria-invalid="false" value="{{old('name')}}"/>
                                                                @if($errors->has('name'))
                                                                    <div class="error">{{ $errors->first('name') }}</div>
                                                                @endif
                                                            </div>
                                                            <!-- One Second (1/2) Column -->
                                                            <div class="column one-second">
                                                                <input class="v2-input" placeholder="Branch Name (Optional)" type="text" name="branch_name" id="branch_name" size="40" aria-required="true" aria-invalid="false" value="{{old('branch_name')}}"/>
                                                                @if($errors->has('branch_name'))
                                                                    <div class="error">{{ $errors->first('branch_name') }}</div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="column one">
                                                            <div class="column one">
                                                                <input class="v2-input" placeholder="Nature of Business" type="text" name="business_nature" id="business_nature" size="40" aria-invalid="false" value="{{old('business_nature')}}" required/>
                                                                @if($errors->has('business_nature'))
                                                                    <div class="error">{{ $errors->first('business_nature') }}</div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="column one">
                                                            <div class="column one">
                                                                <textarea class="v2-textarea" id="business_description" name="business_description" placeholder="Description" name="body" id="body" style="width:100%;" rows="10" aria-invalid="false">{{old('business_description')}}</textarea>
                                                                @if($errors->has('business_description'))
                                                                    <div class="error">{{ $errors->first('business_description') }}</div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="column one">
                                                            <!-- One Second (1/2) Column -->
                                                            <div class="column one">
                                                                <select class="v2-select" data-live-search="true" name="category_id" id="category_id" width="100%" style="min-width:100%; color: #929292;" required>
                                                                    <option style="color: #929292 !important;" value="" hidden>Select Categories</option>
                                                                    @if(count($categories)>0)
                                                                        @foreach($categories as $k => $category)
                                                                            @if(old('category_id') == $category->id )
                                                                            <option value="{{$category->id}}" selected>{{$category->name}}</option>
                                                                            @else
                                                                            <option value="{{$category->id}}">{{$category->name}}</option>
                                                                            @endif
                                                                        @endforeach
                                                                    @endif
                                                                </select>
                                                                @if($errors->has('category_id'))
                                                                    <div class="error">{{ $errors->first('category_id') }}</div>
                                                                @endif
                                                            </div>
                                                        </div>

                                                        <div class="column one">
                                                            <!-- One Second (1/2) Column -->
                                                            <div class="column one">
                                                                <select multiple id="sub_category_id" placeholder="Select Sub-Categories" name="sub_category_id[]" width="100%" style="min-width:100%; min-height: 50px; padding:10px;" height="50px;" required>
                                                                    @if(count($subcategories)>0)
                                                                        @foreach($subcategories as $k => $category)
                                                                            <option value="{{$category->id}}"{{ (collect(old('sub_category_id'))->contains($category->id)) ? 'selected':'' }}>{{$category->name}}</option>
                                                                        @endforeach
                                                                    @endif
                                                                <select>
                                                                @if($errors->has('sub_category_id'))
                                                                    <div class="error">{{ $errors->first('sub_category_id') }}</div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="column one">
                                                            <div class="column one">
                                                                <input class="v2-input" value="{{old('address1')}}" placeholder="Room | Floor | Building Name | Lot No | Block No" type="text" name="address1" id="address1" size="40" aria-required="true" aria-invalid="false" required/>
                                                                @if($errors->has('address1'))
                                                                    <div class="error">{{ $errors->first('address1') }}</div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="column one">
                                                            <!-- (1/3) Column -->
                                                            <div class="column one-third">
                                                                <input class="v2-input" value="Pampanga" placeholder="Province" type="text" disabled name="province" id="province" size="40" aria-required="true" aria-invalid="false" />
                                                                @if($errors->has('province'))
                                                                    <div class="error">{{ $errors->first('province') }}</div>
                                                                @endif
                                                            </div>
                                                            <!-- (1/3) Column -->
                                                            <div class="column one-third">
                                                                <select class="v2-select" required id="municipality" name="municipality" value="{{old('municipality')}}" style="color: #929292;">
                                                                    <option value="" hidden>Select Municipality</option>
                                                                    @if(count($location)>0)
                                                                        @foreach($location as $municipality)
                                                                            <!-- <option value="{{$municipality->id}}">{{$municipality->name}}</option> -->
                                                                            @if(old('municipality') == $municipality->id )
                                                                            <option value="{{$municipality->id}}" selected>{{$municipality->name}}</option>
                                                                            @else
                                                                            <option value="{{$municipality->id}}">{{$municipality->name}}</option>
                                                                            @endif
                                                                        @endforeach
                                                                    @endif
                                                                </select>
                                                                @if($errors->has('municipality'))
                                                                    <div class="error">{{ $errors->first('municipality') }}</div>
                                                                @endif
                                                            </div>
                                                            <!-- (1/3) Column -->
                                                            <div class="column one-third">
                                                                <select class="v2-select" required id="baranggay_id" name="baranggay_id" style="color: #929292;">
                                                                    <option value="">Select Baranggay</option>
                                                                <select>
                                                                @if($errors->has('baranggay_id'))
                                                                    <div class="error">{{ $errors->first('baranggay_id') }}</div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <!-- Google Map -->
                                                        <div class="column one">
                                                            <div class="column one">
                                                                <div id="map" name="map" style="width: 100%; height:500px;"></div>
                                                            </div>
                                                        </div>
                                                        <div class="column one">
                                                            <!-- (1/3) Column -->
                                                            <div class="column one-third">
                                                                <input class="v2-input" value="{{old('contact_person')}}" placeholder="Contact Person" type="text" name="contact_person" id="contact_person" size="40" aria-required="true" aria-invalid="false" required/>
                                                                @if($errors->has('contact_person'))
                                                                    <div class="error">{{ $errors->first('contact_person') }}</div>
                                                                @endif
                                                            </div>
                                                            <!-- (1/3) Column -->
                                                            <div class="column one-third">
                                                                <input class="v2-input" value="{{old('telephone_number')}}" placeholder="Telephone Number" type="number" name="telephone_number" id="telephone_number" size="40" aria-required="true" aria-invalid="false" />
                                                                @if($errors->has('telephone_number'))
                                                                    <div class="error">{{ $errors->first('telephone_number') }}</div>
                                                                @endif
                                                            </div>
                                                            <!-- (1/3) Column -->
                                                            <div class="column one-third">
                                                                <input class="v2-input" value="{{old('mobile_number')}}" placeholder="Mobile Number" type="number" name="mobile_number" id="mobile_number" size="40" aria-required="true" aria-invalid="false" required/>
                                                                @if($errors->has('mobile_number'))
                                                                    <div class="error">{{ $errors->first('mobile_number') }}</div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="column one">
                                                            <!-- One Second (1/2) Column -->
                                                            <div class="column one-second">
                                                                <input class="v2-input" value="{{old('email')}}" placeholder="Business Email Address" type="email" name="email" id="email" size="40" aria-required="true" aria-invalid="false" required/>
                                                                @if($errors->has('email'))
                                                                    <div class="error">{{ $errors->first('email') }}</div>
                                                                @endif
                                                            </div>
                                                            <!-- One Second (1/2) Column -->
                                                            <div class="column one-second">
                                                                <input class="v2-input" class="input_border" value="{{old('website')}}" placeholder="Business Website (Optional)" type="text" name="website" id="website" size="40" aria-required="true" aria-invalid="false" />
                                                                @if($errors->has('website'))
                                                                    <div class="error">{{ $errors->first('website') }}</div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="column one">
                                                            <!-- (1/3) Column -->
                                                            <div class="column one-third">
                                                                <input class="v2-input" value="{{old('facebook')}}" placeholder="Facebook Link" type="text" name="facebook" id="facebook" size="40" aria-required="true" aria-invalid="false" />
                                                                @if($errors->has('facebook'))
                                                                    <div class="error">{{ $errors->first('facebook') }}</div>
                                                                @endif
                                                            </div>
                                                            <!-- (1/3) Column -->
                                                             <div class="column one-third" style="display: -ms-flexbox; display: flex;">
                                                                    {{-- <label>Twitter</label> --}}
                                                                    <span class="btn-social input-icon">@</span>
                                                                    <input class="input-social" value="{{old('twitter')}}" placeholder="Twitter Username" type="text" name="twitter" id="twitter" size="40" aria-required="true" aria-invalid="false" />
                                                                    @if($errors->has('twitter'))
                                                                        <div class="error">{{ $errors->first('twitter') }}</div>
                                                                    @endif
                                                                </div>
                                                            <!-- (1/3) Column -->
                                                            <div class="column one-third" style=" display: -ms-flexbox; display: flex;">
                                                                {{-- <label>Instagram</label> --}}
                                                                <span class="btn-social input-icon">@</span>
                                                                <input class="input-social" value="{{old('instagram')}}" placeholder="Instagram Username" type="text" name="instagram" id="instagram" size="40" aria-required="true" aria-invalid="false" />
                                                                @if($errors->has('instagram'))
                                                                    <div class="error">{{ $errors->first('instagram') }}</div>
                                                                @endif
                                                            </div>
                                                        </div>

                                                        <div class="column one aligncenter">
                                                            <div class="column one align_center">
                                                            <strong><label>Logo</label></strong>
                                                                <input data-preview="#preview" name="business_logo" type="file" id="business_logo"> <br>                                                          
                                                                <img style="width: 200px; height: 200px;" class="col-sm-6 pt-4" id="preview"  src="{{ asset('images/default_image.png') }}">
                                                                @if($errors->has('business_logo'))
                                                                    <div class="error">{{ $errors->first('business_logo') }}</div>
                                                                @endif
                                                            </div>
                                                        </div>

                                                        <!-- Latitude & Longitude -->
                                                        <div class="column one">
                                                            <!-- One Second (1/2) Column -->
                                                            <div class="column one-second">
                                                                <input class="v2-input" value="{{old('latitude')}}" type="hidden" name="latitude" id="latitude"/>
                                                            </div>
                                                            <!-- One Second (1/2) Column -->
                                                            <div class="column one-second">
                                                                <input class="v2-input" value="{{old('longitude')}}" type="hidden" name="longitude" id="longitude"/>
                                                            </div>
                                                        </div>
                                                        
                                                        {{-- <div class="column one">
                                                            <div class="column one aligncenter">
                                                                <h5>LISTING TYPE</h5>
                                                                
                                                                <label for="basic" style="display: unset;" checked>
                                                                <input type="radio" id="basic" name="listing_type" value="basic" required>
                                                                <img class="one-basic" src="{{ asset('v2/content/one/images/one_basic.png') }}" style="width:150px;">
                                                                </label>

                                                               
                                                                <label for="premium" style="display: unset;">
                                                                <input type="radio" id="premium" name="listing_type" value="premium" required>
                                                                <img class="one-premium" src="{{ asset('v2/content/one/images/one_premium.png') }}" style="width:150px; ">
                                                                </label>

                                                            </div>
                                                        </div> --}}

                                                        <div class="column one">
                                                            <div class="column one aligncenter">
                                                                <h5>DATA PRIVACY CONSENT</h5>
                                                                <p style="font-size:14px;line-height: 15px;">
                                                                    <input type="checkbox" id="terms_and_condition" name="terms_and_condition" required>
                                                                    By submitting this registration form, you are hereby giving PROJECT ONE to collect and process your personal and business information. If you want to know how your information is being processed, kindly visit <a href="http://onepampanga.com/privacy">onepampanga.com/privacy</a>
                                                                    
                                                                </p>
                                                            </div>
                                                            <div class="column one aligncenter">
                                                                @if($errors->has('terms_and_condition'))
                                                                    <div class="error">{{ $errors->first('terms_and_condition') }}</div>
                                                                @endif
                                                            </div>
                                                            <div class="column one align_center" style="text-align:center;">
                                                                <button id="btnRegister" style="border-radius:20px; width: 100%; background-color: #EE2C2C;" name="btnRegister" type="submit">Register</button>
                                                            </div>
                                                            <div class="column one align_center" style="text-align:center;">
                                                                <p style="font-size:14px;line-height: 15px;">
                                                                    <strong>NOTE:</strong> If you are having difficulty in registering kindly email the details at <a href="mailto:info@onepampanga.com?Subject=Inquiry from One Pampanga"><strong>info@onepampanga.com</strong></a> and we will help you register your business or services
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="wrap mcb-wrap one valign-top clearfix">
                                    <div class="mcb-wrap-inner">
                                        <div class="column mcb-column one-fourth column_placeholder">
                                            <div class="placeholder">
                                                &nbsp;
                                            </div>
                                        </div>
                                        <div class="column mcb-column one-second column_column">
                                            <div class="column_attr clearfix">
                                                <hr class="no_line" style="margin:0 auto 40px">
                                                <p class="big">
                                                   {{--  To avail your  SINGLE-PAGE WEBSITE  --}}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="section mcb-section aligncenter" style="padding-top:50px; background-repeat:no-repeat; background-position:center top; background-size: cover;">
                            <div class="section_wrapper mcb-section-inner">
                                <div class="wrap mcb-wrap one  valign-top clearfix">
                                    <div class="mcb-wrap-inner">
                                        <div class="column mcb-column one column_placeholder">
                                            <i class="fas fa-check-circle fa-7x" style="color: #532f17"></i>
                                            <h2>
                                                <b>Registered Sucessfully!</b>
                                            </h2>
                                            <a href="{{ session('paymentUrl') }}" target="_blank">
                                                <img src="{{asset('images/pay-now-2.png')}}">
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- BEFORE FOOTER DECORATION  -->
                    <img src="{{ asset('v2/content/one/images/bg-sectionbg4.png') }}" style="background: #FEC842; margin-top: -5px;">  
                    <!-- END OF BEFORE FOOTER DECORATION  -->
                                                                             
                    @include('v2.partials.footer_search')
                    @include('v2.partials.footer_v2')
                </div>
            </div>
        </div>
    </div>

</div>
{{-- <script>
    $("#sub_category_id").select2();
</script> --}}
@endsection

@section('after_scripts')
  
    <script>
        $(document).ready(function () {
            var menu = $('#menu');
            // $('#' + indexValue).addClass("selectedQuestion");
            $('li[id=faq_menu]').addClass("current-menu-item")
            $("#get_listed").remove();
            

            $('select[name="survey"]').on('change', function() {
                console.log('1');
                if ($('select[name="survey"').find(":selected").val() == 'Referral') {
                    $('#referred_by').show();
                    document.getElementById('referred_by').style.visibility = 'visible';
                }
                else {
                    document.getElementById('referred_by').style.visibility = 'hidden';
                }
            });
        });
        $('#business_logo').on('change', function() {
            readURL(this);
        });
        $('#category_id').on('change', function() {
            this.style.color = "#000";
        });
        function readURL(input) {
          if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function(e) {
              $('#preview').attr('src', e.target.result);
            }
            
            reader.readAsDataURL(input.files[0]);
          }
        }

        $( "#registration_form" ).submit(function( event ) {
            var isLogoValid = validateLogo();
            if(! isLogoValid) {
                event.preventDefault();
            }
        });

        function validateLogo()
        {
            const fi = document.getElementById('business_logo');
            // Check if any file is selected.
            if (fi.files.length > 0) {
                for (var i = 0; i <= fi.files.length - 1; i++) {
     
                    const fsize = fi.files.item(i).size;
                    const file = Math.round((fsize / 1024));
                    // The size of the file.
                    if (file > 1024) {
                        alert("File too Big, please select a file less than 1mb");
                        fi.value = "";
                        document.getElementById('preview').removeAttribute('src');
                        return false;
                    }
                }
            }
            return true;
        }
    </script>
    <script>
        // $("#terms_and_condition").click(function() {
        //     $("#btnRegister").attr("disabled", !this.checked);
        // });
        // CALL WHEN USER CHANGE THE CATEGORY
        function getBaranggays(){
            var old = {{old('baranggay_id')}}
            console.log({{old('baranggay_id')}}); // DO NOT REMOVE
            if($('select[name="municipality"').find(":selected").val() != '')
            {
                $('#baranggay_id').css('color', '#000');
                $.ajax({
                    url: "registration/api/get-baranggays",
                    method : "POST", 
                    data:{
                        municipality_id: $('select[name="municipality"').find(":selected").val(),
                        _token:"{{csrf_token()}}"
                    },
                    success: function(result){
                        $('select[name="baranggay_id"]').empty();
                        if(result == ''){
                            var option = '<option value">' + 'N/A' + '</option>';
                            $('select[name="baranggay_id"]').append(option);
                        }
                        else{
                            $.each(result, function(index, value) {
                                $('select[name="baranggay_id"]').prop('disabled', false);
                                // console.log('div' + index + ':', value);
                                // if(old('baranggay_id') == value.id ){
                                //     var option2 = '<option value="'+value.id+'" selected>'+value.name +'</option>'
                                //     $('select[name="baranggay_id"]').append(option2);
                                // }
                                if(old == value.id)
                                {
                                    var option = '<option selected value ="' + value.id + '">' + value.name + '</option>';
                                }
                                else{
                                    var option = '<option value ="' + value.id + '">' + value.name + '</option>';
                                }
                                $('select[name="baranggay_id"]').append(option);
                                
                            });
                        }
                    }
                });
            }
            else {
                $('select[name="baranggay_id"]').empty();
                var option = '<option value>' + "Select Baranggay" + '</option>';
                $('select[name="baranggay_id"]').append(option);
            }
        }
        getBaranggays();
        $('select[name="municipality"').on('change', function() {
            this.style.color = "#000";
            getBaranggays();
        });
    </script>

    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDVBcx1Fi-u32Cec-QaXpaPL7NTt3G6HHQ&map_ids=8f49a54f3d37eefa&callback=initMap&libraries=&v=weekly" async></script>

    <script>
        var latLong;
        var latitude;
        var longitude;
        let marker;

        latitude  = {{ old('latitude') ? old('latitude') : 0 }};
        longitude = {{ old('longitude') ? old('longitude') : 0 }};

        function initMap()
        {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(
                    (position) => {
                        const pos = {
                            lat: position.coords.latitude,
                            lng: position.coords.longitude,
                        };

                        const myLatlng = { lat: latitude ? latitude : position.coords.latitude, lng: longitude ? longitude : position.coords.longitude };
                        const map = new google.maps.Map(document.getElementById("map"), {
                            zoom: 9,
                            center: myLatlng,
                            mapId: '8f49a54f3d37eefa',
                        });

                        // Create / Show Marker
                        marker = new google.maps.Marker({
                            map,
                            draggable: false,
                            animation: google.maps.Animation.DROP,
                            position: myLatlng,
                        });

                        // Create the initial InfoWindow.
                        let infoWindow = new google.maps.InfoWindow({
                            content: "Set your business location by gradding and clicking the map.",
                            position: myLatlng,
                        });
                        infoWindow.open(map);

                        // Configure the click listener.
                        map.addListener("click", (mapsMouseEvent) => {
                            // Close the current InfoWindow.
                            infoWindow.close();
                            // Create a new InfoWindow.
                            // infoWindow = new google.maps.InfoWindow({
                            //   position: mapsMouseEvent.latLng,
                            // });
                            // infoWindow.setContent(
                            //   JSON.stringify(mapsMouseEvent.latLng.toJSON(), null, 2)
                            // );
                            // infoWindow.open(map);

                            latLong   = JSON.stringify(mapsMouseEvent.latLng.toJSON(), null, 2)
                            latitude  = JSON.parse(latLong)["lat"]
                            longitude = JSON.parse(latLong)["lng"]

                            // Change Marker Position
                            marker.setPosition(mapsMouseEvent.latLng);
                            markerToggleBounce();

                            $('input[name=latitude]').val(latitude);
                            $('input[name=longitude]').val(longitude);
                        });
                    },
                    () => {
                        defaultMap();
                    }
                );
            } else {
                // Browser doesn't support Geolocation
                defaultMap();
            }
        }

        function defaultMap()
        {
            const myLatlng = { lat: latitude ? latitude : 15.04426482138687, lng: longitude ? longitude : 120.68958740315281 };
            const map = new google.maps.Map(document.getElementById("map"), {
                zoom: 9,
                center: myLatlng,
                mapId: '8f49a54f3d37eefa',
            });

            // Create / Show Marker
            marker = new google.maps.Marker({
                map,
                draggable: false,
                animation: google.maps.Animation.DROP,
                position: myLatlng,
            });

            // Create the initial InfoWindow.
            let infoWindow = new google.maps.InfoWindow({
                content: "Set your business location by gradding and clicking the map.",
                position: myLatlng,
            });
            infoWindow.open(map);

            // Configure the click listener.
            map.addListener("click", (mapsMouseEvent) => {
                // Close the current InfoWindow.
                infoWindow.close();
                // Create a new InfoWindow.
                // infoWindow = new google.maps.InfoWindow({
                //   position: mapsMouseEvent.latLng,
                // });
                // infoWindow.setContent(
                //   JSON.stringify(mapsMouseEvent.latLng.toJSON(), null, 2)
                // );
                // infoWindow.open(map);

                latLong   = JSON.stringify(mapsMouseEvent.latLng.toJSON(), null, 2)
                latitude  = JSON.parse(latLong)["lat"]
                longitude = JSON.parse(latLong)["lng"]

                // Change Marker Position
                marker.setPosition(mapsMouseEvent.latLng);
                markerToggleBounce();

                $('input[name=latitude]').val(latitude);
                $('input[name=longitude]').val(longitude);
            });
        }

        function markerToggleBounce()
        {
            marker.setAnimation(google.maps.Animation.BOUNCE);
            // if (marker.getAnimation() !== null) {
            //   marker.setAnimation(null);
            // } else {
            //   marker.setAnimation(google.maps.Animation.BOUNCE);
            // }
        }
    </script>
    <script>
        var pageNumber = 1;
        var revapi1, tpj;
        ( function() {
                if (!/loaded|interactive|complete/.test(document.readyState))
                    document.addEventListener("DOMContentLoaded", onLoad);
                else
                    onLoad();
                function onLoad() {
                    if (tpj === undefined) {
                        tpj = jQuery;
                        if ("off" == "on")
                            tpj.noConflict();
                    }
                    if (tpj("#rev_slider_1_1").revolution == undefined) {
                        revslider_showDoubleJqueryError("#rev_slider_1_1");
                    } else {
                        revapi1 = tpj("#rev_slider_1_1").show().revolution({
                            sliderType : "standard",
                            sliderLayout : "fullscreen",
                            dottedOverlay : "none",
                            delay : 9000,
                            navigation : {
                                onHoverStop : "off",
                            },
                            visibilityLevels : [1240, 1024, 778, 480],
                            gridwidth : 1240,
                            gridheight : 800,
                            lazyType : "none",
                            parallax : {
                                type : "mouse",
                                origo : "slidercenter",
                                speed : 3000,
                                speedbg : 0,
                                speedls : 3000,
                                levels : [2, 4, 6, 20, 25, 30, 35, 40, 45, 46, 47, 48, 49, 50, 51, 55],
                            },
                            shadow : 0,
                            spinner : "spinner2",
                            stopLoop : "on",
                            stopAfterLoops : 0,
                            stopAtSlide : 2,
                            shuffle : "off",
                            autoHeight : "off",
                            fullScreenAutoWidth : "off",
                            fullScreenAlignForce : "off",
                            fullScreenOffsetContainer : "",
                            fullScreenOffset : "",
                            disableProgressBar : "on",
                            hideThumbsOnMobile : "off",
                            hideSliderAtLimit : 0,
                            hideCaptionAtLimit : 0,
                            hideAllCaptionAtLilmit : 0,
                            debugMode : false,
                            fallbacks : {
                                simplifyAll : "off",
                                nextSlideOnWindowFocus : "off",
                                disableFocusListener : false,
                            }
                        });
                    };
                };
            }());
        $(document).ready(function () {
            $("#Content").show();
        });
    </script>
     <script>
        $(document).ready(function () {
            $("#Content").show();
        });
    </script>
@endsection


