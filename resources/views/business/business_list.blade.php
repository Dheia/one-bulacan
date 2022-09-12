@extends(backpack_view('blank'))

@php
  $defaultBreadcrumbs = [
    trans('backpack::crud.admin') => url(config('backpack.base.route_prefix'), 'dashboard'),
    $crud->entity_name_plural => url($crud->route),
    trans('backpack::crud.list') => false,
  ];

  // if breadcrumbs aren't defined in the CrudController, use the default breadcrumbs
  $breadcrumbs = $breadcrumbs ?? $defaultBreadcrumbs;
@endphp

@section('header')
  <div class="container-fluid">
    <h2>
      <span class="text-capitalize">{!! $crud->getHeading() ?? $crud->entity_name_plural !!}</span>
      <small id="datatable_info_stack">{!! $crud->getSubheading() ?? '' !!}</small>
    </h2>
  </div>
@endsection

@section('content')

<!-- Default box -->
  <div class="row">

    <!-- THE ACTUAL CONTENT -->
    <div class="{{ $crud->getListContentClass() }}">
      <div class="">
        {{-- WIDGET START --}}
        <div class="row">
          <div class="col-12 col-lg-3">
            <div class="card">
              <div class="card-body p-0 d-flex align-items-center"><i class="fas fa-user-plus bg-primary p-4 px-5 font-2xl mr-3"></i>
                <div>
                  <div class="text-value-sm text-primary">{{count($active_businesses)}}</div>
                  <div class="text-muted text-uppercase font-weight-bold small">Active</div>
                </div>
              </div>
            </div>
          </div>
          <!-- /.col-->
          <div class="col-12 col-lg-3">
            <a href="{{ backpack_url('pending-business') }}">
              <div class="card">
                <div class="card-body p-0 d-flex align-items-center"><i class="fas fa-user-clock bg-info p-4 px-5 font-2xl mr-3"></i>
                  <div>
                    <div class="text-value-sm text-info">{{count($pending_businesses)}}</div>
                    <div class="text-muted text-uppercase font-weight-bold small">Pending</div>
                  </div>
                </div>
              </div>
            </a>
          </div>
          <!-- /.col-->
          <div class="col-12 col-lg-3">
            <div class="card">
              <div class="card-body p-0 d-flex align-items-center"><i class="fas fa-sync-alt bg-warning p-4 px-5 font-2xl mr-3"></i>
                <div>
                  <div class="text-value-sm text-warning">{{count($forrenewal_businesses)}}</div>
                  <div class="text-muted text-uppercase font-weight-bold small">For Renewal</div>
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
                  <div class="text-value-sm text-danger">{{count($expired_businesses)}}</div>
                  <div class="text-muted text-uppercase font-weight-bold small">Expired</div>
                  <div class="text-muted text-uppercase font-weight-bold small">Premium Subscription</div>
                </div>
              </div>
            </div>
          </div>
          <!-- /.col-->
        </div>
        {{-- WIDGET END --}}
        <div class="row mb-0">
          <div class="col-6">
            @if ( $crud->buttons()->where('stack', 'top')->count() ||  $crud->exportButtons())
            <div class="hidden-print {{ $crud->hasAccess('create')?'with-border':'' }}">

              @include('crud::inc.button_stack', ['stack' => 'top'])

            </div>
            @endif
          </div>
          <div class="col-6">
              <div id="datatable_search_stack" class="float-right"></div>
          </div>
        </div>

        {{-- Backpack List Filters --}}
        @if ($crud->filtersEnabled())
          @include('crud::inc.filters_navbar')
        @endif

        <div class="overflow-hidden mt-2">

        <table id="crudTable" class="bg-white table table-striped table-hover nowrap rounded shadow-xs border-xs" cellspacing="0">
            <thead>
              <tr>
                {{-- Table columns --}}
                @foreach ($crud->columns() as $column)
                  <th
                    data-orderable="{{ var_export($column['orderable'], true) }}"
                    data-priority="{{ $column['priority'] }}"
                    data-visible="{{ var_export($column['visibleInTable'] ?? true) }}"
                    data-visible-in-modal="{{ var_export($column['visibleInModal'] ?? true) }}"
                    data-visible-in-export="{{ var_export($column['visibleInExport'] ?? true) }}"
                    >
                    {!! $column['label'] !!}
                  </th>
                @endforeach

                @if ( $crud->buttons()->where('stack', 'line')->count() )
                  <th data-orderable="false" data-priority="{{ $crud->getActionsColumnPriority() }}" data-visible-in-export="false">{{ trans('backpack::crud.actions') }}</th>
                @endif
              </tr>
            </thead>
            <tbody>
            </tbody>
            <tfoot>
              <tr>
                {{-- Table columns --}}
                @foreach ($crud->columns() as $column)
                  <th>{!! $column['label'] !!}</th>
                @endforeach

                @if ( $crud->buttons()->where('stack', 'line')->count() )
                  <th>{{ trans('backpack::crud.actions') }}</th>
                @endif
              </tr>
            </tfoot>
          </table>

          @if ( $crud->buttons()->where('stack', 'bottom')->count() )
          <div id="bottom_buttons" class="hidden-print">
            @include('crud::inc.button_stack', ['stack' => 'bottom'])

            <div id="datatable_button_stack" class="float-right text-right hidden-xs"></div>
          </div>
          @endif

        </div><!-- /.box-body -->

      </div><!-- /.box -->
    </div>

  </div>
  
