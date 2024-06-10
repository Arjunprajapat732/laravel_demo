<!-- account/dashboard.blade.php -->

@extends('account.body.app')

@section('content')
<div>
	<div class="row mb-3">
		<h3>This is image optimizer</h3>
		<p>spatie/laravel-image-optimizer</p>
	</div>
	<div class="container mt-5">
		<form class="clone" action="./store" method="post" enctype="multipart/form-data" onsubmit="return checkFileSize()">
			@csrf
			<label for="image">Choose an image (max 10 MB):</label>
			<input type="file" id="image" name="image" accept="image/*" onchange="displayFileSize(this)">
			<p id="fileSizeMessage"></p>
			<button type="submit">Submit</button>
		</form>
		@foreach($all_images as $image)
			<div class="card">
				<img src="{{ asset('storage/images/' . $image->filename) }}" width="30px" alt="Uploaded Image">
				<p>File Name: {{ $image->filename }}</p>
				<p>File Size: {{ $image->filesize }} KB</p>
			</div>
		@endforeach
	</div>
</div>
@endsection

@section('script')
	<script>
		function displayFileSize(input) {
			const fileSize = input.files[0].size / 1024 / 1024; // Convert to MB
			const fileSizeMessage = document.getElementById("fileSizeMessage");

			if (fileSize > 10) {
				fileSizeMessage.innerHTML = "File size exceeds the maximum limit of 10 MB.";
			} else {
				fileSizeMessage.innerHTML = "File size: " + fileSize.toFixed(2) + " MB";
			}
		}

		function checkFileSize() {
			const input = document.getElementById("image");
			const fileSize = input.files[0].size / 1024 / 1024; // Convert to MB

			if (fileSize > 10) {
				alert("File size exceeds the maximum limit of 10 MB.");
				return false; // Prevent form submission
			}

			return true; // Allow form submission
		}
	</script>
@endsection