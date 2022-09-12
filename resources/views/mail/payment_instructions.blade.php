
<style type="text/css">
	* {
		box-sizing: border-box;
	}

	body {
		margin: 0;
		font-family: Arial, Helvetica, sans-serif;

	}

	.bg-primary {
		background-color: #2d3a4c !important;
	}

	.text-decoration-underline {
		text-decoration: underline;
	}

	.text-primary {
		color: #fca70b !important;
	}

	.text-brown {
		color: #532f17 !important;
	}

	.text-dark {
		color: #343a40 !important;
	}

	.text-white {
		color: #fff !important;
	}

	.text-center {
		text-align: center;
	}

	.text-left {
		text-align: left;
	}

	.text-right {
		text-align: right;
	}

	.d-block {
		display: block;
	}

	.m-0 {
		margin: 0;
		margin-bottom: 4px;
	}

	.m-l-1 {
		margin-left: 10pxl
	}

	.m-r-1 {
		margin-right: 10pxl
	}

	.wrapper {
		height: 100%; 
		min-width: 600px;
		width: auto; 
		background: #c3ced1; 
		padding: 60px;
		overflow-y: auto;
	}

	.second-wrapper {
		height: auto; 
		width: 80%; 
		background: #FFF; 
		margin: auto;
		position: relative;
	}
	
	.header {
		color: #FFF;
	}

	.table {
		width: 100%;
		/*border: 1px solid #ccc;*/
		padding: 10px;
	}

	.table td {
		font-size: 13px;
		vertical-align: top;
	}

	.items {
		background: #f4f6f7;
		margin-top: 30px;
	}
	
	.items table td {
		font-size: 14px;
		padding-top: 3px;
		padding-bottom: 3px;
	}

	.body {
		background: #FFF;
	}

	.footer {
		/*position: absolute;*/
		background: #FFF;
		padding: 20px;
		width: 100%;
	}

	.m-t-0 {
		margin-top: 0 !important;
	}

	.m-b-0 {
		margin-bottom: 0 !important;
	}

	pre {
  		overflow: hidden; 
  		white-space: break-spaces; 
  		word-break: break-word;
		padding-left: 50px;
		padding-right: 50px;
  	}
</style>

