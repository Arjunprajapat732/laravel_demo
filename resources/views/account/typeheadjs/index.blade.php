<!-- account/dashboard.blade.php -->

@extends('account.body.app')

@section('content')
<div>
	<div class="row mb-3">
		<h4>This is typeahead.js</h4>
	</div>
	<div class="container mt-5">
		<h2 class="mb-4">Choose Options:</h2>
	
		<form class="clone" action="/submit" method="post">
			<div class="py-2">
				<button type="button" class="btn btn-primary" onclick="cloneSelect()">Add</button>
				<button type="submit" class="btn btn-primary">Submit</button>
			</div>
			<div class="row">
				<div class="col-md-4 mb-3">
					<label for="options" class="form-label">Select Option:</label>
					<div class="the-basics">
						<input class="typeahead form-control" type="text" placeholder="States of USA">
					</div>
				</div>
				<div class="col-md-4 mb-3">
					<label for="options" class="form-label">Select Option:</label>
					<div class="the-basics">
						<input class="typeahead form-control" type="text" placeholder="States of USA">
					</div>
				</div>
				<div class="col-md-4 mb-3">
					<label for="options" class="form-label">Select Option:</label>
					<div class="the-basics">
						<input class="typeahead form-control" type="text" placeholder="States of USA">
					</div>
				</div>
			</div>
		</form>
	</div>
</div>
@endsection

@section('scripts')
<style>
    .tt-menu {
        background-color: white;
		border: 2px solid black;
    }
</style>
<script src="https://cdnjs.cloudflare.com/ajax/libs/typeahead.js/0.11.1/typeahead.bundle.min.js"></script>
<script type="text/javascript">
	var substringMatcher = function(strs) {
		return function findMatches(q, cb) {
			var matches, substringRegex;
			matches = [];

			substringRegex = new RegExp(q, 'i');
			$.each(strs, function(i, str) {
				if (substringRegex.test(str)) {
					matches.push(str);
				}
			});

			cb(matches);
		};
	};

	var states = ['Alabama', 'Alaska', 'Arizona', 'Arkansas', 'California',
		'Colorado', 'Connecticut', 'Delaware', 'Florida', 'Georgia', 'Hawaii',
		'Idaho', 'Illinois', 'Indiana', 'Iowa', 'Kansas', 'Kentucky', 'Louisiana',
		'Maine', 'Maryland', 'Massachusetts', 'Michigan', 'Minnesota',
		'Mississippi', 'Missouri', 'Montana', 'Nebraska', 'Nevada', 'New Hampshire',
		'New Jersey', 'New Mexico', 'New York', 'North Carolina', 'North Dakota',
		'Ohio', 'Oklahoma', 'Oregon', 'Pennsylvania', 'Rhode Island',
		'South Carolina', 'South Dakota', 'Tennessee', 'Texas', 'Utah', 'Vermont',
		'Virginia', 'Washington', 'West Virginia', 'Wisconsin', 'Wyoming'
	];

	$('.the-basics .typeahead').typeahead({
		hint: true,
		highlight: true,
		minLength: 1
	},
	{
		name: 'states',
		source: substringMatcher(states)
	});

	function cloneSelect() {
		var clone = $('.clone .row').first().clone();
		clone.find('.typeahead').val('');
		$('.clone').append(clone);
	}
</script>
@endsection
