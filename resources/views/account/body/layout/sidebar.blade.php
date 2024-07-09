<!-- Inside your 'account.body.layout.sidebar' include file -->
<style type="text/css">
	#sidebar {
	    height: 100%;
	    overflow-y: auto;
	}
</style>
<nav id="sidebar">
	<div class="sidebar-header">
		<img src="{{ asset('images/arjun.jpg') }}" class="img-fluid" width="70px" alt="Arjun Image">
		<!-- <h3>Learning Here</h3> -->
	</div>

	<ul class="list-unstyled components">
		<li class="{{ request()->is('account/dashboard*') ? 'active' : '' }} rounded-4">
			<a href="{{ url('account/dashboard/index') }}">Dashboard</a>
		</li>
		<li class="{{ request()->is('account/task*') ? 'active' : '' }} rounded-4">
			<a href="{{ url('account/task/index') }}">Task</a>
		</li>
		<li class="{{ request()->is('account/table_pagination*') ? 'active' : '' }} rounded-4">
			<a href="{{ url('account/table_pagination/index') }}">Table Pagination</a>
		</li>
		<li class="{{ request()->is('account/datatable*') ? 'active' : '' }} rounded-4">
			<a href="{{ url('account/datatable/index') }}">DataTables Ajax</a>
			<!-- Submenus go here -->
			<ul>
				<li class="{{ request()->is('account/datatable/index?type=normal') ? 'active' : '' }} rounded-4">
					<a href="{{ url('account/datatable/index?type=normal') }}">Normal</a>
				</li>
				<li class="{{ request()->is('account/datatable/index') ? 'active' : '' }} rounded-4">
					<a href="{{ url('account/datatable/index') }}">Button</a>
				</li>
			</ul>
		</li>
		<li class="{{ request()->is('account/ajax_samples*') ? 'active' : '' }} rounded-4">
			<a href="{{ url('#') }}">Ajax samples</a>
		</li>
		<li class="{{ request()->is('account/payment*') ? 'active' : '' }} rounded-4">
			<a href="{{ url('account/payment/index') }}">Payment Methods</a>
		</li>
		<li class="{{ request()->is('account/pusher*') ? 'active' : '' }} rounded-4">
			<a href="{{ url('account/pusher/index') }}">Pusher</a>
		</li>
		<li class="{{ request()->is('account/dropzone*') ? 'active' : '' }} rounded-4">
			<a href="{{ url('account/dropzone/index') }}">Dropzone</a>
		</li>
		<li class="{{ request()->is('account/type_head_js*') ? 'active' : '' }} rounded-4">
			<a href="{{ url('account/type_head_js/index') }}">Typeahead.js</a>
		</li>
		<li class="{{ request()->is('account/tiny_optimizer*') ? 'active' : '' }} rounded-4">
			<a href="{{ url('account/tiny_optimizer/index') }}">Tiny Optimizer</a>
		</li>
		<li class="{{ request()->is('account/image_optimizer*') ? 'active' : '' }} rounded-4">
			<a href="{{ url('account/image_optimizer/index') }}">Image Optimizer pkg</a>
		</li>
		<li class="{{ request()->is('account/intervention_image*') ? 'active' : '' }} rounded-4">
			<a href="{{ url('account/intervention_image/index') }}">Intervention Image pkg</a>
		</li>
		<li class="{{ request()->is('account/s3_policy*') ? 'active' : '' }} rounded-4">
			<a href="{{ url('account/s3_policy/index') }}">S3 Policy</a>
		</li>
		<li class="{{ request()->is('account/more*') ? 'active' : '' }} rounded-4">
			<a href="{{ url('account/more/index') }}">More</a>
		</li>
	</ul>
</nav>

<style>
	#sidebar {
		height: 100%;
		width: 250px;
		position: fixed;
		top: 0;
		left: 0;
		background-color: #111;
		padding-top: 20px;
		color: white;
	}

	#sidebar ul.components {
		padding: 20px;
	}

	#sidebar ul li {
		padding: 10px;
		font-size: 16px;
	}

	#sidebar ul li a {
		color: white;
		text-decoration: none;
	}

	#sidebar ul li.active {
		background-color: #4CAF50;
	}

	#sidebar .sidebar-header {
		text-align: center;
	}
</style>
