<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Blockchain</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
		
		 <!-- Scripts -->
		<script src="{{ asset('js/app.js') }}" defer></script>

        <!-- Styles -->
		<link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <style>
           table {
				table-layout: fixed;
				word-wrap: break-word;
			}
        </style>

    </head>
    <body class="container-fluid my-5">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
					<div class="card-header bg-transparent">
                        <div class="row">
                            <div class="col-md-12">
								<h2 class="text-center mt-2">Wallet Details</h2>
							</div>
                            
                        </div>
                    </div>
					
					 <div class="row mt-4">
						<div class="col-md-12">
							<h5 class="text-center">{{ $data->network }}</h5>
						</div>
						
					</div>
					<div class="card-body">
						<table class="table">
							<thead class="thead-light">
							<tr>
								<th>Label</th>
								<th>Address</th>
								<th>Available Balance</th>
								<th>Pending Received Balance</th>
								<th>QR Code</th>
								<th>Action</th>
							</tr>
							</thead>
							<tbody>
							@foreach($data->addresses ?? [] as $address)
								<tr>
									<td class="align-middle">{{ $address->label }}</td>
									<td class="align-middle">{{ $address->address }}</td>
									<td class="align-middle">{{ $address->available_balance }}</td>
									<td class="align-middle">{{ $address->pending_received_balance }}</td>
									<td class="align-middle"><a target="_blank" href="https://chart.googleapis.com/chart?chs=250x250&cht=qr&chl={{ $address->address }}">Get Code</a></td>
									<td class="align-middle">
										<a class="" href="{{ route('open-form', ['wallet_id'=>$data->wallet_id, 'address'=>$address->address]) }}">Send Money</a>
									</td>
								</tr>
							@endforeach
							</tbody>
						</table>

					</div>
	
				</div>
				
			</div>
            
        </div>
		<div class="row my-5">
            <div class="col-lg-12 text-center">
				<a href="{{ route('home') }}" class="btn btn-primary btn-md">Back to Home</a>
			</div>
        </div>
    </body>
</html>
