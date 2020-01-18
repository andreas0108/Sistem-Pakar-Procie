<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
	<div class="container">
		<img class="mx-auto" src="/assets/logo.png" height="30" alt="logo">
		<a class="navbar-brand js-scroll-trigger ml-2" href="<?= base_url() ?>#page-top"><?= $appname ?></a>
		<button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
			Menu
			<i class="fas fa-bars"></i>
		</button>
		<div class="collapse navbar-collapse" id="navbarResponsive">
			<ul class="navbar-nav ml-auto">
				<li class="nav-item">
					<a class="nav-link js-scroll-trigger" href="<?= base_url() ?>#about">About</a>
				</li>
				<li class="nav-item">
					<a class="nav-link js-scroll-trigger" href="<?= base_url('blog') ?>">Blog</a>
				</li>
				<li class="nav-item">
					<a class="nav-link text-info" href="<?= base_url('procie') ?>">Start Now !</a>
				</li>
			</ul>
		</div>
	</div>
</nav>
