<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<!DOCTYPE html>
<html lang="en">


<head>
	<?php $this->load->view('_parts/head'); ?>
</head>

<body>
	<div class="wrapper sidebar_minimize">
		<div class="flash-data" data-flashdata="<?= $this->session->flashdata('flashmsg'); ?>"></div>
		<div class="flash-err" data-flasherror="<?= $this->session->flashdata('flasherr'); ?>"></div>
		<!-- Header -->
		<div class="main-header">
			<!-- Logo -->
			<div class="logo-header" data-background-color="white">
				<?php $this->load->view('_parts/header'); ?>
			</div>
			<!-- ./Logo -->

			<!-- Navbar -->
			<nav class="navbar navbar-header navbar-expand-lg" data-background-color="blue2">
				<?php $this->load->view('_parts/navbar'); ?>
			</nav>
			<!-- ./Navbar -->
		</div>
		<!-- Sidebar -->
		<div class="sidebar sidebar-style-2">
			<?php $this->load->view('_parts/sidebar'); ?>
		</div>
		<!-- ./Sidebar -->

		<!-- Content -->
		<div class="main-panel">
			<!-- Main Container -->

			<div class="container">
				<div class="page-inner">
					<!-- <div class="page-inner"> -->
					<div class="page-header">
						<h4 class="page-title"><?= strtoupper($title) ?></h4>
						<ul class="breadcrumbs">
							<?php $this->load->view('_parts/breadcrumb'); ?>
						</ul>
					</div>
					<!-- Content -->
					<div class="row">
						<div class="col-md-3">
							<div class="card card-profile">
								<div class="card-header" style="background-image: url('../assets/img/blogpost.jpg')">
									<div class="profile-picture">
										<div class="avatar avatar-xl">
											<img src="<?= base_url('assets/img/profile/') . $user['img']; ?>" alt="<?= 'img-' . $user['img'] ?>" class="avatar-img rounded-circle">
										</div>
									</div>
								</div>
								<div class="card-body">
									<div class="user-profile text-center">
										<div class="name">
											<?= $user['name'] ?>
										</div>
										<div class="job">
											Administrator
										</div>
										<div class="desc">
											<?= $user['address'] ?>
										</div>
										<!-- <div class="soon">
											<div class="social-media">
												<a class="btn btn-info btn-twitter btn-sm btn-link" href="#">
													<span class="btn-label just-icon"><i class="flaticon-twitter"></i> </span>
												</a>
												<a class="btn btn-danger btn-sm btn-link" rel="publisher" href="#">
													<span class="btn-label just-icon"><i class="flaticon-google-plus"></i> </span>
												</a>
												<a class="btn btn-primary btn-sm btn-link" rel="publisher" href="#">
													<span class="btn-label just-icon"><i class="flaticon-facebook"></i> </span>
												</a>
												<a class="btn btn-danger btn-sm btn-link" rel="publisher" href="#">
													<span class="btn-label just-icon"><i class="flaticon-dribbble"></i> </span>
												</a>
											</div>
											<div class="view-profile">
												<a href="#" class="btn btn-secondary btn-block">View Full Profile</a>
											</div>
										</div> -->
									</div>
								</div>
								<div class="card-footer">
									<div class="row user-stats text-center">
										<div class="col">
											<div class="number">
												<?= count($this->db->get_where('article', ['penulis_id' => $user['id']])->result_array()) ?>
											</div>
											<div class="title">Artikel</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-9">
							<div class="card card-with-nav mr-0">
								<div class="card-header mb-0">
									<ul class="nav nav-primary nav-pills nav-pills-no-bd nav-pills-icons" id="user-tab" role="tablist">
										<li class="nav-item">
											<a class="nav-link active" id="user-settings-tab" data-toggle="pill" href="#user-settings" role="tab" aria-controls="user-settings" aria-selected="true"><i class="fa fa-user-cog"></i> Profile</a>
										</li>
										<li class="nav-item">
											<a class="nav-link" id="profile-pic-tab" data-toggle="pill" href="#profile-pic" role="tab" aria-controls="profile-pic" aria-selected="false"><i class="fa fa-user-circle"></i> Avatar</a>
										</li>
										<li class="nav-item">
											<a class="nav-link" id="password-settings-tab" data-toggle="pill" href="#password-settings" role="tab" aria-controls="password-settings" aria-selected="false"><i class="fa fa-lock"></i> Security</a>
										</li>
									</ul>
									<hr>
									<?php
									$err = $this->form_validation->error_array();
									foreach ($err as $e) : ?>
										<div class="alert alert-danger alert-dismissible fade show" role="alert">
											<?= $e ?>
											<a href="javascript:void(0)" class="nav-link float-right mt--2 pr-0" data-dismiss="alert">
												<span class="icon-close" style="color: red"></span>
											</a>
										</div>
									<?php endforeach ?>
								</div>
								<div class="card-body tab-content mt-0 mb-3" id="user-tabContent">
									<div class="tab-pane fade show active mb-0 pb-0 mt--3" id="user-settings" role="tabpanel" aria-labelledby="user-settings-tab">
										<form action="<?= base_url('dashboard/user') ?>" method="post" id="uservalidate">
											<div class="row">
												<div class="col-md-6">
													<div class="form-group">
														<label for="name">Nama Lengkap</label>
														<input type="name" class="form-control" name="name" id="name" value="<?= $user['name'] ?>" placeholder="Nama lengkap anda" required>
													</div>
												</div>
												<div class="col-md-6">
													<div class="form-group">
														<label for="email">Alamat Email</label>
														<input type="email" class="form-control" name="email" id="email" value="<?= $user['email'] ?>" placeholder="Alamat email anda" disabled>
													</div>
												</div>
											</div>
											<div class="row mt-3">
												<div class="col">
													<div class="form-group">
														<label>Address</label>
														<input type="text" class="form-control" id="address" name="address" value="<?= $user['address'] ?>" placeholder="Address" required>
													</div>
												</div>
												<!-- <div class="col">
													<div class="form-group">
														<label for="role">Role</label>
														<input type="text" class="form-control" id="role" name="role" value="<?= $user['role_id'] == 1 ? 'Administrator' : 'User' ?>" disabled>
													</div>
												</div> -->
											</div>
											<div class="row mt-3">
												<div class="col">
													<div class="form-group">
														<label for="registered">Terdaftar</label>
														<input type="text" class="form-control" id="registered" name="registered" value="<?= unix_indo($user['date_created']) ?>" disabled>
													</div>
												</div>
												<div class="col">
													<div class="form-group">
														<label>Phone</label>
														<input type="text" class="form-control" id="phone" name="phone" value="<?= $user['phone'] ?>" placeholder="Phone" required>
													</div>
												</div>
											</div>
											<div class="float-right mt-3 mb-0">
												<input type="hidden" name="id" value="<?= $user['id'] ?>">
												<button type="submit" class="btn btn-primary"><i class="fa fa-save"> Save</i></button>
											</div>
										</form>
									</div>
									<div class="tab-pane fade" id="profile-pic" role="tabpanel" aria-labelledby="profile-pic-tab">
										<div class="row justify-content-md-center">
											<div class="col-md-4 col-sm-12">
												<div class="mb-2">
													<center>
														<img src="<?= base_url('assets/img/profile/') . $user['img'] ?>" id="preview" class="img-thumbnail rounded-circle" style="object-fit: cover; object-position: center; width:100%">
													</center>
												</div>
											</div>
											<div class="col-md-8 col-sm-12">
												<form action="<?= base_url('dashboard/user/updateimg') ?>" method="post" enctype="multipart/form-data">
													<!-- <input type="file" name="img[]" class="file" accept="image/*" style="visibility: hidden;position: absolute;"> -->
													<input type="file" name="image" class="file" accept="image/*" style="visibility: hidden;position: absolute;">
													<div class="input-group my-2">
														<input type="text" name='img-prev' class="form-control" disabled placeholder="Pilih Foto Anda" id="file">
														<div class="input-group-append">
															<button type="button" class="browse btn btn-primary">Browse...</button>
														</div>
													</div>
													<input type="hidden" name="id" value="<?= $user['id'] ?>">
													<button type="submit" class="btn btn-primary float-right"><i class="fa fa-save"> Save</i></button>
												</form>
											</div>
										</div>
									</div>
									<div class="tab-pane fade" id="password-settings" role="tabpanel" aria-labelledby="password-settings-tab">
										<div class="row">
											<div class="col-md-12">
												<form action="<?= base_url('dashboard/user/updatemail') ?>" method="post" enctype="multipart/form-data">
													<h2>Email</h2>
													<hr>
													<div class="form-group px-0">
														<label for="email">Alamat Email Anda :</label>
														<input type="email" class="form-control" id="email" value="<?= $user['email'] ?>" disabled>
													</div>
													<div class=" form-group px-0">
														<label for="emailb">Alamat Email Baru :</label>
														<input type="email" class="form-control" name="emailb" id="emailb" value="<?= $this->input->post('emailb') ?>" placeholder="email@anda.com" onkeyup="check(this)">
													</div>
													<input type="hidden" name="id" value="<?= $user['id'] ?>">
													<input type="hidden" name="email" value="<?= $user['email'] ?>">
													<button type="submit" id="submite" class="btn btn-primary float-right" disabled><i class="fa fa-save"> Simpan</i></button>
												</form>
											</div>
										</div>
										<br>
										<div class="row">
											<div class="col-md-12">
												<form action="<?= base_url('dashboard/user/updatepass') ?>" method="post">
													<h2>Password</h2>
													<small class="text-info">*Gunakan kombinasi huruf-angka-simbol agar password anda tidak mudah dibajak.</small>
													<hr>
													<div class="form-group px-0">
														<label for="password" class="placeholder">Password Anda :</label>
														<div class="input-icon">
															<input id="cpassword" id="cpassword" name="cpassword" type="password" class="form-control mt-1" onkeyup="check(this)">
															<span class="show-password input-icon-addon">
																<i class="icon-eye"></i>
															</span>
														</div>
													</div>
													<div class="form-group px-0">
														<label for="password1" class="placeholder">Password Baru :</label>
														<div class="input-icon">
															<input id="password1" id="password1" name="password1" type="password" class="form-control mt-1" onkeyup="check(this)">
															<span class="show-password input-icon-addon">
																<i class="icon-eye"></i>
															</span>
														</div>
													</div>
													<div class="form-group px-0">
														<label for="password2" class="placeholder">Konfirmasi Password :</label>
														<div class="input-icon">
															<input id="password2" id="password2" name="password2" type="password" class="form-control mt-1" onkeyup="check(this)">
															<span class="show-password input-icon-addon">
																<i class="icon-eye"></i>
															</span>
														</div>
													</div>
													<input type="hidden" name="id" value="<?= $user['id'] ?>">
													<button type="submit" id="submitp" class="btn btn-primary float-right ml-2" disabled><i class="fa fa-save"> Simpan</i></button>
												</form>
												<!-- <button type="submit" id="submita" class="btn btn-primary float-right " hidden><i class="fa fa-save"> Simpan Semua</i></button> -->
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- ./Content -->
			</div>
			<!-- ./Main Container -->

			<!-- Footer -->
			<footer class="footer">
				<?php $this->load->view('_parts/footer'); ?>
			</footer>
			<!-- ./Footer -->

			<!-- Optional -->

			<!-- ./Optional -->

		</div>
		<!-- ./Content -->
	</div>

	<!-- JS Files   -->
	<?php $this->load->view('_parts/js'); ?>
	<?php $this->load->view('js/js-user'); ?>
	<!-- ./JS Files -->
</body>

</html>