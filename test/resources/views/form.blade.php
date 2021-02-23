<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Blockchain</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

		
		 <!-- Scripts -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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
                 @if (!$address)
					<h4 class="h2 text-white d-inline-block mb-0">
                        <span>Sorry you do not have access to this page</span>
                    </h4>
				@else
					<h4 class="h2 text-center">
                        <span>Send Money</span>
						<h5 class="text-center my-4">Current Balance: {{ $address->available_balance }} </h5>
                    </h4>
					@if(Session::has('success') && !empty(Session::get('success')))
					<div class="container-fluid mt--6">
						<div class="row">
							<div class="col-md-12">
								<div
									class="alert alert-success alert-dismissible"
									data-autoclose
								>
									<button
										type="button"
										class="close"
										data-dismiss="alert"
										aria-label="Close"
									>
										<span aria-hidden="true">&times;</span>
									</button>
									{{ Session::get('success')  }}
								</div>
							</div>
						</div>
					</div>
					@endif
					@if(Session::has('error') && !empty(Session::get('error')))
					<div class="container-fluid mt--6">
						<div class="row">
							<div class="col-md-12">
								<div
									class="alert alert-danger alert-dismissible"
									data-autoclose
								>
									<button
										type="button"
										class="close"
										data-dismiss="alert"
										aria-label="Close"
									>
										<span aria-hidden="true">&times;</span>
									</button>
									{{ Session::get('error') }}
								</div>
							</div>
						</div>
					</div>
					@endif
					{{ Form::open(['role' => 'form', 'route' => ['send-money'], 'method' => 'post', 'id' => 'send-money-form']) }}
				
					<div class="container-fluid mt--6">
					
						<div class="row">
							<div class="col-lg-12">
								<div class="card">
									<div class="card-body">
										<div class="row mb-2">
											<div class="col-lg-12">
												<div class="row">
													<div class="col-12">
														<div class="form-group required">
															{{ Form::label('to_address', 'Address', ['for' => 'to_address']) }}&nbsp;
															<i  title="Required" data-toggle="tooltip" class="fa fa-info-circle fa-sm"></i>
															{{ Form::text('to_address', null, array('required' => 'required', 'class' => 'form-control')) }}
														</div>
													</div>
												</div>

												<div class="row">
													<div class="col-12">
														<div class="form-group required">
															{{ Form::label('amount', 'Amount', ['for' => 'amount']) }}&nbsp;
															<i  title="Required.<br/> Minimum amount: {{ number_format($address->minimum_amount,5) }}" data-html="true" data-toggle="tooltip" class="fa fa-info-circle fa-sm"></i>
															{{ Form::number('amount', null, array('required' => 'required', 'step' => '0.00002', 'min' => $address->minimum_amount, 'max' => $address->available_balance, 'class' => 'form-control')) }}
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-12">
														{{ Form::hidden('from_address', $address->address) }}
													</div>
												</div>
												<div class="row">
													<div class="col-12">
														{{ Form::hidden('wallet_id', $address->wallet_id) }}
													</div>
												</div>

											</div>
										</div>

									</div>
								</div>
							</div>
							<div class="col-lg-12 text-center mt-5 mb-3">
								{{ Form::button('Send', ['type'=>'submit', 'class'=>'btn btn-primary btn-md']) }}
								<a href="{{ route('wallet-details', $address->wallet_id) }}" class="btn btn-secondary btn-md">Cancel</a>
									
							</div>
							<div class="col-lg-12 text-center">
								
								<a href="{{ route('home') }}" class="btn btn-success btn-md">Back to Home</a>
									
							</div>
						</div>
					</div>
					{{ Form::close() }}
				@endif
			</div>
            
        </div>
		
		<script>
			$(document).ready(function() {
				$('[data-toggle="tooltip"]').tooltip();
			});
		</script>
    </body>
</html>
