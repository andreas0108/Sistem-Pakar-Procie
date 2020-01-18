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
<section id="projects" class="projects-section bg-light">
	<div class="container">

		<div class="row">
			<!-- Start Project Row -->
			<div class="col-lg-12">
				<div class="card py-4 h-100">
					<div class="card-body text-center">
						<!-- <i class="  mb-2 text-white"></i> -->
						<i class="far fa-paper-plane fa-2x text-primary mb-2"></i>
						<h4 class="text-uppercase m-0">ANSWER THIS QUESTION</h4>
						<hr class="my-4">
						<div class="text-black-50">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</div>
					</div>
				</div>
			</div>
		</div>

		<!-- Project Two Row -->
		<div class="row justify-content-center gutt">
			<?php for ($no = 1; $no <= 4; $no++) : ?>
				<div class="col-lg-3 order-lg-first">
					<div class="bg-black text-center h-100 project">
						<div class="d-flex h-100">
							<div class="project-text w-100 p-2 ml-2 mr-2 text-center text-lg-center">
								<h4 class="text-white">Answer <?= $no ?></h4>
								<p class="mb-0 text-white-50">
									Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
								<p class="mb-0 text-white-50">
									<a href="#">Read more</a> about this item
								</p>
								<hr class="d-none d-lg-block mb-0 mx-auto">
								<a href="javascript:void(0)" class="btn btn-sm btn-primary mt-3">Start Now</a>
							</div>
						</div>
					</div>
				</div>
			<?php endfor; ?>
		</div>
	</div>

	<!-- Custom Button -->
	<div id="start-now" class="mt-5 container d-flex align-items-center">
		<div class="mx-auto text-center">
			<div class="btn-group">
				<a href="javascript:void(0)" class="btn btn-danger">
					<< Prev</a> <a href="javascript:void(0)" class="btn btn-info">
						Next >>
				</a>
			</div>
		</div>
	</div>
</section>
