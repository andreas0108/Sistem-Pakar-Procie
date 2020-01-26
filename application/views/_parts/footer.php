<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<div class="container-fluid">
	<nav class="pull-left">
		<ul class="nav">
			<li class="nav-item">
				<a class="nav-link" href="<?= base_url() ?>">
					<?= strtolower($this->config->item('site_name')); ?>
				</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="#">
					help
				</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="#">
					licenses
				</a>
			</li>
			<?php if ($this->session->userdata('email')) : ?>
				<li class="nav-item">
					<a class="nav-link logout" href="<?= base_url('logout') ?>">
						logout
					</a>
				</li>
			<?php else : ?>
				<li class="nav-item">
					<a class="nav-link" href="<?= base_url('login') ?>">
						login
					</a>
				</li>
			<?php endif ?>
		</ul>
	</nav>
	<div class="copyright ml-auto">
		2018 - <?= date('Y'); ?>, made with <i class="fa fa-heart heart text-danger"></i> by <a href="http://www.themekita.com">ThemeKita</a>
	</div>
</div>
