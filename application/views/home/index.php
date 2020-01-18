<!-- Header -->
<header class="masthead">
	<div class="container d-flex h-100 align-items-center">
		<div class="mx-auto text-center">
			<h1 class="mx-auto my-0 text-uppercase">PROCIE</h1>
			<h2 class="text-white-50 mx-auto mt-2 mb-5">A tool who recomend you a suitable processor just for you.</h2>
			<a href="<?= base_url('#about') ?>" class="btn btn-primary js-scroll-trigger">Get Started</a>
		</div>
	</div>
</header>

<!-- About Section -->
<section class="about-section text-center">
	<div class="container">
		<div class="row">
			<div class="col-lg-8 m-auto">
				<h2 class="text-white mb-4">Built with <i class="fa fa-heart"> & <i class="fa fa-coffee"></i></i></h2>
				<p class="text-white-50 mb-5">
					This small powerfull tool, builded just for you from deepest heart of developer and some drip of coffe ofcourse to give you best processor.
				</p>
			</div>
		</div>
		<img src="<?= base_url() ?>assets/front/img/xx.png" class="img-fluid mt-0 mb-4" alt="">
	</div>
</section>

<!-- Projects Section -->
<section id="about" class="projects-section bg-light">
	<div class="container mt-0">

		<!-- Featured Project Row -->
		<!-- <div class="row align-items-center no-gutters mb-4 mb-lg-5"> -->
		<div class="row align-items-center no-gutters mt-0 mb-5">
			<div class="col-xl-8 col-lg-7">
				<img class="img-fluid mb-0 mb-lg-0" src="<?= base_url() ?>assets/front/img/bg-masthead.jpg" alt="">
			</div>
			<div class="col-xl-4 col-lg-5">
				<div class="featured-text text-center text-lg-left">
					<h4>Procie</h4>
					<p class="text-black-50 mb-0">Procie is a tools to recommend you the best and suitable processor for you based on your answer from my simple question.</p>
					<p class="text-black-50"> <i>(Relax it's not exam, it's just some <b>simple quiestion</b>)</i>.</p>
				</div>
			</div>
		</div>
		<!-- Project One Row -->
		<div class="row justify-content-center no-gutters mb-5 mb-lg-0">
			<div class="col-lg-6">
				<img class="img-fluid" src="<?= base_url() ?>assets/front/img/questionbox.jpg" alt="">
			</div>
			<div class="col-lg-6">
				<div class="bg-black text-center h-100 project">
					<div class="d-flex h-100">
						<div class="project-text w-100 my-auto text-center text-lg-left">
							<h4 class="text-white">Answering Question</h4>
							<p class="mb-0 text-white-50">You just need to answer every question in here then, just wait the result.</p>
							<hr class="d-none d-lg-block mb-0 ml-0">
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- Project Two Row -->
		<div class="row justify-content-center no-gutters">
			<div class="col-lg-6">
				<img class="img-fluid" src="<?= base_url() ?>assets/front/img/recomend.png" alt="">
			</div>
			<div class="col-lg-6 order-lg-first">
				<div class="bg-black text-center h-100 project">
					<div class="d-flex h-100">
						<div class="project-text w-100 my-auto text-center text-lg-right">
							<h4 class="text-white">Recomendating</h4>
							<p class="mb-0 text-white-50">
								Our tools recomendating processor for you base from your answer and the list of processor is from range 2019-now, so it's not too old for you if you have some lower generations from the result.</p>
							<p class="mb-0 text-white-50">
								And ofcourse, both side <b style="color: red">#TEAMRED</b> & <b style="color: blue">#TEAMBLUE</b>.</p>
							<p class="mb-0 text-white-50">I personally try to neutral.</p>
							<hr class="d-none d-lg-block mb-0 mr-0">
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Custom Button -->
	<div id="start-now" class="mt-5 container d-flex align-items-center">
		<div class="mx-auto text-center">
			<a href="#page-top" class="btn btn-primary js-scroll-trigger">Start Now</a>
		</div>
	</div>
</section>

<!-- Signup Section -->
<section id="signup" class="signup-section">
	<div class="container">
		<?php if ($this->session->flashdata('signup') == true) : ?>
			<div class="row">
				<div class="col-10 mx-auto">
					<div class="alert alert-info alert-dismissible fade show" role="alert">
						<strong>Thanks !</strong> You now will get some article and update from us (not spam).
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
				</div>
			</div>
		<?php endif ?>
		<div class="row">
			<div class="col-10 mx-auto text-center">
				<i class="far fa-paper-plane fa-2x mb-2 text-white"></i>
				<h2 class="text-white mb-5">Subscribe to receive updates!</h2>

				<form class="form-inline d-flex">
					<input type="text" class="form-control flex-fill mr-0 mr-sm-2 mb-3 mb-sm-2" name="name" id="name" placeholder="Your name">
					<input type="email" class="form-control flex-fill mr-0 mr-sm-2 mb-3 mb-sm-2" id="email" name="email" placeholder="Enter email address">
					<button type="submit" class="btn btn-primary mr-0 mr-sm-2 mb-3 mb-sm-2">Subscribe</button>
				</form>

			</div>
		</div>
	</div>
</section>

<!-- Contact Section -->
<?php $lA = $lA[0] ?>
<section class="contact-section bg-black">
	<div class="container">
		<div class="row">
			<div class="col-md-6 col-sm-12 mb-3 mb-md-0">
				<div class="card py-4 h-100">
					<div class="card-body text-center">
						<h4 class="text-uppercase m-0">Last blog</h4>
						<hr class="my-4">
						<div class="div">
							<h4 class="mt-4 bold"><?= $lA['judul'] ?></h4>
							<p class="small text-black-50 pt-1">
								<?= limit_word($lA['isi'], 10) ?><br>
								<a href="<?= base_url('blog/read/') . $lA['slug'] ?>" class="text-info">(Read More.)</a>
							</p>
						</div>
					</div>
				</div>
			</div>

			<div class="col-md-6 col-sm-12 mb-3 mb-md-0">
				<div class="card py-4 h-100">
					<div class="card-body text-center">
						<h4 class="text-uppercase m-0">New Part</h4>
						<hr class="my-4">
						<div class="div">
							<h4 class="mt-4 bold">
								<a href="#"><?= $nK['komponen_name'] ?></a>
							</h4>
							<p class="small text-black-50 pt-1">
								<?= limit_word($nK['desc'], 10) ?>
							</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
