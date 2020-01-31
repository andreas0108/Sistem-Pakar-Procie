<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<!DOCTYPE html>
<html lang="en">


<head>
	<?php $this->load->view('_parts/head'); ?>
</head>

<body>
	<div class="flash-data" data-flashdata="<?= $this->session->flashdata('flashmsg'); ?>"></div>
	<div class="flash-err" data-flasherror="<?= $this->session->flashdata('flasherr'); ?>"></div>
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
					<!-- Content -->
					<div class="row">
						<div class="col-md-4 col-sm-12">
							<div class="card card-profile">
								<div class="card-header" style="background-image: url('../assets/img/blogpost.jpg')">
									<div class="profile-picture">
										<div class="avatar avatar-xl">
											<img src="<?= base_url('assets/img/profile/') ?>ardi.jpg" alt="..." class="avatar-img rounded-circle">
										</div>
									</div>
								</div>
								<div class="card-body">
									<div class="user-profile text-center">
										<div class="name">Andreas Ardi Nur Pratomo</div>
										<div class="job">16.11.0108</div>
										<!-- <div class="desc">A man who hates loneliness</div> -->
										<div class="social-media">
											<a class="btn btn-info btn-twitter btn-sm btn-link" href="https://twitter.com/andreasardinp" target="_blank">
												<span class="btn-label just-icon"><i class="icon-social-twitter"></i> </span>
											</a>
											<a class="btn btn-danger btn-sm btn-link" rel="publisher" href="https://www.instagram.com/andreasardinp/" target="_blank">
												<span class="btn-label just-icon"><i class="icon-social-instagram"></i> </span>
											</a>
											<a class="btn btn-black btn-sm btn-link" rel="publisher" href="https://github.com/andreas0108/" target="_blank">
												<span class="btn-label just-icon"><i class="icon-social-github"></i> </span>
											</a>
										</div>
										<div class="view-profile">
											<a href="https://id.linkedin.com/in/andreas-ardi-320639165?trk=people-guest_people_search-card" class="btn btn-primary btn-block" target="_blank">View Full Profile</a>
										</div>
									</div>
								</div>
								<div class="card-footer">
									<div class="row user-stats text-center">
										<div class="col">
											<div class="number">Skill</div>
											<div class="title">
												Photography, Full Stack Developer, Google Cloud Platform
											</div>
											<div class="title">
												Framework yang dikuasai Bootstrap, Materialize, Codeigniter
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-8 col-sm-12">
							<div class="row">
								<div class="col-md-12">
									<div class="card">
										<div class="card-header">
											<b>ABOUT APPLICATION</b>
										</div>
										<div class="card-body">
											<div class="mb-2">
												<b>Latar Belakang</b>
												<hr>
												<p>
													Belakangan ini 2 kubu penyedia komponen processor yaitu <b>AMD</b> dan <b>Intel</b> sedang bersaing mengembangkan chipset terbaru mereka yang juga membuat jumlah variasi dari Processor itu sendiri semakin banyak, sehingga tak jarang membuat banyak orang yang bingung dengan Processor mana yang sebenarnya mereka butuhkan serta cocok dengan budget yang mereka pula.
												</p>
												<p>
													Tak jarang juga membuat pengguna menyesal karena telah terlanjur membeli Processor yang ternyata tidak sesuai dengan apa yang mereka harapkan. Oleh karena itu saya membuat suatu sistem yang bertujuan untuk memudahkan calon pembeli memilihkan Processor mana yang cocok serta sesuai dengan apa yang memang mereka butuhkan.
												</p>
											</div>
											<div>
												<b>Tentang Aplikasi</b>
												<hr>
												<p>
													PROCIE merupakan aplikasi Sistem Pakar berbasis web yang menggunakan metode <b>Forward Chaining</b> untuk proses rekomendasi komponen Processor. PROCIE sendiri merupakan plesetan dari kata Processor yang sering digunakan di tempat saya.
												</p>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<div class="card">
										<div class="card-header">
											<b>AT A GLANCE</b>
										</div>
										<div class="card-body">
											<ol>
												<li>Arahkan ke sidebar <i class="icon-options-vertical"></i> atau <i class="fas fa-layer-group"></i> diatas.</li>
												<li>Pilih menu <b>Konsultasi</b>.</li>
												<li>Masukan nama dan email anda.</li>
												<li>Jawab semua pertanyaan yang ada.</li>
												<li>Setelah selesai system akan memberikan rekomendasi yang sesuai untuk anda.</li>
											</ol>
										</div>
									</div>
								</div>
							</div>
						</div>
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

	<!-- JS Files   -->
	<?php $this->load->view('_parts/js'); ?>
	<!-- ./JS Files -->
</body>

</html>
