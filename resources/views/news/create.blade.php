@extends('app')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">Nieuw Artikel</div>
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
					<form class="form-horizontal" role="form" method="POST" action="{{ url('/news/create') }}">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">

						<div class="form-group">
							<label class="col-md-1 control-label">Titel</label>
							<div class="col-md-12">
								<input type="text" class="form-control" name="title">
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-1 control-label">Inhoud</label>
							<div class="col-md-12">
<!--								<input type="email" class="form-control" name="body">-->
								<textarea name="body" class="form-control" id="editor1" rows="10"></textarea>
								<script>
									CKEDITOR.replace('editor1');
								</script>
							</div>
						</div>
						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button type="submit" class="btn btn-primary">
									Plaats
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