</div>

{{-- ADD FEATURED MODAL --}}
<div class="modal fade" id="featuredModal" 
  tabindex="-1" role="dialog" 
  aria-labelledby="featuredModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title" 
            id="featuredModalLabel"></h4>
            <button type="button" class="close" 
            data-dismiss="modal" 
            aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
        </div>
          <form method="POST" action="{{ url($crud->route.'/feature') }}">
            @csrf
            {!! csrf_field() !!}
              <div class="modal-body">
                  <div class="form-group">
                      <input type="hidden" id="featured_business_id" name="featured_business_id" value="">
                      <label>Are you sure you want to add this business to featured businesses?</label>
                      <!-- <select class="form-control" name="lenght_of_time" id="lenght_of_time">
                        <option value="1week">1 week</option>
                        <option value="2weeks">2 weeks</option>
                        <option value="3weeks">3 weeks</option>
                        <option value="1month">1 month</option>
                        <option value="3months">3 months</option>
                        <option value="5months">5 months</option>
                        <option value="1year">1 year</option>
                      </select> -->
                  </div>
              </div>
              <div class="modal-footer">
                  <span class="pull-right">
                  <button type="submit" class="btn btn-primary">
                      Add to Featured
                  </button>
                  </span>
                  <button type="button" 
                  class="btn btn-default" 
                  data-dismiss="modal">Cancel</button>
              </div>
          </form>
    </div>
</div>
@endsection

@section('after_styles')
  <!-- DATA TABLES -->
  <link rel="stylesheet" type="text/css" href="{{ asset('packages/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('packages/datatables.net-fixedheader-bs4/css/fixedHeader.bootstrap4.min.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('packages/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}">

  <link rel="stylesheet" href="{{ asset('packages/backpack/crud/css/crud.css') }}">
  <link rel="stylesheet" href="{{ asset('packages/backpack/crud/css/form.css') }}">
  <link rel="stylesheet" href="{{ asset('packages/backpack/crud/css/list.css') }}">
  
  <!-- CRUD LIST CONTENT - crud_list_styles stack -->
  @stack('crud_list_styles')
@endsection

@section('before_scripts')
  {{-- RENEW FEATURED MODAL --}}
  <div class="modal fade" id="publishedRenewalModal" 
    tabindex="-1" role="dialog" 
    aria-labelledby="publishedModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <h4 class="modal-title" 
              id="publishedRenewalModalLabel"></h4>
              <button type="button" class="close" 
              data-dismiss="modal" 
              aria-label="Close">
              <span aria-hidden="true">&times;</span></button>
          </div>
            <form method="POST" action="{{ url($crud->route.'/published_renew') }}">
              @csrf
              {!! csrf_field() !!}
                <div class="modal-body">
                    <div class="form-group">
                        <input type="hidden" id="renew_business_id" name="renew_business_id" value="">
                        <label>Select publish renewal lenght</label>
                        <select class="form-control" name="renew_lenght_of_time" id="renew_lenght_of_time">
                          <option value="1year">1 year</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <span class="pull-right">
                    <button type="submit" class="btn btn-primary">
                        Renew
                    </button>
                    </span>
                    <button type="button" 
                    class="btn btn-default" 
                    data-dismiss="modal">Cancel</button>
                </div>
            </form>
      </div>
  </div>
@endsection
@section('after_scripts')
	@include('crud::inc.datatables_logic')

  <script src="{{ asset('packages/backpack/crud/js/crud.js') }}"></script>
  <script src="{{ asset('packages/backpack/crud/js/form.js') }}"></script>
  <script src="{{ asset('packages/backpack/crud/js/list.js') }}"></script>
  <script>
    $(function() {
        $('#publishedRenewalModal').on("show.bs.modal", function (e) {
            $("#renew_business_id").val($(e.relatedTarget).data('id'));
            $("#publishedRenewalModalLabel").html($(e.relatedTarget).data('title'));
        });
    });

    $(function() {
        $('#featuredModal').on("show.bs.modal", function (e) {
            $("#featured_business_id").val($(e.relatedTarget).data('id'));
            $("#featuredModalLabel").html($(e.relatedTarget).data('title'));
            $("#featured-title").html($(e.relatedTarget).data('title'));
        });
    });
    
</script>

  <!-- CRUD LIST CONTENT - crud_list_scripts stack -->
  @stack('crud_list_scripts')
@endsection
