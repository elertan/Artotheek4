@extends('app')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">Gebruikers</div>
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
						<button id="btnAddUser" class="btn btn-success" style="margin: 10px;">+ Nieuwe Toevoegen</button>
					</div>
					<div class="panel">
					    <input type="text" ng-model="eventQuery" placeholder="Zoek..." class="form-control">
					</div>
					<div class="panel">
						<ul>
							<li><a href="">test</a></li>
							<li><a href="">test</a></li>
							<li><a href="">test</a></li>
						</ul>
					</div>
					<a href="{{ url('/administration') }}">Terug</a>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	$(function () {
		$('#btnAddUser').click(function () {
			window.location.assign('{{ url("/dashboard/register") }}');
		});
	});
</script>
@endsection
