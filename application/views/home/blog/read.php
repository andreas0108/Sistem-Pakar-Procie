<!-- About Section -->
<section id="about" class="signup-section text-center" style="background: linear-gradient(to bottom,rgba(22,22,22,.1) 0,rgba(22, 22, 22, 0.71) 75%,#161616 100%),url(/assets/front/img/bg-signup.jpg)">
	<div class="container">
		<div class="row">
			<div class="col-lg-8 mx-auto">
				<h2 class="text-white mb-4">PROCIE</h2>
				<p class="text-white-50 mb-0">
					Procie is a tools to recommend you the best and suitable processor for you based on your answer from my simple question.
				</p>
			</div>
		</div>
	</div>
</section>

<!-- Projects Section -->
<section id="projects" class="projects-section bg-light">
	<div class="container">

		<div class="row">
			<div class="col-lg-12 mb-2">
				<div class="card mx-2">
					<div class="card-header">
						<a href="<?= base_url() ?>"><i class="fas fa-fw fa-home"></i></a> / <a href="<?= base_url('blog') ?>">Blog</a> / <?= $arti['judul'] ?>
					</div>
					<div class="card-body">
						<h2 class="text-uppercase"><?= $arti['judul'] ?></h2>
						<p class="mb-2">
							Writed by <b><?= $arti['name'] ?></b> on <b><?= date_indo($arti['tgl_buat']) ?></b>
						</p>
						<hr>
						<?php
						// var_dump($arti);
						// die;
						if ($arti['gambar'] != '' || null) : ?>
							<center class="mb-4">
								<img class="img=thumbnail" src="<?= base_url('assets/img/article/poster/') . $arti['gambar'] ?>" alt="<?= $arti['slug'] ?>-image" width="50%">
								<p class="small">
									<a href="<?= base_url('assets/img/article/poster/') . $arti['gambar'] ?>" target="_blank" rel="noopener noreferrer">(view)</a>
								</p>
								<hr>
							</center>
						<?php else : ?>
							<img class="img-thumbnail" src="http://via.placeholder.com/400x100?text=article+image" alt="" srcset="" width="100%" height="10px">
						<?php endif ?>
						<div class="text-black-50 text-justify  mt-2">
							<?= $arti['isi'] ?> -<b><?= substr($arti['name'], 0, 5) ?></b>
						</div>
						<div id="disqus_thread"></div>
						<script>
							(function() { // DON'T EDIT BELOW THIS LINE
								var d = document,
									s = d.createElement('script');
								s.src = 'https://procie.disqus.com/embed.js';
								s.setAttribute('data-timestamp', +new Date());
								(d.head || d.body).appendChild(s);
							})();
						</script>
						<noscript>Error while loading comment section, please make sure you enable the javascript. Thanks, <a href="<?= base_url() ?>">Administrator</a></noscript>
					</div>
					<!-- <div class="card-footer">
						<div class="text-center">
							Related Article
							<hr>
						</div>
						<div class="row">
							<div class="col-md-6 col-sm-12">
								a
							</div>
							<div class="col-md-6 col-sm-12">
								b
							</div>
						</div>
					</div> -->
				</div>
			</div>
		</div>

	</div>
</section>
