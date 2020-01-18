<div class="container-fluid hold-transition login-page">
	<div class="login-box">
		<div class="login-logo">
			<a href="<?= base_url() ?>" class="mb-0"><b>SISTEM</b> PAKAR</a>
		</div>
		<!-- /.login-logo -->
		<div class="card">
			<div class="card-body login-card-body">
				<p class="login-box-msg text-uppercase">Sign in to your account</p>
				<?= $this->session->flashdata('flashmsg'); ?>

				<form action="<?= base_url('dashboard/auth') ?>" method="post">
					<div class="input-group ">
						<input type="email" class="form-control" id="email" name="email" placeholder="Enter Email Address..." value="<?= set_value('email') ?>">
						<div class="input-group-append">
							<div class="input-group-text">
								<span class="fas fa-envelope"></span>
							</div>
						</div>
					</div>
					<?= form_error('email', '<small class="text-danger pl-1" role="alert">', '</small>') ?>
					<div class="input-group mt-2">
						<input type="password" class="form-control" id="password" name="password" placeholder="Password">
						<div class="input-group-append">
							<div class="input-group-text">
								<span class="fas fa-lock"></span>
							</div>
						</div>
					</div>
					<?= form_error('password', '<small class="text-danger pl-1" role="alert">', '</small>') ?>
					<div class="row mt-2">
						<div class="col-md-8 col-sm-12">
							<p class="mt-1 ml-1">
								<a href="#" class="float-left forget_password">Forgot my password</a>
							</p>
						</div>
						<div class="col-md-4 col-sm-12">
							<button type="submit" class="btn btn-primary btn-block">Sign In</button>
						</div>
						<!-- /.col -->
					</div>
				</form>
			</div>
			<!-- /.login-card-body -->
		</div>
	</div>
	<!-- /.login-box -->
</div>
