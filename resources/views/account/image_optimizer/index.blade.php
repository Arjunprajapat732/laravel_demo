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
		<h3>This is image optimizer by tinify</h3>
	</div>
	<div class="container my-5">
		<div class="card shadow-sm mb-3">
			<div class="card-body">
				<h5 class="card-title">Upload Image</h5>
				<form class="clone" action="./store" method="post" enctype="multipart/form-data" onsubmit="return checkFileSize()">
					@csrf
					<div class="mb-3">
						<label for="image" class="form-label">Choose an image ( 10 MB )</label>
						<div class="file-input-wrapper">
							<label class="btn btn-outline-primary file-input-label">
								Browse
								<input type="file" class="file-input" id="image" name="image" accept="image/*" onchange="displayFileSize(this)">
							</label>
						</div>
					</div>
					<p id="fileSizeMessage" class="file-size-message"></p>
					<button type="submit" class="btn btn-primary">Submit</button>
				</form>
			</div>
		</div>
		@foreach($all_images as $image)
			<div class="card mb-2" style="width: 18rem;">
				@if($image->extension != 'pdf')
					<img class="card-img-top" src="{{ asset('profile_images/' . $image->filename) }}" alt="Card image cap">
				@else
					<span><i class="bi bi-file-pdf"></i></span>
				@endif
				<div class="card-body">
					<h5 class="card-title">{{ $image->filename }}</h5>
					<p class="card-text">{{ $image->filesize }}</p>
					<a href="#" class="btn btn-primary">Download</a>
				</div>
			</div>
		@endforeach

	</div>
</div>
@endsection

@section('script')
	<script>
		function displayFileSize(input) {
			const fileSizeMessage = document.getElementById('fileSizeMessage');
			if (input.files && input.files[0]) {
				const fileSize = input.files[0].size / 1024 / 1024; // in MB
				fileSizeMessage.textContent = `File size: ${fileSize.toFixed(2)} MB`;
			} else {
				fileSizeMessage.textContent = '';
			}
		}

		function checkFileSize() {
			const input = document.getElementById('image');
			if (input.files && input.files[0]) {
				const fileSize = input.files[0].size / 1024 / 1024; // in MB
				if (fileSize > 10) {
					alert('File size exceeds 10 MB');
					return false;
				}
			}
			return true;
		}
	</script>
@endsection