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
						<div class="col-lg-10 col-sm-12 mx-auto">
							<div class="page-header ">
								<ul class="breadcrumbs ml-0 pl-3 mb-1">
									<?php $this->load->view('Blog/bc'); ?>
								</ul>
							</div>
							<div class="card">
								<div class="card-header p-0 m-0">
									<img src="<?= base_url('assets/img/article/poster/') . $arti['gambar'] ?>" alt="" srcset="" style="width:100%; height: 15rem; object-fit: cover">
								</div>
								<div class="card-body pb-0">
									<h4 class="page-title mb-1"><?= ucfirst($title) ?></h4>
									<span>
										<a class="btn btn-sm" href="javascript:void(0)" style="margin-left: -15px;">
											<i class="fa fa-fw fa-user"></i> <b><?= $arti['name'] . ' ' ?></b>
										</a>
									</span>
									|
									<span title="<?= unix_indo2($arti['tgl_buat'], "htjs") . ' WIB' ?>">
										<a class="btn btn-sm" href="javascript:void(0)">
											<i class="fa fa-fw fa-calendar"></i> <b> <?= unix_indo2($arti['tgl_buat'], "tgl") ?></b>
										</a>
									</span>
									<div style="text-align: justify">
										<?= $arti['isi'] ?>
									</div>
								</div>
								<div class="mt--2 pt-0 mr-4 mb-4 ml-4" style="text-align: right">
									<?php $tags = explode(',', $arti['tags']) ?>
									Tags :
									<?php foreach ($tags as $t) : ?>
										<span class="badge badge-info">
											<b><?= $t ?></b>
										</span>
									<?php endforeach ?>
								</div>
								<div class="card-footer">
									<button type="button" class="btn btn-sm btn-outline-primary btn-block mb-3" data-toggle="collapse" data-target="#disqus_thread" aria-expanded="false" aria-controls="disqus_thread">Tampilkan Komentar</button>
									<div class="collapse mb-1" id="disqus_thread"></div>
									<script>
										/**
										 *  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
										 *  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables*/

										var disqus_config = function() {
											this.page.url = '<?= base_url('blog/read/') . $arti['slug'] ?>'; // Replace PAGE_URL with your page's canonical URL variable
											this.page.identifier = '<?= $arti['slug'] ?>'; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
										};

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

	<!-- disqus Count JS -->
	<script id="dsq-count-scr" src="//procie.disqus.com/count.js" async></script>

	<?php $this->load->view('js/js-blog-read'); ?>
	<!-- ./JS Files -->
</body>

</html>