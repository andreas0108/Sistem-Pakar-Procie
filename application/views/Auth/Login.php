<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<!DOCTYPE html>
<html lang="en">


<head>
	<?php $this->load->view('_parts/head'); ?>
</head>

<body class="login masthead">
	<div class="wrapper wrapper-login">
		<div class="container container-login animated fadeIn">
			<h3 class="text-center">Sign In To Admin</h3>
			<?php $this->session->flashdata('flashmsg'); ?>
			<div class="login-form">
				<form action="<?= base_url('auth') ?>" method="post">
					<div class="input-group form-floating-label">
						<input id="email" name="email" type="email" class="form-control input-border-bottom mt-1" value="<?= $this->input->post('email'); ?>" required>
						<label for=" email" class="placeholder">Email</label>
					</div>
					<div class="input-group form-floating-label mt-3">
						<input id="password" name="password" type="password" class="form-control input-border-bottom mt-1" required>
						<label for="password" class="placeholder">Password</label>
						<div class="show-password">
							<i class="icon-eye"></i>
						</div>
					</div>
					<div class="row form-sub m-0">
						<div class="custom-control custom-checkbox">
							<!-- <input type="checkbox" class="custom-control-input" id="rememberme">
						<label class="custom-control-label" for="rememberme">Remember Me</label> -->
						</div>

						<a href="javascript:void(0)" class="link float-right">Forget Password ?</a>
					</div>
					<div class="form-action mb-3">
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
	<!-- ./JS Files -->
</body>

</html>
