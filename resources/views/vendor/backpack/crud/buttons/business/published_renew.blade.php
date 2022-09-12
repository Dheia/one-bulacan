
@if ($crud->hasAccess('published_renew'))
    <a href="{{ url($crud->route.'/#publishedRenewalModal') }}"  data-route="{{ url($crud->route.'/'.$entry->getKey()) }}" data-toggle="modal" data-id="{{ $entry->getKey() }}"  data-title="{{$entry->getAttributeValue('name') }}" data-target="#publishedRenewalModal"  class="btn btn-sm btn-link">
    	<i class="fa fa-check"></i> Renew
    </a>
@endif