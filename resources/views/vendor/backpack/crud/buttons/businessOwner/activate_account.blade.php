@if ($crud->hasAccess('activate account'))
	@if(!$entry->credential)

		<a href="javascript:void(0)" onclick="activateAccount(this)" data-id="{{ $entry->getKey() }}" data-route="{{ url($crud->route.'/activate-account/'.$entry->getKey()) }}" class="btn btn-sm btn-link" data-button-type="activateAccount" title="Activate Account">
			<i class="fas fa-user-alt"></i> Activate Account
		</a>

	@elseif(!$entry->credential->active)

		<a href="javascript:void(0)" onclick="activateAccount(this)" data-id="{{ $entry->getKey() }}" data-route="{{ url($crud->route.'/activate-account/'.$entry->getKey()) }}" class="btn btn-sm btn-link" data-button-type="activateAccount" title="Activate Account">
			<i class="fas fa-user-alt"></i> Activate Account
		</a>

	@endif

@endif

{{-- Button Javascript --}}
{{-- - used right away in AJAX operations (ex: List) --}}
{{-- - pushed to the end of the page, after jQuery is loaded, for non-AJAX operations (ex: Show) --}}
@push('after_scripts') @if (request()->ajax()) @endpush @endif
<script>

	if (typeof activateAccount != 'function') {
	  $("[data-button-type=activateAccount]").unbind('click');

	  function activateAccount(button) {
		// ask for confirmation before deleting an item
		// e.preventDefault();
		var button = $(button);
		var route = button.attr('data-route');
		swal({
		  title: "Confirmation",
		  text: "Are you sure you want to activate the account of this business owner?",
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
			  text: "Activate Account",
			  value: true,
			  visible: true,
			  className: "bg-success",
			}
		  },
		}).then((value) => {
			if (value) {
                // window.location.href = route;
                var url = route;
				var form = $('<form action="' + url + '" method="post">@csrf </form>');
				$('body').append(form);
				form.submit();
            }
		});

      }
	}

	// make it so that the function above is run after each DataTable draw event
	// crud.addFunctionToDataTablesDrawEventQueue('deleteEntry');
</script>
@if (!request()->ajax()) @endpush @endif
