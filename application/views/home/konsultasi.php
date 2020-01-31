<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<!DOCTYPE html>
<html lang="en">


<head>
	<?php $this->load->view('_parts/head'); ?>
</head>

<body data-background-color="bg1">
	<div class="wrapper sidebar_minimize">
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
						<div class="col-md-12">
							<div class="wizard-container wizard-round col-md-9">
								<div class="wizard-header text-center">
									<h3 class="wizard-title"><b><?= $this->config->item('site_name'); ?></b></h3>
									<small><?= $desc ?></small>
								</div>
								<form action="<?= base_url('konsultasi/hasil') ?>" method="POST" id="konsulval">
									<div class="wizard-body">
										<div class="row">
											<ul class="wizard-menu nav nav-pills nav-primary nav-fill">
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
																		<img src="holder.js/200x200?text=<?= str_replace(' ', ' ', $j['jawaban_content']) ?>" alt="title" class="imagecheck-image">
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
											<input type="button" class="btn btn-previous btn-fill btn-black" value="<<">
										</div>
										<div class="pull-right">
											<input type="button" class="btn btn-next btn-danger" value=">>">
											<input type="submit" class="btn btn-finish btn-danger" value="Finish" style="display: none;">
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
	<script>
	</script>
	<!-- ./JS Files -->
</body>

</html>
