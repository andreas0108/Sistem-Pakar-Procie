<nav class="main-header navbar navbar-expand navbar-white navbar-light">
	<!-- Left navbar links -->
	<ul class="navbar-nav">
		<li class="nav-item">
			<a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
		</li>
		<li class="nav-item d-none d-sm-inline-block">
			<a href="<?= base_url('dashboard') ?>" class="nav-link">Home</a>
		</li>
		<li class="nav-item mt-auto">
			<a href="/" class="nav-link">View Site</a>
		</li>
	</ul>

	<ul class="navbar-nav ml-auto">
		<li class="nav-item dropdown">
		</li>

		<li class="nav-item dropdown">
			<a href="#" class="nav-link mb-2" data-toggle="dropdown" aria-expanded="false">
				<div class="user-panel d-flex">
					<div class="info">
						<span class="user-name"><?= $user['name']; ?><i class="fas fa-500px fa-fw fa-angle-down"></i></span>
					</div>
					<div class="image">
						<img class="img-circle img-thumbnail img-sm" src="<?= base_url('assets/img/profile/') . $user['img']; ?>" width="40" height="40" alt="">
					</div>
				</div>
			</a>
			<div class="dropdown-menu dropdown-menu-md dropdown-menu-right">
				<a href="#" class="dropdown-item">
					<div class="row">
						<div class="col-3">
							<i class="fas fa-envelope"></i>
						</div>
						<div class="col-9">
							Profile
						</div>
					</div>
				</a>
				<a href="#" class="dropdown-item">
					<div class="row">
						<div class="col-3">
							<i class="fas fa-users"></i>
						</div>
						<div class="col-9">
							Change password
						</div>
					</div>
				</a>
				<a href="#" class="dropdown-item">
					<div class="row">
						<div class="col-3">
							<i class="fas fa-file"></i>
						</div>
						<div class="col-9">
							3 new reports
						</div>
					</div>
				</a>
				<div class="dropdown-divider"></div>
				<a href="<?= base_url('dashboard/logout'); ?>" class="nav-link logout">
					<div class="row">
						<div class="col-3">
							<i class="fas fa-file"></i>
						</div>
						<div class="col-9">
							Logout
						</div>
					</div>
				</a>
			</div>
		</li>
	</ul>


</nav>
