@extends('v2.layouts.app2')

@section('body_class', "color-custom style-simple button-flat layout-full-width no-content-padding header-split minimalist-header-no sticky-header sticky-tb-color ab-hide subheader-both-center menu-link-color menuo-no-borders mobile-tb-center mobile-side-slide mobile-mini-mr-ll tablet-sticky mobile-header-mini mobile-sticky tr-header tr-menu tr-content be-reg-209621")

@section('before_styles')
    <link rel='stylesheet' href="{{ asset('css/select2.css')}}">
@endsection

@section('before_scripts')
    <!-- JS FOR REGISTRATION -->
    <script src="{{asset('js/jquery-3.1.0.min.js')}}"></script>
    <script src="{{asset('js/select2.min.js')}}"></script>
@endsection

@section('content')
<div id="Wrapper">
    <div id="Header_wrapper">
        <header id="Header">
            @include('v2.partials.top_bar')
        </header>
    </div>
    <div id="Content">
        <div class="content_wrapper clearfix">
            <div class="sections_group">
                <div class="entry-content">
                    <div class="section mcb-section bg-cover" style="padding-bottom:15px; background-color:#120905; background-image:url({{ url('v2/content/one/images/contact-main-bg.jpg')}}); background-repeat:no-repeat; background-position:center top; min-height: 60px;">
                        <div class="section_wrapper mcb-section-inner">
                            <div class="wrap mcb-wrap one valign-top clearfix">
                                <div class="mcb-wrap-inner">
                                    <div class="column mcb-column one column_column">
                                        <div class="column_attr clearfix align_center" style="padding-top:150px;">
                                            @if(session()->has('success'))
                                                <i class="fas fa-check-circle fa-7x" style="color: #ddcfbc"></i>
                                                <h2 class="themecolor">
                                                    <b>Business Information Updated Sucessfully!</b>
                                                </h2>
                                            @else
                                                <h1 style="color:#ddcfbc">{{ $business->name }}</h1>
                                                <p class="themecolor">
                                                    <b>Gain better online presence for FREE!</b>
                                                </p>
                                            @endif
                                            <hr class="no_line" style="margin:0 auto 50px">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @if(!session()->has('success'))
                    <div class="section mcb-section" style="padding-top:0px; padding-bottom:175px; background-repeat:no-repeat; background-position:center top; background-size: cover;">
                        <div class="section_wrapper mcb-section-inner">
                            
                            <div class="wrap mcb-wrap one-third valign-top move-up clearfix" style="padding:50px 5% 10px; margin-top:-30px; background-image:url({{url('v2/content/one/images/contact-form-bg.jpg')}}); background-repeat:no-repeat; background-position:right bottom; background-size: cover;" data-mobile="no-up">

                                <div class="column one">
                                    
                                    <img width="250px" height="250px" class="col-sm-6" id="preview"  src="{{asset($business->logo)}}">
                                    @if($errors->has('business_logo'))
                                        <div class="error">{{ $errors->first('business_logo') }}</div>
                                    @endif

                                    <input data-preview="#preview" name="business_logo" type="file" id="business_logo"><br><br>
                                </div>

                                <h4>Business Information</h4>
                                <p class="aligncenter"><strong>{{ $business->name }}</strong></p>
                                <p><strong>Expired :</strong> {{ date("F d, Y", strtotime($business->end_at)) }}</p>
                                @if($business->featured_business)
                                    @if($business->featured_business->status == 'FOR RENEWAL' || $business->featured_business->status == 'ACTIVE')
                                        <p><strong>Subscription :</strong> Premium</p>
                                    @else
                                        <p><strong>Subscription :</strong> Free</p>
                                    @endif
                                @else
                                    <p><strong>Subscription :</strong> Free</p>
                                @endif

                                @if($business->status == 'FOR RENEWAL' || $business->status == 'ACTIVE')
                                        <p><strong>Status :</strong> Active</p>
                                    @else
                                        <p><strong>Status :</strong> Inactive</p>
                                    @endif
    
                            </div>


                            <form class="aligncenter" id="registration_form"  method="POST" action="{{url($business->id.'/'.$business->slug.'/update')}}" enctype="multipart/form-data">
                                @csrf
                                {{-- FIRST FORM --}}
                                <div class="wrap mcb-wrap two-third valign-top move-up clearfix" style="padding:50px 5% 10px; margin-top:-30px; background-image:url({{url('v2/content/one/images/contact-form-bg.jpg')}}); background-repeat:no-repeat; background-position:right bottom; background-size: cover;" data-mobile="no-up">
                                    <div class="mcb-wrap-inner">
                                        <div class="column mcb-column one column_column">
                                            <div class="column_attr clearfix">
                                                <h5>COMPANY DETAILS</h5>
                                                <hr class="no_line" style="margin:0 auto 15px">
                                                <div id="contactWrapper">
                                                    
                                                        <div class="column one">
                                                            <!-- One Second (1/2) Column -->
                                                            <div class="column one-second">
                                                                <input class="br-5" required placeholder="Business Name" type="text" name="name" id="name" size="40" aria-required="true" aria-invalid="false" value="{{old('name') ? old('name') : $business->name}}"/>
                                                                @if($errors->has('name'))
                                                                    <div class="error">{{ $errors->first('name') }}</div>
                                                                @endif
                                                            </div>
                                                            <!-- One Second (1/2) Column -->
                                                            <div class="column one-second">
                                                                <input class="br-5" placeholder="Branch Name (Optional)" type="text" name="branch_name" id="branch_name" size="40" aria-required="true" aria-invalid="false" value="{{old('branch_name') ? old('branch_name') : $business->branch_name}}"/>
                                                                @if($errors->has('branch_name'))
                                                                    <div class="error">{{ $errors->first('branch_name') }}</div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="column one">
                                                            <div class="column one">
                                                                <input placeholder="Nature of Business" type="text" name="business_nature" id="business_nature" size="40" aria-invalid="false" value="{{old('business_nature') ? old('business_nature') : $business->nature}}"/>
                                                                @if($errors->has('business_nature'))
                                                                    <div class="error">{{ $errors->first('business_nature') }}</div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="column one">
                                                            <!-- One Second (1/2) Column -->
                                                            <div class="column one">
                                                                <select data-live-search="true" name="category_id" id="category_id" width="100%" style="min-width:100%;">
                                                                    <option style="color: #929292 !important;" value="" hidden>Select Categories</option>
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
                                                            <!-- One Second (1/2) Column -->
                                                            <div class="column one">
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
                                                                <input value="{{old('address1') ? old('address1') : $business->address1}}" placeholder="Room | Floor | Building Name | Lot No | Block No" type="text" name="address1" id="address1" size="40" aria-required="true" aria-invalid="false" />
                                                                @if($errors->has('address1'))
                                                                    <div class="error">{{ $errors->first('address1') }}</div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="column one">
                                                            <!-- (1/3) Column -->
                                                            <div class="column one-third">
                                                                <input value="Pampanga" placeholder="Province" type="text" disabled name="province" id="province" size="40" aria-required="true" aria-invalid="false" />
                                                                @if($errors->has('province'))
                                                                    <div class="error">{{ $errors->first('province') }}</div>
                                                                @endif
                                                            </div>
                                                            <!-- (1/3) Column -->
                                                            <div class="column one-third">
                                                                <select required id="municipality" name="municipality" value="{{old('municipality')}}">
                                                                    <option value="" hidden>Select Municipality</option>
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
                                                            <!-- (1/3) Column -->
                                                            <div class="column one-third">
                                                                <select required id="baranggay_id" name="baranggay_id" style="color: #929292;">
                                                                    <option value="">Select Baranggay</option>
                                                                <select>
                                                                @if($errors->has('baranggay_id'))
                                                                    <div class="error">{{ $errors->first('baranggay_id') }}</div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="column one">
                                                            <!-- (1/3) Column -->
                                                            <div class="column one-third">
                                                                <input value="{{old('contact_person') ? old('contact_person') : $business->contact_person}}" placeholder="Contact Person" type="text" name="contact_person" id="contact_person" size="40" aria-required="true" aria-invalid="false" />
                                                                @if($errors->has('contact_person'))
                                                                    <div class="error">{{ $errors->first('contact_person') }}</div>
                                                                @endif
                                                            </div>
                                                            <!-- (1/3) Column -->
                                                            <div class="column one-third">
                                                                <input value="{{old('telephone_number') ? old('telephone_number') : $business->telephone}}" placeholder="Telephone Number" type="number" name="telephone_number" id="telephone_number" size="40" aria-required="true" aria-invalid="false" />
                                                                @if($errors->has('telephone_number'))
                                                                    <div class="error">{{ $errors->first('telephone_number') }}</div>
                                                                @endif
                                                            </div>
                                                            <!-- (1/3) Column -->
                                                            <div class="column one-third">
                                                                <input value="{{old('mobile_number') ? old('mobile_number') : $business->mobile}}" placeholder="Mobile Number" type="number" name="mobile_number" id="mobile_number" size="40" aria-required="true" aria-invalid="false" />
                                                                @if($errors->has('mobile_number'))
                                                                    <div class="error">{{ $errors->first('mobile_number') }}</div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="column one">
                                                            <!-- One Second (1/2) Column -->
                                                            <div class="column one-second">
                                                                <input value="{{old('email') ? old('email') : $business->email}}" placeholder="Business Email Address" type="email" name="email" id="email" size="40" aria-required="true" aria-invalid="false" />
                                                                @if($errors->has('email'))
                                                                    <div class="error">{{ $errors->first('email') }}</div>
                                                                @endif
                                                            </div>
                                                            <!-- One Second (1/2) Column -->
                                                            <div class="column one-second">
                                                                <input class="input_border" value="{{old('website') ? old('website') : $business->website}}" placeholder="Business Website (Optional)" type="text" name="website" id="website" size="40" aria-required="true" aria-invalid="false" />
                                                                @if($errors->has('website'))
                                                                    <div class="error">{{ $errors->first('website') }}</div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="column one">
                                                            <!-- (1/3) Column -->
                                                            <div class="column one-third">
                                                                <input value="{{old('facebook') ? old('facebook') : $business->facebook}}" placeholder="Facebook Link" type="text" name="facebook" id="facebook" size="40" aria-required="true" aria-invalid="false" />
                                                                @if($errors->has('facebook'))
                                                                    <div class="error">{{ $errors->first('facebook') }}</div>
                                                                @endif
                                                            </div>
                                                            <!-- (1/3) Column -->
                                                             <div class="column one-third" style="display: -ms-flexbox; display: flex;">
                                                                    {{-- <label>Twitter</label> --}}
                                                                    <span class="btn-social" style="background: #ffd266; color: white; min-width: 30px; text-align: center!important; font-size:18px; padding-top: 5px;">@</span>
                                                                    <input value="{{old('twitter') ? old('twitter') : $business->twitter}}" placeholder="Twitter Username" type="text" name="twitter" id="twitter" size="40" aria-required="true" aria-invalid="false" />
                                                                    @if($errors->has('twitter'))
                                                                        <div class="error">{{ $errors->first('twitter') }}</div>
                                                                    @endif
                                                                </div>
                                                            <!-- (1/3) Column -->
                                                            <div class="column one-third" style=" display: -ms-flexbox; display: flex;">
                                                                {{-- <label>Instagram</label> --}}
                                                                <span class="btn-social" style="background: #ffd266; color: white; min-width: 30px; text-align: center!important; font-size:18px; padding-top: 5px;">@</span>
                                                                <input value="{{old('instagram') ? old('instagram') : $business->instagram}}" placeholder="Instagram Username" type="text" name="instagram" id="instagram" size="40" aria-required="true" aria-invalid="false" />
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
                                    
                                {{-- FORM DIVIDER --}}
                                <div class="column mcb-column one column_placeholder">
                                    <div class="placeholder">
                                        &nbsp;
                                    </div>
                                </div>
                                
                               
                                
                                {{-- SECOND FORM --}}
                                <div id="companyProfile" class="wrap mcb-wrap one valign-top move-up clearfix" style="padding:50px 5% 10px; margin-top:-30px; background-image:url({{url('v2/content/one/images/contact-form-bg.jpg')}}); background-repeat:no-repeat; background-position:right bottom; background-size: cover; display: none;" data-mobile="no-up">
                                    <div class="mcb-wrap-inner">
                                        <div class="column mcb-column one column_column">
                                            <div class="column_attr clearfix">
                                                <h5>COMPANY PROFILE</h5>
                                                <hr class="no_line" style="margin:0 auto 15px">
                                                <div id="contactWrapper">
                                                        {{-- ABOUT --}}
                                                        <div class="column one">
                                                            <!-- One (1) Column About -->
                                                            <div class="column one">
                                                                <label>About</label>
                                                                <textarea class="ckeditor" id="about" name="about" placeholder="About (Optional)">{!!old('about') ? old('about') : $business->about!!}</textarea>
                                                                @if($errors->has('about'))
                                                                    <div class="error">{{ $errors->first('about') }}</div>
                                                                @endif
                                                            </div>
                                                            <!-- One (1) Column Description -->
                                                            <div class="column one">
                                                                <label>Description</label>
                                                                <textarea class="ckeditor" id="business_description" name="business_description" placeholder="Business Description (Optional)">{!!old('business_description') ? old('business_description') : $business->description!!}</textarea>
                                                                @if($errors->has('business_description'))
                                                                    <div class="error">{{ $errors->first('business_description') }}</div>
                                                                @endif
                                                            </div>
                                                            <!-- One (1) Column History -->
                                                            <div class="column one">
                                                                <label>Business History</label>
                                                                <textarea class="ckeditor" id="business_history" name="business_history" placeholder="Business History (Optional)">{!!old('business_history') ? old('business_history') : $business->history!!}</textarea>
                                                                @if($errors->has('business_history'))
                                                                    <div class="error">{{ $errors->first('business_history') }}</div>
                                                                @endif
                                                            </div>
                                                            <!-- One (1) Column Purpose -->
                                                            <div class="column one">
                                                                <label>Purpose</label>
                                                                <textarea class="ckeditor" id="purpose" name="purpose" placeholder="Purpose (Optional)">{!!old('purposse') ? old('purposse') : $business->purpose!!}</textarea>
                                                                @if($errors->has('purpose'))
                                                                    <div class="error">{{ $errors->first('purpose') }}</div>
                                                                @endif
                                                            </div>
                                                            <!-- One (1) Column Mission -->
                                                            <div class="column one">
                                                                <label>Mission</label>
                                                                <textarea class="ckeditor" id="mission" name="mission" placeholder="Mission (Optional)">{{old('mission') ? old('mission') : $business->mission}}</textarea>
                                                                @if($errors->has('mission'))
                                                                    <div class="error">{{ $errors->first('mission') }}</div>
                                                                @endif
                                                            </div>
                                                            <!-- One (1) Column Vision -->
                                                            <div class="column one">
                                                                <label>Vision</label>
                                                                <textarea class="ckeditor" id="vission" name="vission" placeholder="Vision (Optional)">{!!old('vission') ? old('vission') : $business->vission!!}</textarea>
                                                                @if($errors->has('vission'))
                                                                    <div class="error">{{ $errors->first('vission') }}</div>
                                                                @endif
                                                            </div>
                                                            <!-- One (1) Column Core Values -->
                                                            <div class="column one">
                                                                <label>Core Values</label>
                                                                <textarea class="ckeditor" id="core_values" name="core_values" placeholder="Core Values (Optional)">{{old('core_values') ? old('core_values') : $business->core_values}}</textarea>
                                                                @if($errors->has('core_values'))
                                                                    <div class="error">{!! $errors->first('core_values') !!}</div>
                                                                @endif
                                                            </div>
                                                            <!-- One (1) Column Business Goals -->
                                                            <div class="column one">
                                                                <label>Business Goals</label>
                                                                <textarea class="ckeditor" id="business_goals" name="business_goals" placeholder="Business Goals (Optional)">{!!old('business_goals') ? old('business_goals') : $business->goals!!}</textarea>
                                                                @if($errors->has('business_goals'))
                                                                    <div class="error">{{ $errors->first('business_goals') }}</div>
                                                                @endif
                                                            </div>
                                                            <!-- One (1) Column Product $ Services -->
                                                            <div class="column one">
                                                                <label>Product and Services</label>
                                                                <textarea class="ckeditor" id="product_and_services" name="product_and_services" placeholder="Product $ Services (Optional)">{!!old('product_and_services') ? old('product_and_services') : $business->product_services!!}</textarea>
                                                                @if($errors->has('product_and_services'))
                                                                    <div class="error">{{ $errors->first('product_and_services') }}</div>
                                                                @endif
                                                            </div>
                                                            <!-- One (1) Column Branches -->
                                                            <div class="column one">
                                                                <label>Branches</label>
                                                                <textarea class="ckeditor" id="branches" name="branches" placeholder="Branches (Optional)">{!!old('branches') ? old('branches') : $business->branches!!}</textarea>
                                                                @if($errors->has('branches'))
                                                                    <div class="error">{{ $errors->first('branches') }}</div>
                                                                @endif
                                                            </div>
                                                            <!-- One (1) Column Latitude -->
                                                            <div class="column one-second">
                                                                <label>Latitude</label>
                                                                <input value="" placeholder="Latitude (Optional)" type="text" name="latitude" id="latitude" size="40" aria-required="true" aria-invalid="fal{!!old('latitude') ? old('latitude') : $business->latitude!!}se" />
                                                                @if($errors->has('latitude'))
                                                                    <div class="error">{{ $errors->first('latitude') }}</div>
                                                                @endif
                                                            </div>
                                                            <!-- One (1) Column Longitude -->
                                                            <div class="column one-second">
                                                                <label>Longitude</label>
                                                                <input value="{!!old('longitude') ? old('longitude') : $business->longitude!!}" placeholder="Longitude (Optional)" type="text" name="longitude" id="longitude" size="40" aria-required="true" aria-invalid="false" />
                                                                @if($errors->has('longitude'))
                                                                    <div class="error">{{ $errors->first('longitude') }}</div>
                                                                @endif
                                                            </div>
                                                            <!-- One (1) Column LOGO -->
                                                            
                                                            {{-- UPDATE BUTTON --}}
                                                            <div class="column one aligncenter" style="text-align:center;">
                                                                <button id="btnRegister" style=" width: 100%;" name="btnRegister" type="submit" class="btn btn-success">Update</button>
                                                            </div>
                                                            <div class="column one aligncenter">
                                                                <p >
                                                                    <strong>NOTE:</strong> If you are having difficulty in updating your business information kindly email the details at <a href="mailto:info@onepampanga.com?Subject=Inquiry from One Pampanga"><strong>info@onepampanga.com</strong></a> and we will help you update your business or services
                                                                </p>
                                                            </div>
                                                        </div>

                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </form>
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
                        <div class="section-decoration bottom" style="background-image:url({{url('v2/content/one/images/footer-top-bg.png')}});height:109px"></div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @include('v2.partials.footer_search')
    @include('v2.partials.footer')
</div>
<script>
    $("#sub_category_id").select2();
</script>
@endsection

@section('after_scripts')
    <script src="{{ asset('vendor/backpack/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('vendor/backpack/ckeditor/adapters/jquery.js') }}"></script>
    <script>
        $('.ckeditor').ckeditor({
            "filebrowserBrowseUrl": "{{ url(config('backpack.base.route_prefix').'/elfinder/ckeditor') }}",
            
            "extraPlugins" : '{{ isset($field['extra_plugins']) ? implode(',', $field['extra_plugins']) : 'oembed,widget,justify,font' }}'
            @if (isset($field['options']) && count($field['options']))
                {!! ', '.trim(json_encode($field['options']), "{}") !!}
            @endif
        });
    </script>
    <script>
        $(document).ready(function () {
            
            var menu = $('#menu');
            // $('#' + indexValue).addClass("selectedQuestion");
            $('li[id=faq_menu]').addClass("current-menu-item")
            $("#get_listed").remove();
            $(window).on('load', function() {
                menu.addClass('onload');
                // Show Company Profile
                $('#companyProfile').show();
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


