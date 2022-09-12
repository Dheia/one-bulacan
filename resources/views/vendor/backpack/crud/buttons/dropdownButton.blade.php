<div class="dropdown" style="display: initial;">
	<a href="#" class="btn btn-sm btn-link dropdown-toggle text-primary pl-1 icon-rmv" data-toggle="dropdown" title="More" id="dropdownMenu{{ $entry->id }}" aria-haspopup="true" aria-expanded="false">
	    More  <i class="fa fa-caret-down"></i>
	</a>
	@if(isset($crud->data['dropdownButtons']))
		<ul class="dropdown-menu" aria-labelledby="dropdownMenu{{ $entry->id }}" style="right: 0 !important; left: auto !important;">
			@foreach($crud->data['dropdownButtons'] as $item)
				@if($item === "divider")
					<li class="divider"></li>
				@else
					<li>
						@include('vendor.backpack.crud.buttons.' . $item)
					</li>
				@endif
			@endforeach
		</ul>
	@endif
</div>
