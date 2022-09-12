@if ($crud->hasAccess('reset-password'))
	@if($entry->active)
		@if($entry->credential)
			<a href="javascript:void(0)" onclick="resetPassword(this)" data-id="{{ $entry->getKey() }}" data-route="{{ url($crud->route.'/reset-password/'.$entry->getKey()) }}" class="btn btn-sm btn-link" data-button-type="resetPassword" title="Reset Password">
				<i class="la la-undo-alt"></i> Reset Password
			</a>
		@endif
	@endif
@endif

{{-- Button Javascript --}}
{{-- - used right away in AJAX operations (ex: List) --}}
{{-- - pushed to the end of the page, after jQuery is loaded, for non-AJAX operations (ex: Show) --}}
@push('after_scripts') @if (request()->ajax()) @endpush @endif
<script>

	if (typeof resetPassword != 'function') {
	  $("[data-button-type=resetPassword]").unbind('click');

	  function resetPassword(button) {
		// ask for confirmation before deleting an item
		// e.preventDefault();
		var button = $(button);
		var route = button.attr('data-route');
		swal({
		  title: "Confirmation",
		  text: "Are you sure you want to reset the password of this business owner?",
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
			  text: "Reset Password",
			  value: true,
			  visible: true,
			  className: "bg-warning",
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
