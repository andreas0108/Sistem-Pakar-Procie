<!DOCTYPE html>
<html lang="en">

<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<title>An uncaught Exception was encountered</title>
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
		<div class="container">
			<div class="text-center animated fadeIn">
				<h1><?php echo get_class($exception); ?></h1>
			</div>
			<div class="desc animated fadeIn">
				<span><?php echo $message; ?></span><br />
				<div style="font-size: 1rem">File : <?php echo $exception->getFile(); ?> (at line <?php echo $exception->getLine(); ?>)</div>
				<?php if (defined('SHOW_DEBUG_BACKTRACE') && SHOW_DEBUG_BACKTRACE === TRUE) : ?>
					<div class="card card-black mt-1">
						<div class="card-body mt-0 mb-0">
							<code><u>Backtrace</u> :<br></code>
							<?php foreach ($exception->getTrace() as $error) : ?>

								<?php if (isset($error['file']) && strpos($error['file'], realpath(BASEPATH)) !== 0) : ?>
									<code>
										File: <?php echo $error['file']; ?> at line <?php echo $error['line']; ?><br />
										Function: <?php echo $error['function']; ?>
									</code>
								<?php endif ?>

							<?php endforeach ?>

						</div>
					</div>
				<?php endif ?>
			</div>
		</div>
	</div>
	<script src="/assets/js/core/jquery.3.2.1.min.js"></script>
	<script src="/assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
	<script src="/assets/js/core/popper.min.js"></script>
	<script src="/assets/js/core/bootstrap.min.js"></script>
</body>

</html>
