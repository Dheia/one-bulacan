@extends(backpack_view('businessPortal.blank'))

@php
  $defaultBreadcrumbs = [
    'Business Portal' => url(config('backpack.base.portal_route_prefix'), 'dashboard'),
    'Dashboard' => false,
  ];

  // if breadcrumbs aren't defined in the CrudController, use the default breadcrumbs
  $breadcrumbs = $breadcrumbs ?? $defaultBreadcrumbs;
@endphp

@section('content')
	<!-- Widget Start -->
    <div class="row">
        <div class="col-12 col-lg-3">
            <div class="card">
                <div class="card-body p-0 d-flex align-items-center"><i class="fas fa-user-plus bg-primary p-4 px-5 font-2xl mr-3"></i>
                    <div>
                        <div class="text-value-sm text-primary">
                            {{ count($businesses) }}
                        </div>
                        <div class="text-muted text-uppercase font-weight-bold small">Registered</div>
                        <div class="text-muted text-uppercase font-weight-bold small">Businesses</div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.col-->
        <div class="col-12 col-lg-3">
            <div class="card">
                <div class="card-body p-0 d-flex align-items-center"><i class="fas fa-user-clock bg-success p-4 px-5 font-2xl mr-3"></i>
                    <div>
                        <div class="text-value-sm text-success">
                            {{count($businesses->where('status', 'PREMIUM'))}}
                        </div>
                        <div class="text-muted text-uppercase font-weight-bold small">Premium</div>
                        <div class="text-muted text-uppercase font-weight-bold small">Subscription</div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.col-->
        <div class="col-12 col-lg-3">
            <div class="card">
                <div class="card-body p-0 d-flex align-items-center"><i class="fas fa-sync-alt bg-warning p-4 px-5 font-2xl mr-3"></i>
                    <div>
                        <div class="text-value-sm text-warning">
                            {{count($businesses->where('status', 'PREMIUM FOR RENEWAL'))}}
                        </div>
                        <div class="text-muted text-uppercase font-weight-bold small">FOR RENEWAL</div>
                        <div class="text-muted text-uppercase font-weight-bold small">Premium Subscription</div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.col-->
        <div class="col-12 col-lg-3">
            <div class="card">
                <div class="card-body p-0 d-flex align-items-center"><i class="fa fa-bell bg-danger p-4 px-5 font-2xl mr-3"></i>
                    <div>
                        <div class="text-value-sm text-danger">
                            {{count($businesses->where('status', 'PREMIUM EXPIRED'))}}
                        </div>
                        <div class="text-muted text-uppercase font-weight-bold small">EXPIRED</div>
                        <div class="text-muted text-uppercase font-weight-bold small">Premium Subscription</div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.col-->
    </div>
    <!-- /Widget End -->

    <!-- Business List Start -->
    <div class="row">
        
        @foreach ( $businesses as $business )    
            <div class="col-md-6">
                <div class="card mb-3">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <img src="{{ asset($business->logo) }}" class="img-fluid rounded-start h-100 w-100" alt="Business Logo">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title">
                                    <b>{{ $business->name }}</b>
                                </h5>
                                <p class="card-text">
                                    <i class="fa fa-map-marker-alt"></i> {{ $business->complete_address }}
                                    <br>
                                    <i class="fa fa-envelope"></i> <a href="mailto:{{ $business->email }}">{{ $business->email }}</a>
                                    <br>
                                    <i class="fa fa-phone-alt"></i> <a href="tel:{{ $business->mobile }}">{{ $business->mobile }}</a>
                                </p>
                                {{-- <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p> --}}
                                <div class="row">
                                    <div class="col-md-6">
                                        <a href="{{ url('one-portal/transaction?business=' . $business->slug) }}" class="btn btn-pill btn-sm btn-primary w-100">
                                            Transaction
                                        </a>
                                    </div>
                                    <div class="col-md-6">
                                        <a target="_blank" href="{{ url($business->category_slug . '/' . $business->slug) }}" 
                                            class="btn btn-pill btn-sm btn-info w-100">
                                            Page
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <!-- /Business List End -->
@endsection