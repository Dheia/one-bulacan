<!DOCTYPE html>	
<head>
	<title>{{ $business->name }} | QR Code</title>
	<meta charset="utf-8" />
    <meta name="viewport" content="width=device-width">

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
	</style>

</head>
<body style="text-align: center;">

		<div style="background: #000; height: 100%; width: 100%; margin: auto; padding: 20px; display: flex; justify-content: center; align-items: center;">

			<!-- TEMPLATE -->
			<img src="{{ asset('v2/content/one/images/arcylic.png') }}" style="height:675px; width:400px; border-style: solid; border-radius: 10px;">

			<!-- BUSINESS LOGO -->
			<div style="position: absolute; top: 30px;">
				<div style="display: flex; justify-content: center; align-items: center; height: 70px; width: 250px;">
					<img src="{{ url($business->logo) }}" alt="Business Logo" style="max-width:250px; max-height:70px;">
				</div>
			</div>

			<!-- SCAN TO PAY -->
			<div style="position: absolute; top:220px;">
				<div style="display: flex; justify-content: center; align-items: center; height: 50px; width: 310px;">
					<h2 style="color:white; max-height: 50px">
						SCAN TO PAY HERE
					</h2>
				</div>
			</div>

			<!-- QR CODE -->
			<div style="position: absolute; top:278px;">
				<div style="display: flex; justify-content: center; align-items: center; height: 293px; width: 275px;">
					{!! $qr_code !!}
				</div>
			</div>
		</div>
		{{-- <img src="{{ asset('v2/content/one/images/arcylic.png') }}" style="height:30%; width:30%; position:relative;"> --}}
		 {{-- <div style="position:absolute; margin-top:-470px; margin-left:700px; border-radius:10px;">
			{!! $qr_code !!}
		 </div> --}}
		 
		{{-- <img src="{{ url($business->logo) }}" alt="Business Logo" style=" position:absolute; height:20%; border-radius:50%; margin-left:-480px; margin-top:20px;" > --}}
		
			{{-- <h3 style="width:350px;  word-wrap: break-word; text-transform: uppercase; color: #532f17 !important; margin-bottom: 0 !important; position:absolute; margin-top:-750px; margin-left:800px; text-align:left;">
				{{ $business->name }}
			</h3>
			<img src="http://127.0.0.1:8000/v2/content/one/images/one-divider-red.png" style="position:absolute; margin-top:85px; margin-left:-300px;">
			<h5 style="width:250px;  word-wrap: break-word; text-transform: uppercase; color: #532f17 !important; margin-bottom: 0 !important; position:absolute; margin-top:-690px; margin-left:845px; text-align:left;">
				{{ $business->complete_address }}
			</h5>
			<h5 style="width:260px;  word-wrap: break-word; text-transform: uppercase; color: #532f17 !important; margin-bottom: 0 !important; position:absolute; margin-top:-640px; margin-left:845px; text-align:left;">
				{{ $business->mobile }}
			</h5>

			<h1 style="color:white; font-size:45px; position:absolute; margin-top:-570px; margin-left:624px;">
				SCAN TO PAY HERE
			</h1> --}}
		
		<!-- <div class="second-wrapper" style="height: auto; width: 80%; background: #FFF; margin: auto; position: relative;"> -->
			
<!-- 		
			<div class="header" style="padding: 20px; color: #FFF; text-align: center !important;">
				<img src="{{ url($business->logo) }}" alt="Business Logo" width="100" style="display: block; margin: auto;">
				<h3 style="text-align: center !important; color: #532f17 !important; margin-bottom: 0 !important;">
					{{ $business->name }}
				</h3>
				<p style="text-align: center !important; color: #532f17 !important; margin-bottom: 0 !important; font-size: 12px;">
					{{ $business->complete_address }}
				</p>
			</div>
	
			<div class="body" style="text-align: center; padding: 20px 20px 40px 20px; background: #FFF; margin: 0; font-family: Arial, Helvetica, sans-serif;">
	
				{!! $qr_code !!}

				<br>
				<h4 style="color: #fca70b !important"> Online Payment </h4>

			</div>
	
			<div class="footer bg-primary text-center" style="background: #FFF; padding: 20px; text-align: center; background-color: #2d3a4c !important;">
				<img src="{{ url('v2/content/one/images/here_icon.png') }}" alt="One Logo" width="50" style="display: block; margin: auto;">
				<h5 class="text-center text-primary m-0 text" style="margin: 0; margin-bottom: 4px; text-align: center; color: #fca70b !important;">
					{{ env('APP_NAME') ?? 'Project One' }}
				</h5>
			</div> -->
		
	
</body>
</html>