@if ($crud->hasAccess('paid'))
	@if($entry->getAttributeValue('business_last_log') ?? '')
		@if($entry->getAttributeValue('business_last_log') == 'Drafted')
		    <a class="btn btn-sm btn-secondary active"><i class="fas fa-coins"></i> Drafted</a>
		@else
			@if($entry->getAttributeValue('paid') == 0)
		        <a href="{{ url($crud->route.'/#paidModal') }}"  data-route="{{ url($crud->route.'/'.$entry->getKey()) }}" data-toggle="modal" data-id="{{ $entry->getKey() }}"  data-title="{{$entry->getAttributeValue('business_name') }}" data-target="#paidModal" class="btn btn-sm btn-outline-primary"><i class="fas fa-coins"></i> Paid</a>
		    @else
		    	@if($entry->getAttributeValue('complimentary') == 1)
		    		<a class="btn btn-sm btn-warning active"><i class="fas fa-coins"></i> Complimentary</a>
		    	@else
					<a class="btn btn-sm btn-primary active"><i class="fas fa-coins"></i> Paid</a>
		    	@endif
		    @endif
		@endif
	@else
	    <a class="btn btn-sm btn-secondary active"><i class="fas fa-coins"></i> Unpublished</a>
	@endif
@endif