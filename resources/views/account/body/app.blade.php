<!DOCTYPE html>
<html lang="en">
<head>
	@include('account.body.layout.head')
	<!-- Add Bootstrap CDN or include Bootstrap CSS and other stylesheets here -->
	<style>
		.sidebar {
			width: 250px;
			position: fixed;
			height: 100%;
			background-color: #f8f9fa;
			border-right: 1px solid #dee2e6;
			padding-top: 56px; /* Adjust based on your header's height */
		}

		.main-content {
			margin-left: 239px; /* Set the same width as the sidebar */
		}
	</style>
	{{-- <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
	  <script>

	    // Enable pusher logging - don't include this in production
	    Pusher.logToConsole = true;

	    var pusher = new Pusher('7f5febc3fd7887d09f9b', {
	      cluster: 'ap2'
	    });

	    var channel = pusher.subscribe('my-channel');
	    channel.bind('my-event', function(data) {
	      alert(JSON.stringify(data));
	    });
	  </script> --}}
</head>
<body>
	{{-- @php
	  $options = array(
	    'cluster' => 'ap2',
	    'useTLS' => true
	  );
	  $pusher = new Pusher\Pusher(
	    '7f5febc3fd7887d09f9b',
	    'b3baf9b6edf3f8abe42a',
	    '1761357',
	    $options
	  );

	  $data['message'] = 'pusher notification';
	  $pusher->trigger('my-channel', 'my-event', $data);
	@endphp --}}

	@include('account.body.layout.sidebar')
	<div class="container-fluid">
		<div class="main-content">
			@include('account.body.layout.header')
			<div class="container mt-5">
				<div class="card">
					<div class="card-body">
						@yield('content')
					</div>
				</div>
			</div>
			@include('account.body.layout.footer')
		</div>
	</div>
	@include('account.body.layout.scripts')
</body>
</html>
