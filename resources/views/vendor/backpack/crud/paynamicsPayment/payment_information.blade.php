<div class="m-t-10 m-b-10 p-l-20 p-r-20 p-t-10 p-b-10">
	<div class="container">
		<div class="col-md-12">

			<!-- Business Information -->
			<div class="row">
				<div class="col-md-12 text-center">
					<!-- Business Logo -->
					<img src="{{ asset($entry->paymentable->logo) }}" alt="Payment Logo" style="max-height: 75px !important;">
					<!-- Business Name -->
					<h5><b>{{ $entry->payment_to }}</b></h5>
				</div>
			</div>

			<div class="card mt-3">
				<!-- Payment Method Logo -->
				<div class="card-header text-center">
					<img src="{{ asset($entry->paymentMethod->logo) }}" alt="Payment Logo" style="max-height: 40px !important;">
				</div>
				<div class="col-md-12 p-3 text-center">
					<!-- Paynamics Response -->
					@if ($entry->response_code === 'GR001' || $entry->response_code === 'GR002')
						<h5>
							<span class="badge badge-success">
								{{ $entry->response_message }}
							</span>
						</h5>
					@elseif($entry->response_code === 'GR033')
						<h5>
							<span class="badge badge-default">
								{{ $entry->response_message }}
							</span>
						</h5>
					@else
						<h5>
							<span class="badge badge-danger">
								{{ $entry->response_message }}
							</span>
						</h5>
					@endif
					<h5><span class="badge"> {{ $entry->response_code }} </span></h5>
				</div>
			</div>

			<!-- Datetime -->
			<div class="card mt-3">
				<div class="col-md-12 p-3">
					<div class="row">
						<div class="col-md-6 col-6 text-left">
							<b>Date :</b>
						</div>
						<div class="col-md-6 col-6 text-right">
							{{ \Carbon\Carbon::parse($entry->timestamp)->format('M d, Y') }}
						</div>
					</div>
					<!-- Time -->
					<div class="row">
						<div class="col-md-6 col-6 text-left">
							<b>Time :</b>
						</div>
						<div class="col-md-6 col-6 text-right">
							{{ \Carbon\Carbon::parse($entry->timestamp)->format('h:i A') }}
						</div>
					</div>
				</div>
			</div>

			<!-- Payer Information -->
			<div class="card mt-3">
				<div class="col-md-12 p-3">
					<div class="row">
						<div class="col-md-6 text-left">
							<b>From :</b>
						</div>
						<div class="col-md-6 text-right">
							{{ $entry->payment_from }}
						</div>
					</div>
					<!-- Mobile No. -->
					<div class="row">
						<div class="col-md-6 text-left">
							<b>Mobile :</b>
						</div>
						<div class="col-md-6 text-right">
							<a href="tel:{{ $entry->mobile }}"> {{ $entry->mobile }} </a>
						</div>
					</div>
					<!-- Email -->
					<div class="row">
						<div class="col-md-6 text-left">
							<b>Email :</b>
						</div>
						<div class="col-md-6 text-right">
							<a href="mailto:{{ $entry->email }}"> {{ $entry->email }} </a>
						</div>
					</div>
					<!-- Address -->
					<div class="row">
						<div class="col-md-6 text-left">
							<b>Address :</b>
						</div>
						<div class="col-md-6 text-right">
							{{ $entry->address }}
						</div>
					</div>
				</div>
			</div>

			<!-- Payment Information -->
			<div class="card mt-3">
				<div class="col-md-12 p-3">
					<!-- Request ID -->
					<div class="row">
						<div class="col-md-6 text-left">
							<b>Request ID :</b>
						</div>
						<div class="col-md-6 text-right">
							{{ $entry->request_id }}
						</div>
					</div>
					<!-- Reference No. -->
					@if($entry->pay_reference)
					<div class="row">
						<div class="col-md-6 text-left">
							<b>Reference No :</b>
						</div>
						<div class="col-md-6 text-right">
							{{ $entry->pay_reference }}
						</div>
					</div>
					@endif
					<!-- Amount -->
					<div class="row">
						<div class="col-md-6 text-left">
							<b>Amount :</b>
						</div>
						<div class="col-md-6 text-right">
							<b> PHP {{ number_format($entry->amount, 2, '.', ', ') }} </b>
						</div>
					</div>
					<!-- Fee -->
					<div class="row">
						<div class="col-md-6 text-left">
							<b>Fee :</b>
						</div>
						<div class="col-md-6 text-right">
							<b> PHP {{ number_format($entry->fee, 2, '.', ', ') }} </b>
						</div>
					</div>
					<hr>
					<!-- Amount -->
					<div class="row">
						<div class="col-md-6 text-left">
							<b>Total :</b>
						</div>
						<div class="col-md-6 text-right text-danger">
							<b> PHP {{ number_format($entry->total_amount, 2, '.', ', ') }} </b>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="clearfix"></div>