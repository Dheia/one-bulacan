

<div class="m-t-10 m-b-10 p-l-20 p-r-20 p-t-10 p-b-10">
	<div class="row">
		<div class="col-md-12">
			@if( count($entry->businesses) > 0 )
				<strong>Business List</strong>
				<br>
				@foreach($entry->businesses as $business)
					<li> 
						<a href="{{ url('admin-one/business/' . $business->id . '/show') }}" target="_blank"> {{ $business->name }} </a> 
					</li>
				@endforeach
			@else
				<span class="text-center">No Business List</span>
			@endif
		</div>
	</div>
</div>
<div class="clearfix"></div>