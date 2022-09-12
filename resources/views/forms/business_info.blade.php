@extends('layouts.app2')

@section('body_class', "page-template-default page color-custom style-simple button-round layout-full-width no-content-padding no-shadows header-transparent header-fw minimalist-header-no sticky-header sticky-tb-color ab-hide subheader-both-center menu-link-color menuo-right menuo-no-borders mobile-tb-center mobile-side-slide mobile-mini-mr-ll tablet-sticky mobile-header-mini mobile-sticky")

@section('before_styles')
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" /> -->
    <style>
        #Top_bar .onload .menu>li>a, #Top_bar #menu ul li.submenu .menu-toggle {
            color: #fff;
        }
        #Top_bar .scroll .menu>li>a, #Top_bar #menu ul li.submenu .menu-toggle{
            color: #222228;
        }
    </style>
    <link rel='stylesheet' href="{{ asset('css/select2.css')}}">
@endsection

@section('before_scripts')
    <!-- JS FOR REGISTRATION -->
    <script src="{{asset('js/jquery-3.1.0.min.js')}}"></script>
    <!-- <script src="{{asset('js/ckeditor.js')}}"></script> -->
    <script src="{{asset('js/select2.min.js')}}"></script>
 <!--    <script src="{{asset('js/ckeditor.js')}}"></script> -->
    <script src="https://cdn.ckeditor.com/ckeditor5/16.0.0/classic/ckeditor.js"></script>

@endsection

