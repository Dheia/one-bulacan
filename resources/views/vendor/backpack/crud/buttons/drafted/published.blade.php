@if ($crud->hasAccess('published'))
    @if($entry->getAttributeValue('drafted') == 1)
        <a href="{{ url($crud->route.'/#publishModal') }}"  data-route="{{ url($crud->route.'/'.$entry->getKey()) }}" data-toggle="modal" data-id="{{ $entry->getKey() }}"  data-title="{{$entry->getAttributeValue('name') }}" data-target="#publishModal" class="btn btn-sm btn-link"><i class="fa fa-check"></i> Published</a>
    @else
        <a href="javascript:void(0)" onclick="draftEntry(this)" data-id="{{ $entry->getKey() }}" data-route="{{ url($crud->route.'/draft/'.$entry->getKey()) }}" class="btn btn-sm btn-link" data-button-type="draft"><i class="fa fa-close"></i> Draft</a>
    @endif
@endif

@push('after_scripts') @if (request()->ajax()) @endpush @endif
@if (!request()->ajax()) @endpush @endif