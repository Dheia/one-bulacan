
<style type="text/css">
	* {
		box-sizing: border-box;
	}

	body {
		margin: 0;
		font-family: Arial, Helvetica, sans-serif;

	}

	.text-decoration-underline {
		text-decoration: underline;
	}

	.text-primary {
		color: #0e6ea6 !important;
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
		margin-top: 50px;
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

<div class="wrapper">
	
	<div class="second-wrapper">
		
		<!-- <div class="header" style="padding: 20px; background: #156dcc"> -->
		<div class="header" style="padding: 20px;">
			<img src="{{ asset('v2/content/one/images/here_icon.png') }}" alt="logo" width="200" style="display: block; margin: auto;">
			<h1 class="text-center text-primary m-0 text">
				{{ env('APP_NAME') ?? 'Project One' }}
			</h1>
			<p class="text-center text-primary m-0" style="font-size: 12px;">
				{{ Config::get('settings.contact_address') }}
			</p>
		</div>

		<div class="body" style="padding: 20px;">

			<div class="items" style="padding: 20px;">
				<table class="table">
					<tbody>
						<tr>
							<td>Date :</td>
							<td class="text-right">
								<b>{{ date_format($data->created_at, 'F j, Y') }}</b>
							</td>
						</tr>
						<tr>
							<td>Time :</td>
							<td class="text-right">
								<b>{{ date_format($data->created_at, 'h:i A') }}</b>
							</td>
						</tr>
						<tr>
							<td>Sender Name :</td>
							<td class="text-right">{{ $data->sender_name }}</td>
						</tr>
						<tr>
							<td>Sender Email :</td>
							<td class="text-right">
								<a href="mailto:{{ $data->sender_email }}"> {{ $data->sender_email }} </a>
							</td>
						</tr>
					</tbody>
				</table>
			</div>

			<div class="items" style="padding: 20px;">
				<table class="table">
					<tbody>
						<tr>
							<td colspan="3" class="text-center" style="font-size: 16px;">
								<b> Message </b> 
							</td>
						</tr>
						<tr>
							<td colspan="2">
								<b> Subject :</b> 
							</td>
						</tr>
						<tr>
							<td> {{ $data->subject }} </td>
						</tr>
						<!-- EMAIL CONTENT -->
						<tr>
							<td colspan="2">
								<b> Content :</b> 
							</td>
						</tr>
						<tr>
							<td> {{ $data->content }} </td>
						</tr>
					</tbody>
				</table>
			</div>

		</div>

		<div class="footer">
			{{-- <img src="" alt="" width="150" style="display: block; margin: auto;"> --}}
		</div>

	</div>

</div>