@if ($crud->hasAccess('featured'))
    @if($entry->getAttributeValue('featured') == 0)
        <a href="{{ url($crud->route.'/#featuredModal') }}"  data-route="{{ url($crud->route.'/'.$entry->getKey()) }}" data-toggle="modal" data-id="{{ $entry->getKey() }}"  data-title="{{$entry->getAttributeValue('name') }}" data-target="#featuredModal"  class="btn btn-sm btn-link">
        	<i class="fa fa-check"></i> Featured
        </a>
    @endif
@endif