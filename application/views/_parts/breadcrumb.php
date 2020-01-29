<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<!-- Breadcrumbs-->
<li class="nav-home">
	<a href="<?= base_url() ?>" class="text-primary" title="Home">
		<i class="flaticon-home"></i>
	</a>
</li>
<?php foreach ($this->uri->segments as $segment) : ?>
	<?php
	$url = substr($this->uri->uri_string, 0, strpos($this->uri->uri_string, $segment)) . $segment;
	$is_active =  $url == $this->uri->uri_string;
	?>

	<li class="separator">
		<i class="flaticon-right-arrow"></i>
	</li>

	<li class="nav-item">
		<?php if ($is_active) : ?>
			<span title="Halaman saat ini"><?= ucfirst($segment) ?></span>
		<?php else : ?>
			<a href="<?= site_url($url) ?>" class="text-primary" title="<?= ucfirst($segment) ?>"><?= ucfirst($segment) ?></a>
		<?php endif; ?>
	</li>
<?php endforeach; ?>
