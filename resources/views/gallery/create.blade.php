@extends('app')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">Nieuwe Inzenden</div>
				<div class="panel-body">
					@if (count($errors) > 0)
						<div class="alert alert-danger">
							<strong>Oeps!</strong> Er waren problemen met jouw ingevoerde gegevens.<br><br>
							<ul>
								@foreach ($errors->all() as $error)
									<li>{{ $error }}</li>
								@endforeach
							</ul>
						</div>
					@endif
					<form enctype="multipart/form-data" class="form-horizontal" role="form" method="POST" action="{{ url('/gallery/create') }}">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<div class="form-group">
							<label class="col-md-4 control-label">Naam</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="name" required>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-4 control-label">Descriptie</label>
							<div class="col-md-6">
								<textarea class="form-control" name="description" rows="10" required></textarea>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-4 control-label">Foto</label>
							<div class="col-md-6" style="margin-top: 10px;">
								<input type="file" name="picture" required>
							</div>
						</div>
						@if (Auth::user()->isModerator())
							<div class="form-group">
								<label class="col-md-4 control-label">Publiceer</label>
								<div class="col-md-6">
									<input type="checkbox" name="publish" checked>
								</div>
							</div>
						@endif
						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button type="submit" class="btn btn-primary">
									Verstuur
								</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
