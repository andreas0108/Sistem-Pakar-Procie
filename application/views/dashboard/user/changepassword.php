<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1>Profile Page</h1>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="#"><?= $title2 ?></a></li>
						<li class="breadcrumb-item active"><?= $title3 ?></li>
					</ol>
				</div>
			</div>
		</div><!-- /.container-fluid -->
	</section>

	<!-- Main content -->
	<section class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-3">

					<!-- <?= var_dump($jum_article) ?> -->

					<!-- Profile Image -->
					<div class="card card-primary card-outline">
						<div class="card-body box-profile">
							<div class="text-center">
								<img class="profile-user-img img-fluid img-circle" src="<?= base_url('assets/img/profile/') . $user['img']; ?>" alt="User profile picture">
							</div>

							<h3 class="profile-username text-center"><?= $user['name']; ?></h3>

							<p class="text-muted text-center">
								<?php
								if ($user['role_id'] == 1) {
									echo 'Administrator';
								} else {
									echo 'User';
								} ?>
							</p>

							<ul class="list-group list-group-unbordered mb-3">
								<li class="list-group-item">
									<b>Article Writed</b> <a class="float-right"><?= number_format($jum_article) ?></a>
								</li>
								<!-- <li class="list-group-item">
									<b></b> <a class="float-right">543</a>
								</li> -->
							</ul>
						</div>
						<!-- /.card-body -->
					</div>
					<!-- /.card -->

					<!-- About Me Box -->
					<div class="card card-primary">
						<div class="card-header">
							<h3 class="card-title">About Me</h3>
						</div>
						<!-- /.card-header -->
						<div class="card-body">
							<strong><i class="fas fa-fw fa-user-circle mr-1"></i> User ID :</strong>
							<p class="text-muted">
								<?= $user['id'] ?>
							</p>
							<hr>

							<strong><i class="fas fa-envelope mr-1"></i> Email</strong>
							<p class="text-muted"><?= $user['email']; ?></p>
							<hr>

							<strong><i class="fas fa-map-marker-alt mr-1"></i> Address</strong>
							<p class="text-muted"><?= $user['address']; ?></p>
							<hr>

							<strong><i class="fas fa-map-marker-alt mr-1"></i> Phone Number</strong>
							<p class="text-muted"><?= $user['phone_number']; ?></p>
							<hr>

							<strong><i class="far fa-calendar-alt mr-1"></i> Tanggal Registrasi</strong>

							<!-- konversi unixtime ke format global -->
							<!-- <p class="text-muted"><?= gmdate("Y-m-d H:i:s", $user['date_created']) ?></p> -->

							<!-- konversi unixtime ke format tanggal indonesia menggunakan helper tanggal-indo-->
							<p class="text-muted"><?= date_indo(gmdate("Y-m-d H:i:s", $user['date_created'])) ?></p>
						</div>
						<!-- /.card-body -->
					</div>
					<!-- /.card -->
				</div>
				<!-- /.col -->
				<div class="col-md-9">
					<div class="card">
						<div class="card-header mb-0">
							<h5 class="mb-0"><?= $title3 ?></h5>
						</div>
					</div>
					<div class="tab-content">
						<!-- Begin Page Content -->
						<div class="row">
							<div class="col-lg">

								<div class="card border-primary mb-3">
									<div class="card-body">
										<?= $this->session->flashdata('changepass'); ?>
										<form action="<?= base_url('dashboard/user/changepassword') ?>" method="post">
											<div class="row">
												<div class="col-md-6 col-sm-12">
													<div class="form-group">
														<label for="currentPassword">Current Password</label>
														<input type="password" class="form-control" id="currentPassword" name="currentPassword">
														<?= form_error('currentPassword', '<small class="text-danger pl-0" role="alert">', '</small>') ?>
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-md-6 col-sm-12">
													<div class="form-group">
														<label for="newPassword1">New Password</label>
														<input type="password" class="form-control" id="newPassword1" name="newPassword1">
														<?= form_error('newPassword1', '<small class="text-danger pl-0" role="alert">', '</small>') ?>
													</div>
												</div>
												<div class="col-md-6 col-sm-12">
													<div class="form-group">
														<label for="newPassword2">Type Again</label>
														<input type="password" class="form-control" id="newPassword2" name="newPassword2">
														<?= form_error('newPassword2', '<small class="text-danger pl-0" role="alert">', '</small>') ?>
													</div>
												</div>
											</div>
											<div class="form-group">
												<button type="submit" class="btn btn-primary">Change Password</button>
											</div>
										</form>
									</div>
								</div>

							</div>
						</div>
					</div>
					<!-- End of Main Content -->
				</div>
			</div>
		</div>
		<!-- /.nav-tabs-custom -->
		<!-- /.col -->

	</section>
</div><!-- /.container-fluid -->
