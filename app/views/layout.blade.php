<!DOCTYPE html>
<html lang="en">
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="/css/bootstrap.min.css">

		<!-- Optional theme -->
		<link rel="stylesheet" href="/css/bootstrap-theme.min.css">
		<link rel="stylesheet" type="text/css" href="/css/style.css">
		@yield('css')
	</head>
	<body>
		<div class="container">
			<div class="row">
				<div class="col-md-10">
					<h1><a href="/">Recruitments</a></h1>
				</div>
				<div class="col-md-2">
					<div class="logout pull-right"><a href="/logout">Logout</a></div>
				</div>
			</div>

			@yield('content')
		</div>

		@yield('modals')

		<!-- Latest compiled and minified JavaScript -->
		<script src="/js/jquery-2.1.1.min.js"></script>
		<script src="/js/bootstrap.min.js"></script>
		@yield('javascript')


	</body>
</html>