@section('content')
<div id="Wrapper">
    <div id="Header_wrapper" style="padding-bottom:40px">
        @include('partials.header')
        <!-- Subheader -->
        <div id="Subheader" style="padding:10% 0 50px; background-image: url({{ asset('content/seo3/images/seo3-slider-bg.png') }});">
            <div class="container">
                <h1 class="themecolor">REGISTER</h1>
            </div>
        </div>
    </div>
    <div id="Content">
        <div class="content_wrapper clearfix">
            <div class="sections_group">
                <div class="entry-content">
                    @if(session()->has('success'))
                        <div class="section mcb-section mcb-section-uqnjs4egm" style="padding-top:50px;padding-bottom:40px;background-color:#fff">
                            <div class="section_wrapper mcb-section-inner">
                                <div class="wrap mcb-wrap mcb-wrap-fisa74pn3 one valign-top clearfix">
                                    <div class="mcb-wrap-inner">
                                        <div class="column mcb-column mcb-item-eyf6kgam2 one column_column">
                                            <div class="column_attr clearfix align_center" style="background-color:#e73827;padding:70px;box-shadow: 0px 10px 30px rgba(55,43,125,.2); border-radius: 25px; ">
                                                <i style="color:aliceblue;" class="fas fa-check-circle fa-10x"></i>
                                                <div id="contactWrapper" style="text-align: center; color:aliceblue;">
                                                    <div class="alert alert-success" style="text-align: center;">
                                                        <br>
                                                        <h2 class="themecolor">Updated Sucessfully!</h2> 
                                                        <br>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        <form class="align_center" id="registration_form"  method="POST" action="{{url($business->id.'/'.$business->slug.'/update')}}" enctype="multipart/form-data">
                            @csrf
                            {!! csrf_field() !!}
                            <div class="section mcb-section mcb-section-uqnjs4egm" style="padding-top:0px;background-color:#fff">
                                <div class="section_wrapper mcb-section-inner">
                                    <div class="wrap mcb-wrap mcb-wrap-fisa74pn3 one valign-top clearfix">
                                        <div class="mcb-wrap-inner">
                                            <div class="column mcb-column mcb-item-eyf6kgam2 one column_column">
                                                <div class="column_attr clearfix align_center reg_form" style="background-color:#fff;box-shadow: 0px 10px 30px rgba(55,43,125,.2); border-radius: 25px; ">
                                                    <h2 class="themecolor">Company Details</h2>
                                                    <hr class="no_line" style="margin: 0 auto 20px;">
                                                    <div id="contactWrapper">
                                                        <!-- @include('crud.inc.grouped_errors') -->
                                                        
                                                        <div class="column one">
                                                            <!-- One Second (1/2) Column -->
                                                            <div class="column one">
                                                                {{-- <label>Business Name</label> --}}
                                                                <input value="{{$business->name}}" placeholder="Business name" type="text" name="name" id="name" size="40" aria-required="true" aria-invalid="false"/>
                                                                @if($errors->has('name'))
                                                                    <div class="error"><strong>{{ $errors->first('name') }}</strong></div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                       
                                                        <div class="column one">
                                                            <div class="column one-second">
                                                                {{-- <label>Business Nature</label> --}}
                                                                <input value="{{$business->branch_name}}" placeholder="Branch Name (Optional)" type="text" name="branch_name" id="branch_name" size="40" aria-required="true" aria-invalid="false" />
                                                                @if($errors->has('branch_name'))
                                                                    <div class="error">{{ $errors->first('branch_name') }}</div>
                                                                @endif
                                                            </div>
                                                            <div class="column one-second">
                                                                {{-- <label>Business Nature</label> --}}
                                                                <input value="{{$business->nature}}" placeholder="Business Nature" type="text" name="business_nature" id="business_nature" size="40" aria-required="true" aria-invalid="false" />
                                                                @if($errors->has('business_nature'))
                                                                    <div class="error">{{ $errors->first('business_nature') }}</div>
                                                                @endif
                                                            </div>
                                                        </div>

                                                        <div class="column one">
                                                            {{-- <label>Business Category</label> --}}
                                                            <!-- One Second (1/2) Column -->
                                                            <div class="column one">
                                                                <select data-live-search="true" name="category_id" id="category_id" width="100%" style="min-width:100%">
                                                                    <option value="" hidden>Select Categories</option>
                                                                    @if(count($categories)>0)
                                                                        @foreach($categories as $k => $category)
                                                                            @if($business->category_id == $category->id )
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
                                                            <div class="column one">
                                                                <!-- <label>Baranggay</label> -->
                                                                <select multiple id="sub_category_id" placeholder="Select Sub-Categories" name="sub_category_id[]" width="100%" style="min-width:100%; min-height: 50px;" height="50px;">
                                                                    @if(count($subcategories)>0)
                                                                        @foreach($subcategories as $k => $category)
                                                                            <option value="{{$category->id}}"{{ (collect($tags)->contains($category->id)) ? 'selected':'' }}>{{$category->name}}</option>
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
                                                                {{-- <label>Address Line 1</label> --}}
                                                                <input value="{{$business->address1}}" placeholder="Room | Floor | Building Name | Lot No | Block No" type="text" name="address1" id="address1" size="40" aria-required="true" aria-invalid="false" />
                                                                @if($errors->has('address1'))
                                                                    <div class="error">{{ $errors->first('address1') }}</div>
                                                                @endif
                                                            </div>
                                                        </div>

                                                        {{-- <div class="column one">
                                                            <div class="column one">
                                                                <label>Address Line 2 </label>
                                                                <input value="{{$business->address2}}" placeholder="Address Line 2" type="text" name="address2" id="address2" size="40" aria-required="true" aria-invalid="false" />
                                                                @if($errors->has('address2'))
                                                                    <div class="error">{{ $errors->first('address2') }}</div>
                                                                @endif
                                                            </div>
                                                        </div> --}}
                                                        <div class="column one">
                                                            <div class="column one-third">
                                                                {{-- <label>Province</label> --}}
                                                                <input value="Pampanga" placeholder="Province" type="text" disabled name="province" id="province" size="40" aria-required="true" aria-invalid="false" />
                                                                @if($errors->has('province'))
                                                                    <div class="error">{{ $errors->first('province') }}</div>
                                                                @endif
                                                            </div>
                                                            <div class="column one-third">
                                                                {{-- <label>Municipality/City</label> --}}
                                                                <select id="municipality" name="municipality" value="{{$business->location_id}}">
                                                                    @if(count($location)>0)
                                                                        @foreach($location as $municipality)
                                                                            <!-- <option value="{{$municipality->id}}">{{$municipality->name}}</option> -->
                                                                            @if($business->location_id == $municipality->id )
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
                                                            <div class="column one-third">
                                                                {{-- <label>Baranggay</label> --}}
                                                                <select id="baranggay_id" name="baranggay_id">
                                                                    <option value="">Select Baranggay</option>
                                                                <select>
                                                                @if($errors->has('baranggay_id'))
                                                                    <div class="error">{{ $errors->first('baranggay_id') }}</div>
                                                                @endif
                                                            </div>
                                                           
                                                        </div>

                                                        <div class="column one">
                                                            <!-- One Second (1/3) Column -->
                                                            <div class="column one-third">
                                                                {{-- <label>Contact Person</label> --}}
                                                                <input value="{{$business->contact_person}}" placeholder="Contact Person" type="text" name="contact_person" id="contact_person" size="40" aria-required="true" aria-invalid="false" />
                                                                @if($errors->has('contact_person'))
                                                                    <div class="error">{{ $errors->first('contact_person') }}</div>
                                                                @endif
                                                            </div>
                                                            <div class="column one-third">
                                                                {{-- <label>Telephone No.</label> --}}
                                                                <input value="{{$business->telephone}}" placeholder="Telephone Number (Optional)" type="number" name="telephone_number" id="telephone_number" size="40" aria-required="true" aria-invalid="false" />
                                                                @if($errors->has('telephone_number'))
                                                                    <div class="error">{{ $errors->first('telephone_number') }}</div>
                                                                @endif
                                                            </div>
                                                            <div class="column one-third">
                                                                {{-- <label>Mobile No.</label> --}}
                                                                <input value="{{$business->mobile}}" placeholder="Mobile Number" type="number" name="mobile_number" id="mobile_number" size="40" aria-required="true" aria-invalid="false" />
                                                                @if($errors->has('mobile_number'))
                                                                    <div class="error">{{ $errors->first('mobile_number') }}</div>
                                                                @endif
                                                            </div>
                                                        </div>

                                                        <div class="column one">
                                                            <div class="column one-second">
                                                                {{-- <label>Email</label> --}}
                                                                <input value="{{$business->email}}" placeholder="Business e-mail" type="email" name="email" id="email" size="40" aria-required="true" aria-invalid="false" />
                                                                @if($errors->has('email'))
                                                                    <div class="error">{{ $errors->first('email') }}</div>
                                                                @endif
                                                            </div>
                                                            <div class="column one-second">
                                                                {{-- <label>Website</label> --}}
                                                                <input class="input_border" value="{{$business->website}}" placeholder="Business Website (Optional)" type="text" name="website" id="website" size="40" aria-required="true" aria-invalid="false" />
                                                                @if($errors->has('website'))
                                                                    <div class="error">{{ $errors->first('website') }}</div>
                                                                @endif
                                                            </div>
                                                        </div>

                                                        <div class="column one">
                                                            <div class="column one-third">
                                                                {{-- <label>Facebook</label> --}}
                                                                <input value="{{$business->facebook}}" placeholder="Facebook (Optional)" type="text" name="facebook" id="facebook" size="40" aria-required="true" aria-invalid="false" />
                                                                @if($errors->has('facebook'))
                                                                    <div class="error">{{ $errors->first('facebook') }}</div>
                                                                @endif
                                                            </div>
                                                            <div class="column one-third" style="display: -ms-flexbox; display: flex;">
                                                                {{-- <label>Twitter</label> --}}
                                                                <span class="btn-social" style="background: #FCA70B; color: white; min-width: 50px; text-align: center!important; font-size:25px;">@</span>
                                                                <input value="{{$business->twitter}}" placeholder="Twitter Username (Optional)" type="text" name="twitter" id="twitter" size="40" aria-required="true" aria-invalid="false" />
                                                                @if($errors->has('twitter'))
                                                                    <div class="error">{{ $errors->first('twitter') }}</div>
                                                                @endif
                                                            </div>
                                                            <div class="column one-third" style=" display: -ms-flexbox; display: flex;">
                                                                {{-- <label>Instagram</label> --}}
                                                                <span class="btn-social" style="background: #FCA70B; color: white; min-width: 50px; text-align: center!important; font-size:25px;">@</span>
                                                                <input value="{{$business->instagram}}" placeholder="Instagram Username (Optional)" type="text" name="instagram" id="instagram" size="40" aria-required="true" aria-invalid="false" />
                                                                @if($errors->has('instagram'))
                                                                    <div class="error">{{ $errors->first('instagram') }}</div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                       
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="section mcb-section mcb-section-uqnjs4egm" style="padding-top:50px;padding-bottom:20px;background-color:#fff">
                            <div class="section_wrapper mcb-section-inner">
                                <div class="wrap mcb-wrap mcb-wrap-fisa74pn3 one valign-top clearfix">
                                    <div class="mcb-wrap-inner">
                                        <div class="column mcb-column mcb-item-eyf6kgam2 one column_column">
                                            <div class="column_attr clearfix align_center reg_form" style="background-color:#fff;box-shadow: 0px 10px 30px rgba(55,43,125,.2); border-radius: 25px; ">
                                                <h2 class="themecolor">Company Profile</h2>
                                                <hr class="no_line" style="margin: 0 auto 20px;">
                                                <div id="contactWrapper">
                                                    <!-- @include('crud.inc.grouped_errors') -->
                                                    <div class="column one">
                                                        <div class="column one">
                                                            {{-- <label>About</label> --}}
                                                            <textarea class="ckeditor" id="about" name="about" placeholder="About (Optional)">{!!$business->about!!}</textarea>
                                                            @if($errors->has('about'))
                                                                <div class="error">{{ $errors->first('about') }}</div>
                                                            @endif
                                                        </div>
                                                        
                                                        <div class="column one">
                                                            {{-- <label>Business Description</label> --}}
                                                            <textarea id="business_description" name="business_description" placeholder="Business Description (Optional)">{!!$business->description!!}</textarea>
                                                            @if($errors->has('business_description'))
                                                                <div class="error">{{ $errors->first('business_description') }}</div>
                                                            @endif
                                                        </div>
                                                    </div>

                                                    <div class="column one">
                                                        <div class="column one">
                                                            {{-- <label>Business History</label> --}}
                                                            <textarea id="business_history" name="business_history" placeholder="Business History (Optional)">{{$business->history}}</textarea>
                                                            @if($errors->has('business_history'))
                                                                <div class="error">{{ $errors->first('business_history') }}</div>
                                                            @endif
                                                        </div>
                                                        <div class="column one">
                                                            {{-- <label>Purpose</label> --}}
                                                            <textarea id="purpose" name="purpose" placeholder="Purpose (Optional)">{{$business->purpose}}</textarea>
                                                            @if($errors->has('purpose'))
                                                                <div class="error">{{ $errors->first('purpose') }}</div>
                                                            @endif
                                                        </div>
                                                    </div>

                                                    <div class="column one">
                                                        <div class="column one">
                                                            {{-- <label>Mission Statement</label> --}}
                                                            <textarea id="mission" name="mission" placeholder="Mission (Optional)">{{$business->mission}}</textarea>
                                                            @if($errors->has('mission'))
                                                                <div class="error">{{ $errors->first('mission') }}</div>
                                                            @endif
                                                        </div>
                                                        <div class="column one">
                                                            {{-- <label>Vission Statement</label> --}}
                                                            <textarea id="vission" name="vission" placeholder="Vision (Optional)">{{$business->vission}}</textarea>
                                                            @if($errors->has('vission'))
                                                                <div class="error">{{ $errors->first('vission') }}</div>
                                                            @endif
                                                        </div>
                                                    </div>

                                                    <div class="column one">
                                                        <div class="column one">
                                                            {{-- <label>Core Values</label> --}}
                                                            <textarea id="core_values" name="core_values" placeholder="Core Values (Optional)">{{$business->core_values}}</textarea>
                                                            @if($errors->has('core_values'))
                                                                <div class="error">{{ $errors->first('core_values') }}</div>
                                                            @endif
                                                        </div>
                                                        <div class="column one">
                                                            {{-- <label>Business Goals</label> --}}
                                                            <textarea id="business_goals" name="business_goals" placeholder="Business Goals (Optional)">{!!$business->goals!!}</textarea>
                                                            @if($errors->has('business_goals'))
                                                                <div class="error">{{ $errors->first('business_goals') }}</div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="column one">
                                                        <div class="column one">
                                                            {{-- <label>Product $ Services</label> --}}
                                                            <textarea id="product_and_services" name="product_and_services" placeholder="Product $ Services (Optional)">{!!$business->product_services!!}</textarea>
                                                            @if($errors->has('product_and_services'))
                                                                <div class="error">{{ $errors->first('product_and_services') }}</div>
                                                            @endif
                                                        </div>
                                                        <div class="column one">
                                                            {{-- <label>Branches</label> --}}
                                                            <textarea id="branches" name="branches" placeholder="Branches (Optional)">{!!$business->branches!!}</textarea>
                                                            @if($errors->has('branches'))
                                                                <div class="error">{{ $errors->first('branches') }}</div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="column one">
                                                        <div class="column one-second">
                                                            {{-- <label>Latitude</label> --}}
                                                            <input value="{{$business->latitude}}" placeholder="Latitude (Optional)" type="text" name="latitude" id="latitude" size="40" aria-required="true" aria-invalid="false" />
                                                            @if($errors->has('latitude'))
                                                                <div class="error">{{ $errors->first('latitude') }}</div>
                                                            @endif
                                                        </div>
                                                        <div class="column one-second">
                                                            {{-- <label>Longitude</label> --}}
                                                            <input value="{{$business->longitude}}" placeholder="Longitude (Optional)" type="text" name="longitude" id="longitude" size="40" aria-required="true" aria-invalid="false" />
                                                            @if($errors->has('longitude'))
                                                                <div class="error">{{ $errors->first('longitude') }}</div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                     <div class="column one">
                                                        <div class="column one">
                                                        <strong><label>Logo</label></strong>
                                                            <input data-preview="#preview" name="business_logo" type="file" id="business_logo"><br><br>
                                                            <img width="250px" height="250px" class="col-sm-6" id="preview"  src="{{asset($business->logo)}}">
                                                            @if($errors->has('business_logo'))
                                                                <div class="error">{{ $errors->first('business_logo') }}</div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="column one">
                                                        <div class="column one align_center" style="text-align:center;">
                                                            <button id="btnRegister" style=" width: 100%;" name="btnRegister" type="submit" class="btn btn-success">Update</button>
                                                        </div>
                                                        <div class="column one align_center" style="text-align:center;">
                                                            <p class="big">
                                                                <strong>NOTE:</strong> If you are having difficulty in updating your business information kindly email the details at <a href="mailto:info@onepampanga.com?Subject=Inquiry from One Pampanga"><strong>info@onepampanga.com</strong></a> and we will help you update your business or services
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @include('partials.footer_search')
    @include('partials.footer')
