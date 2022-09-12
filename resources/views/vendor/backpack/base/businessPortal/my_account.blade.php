@extends(backpack_view('businessPortal.blank'))

@section('after_styles')
    <style media="screen">
        .backpack-profile-form .required::after {
            content: ' *';
            color: red;
        }
    </style>
@endsection

@php
  $breadcrumbs = [
      'Business Portal' => url(config('backpack.base.portal_route_prefix'), 'dashboard'),
      trans('backpack::base.my_account') => false,
  ];
@endphp

@section('header')
    <section class="content-header">
        <div class="container-fluid mb-3">
            <h1>{{ trans('backpack::base.my_account') }}</h1>
        </div>
    </section>
@endsection

@section('content')
    <div class="row">

        @if (session('success'))
        <div class="col-lg-8">
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        </div>
        @endif

        @if ($errors->count())
        <div class="col-lg-8">
            <div class="alert alert-danger">
                <ul class="mb-1">
                    @foreach ($errors->all() as $e)
                    <li>{{ $e }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
        @endif

        {{-- UPDATE INFO FORM --}}
        <div class="col-lg-8">
            <form class="form" action="{{ route('business-portal.account.info.store') }}" method="post">

                {!! csrf_field() !!}

                <div class="card padding-10">

                    <div class="card-header">
                        {{ trans('backpack::base.update_account_info') }}
                    </div>

                    <div class="card-body backpack-profile-form bold-labels">
                        <div class="row">
                            <div class="col-md-4 form-group">
                                @php
                                    $label = 'Firstname';
                                    $field = 'firstname';
                                @endphp
                                <label class="required">{{ $label }}</label>
                                <input required class="form-control" type="text" name="{{ $field }}" value="{{ old($field) ? old($field) : $user->businessOwner->$field }}">
                            </div>

                            <div class="col-md-4 form-group">
                                @php
                                    $label = 'Middlename';
                                    $field = 'middlename';
                                @endphp
                                <label>{{ $label }}</label>
                                <input class="form-control" type="text" name="{{ $field }}" value="{{ old($field) ? old($field) : $user->businessOwner->$field }}">
                            </div>

                            <div class="col-md-4 form-group">
                                @php
                                    $label = 'Lastname';
                                    $field = 'lastname';
                                @endphp
                                <label class="required">{{ $label }}</label>
                                <input required class="form-control" type="text" name="{{ $field }}" value="{{ old($field) ? old($field) : $user->businessOwner->$field }}">
                            </div>

                            <div class="col-md-4 form-group">
                                @php
                                    $label = 'Gender';
                                    $field = 'gender';
                                @endphp
                                <label class="required">{{ $label }}</label>
                               <select name="gender" class="form-control">
                                    <option value="Male" {{ $user->businessOwner->$field == 'Male' ?  'selected=""' : '' }}>Male</option>
                                    <option value="Female" {{ $user->businessOwner->$field == 'Female' ?  'selected=""' : '' }}>Female</option>
                                </select>
                            </div>

                            <div class="col-md-4 form-group">
                                @php
                                    $label = 'Mobile No.';
                                    $field = 'mobile';
                                @endphp
                                <label class="required">{{ $label }}</label>
                                <input required class="form-control" type="number" name="{{ $field }}" value="{{ old($field) ? old($field) : $user->businessOwner->$field }}">
                            </div>

                            <div class="col-md-4 form-group">
                                @php
                                    $label = 'Telephone No.';
                                    $field = 'telephone';
                                @endphp
                                <label>{{ $label }}</label>
                                <input class="form-control" type="text" name="{{ $field }}" value="{{ old($field) ? old($field) : $user->businessOwner->$field }}">
                            </div>

                            {{-- <div class="col-md-12 form-group">
                                @php
                                    $label = 'Email';
                                    $field = 'email';
                                @endphp
                                <label class="required">{{ $label }}</label>
                                <input required class="form-control" type="email" name="{{ $field }}" value="{{ old($field) ? old($field) : $user->businessOwner->$field }}">
                            </div> --}}

                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-success"><i class="la la-save"></i> {{ trans('backpack::base.save') }}</button>
                        <a href="{{ route('business-portal.dashboard') }}" class="btn">{{ trans('backpack::base.cancel') }}</a>
                    </div>
                </div>

            </form>
        </div>
        
        {{-- CHANGE PASSWORD FORM --}}
        <div class="col-lg-8">
            <form class="form" action="{{ route('business-portal.account.password') }}" method="post">

                {!! csrf_field() !!}

                <div class="card padding-10">

                    <div class="card-header">
                        {{ trans('backpack::base.change_password') }}
                    </div>

                    <div class="card-body backpack-profile-form bold-labels">
                        <div class="row">
                            <div class="col-md-4 form-group">
                                @php
                                    $label = trans('backpack::base.old_password');
                                    $field = 'old_password';
                                @endphp
                                <label class="required">{{ $label }}</label>
                                <input autocomplete="new-password" required class="form-control" type="password" name="{{ $field }}" id="{{ $field }}" value="">
                            </div>

                            <div class="col-md-4 form-group">
                                @php
                                    $label = 'New Password';
                                    $field = 'new_password';
                                @endphp
                                <label class="required">{{ $label }}</label>
                                <input autocomplete="new-password" required class="form-control" type="password" name="{{ $field }}" id="{{ $field }}" value="">
                            </div>

                            <div class="col-md-4 form-group">
                                @php
                                    $label = 'New Password Confirmation';
                                    $field = 'new_password_confirmation';
                                @endphp
                                <label class="required">{{ $label }}</label>
                                <input autocomplete="new-password" required class="form-control" type="password" name="{{ $field }}" id="{{ $field }}" value="">
                            </div>
                        </div>
                    </div>

                    <div class="card-footer">
                            <button type="submit" class="btn btn-success"><i class="la la-save"></i> {{ trans('backpack::base.change_password') }}</button>
                            <a href="{{ route('business-portal.dashboard') }}" class="btn">{{ trans('backpack::base.cancel') }}</a>
                    </div>

                </div>

            </form>
        </div>

    </div>
@endsection
