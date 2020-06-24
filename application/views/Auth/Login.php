<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<!DOCTYPE html>
<html lang="en">


<head>
	<?php $this->load->view('_parts/head'); ?>
</head>

<body class="login" style="background: linear-gradient(to bottom,rgba(22,22,22,.1) 0,rgba(22, 22, 22, 0.71) 75%,#161616 100%),url(/assets/img/bg-masthead.jpg)">
	<div class="flash-data" data-flashdata="<?= $this->session->flashdata('flashmsg'); ?>"></div>
	<div class="flash-err" data-flasherror="<?= $this->session->flashdata('flasherr'); ?>"></div>
	<div class="flash-info" data-flashinf="<?= $this->session->flashdata('flashinf'); ?>"></div>
	<div class="wrapper wrapper-login">
		<div class="container container-login animated fadeIn">
			<h2 class="text-center mb-0">SISTEM <b>PAKAR</b></h2>
			<p class="text-center text-black-50">Silahkan login terlebih dahulu untuk mengakses sistem <b><?= strtoupper($this->config->item('site_name')) ?> </b>.</p>

			<div class="login-form mb-0">
				<form action="<?= base_url('auth') ?>" method="post">
					<div class="form-group">
						<label for="email" class="placeholder">Alamat Email</label>
						<input id="email" name="email" type="email" class="form-control focus mt-1 mb-0" value="<?= $this->input->post('email'); ?>" required>
						<?= $this->input->post('email'); ?>
					</div>
					<div class="form-group mt-0">
						<label for="password" class="placeholder">Password</label>
						<a href="javascript:void(0)" class="link float-right">Lupa Password ?</a>
						<div class="input-icon">
							<input id="password" name="password" type="password" class="form-control mt-1" required>
							<span class="show-password input-icon-addon">
								<i class="icon-eye"></i>
							</span>
						</div>
					</div>
					<div class="form-action mt--2 mb-0 pb-0">
						<button type="submit" class="btn btn-primary btn-rounded btn-login">Masuk</button>
					</div>
				</form>
			</div>
		</div>
	</div>

	<!-- JS Files   -->
	<?php $this->load->view('_parts/js'); ?>
	<!-- ./JS Files -->
</body>

</html>