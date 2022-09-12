@extends(backpack_view('blank'))

@php
   
@endphp

@section('content')
    <!-- Widget Start -->
    <div class="row">
        <div class="col-12 col-lg-6">
            <div class="card">
                <div class="card-body p-3 d-flex align-items-center"><i class="fas fa-user-plus bg-primary p-3 font-2xl mr-3"></i>
                    <div>
                        <div class="text-value-sm text-primary">{{ count($activeBusinesses) }}</div>
                        <div class="text-muted text-uppercase font-weight-bold small">Registered Businesses</div>
                    </div>
                </div>
                <div class="card-footer px-3 py-2">
                    <a class="btn-block text-muted d-flex justify-content-between align-items-center" href="{{ backpack_url('business') }}">
                        <span class="small font-weight-bold">View More</span><i class="fa fa-angle-right"></i>
                    </a>
                </div>
            </div>
        </div>
        <!-- /.col-->
        <div class="col-12 col-lg-6">
            <div class="card">
                <div class="card-body p-3 d-flex align-items-center"><i class="fas fa-user-clock bg-info p-3 font-2xl mr-3"></i>
                    <div>
                        <div class="text-value-sm text-info">{{ count($pendingBusinesses) }}</div>
                        <div class="text-muted text-uppercase font-weight-bold small">Pending Businesses</div>
                    </div>
                </div>
                <div class="card-footer px-3 py-2">
                    <a class="btn-block text-muted d-flex justify-content-between align-items-center" href="{{ backpack_url('pending-business') }}">
                        <span class="small font-weight-bold">View More</span><i class="fa fa-angle-right"></i>
                    </a>
                </div>
            </div>
        </div>
        <!-- /.col-->
    </div>

    <div class="row">
        <div class="col-12 col-lg-4">
            <div class="card">
                <div class="card-body p-3 d-flex align-items-center"><i class="fas fa-star bg-success p-3 font-2xl mr-3"></i>
                    <div>
                        <div class="text-value-sm text-success">{{count($premiumSubscriptions)}}</div>
                        <div class="text-muted text-uppercase font-weight-bold small">Active</div>
                        <div class="text-muted text-uppercase font-weight-bold small">Premium Subscription</div>
                    </div>
                </div>
                <div class="card-footer px-3 py-2">
                    <a class="btn-block text-muted d-flex justify-content-between align-items-center" href="{{ backpack_url('featuredbusiness') }}?status=active">
                        <span class="small font-weight-bold">View More</span><i class="fa fa-angle-right"></i>
                    </a>
                </div>
            </div>
        </div>
        <!-- /.col-->
        <div class="col-12 col-lg-4">
            <div class="card">
                <div class="card-body p-3 d-flex align-items-center"><i class="fas fa-sync-alt bg-warning p-3 font-2xl mr-3"></i>
                    <div>
                        <div class="text-value-sm text-warning">{{count($forrenewalPremiumSubscriptions)}}</div>
                        <div class="text-muted text-uppercase font-weight-bold small">For Renewal</div>
                        <div class="text-muted text-uppercase font-weight-bold small">Premium Subscription</div>
                    </div>
                </div>
                <div class="card-footer px-3 py-2">
                    <a class="btn-block text-muted d-flex justify-content-between align-items-center" href="{{ backpack_url('featuredbusiness') }}?status=for-renewal">
                        <span class="small font-weight-bold">View More</span><i class="fa fa-angle-right"></i>
                    </a>
                </div>
            </div>
        </div>
        <!-- /.col-->
        <div class="col-12 col-lg-4">
            <div class="card">
                <div class="card-body p-3 d-flex align-items-center"><i class="fa fa-bell bg-danger p-3 font-2xl mr-3"></i>
                    <div>
                        <div class="text-value-sm text-danger">{{count($expiredPremiumSubscriptions)}}</div>
                        <div class="text-muted text-uppercase font-weight-bold small">Expired</div>
                        <div class="text-muted text-uppercase font-weight-bold small">Premium Subscription</div>
                    </div>
                </div>
                <div class="card-footer px-3 py-2">
                    <a class="btn-block text-muted d-flex justify-content-between align-items-center" href="{{ backpack_url('featuredbusiness') }}?status=expired">
                        <span class="small font-weight-bold">View More</span><i class="fa fa-angle-right"></i>
                    </a>
                </div>
            </div>
        </div>
        <!-- /.col-->
    </div>
    <!-- /Widget End -->

    <div class="row">
        @if(count($businesses)>0)
            <div class="col-12 col-lg-7">
                <div class="card">
                  <div class="card-header"><i class="fa fa-align-justify"></i> Business Table</div>
                  <div class="card-body">
                    <table class="table table-responsive-sm table-striped" id="business_table">
                      <thead>
                        <tr>
                          <th>Business Name</th>
                          <th>Date registered</th>
                          <th>Total Visits</th>
                          <th>Unique Visitors</th>
                        </tr>
                      </thead>
                      <tbody id="business_body">
                        @foreach($businesses as $key => $business)
                            <tr>
                                <td>{{$business->name}}</td>
                                <td>{{$business->created_at->format('M d Y')}}</td>
                                <td>{{$business->visit}}</td>
                                <td>{{$business->unique_visitor}}</td>
                            </tr>
                        @endforeach
                      </tbody>
                    </table>
                    {{ $businesses->appends(['categories' => $categories->currentPage()])->links() }}
                  </div>
                </div>
            </div>
        @endif

        @if(count($categories)>0)
            <div class="col-12 col-sm-12 col-xl-5">
                <div class="card">
                    <div class="card-header"><i class="fa fa-align-justify"></i> Category List <small>with businesses registered</small></div>
                    <div class="card-body overflow-auto">
                        <table class="table table-striped" style="width:100%">
                            <thead>
                                <tr>
                                  <th scope="col">Name</th>
                                  <th scope="col">Total Business</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($categories as $key => $category)
                                    <tr>
                                      <td>{{$category->name}}</td>
                                      <td>{{count($category->businesses)}}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $categories->appends(['businesses' => $businesses->currentPage()])->links() }}
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection

@section('after_scripts')
    <script type="text/javascript">
        
        $('#search').on('keyup',function(){
            $value=$(this).val();
                $.ajax({
                    type : 'get',
                    url : '{{URL::to('search')}}',
                    data:{'search':$value},
                    success:function(data){
                    $('tbody').html(data);
                }
            });
        });
    </script>
@endsection