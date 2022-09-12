@if ($crud->hasAccess('job_reopen'))
	@if(($entry->getAttributeValue('end_at') < Carbon\Carbon::now()) == true)
		<a href="javascript:void(0)" onclick="reopenEntry(this)" data-id="{{ $entry->getKey() }}" data-route="{{ url($crud->route.'/reopen/'.$entry->getKey()) }}" class="btn btn-sm btn-link" data-button-type="reopen"><i class="fa fa-check"></i> Reopen</a>
	@endif
@endif

{{-- Button Javascript --}}
{{-- - used right away in AJAX operations (ex: List) --}}
{{-- - pushed to the end of the page, after jQuery is loaded, for non-AJAX operations (ex: Show) --}}
@push('after_scripts') @if (request()->ajax()) @endpush @endif
<script>

	if (typeof reopenEntry != 'function') {
	  $("[data-button-type=reopen]").unbind('click');

	  function reopenEntry(button) {
		// ask for confirmation before deleting an item
		// e.preventDefault();
		var button = $(button);
		var route = button.attr('data-route');
		swal({
		  title: "Confirmation",
		  text: "Are you sure you want to reopen this job?",
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
			  text: "Reopen",
			  value: true,
			  visible: true,
			  className: "bg-success",
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
