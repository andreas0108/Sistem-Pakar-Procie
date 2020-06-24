<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<!DOCTYPE html>
<html lang="en">

<head>
	<?php $this->load->view('_parts/head'); ?>
</head>

<body class="page-not-found">
	<div class="flash-data" data-flashdata="<?= $this->session->flashdata('flashmsg'); ?>"></div>
	<div class="wrapper not-found cover">
		<div class="text-center animated fadeIn">
			<h1>PROCIE</h1>
		</div>
		<div class="text-center animated fadeIn">
			<h2 class="text-white-50 mx-auto mt-2 mb-5">SISTEM PAKAR UNTUK PEMILIHAN PROCESSOR</h2>
		</div>
		<a href="<?= base_url('konsultasi') ?>" class="btn btn-primary">
			<span class="btn-label mr-2">
				<i class="fa fa-paper-plane"></i>
			</span>
			Start
		</a>
		<a href="<?= base_url('login') ?>" style="margin-top: 0.5rem;" title="Login as Administrator">Login</a>
	</div>
	<script src="/assets/js/core/jquery.3.2.1.min.js"></script>
	<script src="/assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
	<script src="/assets/js/core/popper.min.js"></script>
	<script src="/assets/js/core/bootstrap.min.js"></script>
</body>

</html>