<div class="section mcb-section mcb-section-6f6315d48 bg-cover-ultrawide" style="padding-top:300px;padding-bottom:0px;background-color:#cb3010;background-image:url({{ asset('../content/seo3/images/seo3-sectionbg6.jpg') }});background-repeat:no-repeat;background-position:center top;">
    <div class="section_wrapper mcb-section-inner">
        <div class="wrap mcb-wrap mcb-wrap-25d801cd9 one valign-top clearfix">
            <div class="mcb-wrap-inner">
                <div class="column mcb-column mcb-item-fb92018dd one-fifth column_placeholder">
                    <div class="placeholder">
                        &nbsp;
                    </div>
                </div>
                @if(session()->has('success'))
                    <div id="newsletterform" class="column mcb-column mcb-item-d22380bce three-fifth column_column">
                        <div class="column_attr clearfix align_center" style>
                            <h6 class="seo3-heading">Registered Sucessfully!</h6>
                            <div id="contactWrapper">
                                <div class="alert alert-success">
                                    <i class="fas fa-check-circle fa-5x"></i>
                                    <br>
                                </div>
                            </div>
                            <h2 style="color: #fff;">{{ session()->get('success') }}</h2>
                        </div>
                    </div>
                @else
                    <div class="column mcb-column mcb-item-d22380bce three-fifth column_column">
                        <div class="column_attr clearfix align_center" style>
                            <h6 class="seo3-heading">JOIN TO US</h6>
                            <hr class="no_line" style="margin: 0 auto 15px;">
                            <h2 style="color: #fff;">Newsletter</h2>
                            <hr class="no_line" style="margin: 0 auto 30px;">
                            <form id="newsletterform" class="newsletter_form"  method="POST" action="{{url('submit_newsletter')}}" enctype="multipart/form-data">
                                @csrf
                                {!! csrf_field() !!}
                                <input value="{{old('email')}}" placeholder="Business e-mail" type="email" id="email" name="email" size="40" aria-required="true" aria-invalid="false" />
                                @if($errors->has('email'))
                                    <div class="error">{{ $errors->first('email') }}</div>
                                @endif
                                <button id="btnRegister" name="btnRegister" type="submit" class="btn btn-success">Sign up</button>
                            </form>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>