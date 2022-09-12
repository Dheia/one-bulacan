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
    <script src="{{asset('js/ckeditor.js')}}"></script>
    <script src="{{asset('js/select2.min.js')}}"></script>
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
                                                        <h2 class="themecolor">Registered Sucessfully!</h2> 
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
                        <form class="align_center" id="registration_form"  method="POST" action="{{url('submit_registration')}}" enctype="multipart/form-data">
                            @csrf
                            {!! csrf_field() !!}
                            <div class="section mcb-section mcb-section-uqnjs4egm" style="padding-top:0px;background-color:#fff">
                                <div class="section_wrapper mcb-section-inner">
                                    <div class="wrap mcb-wrap mcb-wrap-fisa74pn3 one valign-top clearfix">
                                        <div class="mcb-wrap-inner">
                                            <div class="column mcb-column mcb-item-eyf6kgam2 one column_column">
                                                <div class="column_attr clearfix align_center reg_form" style="background-color:#fff; box-shadow: 0px 10px 30px rgba(55,43,125,.2); border-radius: 25px; ">
                                                    <h2 class="themecolor">Company Details</h2>
                                                    <hr class="no_line" style="margin: 0 auto 20px;">
                                                    <div id="contactWrapper">
                                                        <!-- @include('crud.inc.grouped_errors') -->
                                                        
                                                        <div class="column one">
                                                            <!-- One Second (1/2) Column -->
                                                            <div class="column one">
                                                                {{-- <label>Business Name</label> --}}
                                                                <input value="{{old('name')}}" placeholder="Business name" type="text" name="name" id="name" size="40" aria-required="true" aria-invalid="false"/>
                                                                @if($errors->has('name'))
                                                                    <div class="error"><strong>{{ $errors->first('name') }}</strong></div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                       
                                                        <div class="column one">
                                                            <div class="column one-second">
                                                                {{-- <label>Business Nature</label> --}}
                                                                <input value="{{old('branch_name')}}" placeholder="Branch Name (Optional)" type="text" name="branch_name" id="branch_name" size="40" aria-required="true" aria-invalid="false" />
                                                                @if($errors->has('branch_name'))
                                                                    <div class="error">{{ $errors->first('branch_name') }}</div>
                                                                @endif
                                                            </div>
                                                            <div class="column one-second">
                                                                {{-- <label>Business Nature</label> --}}
                                                                <input value="{{old('business_nature')}}" placeholder="Business Nature" type="text" name="business_nature" id="business_nature" size="40" aria-required="true" aria-invalid="false" />
                                                                @if($errors->has('business_nature'))
                                                                    <div class="error">{{ $errors->first('business_nature') }}</div>
                                                                @endif
                                                            </div>
                                                        </div>

                                                        <div class="column one">
                                                            <div class="column one-second">
                                                                {{-- <label>About</label> --}}
                                                                <textarea id="about" name="about" placeholder="About (Optional)">{{old('about')}}</textarea>
                                                                @if($errors->has('about'))
                                                                    <div class="error">{{ $errors->first('about') }}</div>
                                                                @endif
                                                            </div>
                                                            <div class="column one-second">
                                                                {{-- <label>Business Description</label> --}}
                                                                <textarea id="business_description" name="business_description" placeholder="Business Description (Optional)">{{old('business_description')}}</textarea>
                                                                @if($errors->has('business_description'))
                                                                    <div class="error">{{ $errors->first('business_description') }}</div>
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
                                                            <div class="column one">
                                                                <!-- <label>Baranggay</label> -->
                                                                <select multiple id="sub_category_id" placeholder="Select Sub-Categories" name="sub_category_id[]" width="100%" style="min-width:100%; min-height: 50px;" height="50px;">
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
                                                                {{-- <label>Address Line 1</label> --}}
                                                                <input value="{{old('address1')}}" placeholder="Room | Floor | Building Name | Lot No | Block No" type="text" name="address1" id="address1" size="40" aria-required="true" aria-invalid="false" />
                                                                @if($errors->has('address1'))
                                                                    <div class="error">{{ $errors->first('address1') }}</div>
                                                                @endif
                                                            </div>
                                                        </div>

                                                        {{-- <div class="column one">
                                                            <div class="column one">
                                                                <label>Address Line 2 </label>
                                                                <input value="{{old('address2')}}" placeholder="Address Line 2" type="text" name="address2" id="address2" size="40" aria-required="true" aria-invalid="false" />
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
                                                                <select id="municipality" name="municipality" value="{{old('municipality')}}">
                                                                <option value="">Select Municipality</option>
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
                                                                <input value="{{old('contact_person')}}" placeholder="Contact Person" type="text" name="contact_person" id="contact_person" size="40" aria-required="true" aria-invalid="false" />
                                                                @if($errors->has('contact_person'))
                                                                    <div class="error">{{ $errors->first('contact_person') }}</div>
                                                                @endif
                                                            </div>
                                                            <div class="column one-third">
                                                                {{-- <label>Telephone No.</label> --}}
                                                                <input value="{{old('telephone_number')}}" placeholder="Telephone Number (Optional)" type="number" name="telephone_number" id="telephone_number" size="40" aria-required="true" aria-invalid="false" />
                                                                @if($errors->has('telephone_number'))
                                                                    <div class="error">{{ $errors->first('telephone_number') }}</div>
                                                                @endif
                                                            </div>
                                                            <div class="column one-third">
                                                                {{-- <label>Mobile No.</label> --}}
                                                                <input value="{{old('mobile_number')}}" placeholder="Mobile Number" type="number" name="mobile_number" id="mobile_number" size="40" aria-required="true" aria-invalid="false" />
                                                                @if($errors->has('mobile_number'))
                                                                    <div class="error">{{ $errors->first('mobile_number') }}</div>
                                                                @endif
                                                            </div>
                                                        </div>

                                                        <div class="column one">
                                                            <div class="column one-second">
                                                                {{-- <label>Email</label> --}}
                                                                <input value="{{old('email')}}" placeholder="Business e-mail" type="email" name="email" id="email" size="40" aria-required="true" aria-invalid="false" />
                                                                @if($errors->has('email'))
                                                                    <div class="error">{{ $errors->first('email') }}</div>
                                                                @endif
                                                            </div>
                                                            <div class="column one-second">
                                                                {{-- <label>Website</label> --}}
                                                                <input class="input_border" value="{{old('website')}}" placeholder="Business Website (Optional)" type="text" name="website" id="website" size="40" aria-required="true" aria-invalid="false" />
                                                                @if($errors->has('website'))
                                                                    <div class="error">{{ $errors->first('website') }}</div>
                                                                @endif
                                                            </div>
                                                        </div>

                                                        <div class="column one">
                                                            <div class="column one-third">
                                                                {{-- <label>Facebook</label> --}}
                                                                <input value="{{old('facebook')}}" placeholder="Facebook (Optional)" type="text" name="facebook" id="facebook" size="40" aria-required="true" aria-invalid="false" />
                                                                @if($errors->has('facebook'))
                                                                    <div class="error">{{ $errors->first('facebook') }}</div>
                                                                @endif
                                                            </div>
                                                            <div class="column one-third" style="display: -ms-flexbox; display: flex;">
                                                                {{-- <label>Twitter</label> --}}
                                                                <span class="btn-social" style="background: #FCA70B; color: white; min-width: 50px; text-align: center!important; font-size:25px;">@</span>
                                                                <input value="{{old('twitter')}}" placeholder="Twitter Username (Optional)" type="text" name="twitter" id="twitter" size="40" aria-required="true" aria-invalid="false" />
                                                                @if($errors->has('twitter'))
                                                                    <div class="error">{{ $errors->first('twitter') }}</div>
                                                                @endif
                                                            </div>
                                                            <div class="column one-third" style=" display: -ms-flexbox; display: flex;">
                                                                {{-- <label>Instagram</label> --}}
                                                                <span class="btn-social" style="background: #FCA70B; color: white; min-width: 50px; text-align: center!important; font-size:25px;">@</span>
                                                                <input value="{{old('instagram')}}" placeholder="Instagram Username (Optional)" type="text" name="instagram" id="instagram" size="40" aria-required="true" aria-invalid="false" />
                                                                @if($errors->has('instagram'))
                                                                    <div class="error">{{ $errors->first('instagram') }}</div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="column one">
                                                            <div class="column one">
                                                            <strong><label>Logo</label></strong>
                                                                <input data-preview="#preview" name="" type="file" id="business_logo"> <br>                                                          
                                                                <img width="300px" height="300px" class="col-sm-6" id="preview"  src="">
                                                                @if($errors->has('business_logo'))
                                                                    <div class="error">{{ $errors->first('business_logo') }}</div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="column one">
                                                            <div class="column one">
                                                                <p class="big"><strong>How did you know about OnePampanga?</strong></p>
                                                            </div>
                                                            <div class="column one-second">
                                                                <select name="survey" id="survey" width="100%" style="min-width:100%; text-align: center;">
                                                                    <option value="" hidden> Please select </option>
                                                                    @if(old('survey') == 'Search Engines' )
                                                                        <option value="Search Engines" selected>Search Engines ( Google)</option>
                                                                        <option value="Referral" >Referral</option>
                                                                        <option value="Social Media" >Social Media (Facebook)</option>
                                                                    @elseif((old('survey') == 'Referral' ))
                                                                        <option value="Search Engines">Search Engines ( Google)</option>
                                                                        <option value="Referral" selected>Referral</option>
                                                                        <option value="Social Media" >Social Media (Facebook)</option>
                                                                    @elseif((old('survey') == 'Social Media' ))
                                                                        <option value="Search Engines">Search Engines ( Google)</option>
                                                                        <option value="Referral" >Referral</option>
                                                                        <option value="Social Media" selected>Social Media (Facebook)</option>
                                                                    @else
                                                                        <option value="" hidden> Please select </option>
                                                                        <option value="Search Engines" >Search Engines ( Google)</option>
                                                                        <option value="Referral" >Referral</option>
                                                                        <option value="Social Media" >Social Media (Facebook)</option>
                                                                    @endif
                                                                </select>
                                                                @if($errors->has('survey'))
                                                                    <div class="error">{{ $errors->first('survey') }}</div>
                                                                @endif
                                                            </div>
                                                            {{-- <input style="" type="radio" id="survey" name="survey" value="Search Engines" @if(old('survey') == 'Search Engines') checked @endif> Search Engines ( Google)
                                                            <input type="radio" id="survey" name="survey" value="Referral" @if(old('survey') == 'Referral') checked @endif> Referral
                                                            <input type="radio" id="survey" name="survey" value="Social Media" @if(old('survey') == 'Social Media') checked @endif> Social Media (Facebook)<br> --}}
                                                            <div class="column one-second">
                                                                <input type="text" style="visibility:hidden;" name="referred_by" id="referred_by" placeholder="Referred by" value="{{old('referred_by')}}"/>
                                                            </div>
                                                        </div>
                                                        <div class="column one">
                                                            <div class="column one">
                                                                <p class="big"><strong>DATA PRIVACY CONSENT</strong><br>
                                                                    By submitting this registration form, you are hereby giving PROJECT ONE to collect and process your personal and business information. If you want to know how your information is being processed, kindly visit <a href="http://onepampanga.com/privacy">onepampanga.com/privacy</a>
                                                                    
                                                                </p>
                                                            </div>
                                                            <div class="column one">
                                                                <input type="checkbox" id="terms_and_condition" name="terms_and_condition"> I agree<br>
                                                                @if($errors->has('terms_and_condition'))
                                                                    <div class="error">{{ $errors->first('terms_and_condition') }}</div>
                                                                @endif
                                                            </div>
                                                            <div class="column one align_center" style="text-align:center;">
                                                                <button id="btnRegister" style=" width: 100%;" name="btnRegister" type="submit" class="btn btn-success">Register</button>
                                                            </div>
                                                            <div class="column one align_center" style="text-align:center;">
                                                                <p class="big">
                                                                    <strong>NOTE:</strong> If you are having difficulty in registering kindly email the details at <a href="mailto:{{Config('settings.contact_email')}}?Subject=Inquiry from One Pampanga"><strong>{{Config('settings.contact_email')}}</strong></a> and we will help you register your business or services
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
            var old = {{old('baranggay_id')}}
            console.log({{old('baranggay_id')}}); // DO NOT REMOVE
            if($('select[name="municipality"').find(":selected").val() != '')
            {
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
            getBaranggays();
        });
    </script>
@endsection


