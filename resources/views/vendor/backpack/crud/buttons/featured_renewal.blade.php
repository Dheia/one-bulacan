{{-- @if ($crud->hasAccess('featured_renewal'))
        <a href="{{ url($crud->route.'/#featuredRenewalModal') }}"  data-route="{{ url($crud->route.'/'.$entry->getKey()) }}" data-toggle="modal" data-id="{{ $entry->getKey() }}"  data-title="{{$entry->getAttributeValue('business_name') }}" data-target="#featuredRenewalModal"  class="btn btn-sm btn-link"><i class="fa fa-check"></i> Renew</a>
@endif --}}

@if ($crud->hasAccess('featured_renewal'))
	@if($entry->getAttributeValue('isActive') == 1)
    	<li>
    		<a href="{{ url($crud->route.'/#featuredRenewalModal') }}"  data-route="{{ url($crud->route.'/'.$entry->getKey()) }}" data-toggle="modal" data-id="{{ $entry->getKey() }}"  data-title="{{$entry->getAttributeValue('business_name') }}" data-target="#featuredRenewalModal"  class="btn btn-sm btn-link"><i class="fa fa-check"></i> Renew</a>
    	</li>
    @endif
@endif