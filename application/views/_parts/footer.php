<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<div class="container-fluid">
	<nav class="pull-left">
		<ul class="nav">
			<li class="nav-item">
				<a class="nav-link" href="<?= base_url('konsultasi') ?>">
					Konsultasi
				</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="<?= base_url('blog') ?>">
					Blog
				</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="<?= base_url('about') ?>">
					About
				</a>
			</li>
			<?php if ($this->session->userdata('email')) : ?>
				<li class="nav-item">
					<a class="nav-link logout" href="<?= base_url('logout') ?>">
						Logout
					</a>
				</li>
			<?php else : ?>
				<li class="nav-item">
					<a class="nav-link" href="<?= base_url('login') ?>">
						Login
					</a>
				</li>
			<?php endif ?>
		</ul>
	</nav>
	<div class="copyright ml-auto">
		&copy; 2019 - <?= date('Y'); ?>, made with <i class="fa fa-heart heart text-danger"></i> by <a href="<?= base_url() ?>">Andreas Ardi</a>
	</div>
</div>