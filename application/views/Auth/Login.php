<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<!DOCTYPE html>
<html lang="en">


<head>
	<?php $this->load->view('_parts/head'); ?>
</head>

<body class="login" style="background: linear-gradient(to bottom,rgba(22,22,22,.1) 0,rgba(22, 22, 22, 0.71) 75%,#161616 100%),url(/assets/img/bg-masthead.jpg)">
	<div class="flash-data" data-flashdata="<?= $this->session->flashdata('flashmsg'); ?>"></div>
	<div class="flash-err" data-flasherror="<?= $this->session->flashdata('flasherr'); ?>"></div>
	<div class="wrapper wrapper-login">
		<div class="container container-login animated fadeIn">
			<h2 class="text-center mb-0">SISTEM <b>PAKAR</b></h2>
			<p class="text-center text-black-50">You must login to access the <b><?= strtoupper($this->config->item('site_name')) ?> </b>system.</p>

			<div class="login-form mb-0">
				<form action="<?= base_url('auth') ?>" method="post" id="login-form">
					<div class="form-group">
						<label for="email" class="placeholder">Alamat Email</label>
						<input id="email" name="email" type="email" class="form-control mt-1 mb-0" value="<?= $this->input->post('email'); ?>" required>
					</div>
					<div class="form-group mt-0">
						<label for="password" class="placeholder">Password</label>
						<a href="javascript:void(0)" class="link float-right">Forget Password ?</a>
						<div class="input-icon">
							<input id="password" name="password" type="password" class="form-control mt-1" required>
							<span class="show-password input-icon-addon">
								<i class="icon-eye"></i>
							</span>
						</div>
					</div>
					<div class="form-action mt--2 mb-0 pb-0">
						<button type="submit" class="btn btn-primary btn-rounded btn-login">Sign In</button>
					</div>
				</form>
				<!-- <div class="login-account">
					<span class="msg">Don't have an account yet ?</span>
					<a href="login.html#" id="show-signup" class="link">Sign Up</a>
				</div> -->
			</div>
		</div>
	</div>

	<!-- JS Files   -->
	<?php $this->load->view('_parts/js'); ?>
	<?php $this->load->view('js/js-auth'); ?>
	<!-- ./JS Files -->
</body>

</html>
