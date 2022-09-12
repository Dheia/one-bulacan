{{-- regular object attribute --}}
@php
	$value = data_get($entry, $column['name']);

	$column['escaped'] = $column['escaped'] ?? true;
    $column['limit'] = $column['limit'] ?? 40;
    $column['text'] = Str::limit($value, $column['limit'], '[...]');
@endphp

@if($value == "FOR RENEWAL")
	<span class="badge badge-warning">
		@includeWhen(!empty($column['wrapper']), 'crud::columns.inc.wrapper_start')
	        @if($column['escaped'])
	            {{ $column['text'] }}
	        @else
	            {!! $column['text'] !!}
	        @endif
	    @includeWhen(!empty($column['wrapper']), 'crud::columns.inc.wrapper_end')
	</span>
@elseif($value == "EXPIRED")
	<span class="badge badge-danger">
		@includeWhen(!empty($column['wrapper']), 'crud::columns.inc.wrapper_start')
	        @if($column['escaped'])
	            {{ $column['text'] }}
	        @else
	            {!! $column['text'] !!}
	        @endif
	    @includeWhen(!empty($column['wrapper']), 'crud::columns.inc.wrapper_end')
	</span>
@elseif($value == "NOT ACTIVE")
	<span class="badge badge-secondary">
		@includeWhen(!empty($column['wrapper']), 'crud::columns.inc.wrapper_start')
	        @if($column['escaped'])
	            {{ $column['text'] }}
	        @else
	            {!! $column['text'] !!}
	        @endif
	    @includeWhen(!empty($column['wrapper']), 'crud::columns.inc.wrapper_end')
	</span>
@elseif($value == "ACTIVE")
	<span class="badge badge-success">
		@includeWhen(!empty($column['wrapper']), 'crud::columns.inc.wrapper_start')
	        @if($column['escaped'])
	            {{ $column['text'] }}
	        @else
	            {!! $column['text'] !!}
	        @endif
	    @includeWhen(!empty($column['wrapper']), 'crud::columns.inc.wrapper_end')
	</span>
@endif