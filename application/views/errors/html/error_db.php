<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<title>Database Error</title>
	<link rel="stylesheet" href="/assets/plugins/bootstrap/css/bootstrap.css">
	<link rel="icon" href="/assets/logo.ico" type="image/x-icon">
	<style type="text/css">
		a,
		a:focus,
		a:hover {
			color: #fff;
		}

		/* Custom default button */
		.btn-secondary,
		.btn-secondary:hover,
		.btn-secondary:focus {
			color: #333;
			text-shadow: none;
			/* Prevent inheritance from `body` */
			background-color: #fff;
			border: .05rem solid #fff;
		}

		html,
		body {
			height: 100%;
			background-color: #333;
		}

		body {
			display: -ms-flexbox;
			display: -webkit-box;
			display: flex;
			-ms-flex-pack: center;
			-webkit-box-pack: center;
			justify-content: center;
			color: #fff;
			text-shadow: 0 .05rem .1rem rgba(0, 0, 0, .5);
			box-shadow: inset 0 0 5rem rgba(0, 0, 0, .5);
		}

		.cover-container {
			max-width: 42em;
		}

		.masthead {
			margin-bottom: 2rem;
		}

		.masthead-brand {
			margin-bottom: 0;
		}

		.nav-masthead .nav-link {
			padding: .25rem 0;
			font-weight: 700;
			color: rgba(255, 255, 255, .5);
			background-color: transparent;
			border-bottom: .25rem solid transparent;
		}

		.nav-masthead .nav-link:hover,
		.nav-masthead .nav-link:focus {
			border-bottom-color: rgba(255, 255, 255, .25);
		}

		.nav-masthead .nav-link+.nav-link {
			margin-left: 1rem;
		}

		.nav-masthead .active {
			color: #fff;
			border-bottom-color: #fff;
		}

		@media (min-width: 48em) {
			.masthead-brand {
				float: left;
			}

			.nav-masthead {
				float: right;
			}
		}

		.cover {
			padding: 0 1.5rem;
		}

		.cover .btn-lg {
			padding: .75rem 1.25rem;
			font-weight: 700;
		}

		.mastfoot {
			color: rgba(255, 255, 255, .5);
		}
	</style>
</head>

<body class="text-center">

	<div class="cover-container d-flex h-100 p-3 mx-auto flex-column">
		<header class="masthead mb-auto">
		</header>

		<main role="main" class="inner cover">
			<h1 class="cover-heading">Error <?php echo $heading; ?></h1>
			<p class="lead"><?php echo $message; ?></p>
			<p class="lead mt-lg-5">
				<a href="/" class="btn btn-md btn-secondary">Home</a>
			</p>
		</main>

		<footer class="mastfoot mt-auto">
		</footer>
	</div>


	<!-- Bootstrap core JavaScript
    ================================================== -->
	<!-- Placed at the end of the document so the pages load faster -->
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script>
		window.jQuery || document.write('<script src="/assets/plugins/jquery/jquery.slim.min.js"><\/script>')
	</script>
	<script src="/assets/plugins/popper/popper.min.js"></script>
	<script src="/assets/plugins/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>
