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
										if ($k['manufacture'] == 1) : ?>
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
											<h5 class="card-title"><?= $k['name'] ?></h5>
										</div>
										<div class="card-body">
											<h5 class="card-text"><b>Deskripsi</b></h5>
											<hr>
											<?= $k['desc'] ?>
											<hr>
											<div class="row">
												<div class="col">
													<div class="row">
														<div class="col-md-3">
															<h5 class="card-text"><b>Kategori : </b></h5>
														</div>
														<div class="col-md-9"><?= $k['kategori'] ?></div>
													</div>
												</div>
												<div class="col">
													<div class="row">
														<div class="col-md-3">
															<h5 class="card-text"><b>Harga : </b></h5>
														</div>
														<div class="col-md-9"><?= "Rp " . number_format($k['price'], null, null, '.'); ?></div>
													</div>
												</div>
											</div>
											<hr>
											<h5 class="card-text"><b>Spesifikasi Teknis</b></h5>
											<hr>
											(coming soon...)
											<!-- <?= var_dump($kasil) ?> -->
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

			<!-- ./Optional -->

		</div>
		<!-- ./Content -->
	</div>

	<!-- JS Files   -->
	<?php $this->load->view('_parts/js'); ?>
	<!-- ./JS Files -->
</body>

</html>
