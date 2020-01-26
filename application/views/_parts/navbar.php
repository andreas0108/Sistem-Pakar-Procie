<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<div class="container-fluid">
	<?php if ($this->uri->segment(1) != '') : ?>
		<div class="collapse" id="search-nav">
			<form class="navbar-left navbar-form nav-search mr-md-3">
				<div class="input-group">
					<div class="input-group-prepend">
						<button type="submit" class="btn btn-search pr-1">
							<i class="fa fa-search search-icon"></i>
						</button>
					</div>
					<input type="text" placeholder="Search ..." class="form-control">
				</div>
			</form>
		</div>
	<?php endif ?>
	<ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
		<!-- Search Button -->
		<li class="nav-item toggle-nav-search hidden-caret">
			<a class="nav-link" data-toggle="collapse" href="#search-nav" role="button" aria-expanded="false" aria-controls="search-nav">
				<i class="fa fa-search"></i>
			</a>
		</li>
		<!-- ./Search Button -->

		<!-- Quick App -->
		<li class="nav-item dropdown hidden-caret">
			<a class="nav-link" data-toggle="dropdown" href="#" aria-expanded="false">
				<i class="fas fa-layer-group"></i>
			</a>
			<div class="dropdown-menu quick-actions quick-actions-info animated fadeIn">
				<div class="quick-actions-header">
					<span class="title mb-1">Quick Actions</span>
				</div>
				<div class="quick-actions-scroll scrollbar-outer">
					<div class="quick-actions-items">
						<div class="row m-0">
							<a class="col-6 col-md-4 p-0" href="<?= base_url('konsultasi') ?>">
								<div class="quick-actions-item">
									<div class="avatar-item bg-danger rounded-circle">
										<i class="fas fa-project-diagram"></i>
									</div>
									<span class="text">Konsultasi</span>
								</div>
							</a>
							<a class="col-6 col-md-4 p-0" href="<?= base_url('blog') ?>">
								<div class="quick-actions-item">
									<div class="avatar-item bg-warning rounded-circle">
										<i class="fas fa-comment-alt"></i>
									</div>
									<span class="text">Blog</span>
								</div>
							</a>
							<a class="col-6 col-md-4 p-0" href="<?= base_url('about') ?>">
								<div class="quick-actions-item">
									<div class="avatar-item bg-info rounded-circle">
										<i class="fas fa-question"></i>
									</div>
									<span class="text">About</span>
								</div>
							</a>
						</div>
					</div>
				</div>
				<div class="quick-actions-header">
					<a href="<?= base_url('login') ?>" class="subtitle op-8" style="color: white"><i class="icon-login"></i> Login</a>
				</div>
			</div>
		</li>
		<!-- ./Quick App -->

		<!-- Profile -->
		<?php if ($this->session->userdata('email')) : ?>
			<li class="nav-item dropdown hidden-caret">
				<a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#" aria-expanded="false">
					<div class="avatar-sm">
						<?php if ($this->session->userdata('email')) : ?>
							<img src="<?= base_url('assets/img/profile/') . $user['img'] ?>" alt="..." class="avatar-img rounded-circle">
						<?php else : ?>
							<img src="<?= base_url('assets/img/profile/') . 'default.png' ?>" alt="..." class="avatar-img rounded-circle">
						<?php endif ?>
					</div>
				</a>
				<ul class="dropdown-menu dropdown-user animated fadeIn">
					<div class="dropdown-user-scroll scrollbar-outer">
						<li>
							<div class="user-box">
								<div class="avatar-lg">
									<img src="<?= base_url('assets/img/profile/') . $user['img'] ?>" alt=" image profile" class="avatar-img rounded">
								</div>
								<div class="u-text">
									<h4><?= $user['name'] ?></h4>
									<p class="text-muted">
										<a href="mailto:<?= $user['email'] ?>"><?= substr($user['email'], 0, 15) . '...' ?></a>
									</p>
									<a href="javascript:void(0)" class="btn btn-xs btn-secondary btn-sm">View Profile</a>
								</div>
							</div>
						</li>
						<li>
							<div class="dropdown-divider"></div>
							<a class="dropdown-item" href="#">My Profile</a>
							<a class="dropdown-item" href="#">My Balance</a>
							<a class="dropdown-item" href="#">Inbox</a>
							<div class="dropdown-divider"></div>
							<a class="dropdown-item" href="#">Account Setting</a>
							<div class="dropdown-divider"></div>
							<a class="dropdown-item" href="#">Logout</a>
						</li>
					</div>
				</ul>
			</li>
		<?php endif ?>
		<!-- ./Profile -->
	</ul>
</div>
