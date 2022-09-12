@if ($crud->hasAccess('published'))
    @if($entry->getAttributeValue('active') == 0)
        <a href="{{ url($crud->route.'/#publishModal') }}"  data-route="{{ url($crud->route.'/'.$entry->getKey()) }}" data-toggle="modal" data-id="{{ $entry->getKey() }}"  data-title="{{$entry->getAttributeValue('name') }}" data-target="#publishModal" class="btn btn-sm btn-link"><i class="fa fa-check"></i> Published</a>
    @else
    	@if($entry->getAttributeValue('paid') == 1)
        	<a class="btn btn-sm btn-secondary active"><i class="fas fa-close"></i> Draft</a>
        @else
			<a href="javascript:void(0)" onclick="draftEntry(this)" data-id="{{ $entry->getKey() }}" data-route="{{ url($crud->route.'/draft/'.$entry->getKey()) }}" class="btn btn-sm btn-link" data-button-type="draft"><i class="fa fa-close"></i> Draft</a>
        @endif
    @endif
@endif

@push('after_scripts') @if (request()->ajax()) @endpush @endif

{{-- DRAFT MODAL --}}
<script>
	if (typeof draftEntry != 'function') {
	  $("[data-button-type=draft]").unbind('click');

	  function draftEntry(button) {
		// ask for confirmation before deleting an item
		// e.preventDefault();
		var button = $(button);
		var route = button.attr('data-route');
		swal({
		  title: "Confirmation",
		  text: "Are you sure you want to draft this business?",
		  icon: "warning",
		  buttons: {
		  	cancel: {
			  text: "Cancel",
			  value: null,
			  visible: true,
			  className: "bg-secondary",
			  closeModal: true,
			},
		  	submit: {
			  text: "Draft",
			  value: true,
			  visible: true,
			  className: "bg-danger",
			}
		  },
		}).then((value) => {
			if (value) {
                window.location.href = route;
            }
		});

      }
	}

	// make it so that the function above is run after each DataTable draw event
	// crud.addFunctionToDataTablesDrawEventQueue('deleteEntry');
</script>
@if (!request()->ajax()) @endpush @endif