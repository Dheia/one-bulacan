@if ($crud->hasAccess('activate') || $crud->hasAccess('deactivate'))
    @if(isset($entry->active))
        @if(! $entry->active)
            <!-- Activate button -->
            @if($crud->hasAccess('activate'))
                <a href="{{ url($crud->route.'/'.$entry->getKey().'/activate') }}" class="btn btn-sm btn-link">
                    <i class="la la-toggle-off"></i> Activate
                </a>
            @endif
        @else
            <!-- Deactivate button -->
            @if($crud->hasAccess('activate'))
                <a href="{{ url($crud->route.'/'.$entry->getKey().'/deactivate') }}" class="btn btn-sm btn-link">
                    <i class="la la-toggle-on"></i> Deactivate
                </a>
            @endif
        @endif
    @endif
@endif