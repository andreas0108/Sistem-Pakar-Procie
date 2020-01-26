<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<!DOCTYPE html>
<html lang="en">


<head>
	<?php $this->load->view('_parts/head'); ?>
</head>

<body>
	<div class="wrapper">
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
		<div class="flash-data" data-flashdata="<?= $this->session->flashdata('flashmsg'); ?>"></div>
		<div class="main-panel">
			<!-- Main Container -->
			<div class="container">
				<div class="page-inner">
					<!-- <div class="page-inner"> -->
					<div class="row">
						<div class="col-md-12">
							<div class="page-header">
								<h4 class="page-title"><?= strtoupper($title) ?></h4>
								<ul class="breadcrumbs">
									<?php $this->load->view('_parts/breadcrumb'); ?>
								</ul>
							</div>
							<?php foreach ($blogpost as $bp) : ?>
								<div class="card">
									<div class="card-body">
										<div class="row">
											<div class="col-md-1 col-sm-12">
												<?php if ($bp['gambar'] == '' || null) : ?>
													<img src="https://via.placeholder.com/400?text=No+Image" alt="<?= $bp['judul'] . ' img' ?>" srcset="" class="img-thumbnail card-product m-auto" style="width: 7rem; height:7rem">
												<?php else : ?>
													<img src="<?= base_url('assets/img/article/poster/') . $bp['gambar'] ?>" alt="<?= $bp['judul'] . ' img' ?>" srcset="" class="img-thumbnail card-product m-auto" style="width: 7rem; height:7rem">
												<?php endif ?>
											</div>
											<div class="col-md-11 col-sm-12">
												<a href="<?= base_url('blog/read/') . $bp['slug'] ?>" target="_blank" rel="noopener noreferrer">
													<h2 class="mb-0"><?= $bp['judul'] ?></h2>
												</a>
												<small class="mb-0"><?= date_indo(gmdate("Y-m-d H:i:s", $bp['tgl_buat'])) ?></small>
												<hr class="mb-2">
												<p class="mt-0">
													<?= substr(html_escape(preg_replace('/<+\s*\/*\s*([A-Z][A-Z0-9]*)\b[^>]*\/*\s*>+/i', '', $bp['isi'])), 0, 300)  ?>
													<?php if ($bp['isi'] == '' || null) : ?>
														<p class="text-sm text-info italic">Kosong</p>
													<?php else : ?>
														...
													<?php endif ?>
												</p>
											</div>
										</div>
									</div>
								</div>
							<?php endforeach ?>
							<?= $this->pagination->create_links(); ?>
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

	<!-- JS Files   -->
	<?php $this->load->view('_parts/js'); ?>
	<!-- ./JS Files -->
</body>

</html>
