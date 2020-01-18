<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
	<!-- Brand Logo -->
	<a href="<?= base_url(); ?>" class="brand-link">
		<img src="<?= base_url('assets/') ?>img/logo.png" alt="Site Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
		<span class="brand-text font-weight-light"><?= $this->config->item('site_name'); ?></span>
	</a>

	<!-- Sidebar -->
	<div class="sidebar">
		<!-- Sidebar Menu -->
		<nav class="mt-2">
			<ul class="nav nav-pills nav-sidebar flex-column nav-child-indent" data-widget="treeview" role="menu" data-accordion="false">
				<!-- Query menu -->
				<?php
				$menu = $this->db->get_where('user_menu', 'is_active = 1')->result_array();
				?>
				<!-- Add icons to the links using the .nav-icon class
			   with font-awesome or any other icon font library -->
				<!-- Static Menu & SubMenu -->
				<li class="nav-header">Home</li>
				<li class="nav-item">
					<?php if ($title3 == 'Dashboard') : ?>
						<a href="<?= base_url('dashboard') ?>" class="nav-link active">
							<i class="fas fa-fw fa-home"></i>
							<p>Dashboard</p>
						</a>
					<?php else : ?>
						<a href="<?= base_url('dashboard') ?>" class="nav-link">
							<i class="nav-icon fas fa-fw fa-home"></i>
							<p>Dashboard</p>
						</a>
					<?php endif ?>
				</li>

				<!-- Dynamic Menu & SubMenu -->
				<?php foreach ($menu as $m) : ?>
					<li class="nav-header"><?= $m['menu'] ?></li>
					<?php
					$this->db->where('menu_id', $m['id']);
					$this->db->where('is_active', 1);
					$subMenu = $this->db->get('user_sub_menu')->result_array();
					?>
					<?php foreach ($subMenu as $sm) : ?>
						<li class="nav-item">
							<?php if ($title3 == $sm['title']) : ?>
								<a href="<?= base_url($sm['url']); ?>" class="nav-link active">
									<i class="nav-icon <?= $sm['icon']; ?>"></i>
									<p><?= $sm['title']; ?></p>
								</a>
							<?php else : ?>
								<a href="<?= base_url($sm['url']); ?>" class="nav-link">
									<i class="nav-icon <?= $sm['icon']; ?>"></i>
									<p><?= $sm['title']; ?></p>
								</a>
							<?php endif ?>
						</li>
					<?php endforeach ?>
				<?php endforeach ?>
				<li class="nav-header">Extra</li>
				<li class="nav-item">
					<a href="<?= base_url('dashboard/logout'); ?>" class="nav-link logout">
						<i class="nav-icon fas fa-sign-out-alt"></i>
						<p>
							Logout
						</p>
					</a>
				</li>
				<li class="nav-item">
					<a href="#" class="nav-link">
						<i class="nav-icon fas fa-th"></i>
						<p>
							Simple Link
							<span class="right badge badge-danger">New</span>
						</p>
					</a>
				</li>
			</ul>
		</nav>
		<!-- /.sidebar-menu -->
	</div>
	<!-- /.sidebar -->
</aside>
