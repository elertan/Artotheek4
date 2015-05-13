@extends('app')

@section('content')
@if (count($errors) > 0)
    <div class="alert alert-danger">
        <strong>Oeps!</strong> Er waren problemen.<br><br>
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
<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading">Nieuws</div>
				<div class="panel-body" ng-controller="newsController">
					@if (Auth::check() && Auth::user()->isModerator())
					    <div class="panel">
					        <button id="btnNewArticle" class="btn btn-success"><span class="glyphicon glyphicon-plus"></span> Nieuw Artikel</button>
					    </div>
					@endif
                    <input type="text" ng-model="newsQuery" placeholder="Zoek..." class="form-control">
                    <div class="panel news-article" ng-repeat="article in articles | filter:newsQuery">
                        @if (Auth::check() && Auth::user()->isModerator())
                            <h4 style="color: gray;">@{{ article.stateString }}</h4>
                        @endif
                        <h4>@{{ article.title || 'Laden...' }}</h4>
                        <p>@{{ article.body }}</p>
                        <p><a href="/news/@{{ article.id }}">Lees verder...</a></p>
                    </div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Evenementen</div>
                <div class="panel-body" ng-controller="eventsController">
                   @if (Auth::check() && Auth::user()->isModerator())
					    <div class="panel">
					        <button id="btnNewArticle" class="btn btn-success"><span class="glyphicon glyphicon-plus"></span> Nieuw Evenement</button>
					    </div>
					@endif
                    <input type="text" ng-model="eventQuery" placeholder="Zoek..." class="form-control">
                    <div class="panel" ng-repeat="event in events | filter:eventQuery">
                        <h4>@{{ article.title || 'Laden...' }}</h4>
                        <p>@{{ article.body }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    var app = angular.module('app', []);
    app.controller('newsController', function ($scope, $http) {
        $scope.articles = [{}];
        var request = $http.get('{{ url("/news/json") }}');
        request.then(function (response) {
            $scope.articles = response.data;
        });
        
        $scope.events = [{}];
        
    });
    $(function () {
        $('#btnNewArticle').click(function () {
            window.location.assign("{{ url('news/create') }}");
        });
    });
</script>
@endsection