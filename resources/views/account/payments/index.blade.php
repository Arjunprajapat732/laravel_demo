<!-- account/dashboard.blade.php -->

@extends('account.body.app')

@section('content')
<style type="text/css">
	.product {
			border: 1px solid #ddd;
			border-radius: 8px;
			margin-bottom: 20px;
			padding: 20px;
	}

	.product img {
		max-width: 100px;
		max-height: 100px;
		margin-right: 20px;
	}

	.buy-button {
		background-color: #28a745;
		color: #fff;
		padding: 8px 15px;
		border: none;
		cursor: pointer;
	}
</style>
<div>
	<div class="container">
		<div class="product">
			<div class="row">
				<div class="col-md-3">
					<img src="https://placekitten.com/100/100" alt="Product 1" class="img-fluid">
				</div>
				<div class="col-md-6">
					<h3>Product 1</h3>
					<p>Description of Product 1 goes here.</p>
					<p>Price: $19.99</p>
				</div>
				<div class="col-md-3">
					<button class="btn btn-success buy-button"> <a class="text-white" href="{{ url('account/payment/payment_form') }}">Buy</a></button>
				</div>
			</div>
		</div>

		<div class="product">
			<div class="row">
				<div class="col-md-3">
					<img src="https://placekitten.com/100/100" alt="Product 2" class="img-fluid">
				</div>
				<div class="col-md-6">
					<h3>Product 2</h3>
					<p>Description of Product 2 goes here.</p>
					<p>Price: $29.99</p>
				</div>
				<div class="col-md-3">
					<button class="btn btn-success buy-button"> <a class="text-white" href="{{ url('account/payment/payment_form') }}">Buy</a></button>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection