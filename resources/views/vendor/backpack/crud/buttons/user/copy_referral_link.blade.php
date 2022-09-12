@if ($crud->hasAccess('copyReferralLink'))
	<a href="javascript:void(0)" data-id="{{$entry->id}}" data-link="{{ $entry->referral_link }}" onclick="copyReferralLink(this)" class="btn btn-sm btn-link" data-clipboard-target="#refLink{{ $entry->id }}"><i class="la la-copy"></i> Copy Referral Link</a>
@endif

<script>
	function copyReferralLink(button) {
  		/* Get the text field */
		var button 	= $(button);
		var id 		= button.attr('data-id');
		var link 	= button.attr('data-link');

		var refLinkInput 	= document.createElement("input");
	    refLinkInput.style = "position: absolute; left: -1000px; top: -1000px";
	    refLinkInput.value = link;
	    document.body.appendChild(refLinkInput);
	    refLinkInput.select();
	    document.execCommand("copy");
	    document.body.removeChild(refLinkInput);
		// Show an alert with the result
		new Noty({
		    type: "success",
		    text: "Copied the Referral Link: " + link,
		}).show();
	} 
  	
</script>