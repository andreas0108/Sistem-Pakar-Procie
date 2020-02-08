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
					<div class="row">
						<!-- Content -->
						<div class="wizard-container wizard-round col-md-9">
							<div class="text-white wizard-cover wizard-header bg-black2 text-center">
								<h2 class="text-white wizard-title"><b><?= $this->config->item('site_name'); ?></b></h2>
								<small><?= $desc ?></small>
							</div>
							<form action="<?= base_url('konsultasi/proses') ?>" method="POST">
								<div class="wizard-body">
									<div class="row">
										<ul class="nav nav-pills nav-primary ">
											<?php $this->db->where('status', 1);
											$pertanyaan = $this->db->get('pertanyaan')->result_array(); ?>
											<?php $i = 1;
											foreach ($pertanyaan as $p) : ?>
												<li class="step">
													<a class="nav-link" href="#<?= $p['id'] ?>" data-toggle="tab" aria-expanded="true">Pertanyaan <?= $i++ ?></a>
												</li>
											<?php endforeach ?>
										</ul>
									</div>
									<div class="tab-content">
										<?php foreach ($pertanyaan as $pi) : ?>
											<div class="tab-pane" id="<?= $pi['id'] ?>">
												<h3 class="info-text"><?= $pi['pertanyaan_content'] ?></h3>
												<div class="row justify-content-center">
													<div class="form-group">
														<?php $this->db->where('status', 1);
														$jawaban = $this->db->get_where('jawaban', ['pertanyaan_id' => $pi['id']])->result_array() ?>
														<?php
														foreach ($jawaban as $j) : ?>
															<label class="imagecheck mb-4">
																<input name="data<?= $pi['id'] ?>" type="radio" value="<?= $j['id'] ?>" class="imagecheck-input">
																<figure class="imagecheck-figure m-1">
																	<img src="https://via.placeholder.com/200.png?text=<?= str_replace(' ', ' ', $j['jawaban_content']) ?>" alt="title" class="imagecheck-image">
																</figure>
															</label>
														<?php endforeach ?>
													</div>
												</div>
											</div>
										<?php endforeach ?>
									</div>
								</div>

								<div class="wizard-action">
									<div class="pull-left">
										<input type="button" class="btn btn-previous btn-fill btn-black disabled" name="previous" value="Previous">
									</div>
									<div class="pull-right">
										<input type="button" class="btn btn-next btn-danger" value="Next">
										<input type="submit" class="btn btn-finish btn-danger" value="Finish" style="display: none;">
									</div>
									<div class="clearfix"></div>
								</div>
							</form>
						</div>
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
		});
	</script>
	<!-- ./JS Files -->
</body>

</html>
