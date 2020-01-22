<!-- About Section -->
<section id="about" class="signup-section text-center" style="background: linear-gradient(to bottom,rgba(22,22,22,.1) 0,rgba(22, 22, 22, 0.71) 75%,#161616 100%),url(../assets/front/img/bg-signup.jpg)">
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
<section id="projects" class="projects-section">
	<div class="container">

		<div class="row">
			<!-- Start Project Row -->
			<div class="col-lg-12">
				<div class="card py-4 h-100">
					<div class="card-body text-center">
						<i class="far fa-paper-plane fa-2x text-primary mb-2"></i>
						<h4 class="text-uppercase m-0">ANSWER THIS QUESTION</h4>
						<hr class="my-4">
						<form action="#" id="myForm" role="form" data-toggle="validator" method="post" accept-charset="utf-8">

							<!-- SmartWizard html -->
							<div id="smartwizard">
								<!-- Tab pertanyaan -->
								<ul class="nav nav-fill">
									<!-- <li>
										<a href="#p0">Testing</a>
									</li> -->
									<?php
									$i = 1;
									foreach ($pert as $p) : ?>
										<li>
											<a href="#<?= $p['id'] ?>">
												Pertanyaan <?= $i++ ?>
											</a>
										</li>
									<?php endforeach ?>
								</ul>

								<!-- Pertanyaan-content -->
								<div class="m-1">
									<!-- <div id="p0">
										<h2>Test Purpose</h2>
										<div id="form-step-0" role="form" data-toggle="validator">
											
										</div>
									</div> -->
									<?php
									$i = 1;
									foreach ($pert as $p2) : ?>
										<div id="<?= $p2['id'] ?>">
											<h2><?= $p2['pertanyaan_content'] ?></h2>
											<div id="form-step-<?= $i++ ?>" role="form" data-toggle="validator">
												<p>Test</p>
											</div>
										</div>
									<?php endforeach ?>
								</div>
							</div>
					</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	</div>
</section>
