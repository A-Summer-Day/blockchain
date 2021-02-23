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
								<h2 class="text-center mt-2">All Your Wallets In One Place</h2>
							</div>
                            
                        </div>
                    </div>
					@foreach($data ?? [] as $wallet)
					<div class="card-body">
						<table class="table">
							<thead class="thead-light">
							<tr>
								<th>Network</th>
								<th>Available Balance</th>
								<th>Pending Received Balance</th>
								<th>Action</th>
							</tr>
							</thead>
							<tbody>
								<tr>
									<td class="align-middle">{{ $wallet->network }}</td>
									<td class="align-middle">{{ $wallet->available_balance }}</td>
									<td class="align-middle">{{ $wallet->pending_received_balance }}</td>

									<td class="align-middle">
										<a class="" href="{{ route('wallet-details', $wallet->id) }}">View Wallet Details</a>
									</td>
								</tr>
							</tbody>
						</table>

					</div>
					@endforeach
				</div>
			</div>
            
        </div>
    </body>
</html>
