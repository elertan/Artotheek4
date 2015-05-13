@extends('app')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">Artiesten</div>
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
					    <input type="text" ng-model="eventQuery" placeholder="Zoek..." class="form-control">
					</div>
					@for ($i = 0; $i < 12; $i++)
						<div class="img-responsive artwork-img col-md-3">
							<img src="{{ asset('images/users/anonymous.jpg') }}" class="img-responsive">
							<p class="artist-label" style="text-align: center;">Lorem Ipsum</p>
						</div>
					@endfor
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	$(function () {
		$('#btnSendNew').click(function () {
			window.location.assign('{{ url("/gallery/create") }}');
		});
	});
</script>
@endsection