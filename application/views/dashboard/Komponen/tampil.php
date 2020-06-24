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
		<div class="flash-info" data-flasherror="<?= $this->session->flashdata('flashinf'); ?>"></div>
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
							<div class="row">
								<div class="col-md-3 col-sm-12">
									<div class="card">
										<?php $k = $kompo;
										if ($k['kmanufid'] == 1) : ?>
											<img src="<?= $kompo['img'] != '' ? base_url('assets/img/komponen/') . $kompo['img'] : 'https://placehold.it/300?text=AMD' ?>" id="preview" class="img-thumbnail animated fadeIn" style="object-position: center; object-fit: cover">
										<?php else : ?>
											<img src="<?= $kompo['img'] != '' ? base_url('assets/img/komponen/') . $kompo['img'] : 'https://placehold.it/300?text=Intel' ?>" id="preview" class="img-thumbnail animated fadeIn" style="object-position: center; object-fit: cover">
										<?php endif
										?>
									</div>
								</div>
								<div class="col-md-9 col-sm-12">
									<div class="card">
										<div class="card-header">
											<?php if ($this->uri->segment(1) == 'konsultasi') { ?>
												<button class="btn btn-info float-right" data-toggle="modal" data-target="#feedbackModal"><i class="fas fa-fw fa-plus-circle"></i> Feedback</button>
											<?php } ?>
											<h5 class="card-title"><?= $k['name'] ?></h5>
											<span><?= "Rp " . number_format($k['price'], null, null, '.'); ?></span>
										</div>
									</div>
									<div class="card">
										<div class="card-body">
											<h5 class="card-text"><b>Deskripsi</b></h5>
											<hr>
											<?= $k['desc'] ?>
										</div>
									</div>
									<div class="card">
										<div class="card-body">
											<div class="row">
												<div class="col">
													<h5 class="card-text"><b>Kategori : </b></h5>
													<div class="form-control">
														<?= $k['kategori'] ?>
													</div>
												</div>
											</div>
											<div class="row mt-4">
												<div class="col">
													<h5 class="card-text"><b>Manufacture : </b></h5>
													<div class="form-control">
														<?= $k['manufacture'] ?>
													</div>
												</div>
												<div class="col">
													<h5 class="card-text"><b>Socket : </b></h5>
													<div class="form-control">
														<?= $k['socket'] ?>
													</div>
												</div>
											</div>
											<div class="row mt-4">
												<div class="col-md-6 col-sm-12">
													<div class="row">
														<div class="col">
															<h5 class="card-text"><b># Core </b></h5>
															<div class="form-control">
																<?= $k['core'] ?>
															</div>
														</div>
														<div class="col">
															<h5 class="card-text"><b># Thread </b></h5>
															<div class="form-control">
																<?= $k['thread'] ?>
															</div>
														</div>
													</div>
												</div>
												<div class="col-md-6 col-sm-12">
													<div class="row">
														<div class="col">
															<h5 class="card-text"><b>Base Clock : </b></h5>
															<div class="form-control">
																<?= $k['base'] ?> GHz
															</div>
														</div>
														<div class="col">
															<h5 class="card-text"><b>Boost Clock : </b></h5>
															<div class="form-control">
																<?= $k['boost'] ?> GHz
															</div>
														</div>
													</div>
												</div>
											</div>
											<div class="row mt-4">
												<div class="col">
													<h5 class="card-text"><b>Link Pembelian :</b></h5>
													<div class="row">
														<?php if ($k['link1']) { ?>
															<div class="col">
																<a class="btn btn-success btn-block" href="<?= $k['link1'] ?>" target="_blank">TOKOPEDIA</a>
															</div>
														<?php } ?>
														<?php if ($k['link2']) { ?>
															<div class="col">
																<a class="btn btn-danger btn-block" href="<?= $k['link2'] ?>" target="_blank">BUKALAPAK</a>
															</div>
														<?php } ?>
														<?php if ($k['link3']) { ?>
															<div class="col">
																<a class="btn btn-warning btn-block" href="<?= $k['link3'] ?>" target="_blank">SHOPEE</a>
															</div>
														<?php } ?>
													</div>
												</div>
											</div>
											<div class="row mt-4">
												<div class="col">
													<?php if ($k['ref']) { ?>
														<a class="btn btn-primary btn-block" href="<?= $k['ref'] ?>">Info Selengkapnya</a>
													<?php } ?>
												</div>
											</div>
										</div>
									</div>
								</div>
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
			<?php if ($this->uri->segment(1) == 'konsultasi') { ?>
				<div class="modal animated fadeIn" id="feedbackModal" tabindex="-1" role="dialog" aria-labelledby="feedbackModalLabel" aria-hidden="true">
					<div class="modal-dialog modal-dialog-centered" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="feedbackModalLabel">Berikan Feedback</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<form action="<?= base_url('dashboard/feedback/kirim') ?>" method="post">
								<div class="modal-body">
									<div class="form-group">
										<input type="text" class="form-control" name="name" placeholder="nama_anda" value="<?= $this->session->userdata('name') == '' || null ? $this->session->userdata('uname') : $this->session->userdata('name'); ?>" required>
									</div>
									<div class="form-group">
										<input type="email" class="form-control" placeholder="email@anda.com" value="<?= $this->session->userdata('umail'); ?>" disabled>
										<input type="hidden" name="email" value="<?= $this->session->userdata('umail'); ?>">
									</div>
									<div class=" form-group">
										<textarea class="form-control" name="isi" rows="8" placeholder="Tulis feedback anda disini" required></textarea>
									</div>
								</div>
								<div class="modal-footer">
									<input type="hidden" name="url" value="<?= current_url() ?>">
									<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
									<button type="submit" class="btn btn-primary">Kirim</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			<?php } ?>
			<!-- ./Optional -->

		</div>
		<!-- ./Content -->
	</div>

	<!-- JS Files   -->
	<?php $this->load->view('_parts/js'); ?>
	<!-- ./JS Files -->
</body>

</html>