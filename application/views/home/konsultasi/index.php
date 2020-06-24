<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<!DOCTYPE html>
<html lang="en">


<head>
	<?php $this->load->view('_parts/head'); ?>
</head>

<body data-background-color="bg1">
	<div class="wrapper sidebar_minimize">
		<div class="data-user" data-user="<?= $this->session->userdata('umail') ?>"></div>
		<div class="flash-data" data-flashdata="<?= $this->session->flashdata('flashmsg'); ?>"></div>
		<div class="flash-err" data-flasherror="<?= $this->session->flashdata('flasherr'); ?>"></div>
		<div class="flash-info" data-flashinf="<?= $this->session->flashdata('flashinf'); ?>"></div>
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
					<!-- <?php $x = true ?> -->
					<div class="row">
						<?php $this->load->view('Home/konsultasi/form_konsultasi'); ?>
					</div>
					<!-- ./Content -->
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

	<!-- Modal -->
	<div class="modal fade animated fadeIn" id="setUserData" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h3 class="modal-title" id="exampleModalLongTitle">Informasi Pengguna</h3>
				</div>
				<form action="" method="POST" class="form-horizontal">
					<div class="modal-body">
						<div class="form-group form-floating-label">
							<input id="userNameSave" name="username" type="text" class="form-control input-border-bottom" required="">
							<label for="userNameSave" class="placeholder">Nama Anda</label>
						</div>
						<div class="form-group form-floating-label">
							<input id="userMailSave" name="usermail" type="email" class="form-control input-border-bottom" required="">
							<label for="userMailSave" class="placeholder">Email Anda</label>
						</div>
					</div>
					<div class="modal-footer">
						<!-- <button class="btn btn-primary">Test</button> -->
						<button type="reset" class="btn btn-secondary">Reset</button>
						<button type="submit" class="btn btn-info" id="userSave">Simpan</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<!-- ./Modal -->

	<!-- JS Files   -->
	<?php $this->load->view('_parts/js'); ?>
	<script>
		$(document).ready(function() {
			const dataUser = $('.data-user').data('user');
			if (dataUser == false) {
				$('#setUserData').modal({
					backdrop: 'static',
					keyboard: false,
				})
			};

			$('.pilihan').click(function() {
				var checked_status = this.checked;
				if (checked_status == true) {
					$('#selanjutnya').removeAttr("disabled");
					$('#finish').removeAttr("disabled");
				} else {
					$('#selanjutnya').attr("disabled", "disabled");
					$('#finish').attr("disabled", "disabled");
				}
			});

			$('#reset').click(function() {
				$('#selanjutnya').attr("disabled", "disabled");
				$('#finish').attr("disabled", "disabled");
			});
		});
	</script>
	<!-- ./JS Files -->
</body>

</html>