</div>
<script>
    $("#sub_category_id").select2();
</script>
@endsection

@section('after_scripts')
<script src="{{ asset('vendor/backpack/ckeditor/ckeditor.js') }}"></script>
    <script>
        ClassicEditor.height = 500;      
        ClassicEditor.height = '25em';     // CSS length.
        ClassicEditor.height = '300px';     
        ClassicEditor
            .create( document.querySelector( '#about'), "extraPlugins" : 'oembed,widget,justify,font')
            .then( editor => {
                    console.log( editor );
            } )
            .catch( error => {
                    console.error( error );
            } );
        ClassicEditor
            .create( document.querySelector( '#business_description'), )
            .then( editor => {
                    console.log( editor );
            } )
            .catch( error => {
                    console.error( error );
            } );
        ClassicEditor
            .create( document.querySelector( '#business_history'), )
            .then( editor => {
                    console.log( editor );
            } )
            .catch( error => {
                    console.error( error );
            } );
        ClassicEditor
            .create( document.querySelector( '#purpose'), )
            .then( editor => {
                    console.log( editor );
            } )
            .catch( error => {
                    console.error( error );
            } );
        ClassicEditor
            .create( document.querySelector( '#mission'), )
            .then( editor => {
                    console.log( editor );
            } )
            .catch( error => {
                    console.error( error );
            } );
        ClassicEditor
            .create( document.querySelector( '#vission'), )
            .then( editor => {
                    console.log( editor );
            } )
            .catch( error => {
                    console.error( error );
            } );
        ClassicEditor
            .create( document.querySelector( '#core_values'), )
            .then( editor => {
                    console.log( editor );
            } )
            .catch( error => {
                    console.error( error );
            } );
        ClassicEditor
            .create( document.querySelector( '#business_goals'), )
            .then( editor => {
                    console.log( editor );
            } )
            .catch( error => {
                    console.error( error );
            } );
        ClassicEditor
            .create( document.querySelector( '#product_and_services'), )
            .then( editor => {
                    console.log( editor );
            } )
            .catch( error => {
                    console.error( error );
            } );
        ClassicEditor
            .create( document.querySelector( '#branches'), )
            .then( editor => {
                    console.log( editor );
            } )
            .catch( error => {
                    console.error( error );
            } );
    </script>
    <script>
        $(document).ready(function () {
            
            var menu = $('#menu');
            // $('#' + indexValue).addClass("selectedQuestion");
            $('li[id=faq_menu]').addClass("current-menu-item")
            $("#get_listed").remove();
            $(window).on('load', function() {
                menu.addClass('onload');
            });
            $(window).on('scroll', function() {
                if ($(window).scrollTop()  === 0) {
                    menu.removeClass('scroll');
                    menu.addClass('onload');
                } else {
                    menu.removeClass('onload');
                    menu.addClass('scroll');
                }

            });
        });
        $('#business_logo').on('change', function() {
            readURL(this);
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
    </script>
    <script>
        // $("#terms_and_condition").click(function() {
        //     $("#btnRegister").attr("disabled", !this.checked);
        // });
        // CALL WHEN USER CHANGE THE CATEGORY
        function getBaranggays(){
            var old = {{$business->baranggay_id}}
            console.log({{$business->baranggay_id}}); // DO NOT REMOVE
            if($('select[name="municipality"').find(":selected").val() != '')
            {
                $.ajax({
                    url: "api/get-baranggays", 
                    data:{
                        municipality_id: $('select[name="municipality"').find(":selected").val(),
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
            getBaranggays();
        });
    </script>
@endsection


