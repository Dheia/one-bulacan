@if ($crud->hasAccess('add_coupon'))
    <a href="{{ url('one-portal/coupon/create?business_id=' . $entry->getKey()) }}" class="btn btn-sm btn-link">
    	<i class="fa fa-plus"></i> 
    	Add Coupon
    </a>
@endif