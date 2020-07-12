<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<div class="sidebar-wrapper scrollbar scrollbar-inner">
	<div class="sidebar-content">
		<!-- if admin user found -->
		<?php if ($this->session->userdata('email')) : ?>
			<div class="user">
				<div class="avatar-sm float-left mr-2">
					<img src="<?= base_url('assets/img/profile/') . $user['img'] ?>" alt="..." class="avatar-img rounded-circle">
				</div>
				<div class="info">
					<a data-toggle="collapse" href="#collapseExample" aria-expanded="true">
						<span>
							<?php
							if (strlen($user['name']) >= 14) {
								echo substr($user['name'], 0, 14) . '...';
							} else {
								echo $user['name'];
							}
							?>
							<span class="user-level">Administrator</span>
							<span class="caret"></span>
						</span>
					</a>
					<div class="clearfix"></div>

					<div class="collapse in" id="collapseExample">
						<ul class="nav">
							<li>
								<a href="<?= base_url('dashboard/user') ?>">
									<span class="link-collapse">My Profile</span>
								</a>
							</li>
						</ul>
					</div>
				</div>
			</div>
		<?php endif ?>
		<!-- default sidebar -->
		<ul class="nav nav-primary">
			<li class="nav-section">
				<span class="sidebar-mini-icon">
					<i class="fa fa-ellipsis-h"></i>
				</span>
				<h4 class="text-section">Home</h4>
			</li>
			<?php if ($this->session->userdata('email')) : ?>
				<li class="nav-item <?= strtolower($this->uri->segment(1)) == '' ? 'active' : '' ?>">
					<a href="<?= base_url() ?>">
						<i class="fas fa-tachometer-alt"></i>
						<p>Dashboard</p>
					</a>
				</li>
				<li class="nav-item <?= strtolower($this->uri->segment(2)) == 'user' ? 'active' : '' ?>">
					<a href="<?= base_url('dashboard/user') ?>">
						<i class="fas fa-user"></i>
						<p>User</p>
					</a>
				</li>
			<?php else : ?>
				<li class="nav-item <?= strtolower($this->uri->segment(1)) == '' ? 'active' : '' ?>">
					<a href="<?= base_url() ?>">
						<i class="fas fa-home"></i>
						<p>Home</p>
					</a>
				</li>
			<?php endif ?>

			<li class="nav-section">
				<span class="sidebar-mini-icon">
					<i class="fa fa-ellipsis-h"></i>
				</span>
				<h4 class="text-section">Sistem Pakar</h4>
			</li>
			<li class="nav-item <?= strtolower($this->uri->segment(1)) == 'konsultasi' ? 'active' : '' ?>">
				<a href="<?= base_url('konsultasi') ?>">
					<i class="fas fa-project-diagram"></i>
					<p>Konsultasi</p>
				</a>
			</li>
			<li class="nav-item <?= strtolower($this->uri->segment(1)) == 'blog' ? 'active' : '' ?>">
				<a href="<?= base_url('blog') ?>">
					<i class="fas fa-book"></i>
					<p>Blog</p>
				</a>
			</li>
			<li class="nav-item <?= strtolower($this->uri->segment(1)) == 'about' ? 'active' : '' ?>">
				<a href="<?= base_url('about') ?>">
					<i class="fas fa-question"></i>
					<p>Tentang</p>
				</a>
			</li>

			<!-- Admin Menu -->
			<?php if ($this->session->userdata('email')) : ?>
				<?php $menu = $this->db->get_where('user_menu', 'is_active = 1')->result_array();
				foreach ($menu as $m) : ?>
					<li class="nav-section">
						<span class="sidebar-mini-icon">
							<i class="fa fa-ellipsis-h"></i>
						</span>
						<h4 class="text-section">Dashboard Menu</h4>
					</li>
					<?php $submenu = $this->db->get_where('user_sub_menu', ['menu_id' => $m['id']])->result_array();

					foreach ($submenu as $sm) : ?>

						<li class="nav-item <?= strtolower($this->uri->segment(2)) == strtolower($sm['title']) ? 'active' : '' ?>">
							<a href="<?= base_url() . $sm['url'] ?>">
								<i class="<?= $sm['icon'] ?>"></i>
								<p><?= $sm['title'] ?></p>
							</a>
						</li>
					<?php endforeach ?>
				<?php endforeach ?>
				<li class="nav-item <?= strtolower($this->uri->segment(2)) == 'log' ? 'active' : '' ?>">
					<a href="<?= base_url('Dashboard/log') ?>">
						<i class="fas fa-server"></i>
						<p>System Logs</p>
					</a>
				</li>
			<?php endif ?>
		</ul>
	</div>
</div>