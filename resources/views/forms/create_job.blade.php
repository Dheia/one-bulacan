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
                {{-- <h1 class="themecolor">Job</h1> --}}
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
                                                <h2 class="themecolor">Created Sucessfully!</h2>
                                                <div id="contactWrapper" style="text-align: center;">
                                                    <div class="alert alert-success" style="text-align: center;">
                                                        <i class="fas fa-check-circle fa-5x"></i>
                                                        <br>
                                                        {{ session()->get('success') }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                    <form class="align_center" id="registration_form"  method="POST" action="{{url('submit-job')}}" enctype="multipart/form-data">
                        @csrf
                        {!! csrf_field() !!}
                        <div class="section mcb-section mcb-section-uqnjs4egm" style="padding-top:0px;background-color:#fff">
                            <div class="section_wrapper mcb-section-inner">
                                <div class="wrap mcb-wrap mcb-wrap-fisa74pn3 one valign-top clearfix">
                                    <div class="mcb-wrap-inner">
                                        <div class="column mcb-column mcb-item-eyf6kgam2 one column_column">
                                            <div class="column_attr clearfix align_center reg_form" style="background-color:#fff;box-shadow: 0px 10px 30px rgba(55,43,125,.2); border-radius: 25px; ">
                                                <h2 class="themecolor">Job Details</h2>
                                                <hr class="no_line" style="margin: 0 auto 20px;">
                                                <div id="contactWrapper">
                                                    <!-- @include('crud.inc.grouped_errors') -->
                                                    <div class="column one">
                                                        <!-- One Second (1/2) Column -->
                                                        <div class="column one">
                                                            <label>Is your business registered in One Pampanga?</label>
                                                            <select data-live-search="true" name="registered" id="registered" width="100%" style="min-width:100%">
                                                                <option value="1">Registered</option>
                                                                <option value="0">Not Registered</option>
                                                            </select>
                                                            @if($errors->has('registered'))
                                                                <div class="error"><strong>{{ $errors->first('registered') }}</strong></div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="column one">
                                                        <!-- One Second (1/2) Column -->
                                                        <div class="column one">
                                                            {{-- <label>Business Name</label> --}}
                                                            <input value="{{old('business_id')}}" placeholder="Business ID" type="number" name="business_id" id="business_id" size="40" aria-required="true" aria-invalid="false"/>
                                                            @if($errors->has('business_id'))
                                                                <div class="error" id="error-business_id"><strong>{{ $errors->first('business_id') }}</strong></div>
                                                            @endif
                                                            <input value="{{old('company_name')}}" placeholder="Business Name" type="text" name="company_name" id="company_name" size="40" aria-required="true" aria-invalid="false"/>
                                                            @if($errors->has('company_name'))
                                                                <div class="error" id="error-company_name"><strong>{{ $errors->first('company_name') }}</strong></div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="column one">
                                                        {{-- <label>Business Category</label> --}}
                                                        <!-- One Second (1/2) Column -->
                                                        <div class="column one">
                                                            <select data-live-search="true" name="category_id" id="category_id" width="100%" style="min-width:100%">
                                                                <option value="" hidden>Select Job Category</option>
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
                                                            {{-- <label>Business Name</label> --}}
                                                            <input value="{{old('position')}}" placeholder="Position" type="text" name="position" id="position" size="40" aria-required="true" aria-invalid="false"/>
                                                            @if($errors->has('position'))
                                                                <div class="error"><strong>{{ $errors->first('position') }}</strong></div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="column one">
                                                        <div class="column one">
                                                            {{-- <label>Description</label> --}}
                                                            <textarea id="description" name="description" placeholder="Job Description">{{old('description')}}</textarea>
                                                            @if($errors->has('description'))
                                                                <div class="error">{{ $errors->first('description') }}</div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="column one">
                                                        <div class="column one">
                                                            {{-- <label>Requirement</label> --}}
                                                            <textarea id="requirement" name="requirement" placeholder="Job Requirements">{{old('requirement')}}</textarea>
                                                            @if($errors->has('requirement'))
                                                                <div class="error">{{ $errors->first('requirement') }}</div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="column one">
                                                        <div class="column one">
                                                            {{-- <label>Qualification</label> --}}
                                                            <textarea id="qualification" name="qualification" placeholder="Job Qualifications">{{old('qualification')}}</textarea>
                                                            @if($errors->has('qualification'))
                                                                <div class="error">{{ $errors->first('qualification') }}</div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="column one">
                                                        <!-- One Second (1/2) Column -->
                                                        <div class="column one">
                                                            {{-- <label>Quantity</label> --}}
                                                            <input value="{{old('quantity')}}" placeholder="Quantity" type="text" name="quantity" id="quantity" size="40" aria-required="true" aria-invalid="false"/>
                                                            @if($errors->has('quantity'))
                                                                <div class="error"><strong>{{ $errors->first('quantity') }}</strong></div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="column one">
                                                        <!-- One Second (1/2) Column -->
                                                        <div class="column one">
                                                            <label>Is the job offer in local or overseas?</label>
                                                            <select data-live-search="true" name="local" id="local" width="100%" style="min-width:100%">
                                                                <option value="1">Local</option>
                                                                <option value="0">Overseas</option>
                                                            </select>
                                                            @if($errors->has('local'))
                                                                <div class="error"><strong>{{ $errors->first('local') }}</strong></div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="column one align_center" style="text-align:center;">
                                                        <div class="column one">
                                                            {{-- <label>Quantity</label> --}}
                                                            <input value="{{old('contact_person')}}" placeholder="Contact Person" type="text" name="contact_person" id="contact_person" size="40" aria-required="true" aria-invalid="false"/>
                                                            @if($errors->has('contact_person'))
                                                                <div class="error" id="error-contact_person"><strong>{{ $errors->first('contact_person') }}</strong></div>
                                                            @endif
                                                        </div>
                                                        <div class="column one">
                                                            {{-- <label>Quantity</label> --}}
                                                            <input value="{{old('contact_number')}}" placeholder="Contact Number" type="text" name="contact_number" id="contact_number" size="40" aria-required="true" aria-invalid="false"/>
                                                            @if($errors->has('contact_number'))
                                                                <div class="error" id="error-contact_number"><strong>{{ $errors->first('contact_number') }}</strong></div>
                                                            @endif
                                                        </div>
                                                        <div class="column one">
                                                            <button id="btnRegister" style=" width: 100%;" name="btnRegister" type="submit" class="btn btn-success">CREATE JOB</button>
                                                    
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
@endsection

@section('after_scripts')
    <script>
        var old = {{old('registered')}}
        console.log({{old('registered')}}); // DO NOT REMOVE
        console.log($('select[name="registered"').find(":selected").val());
        $(document).ready(function () {
            var menu = $('#menu');
            // $('#' + indexValue).addClass("selectedQuestion");
            $('li[id=jobs]').addClass("current-menu-item")
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
            if(old == 0){
                $('select[name="registered"').val('0'); 
                $('input[name="business_id"').hide();

                // Fields if Business Not Registered
                $('input[name="company_name"').show();
                $('input[name="contact_person"').show();
                $('input[name="contact_number"').show();
            }else if(old == 1){
                $('select[name="registered"').val('1');
                $('input[name="company_name"').hide();
                $('input[name="contact_person"').hide();
                $('input[name="contact_number"').hide();
            }
            else if($('select[name="registered"').find(":selected").val() == 1){
                $('input[name="company_name"').hide();
                $('input[name="contact_person"').hide();
                $('input[name="contact_number"').hide();
            }
            else if($('select[name="registered"').find(":selected").val() == 0){
                $('input[name="business_id"').hide();

                // Fields if Business Not Registered
                $('input[name="company_name"').show();
                $('input[name="contact_person"').show();
                $('input[name="contact_number"').show();
            }
        });
        $('select[name="registered"').on('change', function() {
            console.log($('select[name="registered"').find(":selected").val());
        // Check if Business is Registered in One Papanga
            if ($('select[name="registered"').find(":selected").val() == '1'){
                $('select[name="registered"').val('1');
                $('input[name="business_id"').show();
                $('#error-business_id').show();

                // Fields if Business Not Registered
                $('input[name="company_name"').hide();
                $('input[name="contact_person"').hide();
                $('input[name="contact_number"').hide();
                $('#error-company_name').hide();
                $('#error-contact_number').hide();
                $('#error-contact_person').hide();
            } else {
                $('select[name="registered"').val('0');
                $('input[name="business_id"').hide();
                $('#error-business_id').hide();

                // Fields if Business Not Registered
                $('input[name="company_name"').show();
                $('input[name="contact_person"').show();
                $('input[name="contact_number"').show();
                $('#error-company_name').show();
                $('#error-contact_number').show();
                $('#error-contact_person').show();
            }
        });
    </script>
@endsection

