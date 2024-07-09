<!-- account/dashboard.blade.php -->

@extends('account.body.app')

@section('content')
<style>
	.file-input-wrapper {
		position: relative;
		overflow: hidden;
		display: inline-block;
	}

	.file-input {
		font-size: 1.25rem;
		position: absolute;
		left: 0;
		top: 0;
		opacity: 0;
	}

	.file-input-label {
		display: inline-block;
		padding: 0.5rem 1.5rem;
		cursor: pointer;
	}

	.file-size-message {
		margin-top: 0.5rem;
		color: red;
	}
</style>
<div>
	<div class="row mb-3">
		<h3>This is S3 policy changer</h3>
	</div>
	<div class="container my-5">
		<div class="card shadow-sm mb-3">
			<div class="card-body">
				<h5 class="card-title">Policy Change</h5>
			</div>
			<a href="{{ url('account/s3_policy/grant-access') }}" class="btn btn-primary my-2">Grant Access</a>
			<a href="{{ url('account/s3_policy/remove-access') }}" class="btn btn-danger">Remove Access</a>
		</div>
	</div>
</div>
@endsection

@section('script')
@endsection