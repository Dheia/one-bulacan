@php
  if(backpack_user() && (Str::startsWith(\Request::path(), config('backpack.base.route_prefix'))))
  {
    $extends = 'errors.layout';
  }
  else {
    $extends = Auth::guard('business-portal')->user() && (Str::startsWith(\Request::path(), 'one-portal')) ? 'errors.layout' : 'errors.v2_layout';
  }
@endphp

@extends($extends)
{{-- @extends('errors.layout') --}}

@php
  $error_number = 404;
@endphp

@section('title')
  Page not found.
@endsection

@section('description')
  @php
    $default_error_message = "Please <a href='javascript:history.back()'>go back</a> or return to <a href='".url('')."'>our homepage</a>.";
  @endphp
  {!! isset($exception)? ($exception->getMessage()?e($exception->getMessage()):$default_error_message): $default_error_message !!}
@endsection