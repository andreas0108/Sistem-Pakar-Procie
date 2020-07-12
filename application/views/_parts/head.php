<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<meta http-equiv="X-UA-Compatible" content="IE=edge" />

<?php if ($this->uri->segment(1) == '') { ?>
	<title><?= ucfirst($title); ?></title>
<?php } else { ?>
	<title><?= ucfirst($title) . ' - ' . $this->config->item('site_name'); ?></title>
<?php } ?>

<meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
<link rel="icon" href="<?= base_url('assets/') ?>img/icon.ico" type="image/x-icon" />

<!-- Fonts and icons -->
<script src="<?= base_url('assets/') ?>js/plugin/webfont/webfont.min.js"></script>
<script>
	WebFont.load({
		google: {
			"families": ["Lato:300,400,700,900"]
		},
		custom: {
			"families": ["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands", "simple-line-icons"],
			urls: ['<?= base_url('assets/') ?>css/fonts.min.css']
		},
		active: function() {
			sessionStorage.fonts = true;
		}
	});
</script>

<script src='https://cdn.tiny.cloud/1/2qeef6zmuvht5ljdruacbt0dctjepm75zzmqodo20jhzhpob/tinymce/5/tinymce.min.js' referrerpolicy="origin"></script>
<script>
	tinymce.init({
		selector: '#mytextarea'
	});
</script>

<!-- CSS Files -->
<link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">
<link rel="stylesheet" href="<?= base_url('assets/') ?>css/bootstrap.min.css">
<link rel="stylesheet" href="<?= base_url('assets/') ?>css/atlantis.css">

<!-- CSS Just for demo purpose, don't include it in your project -->
<!-- <link rel="stylesheet" href="<?= base_url('assets/') ?>css/demo.css"> -->