<div class="wrapper" style="height: 100%; min-width: 600px; width: auto; background: #c3ced1; padding: 60px; overflow-y: auto;">
	
	<div class="second-wrapper" style="height: auto; width: 80%; background: #FFF; margin: auto; position: relative;">
		
		<!-- <div class="header" style="padding: 20px; background: #156dcc"> -->
		<div class="header" style="padding: 20px; color: #FFF; text-align: center !important;">
			<img src="{{ url($business->logo) }}" alt="Business Logo" width="100" style="display: block; margin: auto;">
			<h3 style="text-align: center !important; color: #532f17 !important; margin-bottom: 0 !important;">
				{{ $business->name }}
			</h3>
			<p style="text-align: center !important; color: #532f17 !important; margin-bottom: 0 !important; font-size: 12px;">
				{{ $business->complete_address }}
			</p>
		</div>

		<div class="body" style="padding: 20px 20px 40px 20px; background: #FFF; margin: 0; font-family: Arial, Helvetica, sans-serif;">

			<!-- TRANSACTION MESSAGE (STATUS) -->
			<div class="items" style="padding: 20px; background: #f4f6f7; margin-top: 30px;">
				<table class="table" style=" width: 100% !important; padding: 10px; !important;">
					<tbody>
						<tr>
							<td class="text-center text-brown" style="text-align: center !important; color: #532f17 !important; 
								font-size: 14px !important;
								padding-top: 3px !important;
								padding-bottom: 3px !important;">
									<b>{{ $paynamicsPayment->response_message }}</b>
							</td>
						</tr>
					</tbody>
				</table>
			</div>

			<div class="items" style="padding: 20px; background: #f4f6f7; margin-top: 30px;">
				<div class="container-fluid text-center" style="text-align: center !important;">
					<table class="table" style="width: 100% !important; padding: 10px; !important;" width="100%">
						<tbody>
							<!-- DATE -->
							<tr>
								<td class="text-left text-brown" style="text-align: left !important; color: #532f17 !important; 
									font-size: 14px !important;
									padding-top: 3px !important;
									padding-bottom: 3px !important;">
										<b>Date :</b>
								</td>
								<td class="text-right text-brown"  style="text-align: right !important; color: #532f17 !important;
									font-size: 14px !important;
									padding-top: 3px !important;
									padding-bottom: 3px !important;">
									<b>{{ \Carbon\Carbon::parse($paynamicsPayment->timestamp)->format('F d, Y'); }}</b>
								</td>
							</tr>
							<!-- TIME -->
							<tr>
								<td class="text-left text-brown"  style="text-align: left !important; color: #532f17 !important;
									font-size: 14px !important;
									padding-top: 3px !important;
									padding-bottom: 3px !important;">
										<b>Time :</b>
								</td>
								<td style="text-align: right !important; color: #532f17 !important;">
									<b>{{ \Carbon\Carbon::parse($paynamicsPayment->timestamp)->format('h:i A'); }}</b>
								</td>
							</tr>
							<!-- EXPIRY -->
							<tr>
								<td class="text-left text-brown" style="text-align: left !important; color: #532f17 !important;
									font-size: 14px !important;
									padding-top: 3px !important;
									padding-bottom: 3px !important;">
										<b>Exipiry Limit :</b>
								</td>
								<td class="text-right text-brown" style="text-align: right !important; color: #532f17 !important;
									font-size: 14px !important;
									padding-top: 3px !important;
									padding-bottom: 3px !important;">
										<b>{{ \Carbon\Carbon::parse($paynamicsPayment->expiry_limit)->format('F d, Y - h:i A'); }}</b>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>

			<div class="items" style="padding: 20px; background: #f4f6f7; margin-top: 30px;">
				<div class="container-fluid text-center" style="text-align: center !important;">

					<img src="{{ asset($paymentMethod->logo) }}" alt="Payment Logo" style="max-height: 125px !important;">
					<hr>

					<table class="table" style="width: 100% !important; padding: 10px; !important;" width="100%">
						<tbody>
							<!-- REFERENCE NUMBER -->
							<tr>
								<td class="text-left text-brown" style="text-align: left !important; color: #532f17 !important;
									font-size: 14px !important;
									padding-top: 3px !important;
									padding-bottom: 3px !important;">
										<b>Reference Number :</b>
								</td>
								<td class="text-right text-brown" style="text-align: right !important; color: #532f17 !important;
									font-size: 14px !important;
									padding-top: 3px !important;
									padding-bottom: 3px !important;">
										<b> {{ $payment_instructions->pay_reference }} </b>
								</td>
							</tr>
							<!-- AMOUNT -->
							<tr>
								<td class="text-left text-brown" style="text-align: left !important; color: #532f17 !important;
									font-size: 14px !important;
									padding-top: 3px !important;
									padding-bottom: 3px !important;">
									<b>Amount :</b>
								</td>
								<td class="text-right text-brown" style="text-align: right !important; color: #532f17 !important;
									font-size: 14px !important;
									padding-top: 3px !important;
									padding-bottom: 3px !important;">
									<b> PHP {{ number_format($amount, 2, '.', ', ') }} </b>
								</td>
							</tr>
							<!-- INSTRUCTIONS -->
							<tr>
								<td colspan="2" class="text-center text-brown" style="text-align: center !important; color: #532f17 !important;
									font-size: 14px !important;
									padding-top: 3px !important;
									padding-bottom: 3px !important;">
									<b>PAYMENT INSTRUCTION</b>
								</td>
							</tr>
							<tr>
								<td colspan="2" class="text-left text-brown" style="text-align: left !important; color: #532f17 !important;
									font-size: 14px !important;
									padding-top: 3px !important;
									padding-bottom: 3px !important;">
										<pre class="text-brown"
											style="overflow: hidden !important; 
											white-space: break-spaces !important; 
											word-break: break-word !important;
										  	padding-left: 50px !important;
										  	padding-right: 50px !important;">
												{!! str_replace("PAYMENT INSTRUCTION", "", $payment_instructions->pay_instructions) !!}
										</pre>
								</td>
							</tr>
						</tbody>
					</table>
				</div>

			</div>

		</div>

		<div class="footer bg-primary text-center" style="background: #FFF; padding: 20px; text-align: center; background-color: #2d3a4c !important;">
			<img src="{{ url('v2/content/one/images/here_icon.png') }}" alt="One Logo" width="50" style="display: block; margin: auto;">
            <h5 class="text-center text-primary m-0 text" style="margin: 0; margin-bottom: 4px; text-align: center; color: #fca70b !important;">
                {{ env('APP_NAME') ?? 'Project One' }}
            </h5>
		</div>

	</div>

</div>