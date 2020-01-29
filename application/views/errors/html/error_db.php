<!DOCTYPE html>
<html lang="en">

<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<title><?php echo $heading; ?></title>
	<meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
	<link rel="icon" href="/assets/img/icon.ico" type="image/x-icon" />

	<!-- Fonts and icons -->
	<script src="/assets/js/plugin/webfont/webfont.min.js"></script>
	<script>
		WebFont.load({
			google: {
				"families": ["Lato:300,400,700,900"]
			},
			custom: {
				"families": ["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands", "simple-line-icons"],
				urls: ['../assets/css/fonts.min.css']
			},
			active: function() {
				sessionStorage.fonts = true;
			}
		});
	</script>

	<!-- CSS Files -->
	<link rel="stylesheet" href="/assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="/assets/css/atlantis.css">
</head>

<body class="page-not-found">
	<div class="wrapper not-found">
		<?php $hdg = explode(' ', $heading); ?>
		<div class="text-center animated fadeIn">
			<h1><?= $hdg[1] . ' ' . $hdg[2] ?></h1>
		</div>
		<?php
		$x = str_replace('<p>', '', $message);
		$msg = explode('</p>', $x);
		?>
		<div class="container desc animated fadeIn"><span><?= $msg[0] ?></span><br /><?= $msg[1] ?>
			<div class="card card-black mt-1">
				<div class="card-body mt-0 mb-0">
					<code><?= $msg[2] . '<br>' . $msg[3] . ' at ' . $msg[4] ?></code>
				</div>
			</div>
		</div>
		<a href="/" class="btn btn-primary btn-back-home mt-4 animated fadeInUp">
			<span class="btn-label mr-2">
				<i class="flaticon-home"></i>
			</span>
			Back To Home
		</a>
	</div>
	<script src="/assets/js/core/jquery.3.2.1.min.js"></script>
	<script src="/assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
	<script src="/assets/js/core/popper.min.js"></script>
	<script src="/assets/js/core/bootstrap.min.js"></script>
</body>

</html>
