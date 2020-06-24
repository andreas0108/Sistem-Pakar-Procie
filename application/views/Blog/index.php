<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<!DOCTYPE html>
<html lang="en">


<head>
	<?php $this->load->view('_parts/head'); ?>
</head>

<body>
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
							<?php
							if (count($blogpost) == 0) : ?>
								<div class="alert alert-primary" role="alert">
									Belum ada artikel yang diterbitkan untuk saat ini. <br>
									<a href="<?= base_url('blog') ?>">(Segarkan.)</a>
								</div>
							<?php else : ?>
								<?php foreach ($blogpost as $bp) : ?>
									<div class="card">
										<div class="card-body">
											<div class="row">
												<div class="col-lg-2 col-md-4 col-sm-12">
													<center>
														<?php if ($bp['gambar'] == '' || null) : ?>
															<img src="https://via.placeholder.com/400?text=No+Image" alt="<?= $bp['judul'] . ' img' ?>" srcset="" class="img-thumbnail card-product" style="margin: auto; height: 10rem; object-fit: cover;">
														<?php else : ?>
															<img src="<?= base_url('assets/img/article/poster/') . $bp['gambar'] ?>" alt="<?= $bp['judul'] . ' img' ?>" srcset="" class="img-thumbnail card-product" style="margin: auto; height: 10rem; object-fit: cover;">
														<?php endif ?>
													</center>
												</div>
												<div class="col-lg-10 col-md-8 col-sm-12">
													<a href="<?= base_url('blog/read/') . $bp['slug'] ?>" target="_blank" rel="noopener noreferrer">
														<h2><?= $bp['judul'] . ' '; ?></h2>
													</a>
													<?php $tags = explode(',', $bp['tags']) ?>
													<span class="badge badge-count"><?= ' ' . unix_indo($bp['tgl_buat']); ?></span>
													<?php foreach ($tags as $t) : ?>
														<span class="badge badge-info mb-0">
															<b><?= $t ?></b>
														</span>
													<?php endforeach ?>
													<hr class=" mb-2">
													<p class="mt-0">
														<?php if ($bp['isi'] == '' || null) : ?>
															<p class="text-sm text-info italic">Kosong</p>
														<?php else : ?>
															<?= limit_word_regex($bp['isi'], 20) ?><br>
															<a href="<?= base_url('blog/read/') . $bp['slug'] ?>" target="_blank" rel="noopener noreferrer" class="badge badge-primary">Baca artikel</a>
														<?php endif ?>
													</p>
												</div>
											</div>
										</div>
									</div>
								<?php endforeach ?>
								<?= $this->pagination->create_links(); ?>
							<?php endif ?>
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

	<!-- disqus Count JS -->
	<!-- <script id="dsq-count-scr" src="//procie.disqus.com/count.js" async></script> -->

	<!-- ./JS Files -->
</body>

</html>