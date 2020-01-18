<div class="container-fluid hold-transition register-page">
	<div class=" register-box">
		<div class="register-logo text-uppercase">
			<a href="<?= base_url('register'); ?>"><b>Registration</b> Page</a>
		</div>

		<div class="card">
			<div class="card-body register-card-body">
				<p class="login-box-msg text-uppercase">Create your Account!</p>

				<form action="<?= base_url('dashboard/auth/registration'); ?>" method="post">
					<div class="input-group">
						<input type="text" class="form-control" id="name" name="name" placeholder="Full Name" value="<?= set_value('name') ?>">
						<div class="input-group-append">
							<div class="input-group-text">
								<span class="fas fa-user"></span>
							</div>
						</div>
					</div>
					<?= form_error('name', '<small class="text-danger pl-2" role="alert">', '</small>') ?>
					<div class="input-group mt-3">
						<input type="email" class="form-control" id="email" name="email" placeholder="Email Address" value="<?= set_value('email') ?>">
						<div class="input-group-append">
							<div class="input-group-text">
								<span class="fas fa-envelope"></span>
							</div>
						</div>
					</div>
					<?= form_error('email', '<small class="text-danger pl-2" role="alert">', '</small>') ?>
					<div class="input-group mt-3">
						<input type="password" class="form-control" id="pasword1" name="password1" placeholder="Password">
						<div class="input-group-append">
							<div class="input-group-text">
								<span class="fas fa-lock"></span>
							</div>
						</div>
					</div>
					<?= form_error('password1', '<small class="text-danger pl-2" role="alert">', '</small>') ?>
					<div class="input-group mt-3">
						<input type="password" class="form-control" id="password2" name="password2" placeholder="Repeat Password">
						<div class="input-group-append">
							<div class="input-group-text">
								<span class="fas fa-lock"></span>
							</div>
						</div>
					</div>
					<div class="row mt-3">
						<div class="col-8 mt-1">
							<a href="<?= base_url('login') ?>" class="text-center m-auto">I already have a membership</a>
						</div>
						<!-- /.col -->
						<div class="col-4">
							<button type="submit" class="btn btn-primary btn-block">Register</button>
						</div>
						<!-- /.col -->
					</div>
				</form>
			</div>
			<!-- /.form-box -->
		</div><!-- /.card -->
	</div>
</div>
