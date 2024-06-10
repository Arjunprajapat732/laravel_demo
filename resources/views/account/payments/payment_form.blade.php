<!-- account/dashboard.blade.php -->

@extends('account.body.app')

@section('content')
<div>
	<div class="container">
	    <h2 class="mb-4">Payment Details</h2>

	    <form>
	        <div class="form-group">
	            <label for="cardNumber">Card Number</label>
	            <input type="text" class="form-control" id="cardNumber" placeholder="Enter card number" required>
	        </div>

	        <div class="form-row">
	            <div class="form-group col-md-6">
	                <label for="expirationDate">Expiration Date</label>
	                <input type="text" class="form-control" id="expirationDate" placeholder="MM/YY" required>
	            </div>
	            <div class="form-group col-md-6">
	                <label for="cvv">CVV</label>
	                <input type="text" class="form-control" id="cvv" placeholder="CVV" required>
	            </div>
	        </div>

	        <div class="form-group">
	            <label for="cardHolderName">Cardholder Name</label>
	            <input type="text" class="form-control" id="cardHolderName" placeholder="Enter cardholder name" required>
	        </div>
	        <br>
	        @include('account.payments.googlepay')
	        @include('account.payments.square_payment')
	        <!-- <button type="submit" id="data_submit" class="btn btn-primary mt-2">Submit Payment</button> -->
	    </form>
	</div>
</div>
@endsection