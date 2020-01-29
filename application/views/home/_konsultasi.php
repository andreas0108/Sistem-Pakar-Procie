<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<!DOCTYPE html>
<html lang="en">


<head>
	<?php $this->load->view('_parts/head'); ?>
</head>

<body data-background-color="bg1">
	<div class="wrapper sidebar_minimize">
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
					<div class="col-md-12">
						<!-- Content -->
						<div class="row">
							<div class="wizard-container wizard-round col-md-9">
								<div class="wizard-header text-center">
									<h3 class="wizard-title"><b><?= $this->config->item('site_name'); ?></b></h3>
									<small><?= $desc ?></small>
								</div>
								<form>
									<div class="wizard-body">
										<div class="row">
											<ul class="wizard-menu nav nav-pills nav-primary">
												<li class="step" style="width: 33.3333%;">
													<a class="nav-link active" href="#about" data-toggle="tab" aria-expanded="true"><i class="fa fa-user mr-0"></i> About</a>
												</li>
												<li class="step" style="width: 33.3333%;">
													<a class="nav-link" href="#account" data-toggle="tab"><i class="fa fa-file mr-2"></i> Account</a>
												</li>
												<li class="step" style="width: 33.3333%;">
													<a class="nav-link" href="#address" data-toggle="tab"><i class="fa fa-map-signs mr-2"></i> Address</a>
												</li>
											</ul>
										</div>
										<div class="tab-content">
											<div class="tab-pane active" id="about">
												<div class="row">
													<div class="col-md-12">
														<h4 class="info-text">Tell us who you are.</h4>
													</div>
													<div class="col-md-6">
														<div class="form-group">
															<label>First Name :</label>
															<input name="firstname" type="text" class="form-control" required>
														</div>

														<div class="form-group">
															<label>About :</label>
															<textarea name="about" class="form-control" rows="5" required></textarea>
														</div>
													</div>

													<div class="col-md-6">
														<div class="form-group">
															<label>Last Name :</label>
															<input name="lastname" type="text" class="form-control" required>
														</div>

														<div class="form-group">
															<label>Picture :</label>
															<div class="input-file input-file-image">
																<img class="img-upload-preview img-circle" width="100" height="100" src="http://placehold.it/100x100" alt="preview">
																<input type="file" class="form-control form-control-file" id="uploadImg" name="uploadImg" accept="image/*" required>
																<label for="uploadImg" class=" label-input-file btn btn-primary">Upload a Image</label>
															</div>
														</div>
													</div>
												</div>
											</div>
											<div class="tab-pane" id="account">
												<h4 class="info-text">Set up your account </h4>
												<div class="row">
													<div class="col-md-8 ml-auto mr-auto">
														<div class="form-group">
															<label>Email :</label>
															<input type="email" name="email" class="form-control" required>
														</div>
														<div class="form-group">
															<label>Password :</label>
															<input type="password" name="password" class="form-control" required>
														</div>
														<div class="form-group">
															<label>Confirm Password :</label>
															<input type="password" name="confirmpassword" class="form-control" required>
														</div>
													</div>
												</div>
											</div>
											<div class="tab-pane" id="address">
												<h4 class="info-text">Tell us where you live.</h4>
												<div class="row">
													<div class="col-sm-8 ml-auto mr-auto">
														<div class="form-group">
															<label>Country :</label>

															<select name="country" class="form-control" required>
																<option value="">&nbsp;</option>
																<option value="id">Indonesia</option>
																<option value="my">Malaysia</option>
																<option value="th">Thailand</option>
																<option value="sg">Singapore</option>
															</select>
														</div>

														<div class="form-group">
															<label>Address</label>

															<textarea name="address" rows="3" class="form-control" required></textarea>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>

									<div class="wizard-action">
										<div class="pull-left">
											<input type="button" class="btn btn-previous btn-fill btn-black" name="previous" value="Previous">
										</div>
										<div class="pull-right">
											<input type="button" class="btn btn-next btn-danger" name="next" value="Next">
											<input type="button" class="btn btn-finish btn-danger" name="finish" value="Finish" style="display: none;">
										</div>
										<div class="clearfix"></div>
									</div>
								</form>
							</div>
						</div>
						<!-- ./Content -->
					</div>
				</div>
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
	<!-- ./JS Files -->
</body>

</html>
