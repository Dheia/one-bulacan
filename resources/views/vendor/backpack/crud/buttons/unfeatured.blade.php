@if ($crud->hasAccess('unfeatured'))
    @if($entry->getAttributeValue('isActive') == 1)
        <li>
        	<a href="{{ url($crud->route.'/#unfeatureModal') }}" data-route="{{ url($crud->route.'/unfeature') }}" data-toggle="modal" data-id="{{ $entry->getKey() }}"  data-title="{{$entry->getAttributeValue('business_name') }}" data-target="#unfeatureModal" data-action="unfeature" class="btn btn-sm btn-link"><i class="fa fa-close"></i> Unfeature</a>
        </li>
    @elseif($entry->getAttributeValue('isActive') == 0)
    	<li>
        	<a href="{{ url($crud->route.'/#unfeatureModal') }}" data-route="{{ url($crud->route.'/feature') }}" data-toggle="modal" data-id="{{ $entry->getKey() }}"  data-title="{{$entry->getAttributeValue('business_name') }}" data-target="#unfeatureModal" data-action="feature"  class="btn btn-sm btn-link"><i class="fa fa-check"></i> Feature</a>
        </li>
    @endif
@endif

