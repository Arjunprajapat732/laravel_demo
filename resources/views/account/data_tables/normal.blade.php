
@extends('account.body.app')

@section('content')
<h1 class="mt-4">DATA WITH DATABASE</h1>
<div>
	<table id="myTable" class="display">
		<thead>
			<tr>
				<th>Id</th>
				<th>Note</th>
				<th>Description</th>
				<th>Time</th>
			</tr>
		</thead>
		<tbody>
			@foreach($datas as $data)
				<tr>
					<td>{{ $data->id }}</td>
					<td>{{ $data->title }}</td>
					<td>{{ $data->description }}</td>
					<td>{{ $data->created_at }}</td>
				</tr>
			@endforeach
		</tbody>
	</table>
</div>
@endsection
@section('scripts')
<script type="text/javascript">
	$(document).ready(function () {
		var table = $('#myTable').DataTable();
	});
</script>
@endsection