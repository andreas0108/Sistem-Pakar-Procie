<!-- About Section -->
<section id="about" class="signup-section text-center" style="background: linear-gradient(to bottom,rgba(22,22,22,.1) 0,rgba(22, 22, 22, 0.71) 75%,#161616 100%),url(../assets/front/img/bg-masthead.jpg)">
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
			<div class="col-12">
				<form>
					<div class="form-group d-flex">
						<input type="text" class="form-control flex-fill mb-3 mb-sm-2 mr-3" id="title" placeholder="Search">
						<div class="float-right mx-auto mt-2">
							<i class="fas fa-fw fa-search"></i>
						</div>
					</div>
				</form>
			</div>
		</div>
		<div class="row">
			<?php foreach ($liBo as $lB) : ?>
				<div class="col-lg-12 mb-2">
					<div class="card py-4 h-100">
						<div class="card-body text-center">
							<h4 class="text-uppercase m-0">
								<a href="<?= base_url('blog/read/') . $lB['slug'] ?>">
									<?= $lB['judul'] ?>
								</a>
							</h4>
							<p class="small text-black-50">Writed by <b><?= $lB['name'] ?></b> on <?= date_indo($lB['tgl_buat']) ?></p>
							<hr class="my-4">
							<div class="text-black-50"><?= limit_word_regex($lB['isi'], 10); ?></div>
						</div>
					</div>
				</div>
			<?php endforeach ?>
			<?= $this->pagination->create_links(); ?>
		</div>

	</div>
</section>
