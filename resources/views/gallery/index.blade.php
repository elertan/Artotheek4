@extends('app')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">Gallerij</div>
				<div class="panel-body" ng-controller="artworkController">
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
					@if (Auth::check() && Auth::user()->isStudent())
						<button id="btnSendNew" class="btn btn-success" style="margin: 10px;">+ Nieuwe Inzenden</button>
						<div class="panel"></div>
					@endif
					<div class="panel">
					    <input type="text" ng-model="artworkQuery" placeholder="Zoek..." class="form-control">
					</div>
                    <div class="artwork-img col-md-2" ng-repeat="artwork in artworks | filter:artworkQuery">
                        <img src="@{{ '/images/artworks/' + artwork.id + '.' + artwork.extension }}" class="img-responsive">
                        <p style="text-align: center;">@{{ artwork.title }}</p>
                    </div>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
    app.controller('artworkController', function ($scope, $http) {
        $http.get('/gallery/json').then(function (response) {
            $scope.artworks = response.data;
        });
    });
	$(function () {
		$('#btnSendNew').click(function () {
			window.location.assign('{{ url("/gallery/create") }}');
		});
	});
</script>
@endsection