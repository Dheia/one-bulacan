@if ($crud->hasAccess('read') || $crud->hasAccess('unread'))
    @isset($entry->is_read)
        @if(! $entry->read_at)
            <!-- Read button -->
            @if($crud->hasAccess('read'))
                <a href="{{ url($crud->route.'/'.$entry->getKey().'/read') }}" class="btn btn-sm btn-link">
                    <i class="la la-envelope"></i> Mark as read
                </a>
            @endif
        @else
            <!-- Unread button -->
            @if($crud->hasAccess('unread'))
                <a href="{{ url($crud->route.'/'.$entry->getKey().'/unread') }}" class="btn btn-sm btn-link">
                    <i class="la la-envelope-open"></i> Mark as unread
                </a>
            @endif
        @endif
    @endisset
@endif