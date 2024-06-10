<!-- account/dashboard.blade.php -->

@extends('account.body.app')

@section('content')
<div>
	<h2 class="p-4">Make Your Tasks</h2>
	<form class="p-4" action="{{ url('account/task/store') }}" method="post">
		@csrf
		<div class="form-group">
			<label for="task">Title:</label>
			<input type="text" class="form-control" placeholder="Enter title" value="{{ $tasks->title }}" name="title">
		</div>
		<div class="form-group mt-1">
			<label for="message">Description:</label>
			<textarea required class="form-control" placeholder="Enter description" value="{{ $tasks->description }}" name="description"></textarea>
		</div>
		<button type="submit" class="btn btn-primary my-1">Submit</button>
	</form>
</div>
@endsection