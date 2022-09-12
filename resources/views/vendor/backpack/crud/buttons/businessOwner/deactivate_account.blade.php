@if ($crud->hasAccess('deactivate account'))
	@if($entry->credential)
		@if($entry->credential->active)
			<a href="javascript:void(0)" onclick="deactivateAccount(this)" data-id="{{ $entry->getKey() }}" data-route="{{ url($crud->route.'/deactivate-account/'.$entry->id) }}" class="btn btn-sm btn-link" data-button-type="deactivateAccount" title="Deactivate Account">
				<i class="fas fa-user-alt-slash"></i> Deactivate Account
			</a>
		@endif
	@endif
@endif

{{-- Button Javascript --}}
{{-- - used right away in AJAX operations (ex: List) --}}
{{-- - pushed to the end of the page, after jQuery is loaded, for non-AJAX operations (ex: Show) --}}
@push('after_scripts') @if (request()->ajax()) @endpush @endif
<script>

	if (typeof deactivateAccount != 'function') {
	  $("[data-button-type=deactivateAccount]").unbind('click');

	  function deactivateAccount(button) {
		// ask for confirmation before deleting an item
		// e.preventDefault();
		var button = $(button);
		var route = button.attr('data-route');
		swal({
		  title: "Confirmation",
		  text: "Are you sure you want to deactivate the account of this business owner?",
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
			  text: "Deactivate Account",
			  value: true,
			  visible: true,
			  className: "bg-danger",
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
