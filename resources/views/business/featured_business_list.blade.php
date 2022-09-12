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
                  <div class="text-value-sm text-primary">{{count($active)}}</div>
                  <div class="text-muted text-uppercase font-weight-bold small">Active</div>
                </div>
              </div>
            </div>
          </div>
          <!-- /.col-->
          <div class="col-12 col-lg-3">
            <div class="card">
              <div class="card-body p-0 d-flex align-items-center"><i class="fas fa-user-clock bg-info p-4 px-5 font-2xl mr-3"></i>
                <div>
                  <div class="text-value-sm text-info">{{count($not_active)}}</div>
                  <div class="text-muted text-uppercase font-weight-bold small">Not Actvie</div>
                </div>
              </div>
            </div>
          </div>
          <!-- /.col-->
          <div class="col-12 col-lg-3">
            <div class="card">
              <div class="card-body p-0 d-flex align-items-center"><i class="fas fa-sync-alt bg-warning p-4 px-5 font-2xl mr-3"></i>
                <div>
                  <div class="text-value-sm text-warning">{{count($renewal)}}</div>
                  <div class="text-muted text-uppercase font-weight-bold small">For Renewal</div>
                </div>
              </div>
            </div>
          </div>
          <!-- /.col-->
          <div class="col-12 col-lg-3">
            <div class="card">
              <div class="card-body p-0 d-flex align-items-center"><i class="fa fa-bell bg-danger p-4 px-5 font-2xl mr-3"></i>
                <div>
                  <div class="text-value-sm text-danger">{{count($expired)}}</div>
                  <div class="text-muted text-uppercase font-weight-bold small">Expired</div>
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

<!-- UNFEATURED MODAL -->
<div class="modal fade" id="unfeatureModal" 
     tabindex="-1" role="dialog" 
     aria-labelledby="unfeatureModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" 
        id="unfeatureModalLabel">TITLE</h4>
        <button type="button" class="close" 
          data-dismiss="modal" 
          aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        
      </div>
      <form id="unfeatureForm" method="POST" action="#">
        @csrf
        {!! csrf_field() !!}
        <div class="modal-body">
          <input type="hidden" id="unfeature_business_id" name="unfeature_business_id" value="">
          <p id="unfeatureDesc">
            Are you sure you want to unfeature this business?
          </p>
        </div>
        <div class="modal-footer">
          <button type="button" 
          class="btn btn-default" 
          data-dismiss="modal">Cancel</button>
          <span class="pull-right">
            <button type="submit" class="btn btn-danger" id="unfeatureButton">
              Unfeature
            </button>
          </span>
        </div>
      </form>
    </div>
  </div>
</div>
{{-- RENEW FEATURED MODAL --}}
<div class="modal fade" id="featuredRenewalModal" 
  tabindex="-1" role="dialog" 
  aria-labelledby="featuredRenewalModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title" 
            id="featuredRenewalModalLabel"></h4>
            <button type="button" class="close" 
            data-dismiss="modal" 
            aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
        </div>
          <form method="POST" action="{{ url($crud->route.'/featured_renew') }}">
            @csrf
            {!! csrf_field() !!}
              <div class="modal-body">
                  <div class="form-group">
                      <input type="hidden" id="renew_business_id" name="renew_business_id" value="">
                      <p>
                        Are you sure you want to renew the premium subscription?
                      </p>
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

@section('after_scripts')
	@include('crud::inc.datatables_logic')

    <script src="{{ asset('packages/backpack/crud/js/crud.js') }}"></script>
    <script src="{{ asset('packages/backpack/crud/js/form.js') }}"></script>
    <script src="{{ asset('packages/backpack/crud/js/list.js') }}"></script>
    <script>
        $(function() {
            $('#featuredRenewalModal').on("show.bs.modal", function (e) {
                $("#renew_business_id").val($(e.relatedTarget).data('id'));
                $("#featuredRenewalModalLabel").html($(e.relatedTarget).data('title'));
            });
           
        });
        $(function() {
            $('#unfeatureModal').on("show.bs.modal", function (e) {
              $("#unfeature_business_id").val($(e.relatedTarget).data('id'));
              $("#unfeatureModalLabel").html($(e.relatedTarget).data('title'));
              $('#unfeatureForm').attr('action', $(e.relatedTarget).data('route'));
              
              var buttonAction = $(e.relatedTarget).data('action');
              if(buttonAction == 'feature') {
                $('#unfeatureDesc').text('Are you sure you want to feature this business?');
                $('#unfeatureButton').attr('class', 'btn btn-success');
                $('#unfeatureButton').text('Feature');
              }

              if(buttonAction == 'unfeature') {
                $('#unfeatureDesc').text('Are you sure you want to unfeature this business?');
                $('#unfeatureButton').attr('class', 'btn btn-danger');
                $('#unfeatureButton').text('Unfeature');
              }
            });
        });
    </script>

  <!-- CRUD LIST CONTENT - crud_list_scripts stack -->
  @stack('crud_list_scripts')
@endsection
