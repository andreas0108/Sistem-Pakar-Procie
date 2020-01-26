<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<div class="panel-header bg-primary-gradient">
	<div class="page-inner py-5">
		<div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
			<div>
				<h2 class="text-white pb-2 fw-bold"><?= strtoupper($title) ?></h2>
				<h5 class="text-white op-7 mb-2"><?= $desc ?></h5>
			</div>
			<div class="ml-md-auto py-2 py-md-0">
				<?php if ($title == 'Home') : ?>
					<a href="javascript:void(0)" class="btn btn-white btn-border btn-round mr-2">Start Now</a>
				<?php endif ?>
			</div>
		</div>
	</div>
</div>
