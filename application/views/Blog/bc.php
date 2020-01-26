<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<!-- Breadcrumbs-->
<li class="nav-home">
	<a href="<?= base_url() ?>">
		<i class="flaticon-home"></i>
	</a>
</li>
<?php
$item = [
	['title' => ucfirst($this->uri->segment(1)), 'url' => base_url() . $this->uri->segment(1)],
	['title' => ucfirst($title), 'url' =>  'javascript:void(0)'],
];
?>

<?php foreach ($item as $i) : ?>
	<li class="separator">
		<i class="flaticon-right-arrow"></i>
	</li>
	<li class="nav-item">
		<a href="<?= $i['url'] ?>"><?= $i['title'] ?></a>
	</li>
<?php endforeach ?>
