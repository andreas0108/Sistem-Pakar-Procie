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
				<a href="<?= base_url('') ?>" class="logo">
					<img src="<?= base_url('assets/') ?>logo2.png" alt="navbar brand" class="navbar-brand" style="height: 35px">
				</a>
				<button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse" data-target="collapse" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon">
						<i class="icon-menu"></i>
					</span>
				</button>
				<button class="topbar-toggler more"><i class="icon-options-vertical"></i></button>
				<div class="nav-toggle">
					<button class="btn btn-toggle toggle-sidebar">
						<i class="icon-menu"></i>
					</button>
				</div>
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
					<div class="row">
						<div class="col-md-12">
							<div class="page-header mb-1">
								<h4 class="page-title"><?= ucfirst($title) ?></h4>
								<ul class="breadcrumbs">
									<?php $this->load->view('Blog/bc'); ?>
								</ul>
							</div>
							<div class="mb-3">
								<span class="badge badge-count">
									Writted by <b><?= $arti['name'] ?></b>
								</span>
								<span class="badge badge-info" title="<?= unix_indo2($arti['tgl_buat'], "htjs") . ' WIB' ?>">
									<b><?= unix_indo2($arti['tgl_buat'], "tgl") ?></b>
								</span>
							</div>

							<div class="card full-height">
								<div class="card-body image-gallery">
									<center>
										<?php if ($arti['gambar'] == '' || null) : ?>
											<a href="https://via.placeholder.com/400x200?text=No+Image">
												<img src="https://via.placeholder.com/400x200?text=No+Image" alt="<?= $arti['slug'] . '-img' ?>" class="img-fluid img-thumbnail mb-3">
											</a>
										<?php else : ?>
											<a href="<?= base_url('assets/img/article/poster/') . $arti['gambar'] ?>">
												<img src="<?= base_url('assets/img/article/poster/') . $arti['gambar'] ?>" alt="" class="img-fluid img-thumbnail mb-3" style="width:25%;">
											</a>
										<?php endif ?>
									</center>
									<?= $arti['isi'] ?>
								</div>
								<div class="card-footer">
									<button type="button" class="btn btn-sm btn-outline-secondary btn-block mb-3" data-toggle="collapse" data-target="#disqus_thread" aria-expanded="false" aria-controls="disqus_thread">Tampilkan Komentar</button>
									<div class="collapse mb-1" id="disqus_thread"></div>
									<script>
										/**
										 *  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
										 *  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables*/
										/*
										var disqus_config = function () {
										this.page.url = PAGE_URL;  // Replace PAGE_URL with your page's canonical URL variable
										this.page.identifier = PAGE_IDENTIFIER; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
										};
										*/
										(function() { // DON'T EDIT BELOW THIS LINE
											var d = document,
												s = d.createElement('script');
											s.src = 'https://procie.disqus.com/embed.js';
											s.setAttribute('data-timestamp', +new Date());
											(d.head || d.body).appendChild(s);
										})();
									</script>
									<noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
								</div>
							</div>
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
	<?php $this->load->view('js/js-blog-read'); ?>
	<!-- ./JS Files -->
</body>

</html>
