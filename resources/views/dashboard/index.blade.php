@extends('app')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">Dashboard</div>
				<div class="panel-body">
					@if (count($errors) > 0)
						<div class="alert alert-danger">
							<strong>Oeps!</strong> Er waren problemen met jou ingevoerde gegevens.<br><br>
							<ul>
								@foreach ($errors->all() as $error)
									<li>{{ $error }}</li>
								@endforeach
							</ul>
						</div>
					@endif
					@if (Session::get('message') != null)
						<div class="alert alert-success">
							<p>{{ Session::get('message') }}</p>
						</div>
					@endif
					<h2>{{ Auth::user()->name }}</h2>
					<img src="{{ asset('images/users/anonymous.jpg') }}">
					<h5>{{ Auth::user()->privelegeString() }}</h5>
					<h5>{{ Auth::user()->email }}</h5>
					@if (Auth::user()->priveleges == 0)
						<p>Je bent nog geen student, dit betekent dat je niets mag inzenden.</p>
					@endif
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
