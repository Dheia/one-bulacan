@if ($crud->hasAccess('verified'))
    @if($entry->getAttributeValue('verified') == 1)
    	<a class="btn btn-sm btn-primary active"><i class="fas fa-check"></i> Verified</a>
    @else
        <a href="javascript:void(0)" onclick="verify(this)" data-name="{{ $entry->getAttributeValue('name') }}" data-id="{{ $entry->getKey() }}" data-route="{{ url($crud->route.'/verify/'.$entry->getKey()) }}" class="btn btn-sm btn-link" data-button-type="verify"><i class="fa fa-check"></i> Verify</a>
    @endif
@endif

@push('after_scripts') @if (request()->ajax()) @endpush @endif
<script>
	if (typeof unverify != 'function') {
	  $("[data-button-type=unverify]").unbind('click');

	  function unverify(button) {
		// ask for confirmation before deleting an item
		// e.preventDefault();
		var button = $(button);
		var route = button.attr('data-route');
        var business_name = button.attr('data-name');
		swal({
		  title: "Confirmation",
		  text: "Are you sure you want to unverify "+button.attr('data-name')+ "?",
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
			  text: "Unverify",
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

<script>

	if (typeof verify != 'function') {
	  $("[data-button-type=verify]").unbind('click');

	  function verify(button) {
		// ask for confirmation before deleting an item
		// e.preventDefault();
		var button = $(button);
		var route = button.attr('data-route');
        var business_name = button.attr('data-name');
		swal({
		  title: "Confirmation",
		  text: "Are you sure you want to verify "+button.attr('data-name')+ "?",
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
			  text: "Verify",
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
