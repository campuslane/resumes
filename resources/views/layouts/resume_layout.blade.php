<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="csrf-token" content="{{ csrf_token() }}">

	<title>@yield('title')</title>

	<link href="http://netdna.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.css" rel="stylesheet">
  	<link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.1/summernote.css" rel="stylesheet">

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
	
	<style>
		.ui-helper-hidden-accessible {
			display:none;
		}
	</style>
	@yield('styles')

</head>
<body>
	<br><br>
	<div class="container">
		@yield('content')
	</div>

	<script src="https://code.jquery.com/jquery-2.2.2.min.js" integrity="sha256-36cp2Co+/62rEAAYHLmRCPIych47CvdM+uTBJwSzWjI=" crossorigin="anonymous"></script>


	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/handlebars.js/4.0.5/handlebars.min.js"></script>
	<script src="https://cdn.jsdelivr.net/summernote/0.8.1/summernote.min.js"></script>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/rangy/1.3.0/rangy-core.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/rangy/1.3.0/rangy-selectionsaverestore.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/rangy/1.3.0/rangy-textrange.min.js"></script>

	@yield('scripts')
</body>
</html>