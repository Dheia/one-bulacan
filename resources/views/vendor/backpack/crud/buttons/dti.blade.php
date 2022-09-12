@if ($crud->hasAccess('dti'))
    @if($entry->getAttributeValue('dti') == 1)
        <a class="btn btn-sm btn-primary active"><i class="fas fa-check"></i> DTI</a>
    @else
    	<a href="javascript:void(0)" onclick="dti(this)" data-name="{{ $entry->getAttributeValue('name') }}" data-id="{{ $entry->getKey() }}" data-route="{{ url($crud->route.'/dti/'.$entry->getKey()) }}" class="btn btn-sm btn-link" data-button-type="dti"><i class="fa fa-check"></i> DTI</a>
    @endif
@endif

@push('after_scripts') @if (request()->ajax()) @endpush @endif
<script>

	if (typeof dti != 'function') {
	  $("[data-button-type=unverify]").unbind('click');

	  function dti(button) {
		// ask for confirmation before deleting an item
		// e.preventDefault();
		var button = $(button);
		var route = button.attr('data-route');
        var business_name = button.attr('data-name');
		swal({
		  title: "Confirmation",
		  text: "Are you sure you want to verify the dti permit of "+button.attr('data-name')+ "?",
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
			  text: "Confirm",
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
