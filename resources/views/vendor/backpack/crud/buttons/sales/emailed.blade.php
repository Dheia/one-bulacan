@if ($crud->hasAccess('email'))
    @if($entry->getAttributeValue('emailed') == 0)
        <a href="javascript:void(0)" onclick="email(this)" data-name="{{ $entry->getAttributeValue('business_name') }}" data-id="{{ $entry->getKey() }}" data-route="{{ url($crud->route.'/email/'.$entry->getKey()) }}" class="btn btn-sm btn-outline-primary" data-button-type="email"><i class="fas fa-envelope"></i> Email</a>
    @else
        <a class="btn btn-sm btn-primary active"><i class="fas fa-comment-dots"></i> Emailed</a>
    @endif
@endif

@push('after_scripts') @if (request()->ajax()) @endpush @endif
<script>

	if (typeof email != 'function') {
	  $("[data-button-type=email]").unbind('click');

	  function email(button) {
		// ask for confirmation before deleting an item
		// e.preventDefault();
		var button = $(button);
		var route = button.attr('data-route');
        var business_name = button.attr('data-name');
		swal({
		  title: "Confirmation",
		  text: "Are you sure you want to email "+button.attr('data-name')+ "?",
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
			  text: "Email",
			  value: true,
			  visible: true,
			  className: "bg-primary",
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
