@extends('app')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">Wijzig Artikel</div>
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
					<form class="form-horizontal" role="form" method="POST" action="">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">

						<div class="form-group">
							<label class="col-md-4 control-label">Titel</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="title" value="{{ $article->title }}">
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-4 control-label">Inhoud</label>
							<div class="col-md-6">
<!--								<input type="email" class="form-control" name="body">-->
								<textarea name="body" class="form-control" rows="10">{{ $article->body }}</textarea>
							</div>
						</div>
						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<input type="submit" value="Wijzig" class="btn btn-primary">
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
