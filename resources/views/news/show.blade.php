@extends('app')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">{{ $article->title }}</div>
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
					{!! $article->body !!}
					@if (Auth::check() && Auth::user()->isModerator())
					    <div class="container" style="margin-top: 10px;">
                            <button id="btnEditArticle" class="btn btn-primary">Wijzig</button>
                            <button id="btnArchiveArticle" class="btn btn-warning">Archiveer</button>
					        <button id="btnRemoveArticle" class="btn btn-danger">Verwijder</button>
					    </div>
					@endif
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	$(function () {
		$('#btnEditArticle').click(function () {
            window.location.assign('/news/{{ $article->id }}/edit');
        });
        $('#btnArchiveArticle').click(function () {
            window.location.assign('/news/{{ $article->id }}/archive');
        });
        $('#btnRemoveArticle').click(function () {
            if (confirm('Weet je zeker dat je dit artikel wilt verwijderen?')) {
                window.location.assign('/news/{{ $article->id }}/destroy');
            }
        });
	});
</script>
@endsection