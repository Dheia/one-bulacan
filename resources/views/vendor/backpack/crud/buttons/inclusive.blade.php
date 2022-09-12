@if ($crud->hasAccess('inclusive') || $crud->hasAccess('exclusive'))
    @if(isset($entry->is_inclusive))
        @if(! $entry->is_inclusive)
            <!-- Inclusive button -->
            @if($crud->hasAccess('inclusive'))
                <a href="{{ url($crud->route.'/'.$entry->getKey().'/inclusive') }}" class="btn btn-sm btn-link">
                    <i class="la la-toggle-off"></i> Inclusive
                </a>
            @endif
        @else
            <!-- Exclusive button -->
            @if($crud->hasAccess('exclusive'))
                <a href="{{ url($crud->route.'/'.$entry->getKey().'/exclusive') }}" class="btn btn-sm btn-link">
                    <i class="la la-toggle-on"></i> Exclusive
                </a>
            @endif
        @endif
    @endif
@endif