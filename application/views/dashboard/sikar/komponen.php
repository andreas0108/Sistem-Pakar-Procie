<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1><?= $title3 ?></h1>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="#"><?= $title2 ?></a></li>
						<li class="breadcrumb-item active"><?= $title3 ?></li>
					</ol>
				</div>
			</div>
		</div><!-- /.container-fluid -->
	</section>

	<!-- Main content -->
	<section class="content">

		<!-- Default box -->
		<div class="card">
			<div class="card-header">
				<h3 class="card-title"><?= $title3 ?></h3>

				<div class="card-tools">
					<a href="javascript:void(0)" type="button" class="btn btn-sm btn-outline-primary addKomponen" id="addKomponen" data-toggle="modal" data-target="#modalKomponen">Add <?= $title3 ?></a>
					<button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
						<i class="fas fa-minus"></i>
					</button>
				</div>
			</div>
			<div class="card-body">
				<?php if (validation_errors()) : ?>
					<div class="alert alert-danger alert-dismissible fade show" role="alert">
						<?= validation_errors() ?>
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span></button>
					</div>
				<?php endif; ?>

				<div class="flash-data" data-flashdata="<?= $this->session->flashdata('flashmsg'); ?>"></div>

				<table class="table table-bordered table-hover" id="tablekomponen">
					<thead>
						<tr class="text-center">
							<th style="width: 5%">
								#
							</th>
							<th>
								Name
							</th>
							<th>
								Manufacture
							</th>
							<th>
								Category
							</th>
							<th style="width: 30%">
								Description
							</th>
							<th style="width: 10%">
								Price
							</th>
							<th style="width: auto">
								Status
							</th>
							<th style="width: auto">

							</th>
						</tr>
					</thead>
					<tbody>
						<?php $num = 1; ?>
						<?php foreach ($komponen as $kom) : ?>
							<tr>
								<td>
									<?= $num ?>
								</td>
								<td>
									<?= $kom['name'] ?>
								</td>
								<td>
									<?php if ($kom['manufacture'] == 1) {
										echo "AMD";
									} else {
										echo "Intel";
									}
									?>
								</td>
								<td>
									<?= $kom['kategori'] ?>
								</td>
								<td>
									<?= $kom['desc'] ?>
								</td>
								<td>
									<?= "Rp. " . number_format($kom['price'], "0", "", ".") ?>
								</td>
								<td class="text-center">
									<?php if ($kom['status'] == 1) {
										echo 	'<div class="alert alert-success" role="alert">
													Integrated to System
												</div>';
									} else {
										echo 	'<div class="alert alert-danger" role="alert">
													Not Integrated to System
												</div>';
									}
									?>
								</td>
								<td class="project-actions text-right">
									<a class="btn btn-info btn-sm ubahKomponen" href="#" id="ubahKomponen" data-toggle="modal" data-target="#modalKomponen" data-komponenid="<?= $kom['id'] ?>">
										<i class="fas fa-fw fa-eye">
										</i>
										Config
									</a>
									<a class="btn btn-danger btn-sm btn-remove" href="<?= base_url('dashboard/sikar/deleteK/') . $kom['id']; ?>" data-text="<?= $title3 ?>">
										<i class="fas fa-trash">
										</i>
										Delete
									</a>
								</td>
							</tr>
						<?php $num++;
						endforeach ?>
					</tbody>
				</table>
			</div>
		</div>
		<!-- /.card -->

	</section>
	<!-- /.content -->
</div>
<!-- /.content-wrapper -->
