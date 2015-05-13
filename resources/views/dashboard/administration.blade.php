@extends('app')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">Administratie Tools</div>
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
					<div class="panel">
						<a href="{{ url('/administration/users') }}">Gebruikers</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
