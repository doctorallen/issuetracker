<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>@yield('title')</title>
		{{ HTML::style('css/main.css') }}
		{{ HTML::style('css/bootstrap.min.css') }}
		{{ HTML::style('css/bootstrap-theme.min.css') }}
		@yield('head')
	</head>
	<body>
	<div class="navbar navbar-default navbar-fixed-top" role="navigation">
		  <div class="container">
			<div class="navbar-header">
			  <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			  </button>
			{{HTML::linkRoute('home', '', null,array('class' => 'brand navbar-brand')) }}
			</div>
			<div class="navbar-collapse collapse navbar-right">
			  <ul class="nav navbar-nav">
				@if(Auth::check())
					@if(Auth::user()->permission_level < 1)
						@include('nav._admin')
					@else
						@include('nav._user')
					@endif
				@else
					@include('nav._guest')
				@endif
			  </ul>
			</div><!--/.nav-collapse -->
		  </div> <!--/.container-->
		</div><!--/.navbar -->
		<div class="container">
			<div class="inner">
			@yield('content')
			</div>
		</div>
		{{ HTML::script('js/vendor/jquery-1.9.1.min.js') }}
		{{ HTML::script('js/vendor/jquery.tablesorter.min.js') }}
		{{ HTML::script('js/vendor/jquery.tablesorter.widgets.min.js') }}
		{{ HTML::script('js/vendor/ua-parser.min.js') }}
		{{ HTML::script('js/vendor/underscore-min.js') }}
		{{ HTML::script('js/bootstrap.min.js') }}
		{{ HTML::script('js/script.js') }}
		@yield('footer')
	</body>
</html>
