<!-- account/dashboard.blade.php -->

@extends('account.body.app')

@section('content')
<div class="card">
	<div class="card-body">
		<div class="row">
			<h3>Task 
				<a href="{{ url('account/task/edit') }}" class="btn btn-primary float-end mt-md-0 mt-2"><i class="bi bi-plus-lg"></i> Add Task</a>
			</h3>
		</div>
		<hr>
		<div style="overflow: auto;">
			<div class="d-flex justify-content-end mb-3">
				<div class="btn-group">
					<button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
					Sort by</i>
				  	</button>
					<ul class="dropdown-menu">
						<li><a class="dropdown-item" href="{{ url('account/task/index?page_sort=ascending') }}">Ascending</a></li>
						<li><a class="dropdown-item" href="{{ url('account/task/index?page_sort=descending') }}">Descending</a></li>
					</ul>
				</div>
			</div>
			<hr>
			<table class="table text-center">
				<thead>
					<tr class="text-capitalize">
						<th>S. No.</th>
						<th>Title</th>
						<th>description</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					@forelse($tasks as $key => $task)
						<tr>
							<td>{{ $task->id }}</td>
							<td>{{ $task->title }}</td>
							<td>{{ $task->description }}</td>
							<td>
								<a href="{{ url('account/task/edit?id='.$task->id) }}" class="btn btn-primary text-white"><i class="fa-solid fa-pen-to-square"></i></a>
								<a href="javascript:void()" class="btn btn-secondary text-white" onclick="confirmationById('{{ url('account/task/delete') }}', 'Are you sure? You want to delete this category.', '{{ $task->id }}');"><i class="fa-solid fa-trash"></i></a>
							</td>
						</tr>
					@empty
						<tr>
							<td colspan="5">
								<center>No record found</center>
							</td>
						</tr>
					@endforelse
				</tbody>
			</table>
		</div>
		<div class="row align-items-center">
			<div class="mx-auto col-md-4 col-6 text-center">
				<a href="{{ $tasks->previousPageUrl() }}">
					<i class="fa fa-caret-left"></i>
				</a> 
				<span class="desktop">Results:</span>
				{{ $tasks->firstItem() ?? 0 }}
				- 
				{{ $tasks->lastItem() ?? 0 }}
				of
				{{ $tasks->total() }}
				<a href="{{ $tasks->nextPageUrl() }}">
					<i class="fa fa-caret-right"></i>
				</a>
			</div>
		</div>
	</div>
</div>
@endsection