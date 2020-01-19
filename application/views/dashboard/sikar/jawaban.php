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
					<a href="javascript:void(0)" type="button" class="btn btn-sm btn-outline-primary" id="add<?= $title3 ?>" data-toggle="modal" data-target="#modal<?= $title3 ?>">Add <?= $title3 ?></a>
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
							<th style="width: 2%">
								#
							</th>
							<th style="width: 5%">
								ID
							</th>
							<th style="width: 70%">
								Pertanyaan
							</th>
							<th style="width: 10%">
								Status
							</th>
							<th style="width: 13%">

							</th>
						</tr>
					</thead>
					<tbody>
						<?php $num = 1; ?>
						<?php foreach ($jawab as $jw) : ?>
							<tr>
								<td>
									<?= $num ?>
								</td>
								<td>
									<?= $jw['id'] ?>
								</td>
								<td>
									<?= $jw['jawaban_content'] ?>
								</td>
								<td class="text-center">
									<?php if ($jw['status'] == 1) {
										echo 	'<div class="alert alert-success" role="alert">
													Enable
												</div>';
									} else {
										echo 	'<div class="alert alert-danger" role="alert">
													Disable
												</div>';
									}
									?>
								</td>
								<td class="project-actions text-right">
									<button class="btn btn-group">
										<a class="btn btn-info btn-sm ubah<?= $title3 ?>" href="#" id="ubah<?= $title3 ?>" data-toggle="modal" data-target="#modal<?= $title3 ?>" data-jwid="<?= $jw['id'] ?>" title="Edit">
											<i class="fas fa-fw fa-pencil-alt">
											</i>
										</a>
										<a class="btn btn-danger btn-sm btn-remove" href="<?= base_url('dashboard/sikar/deleteJ/') . $jw['id']; ?>" data-text="<?= $title3 ?>" title="Remove">
											<i class="fas fa-fw fa-trash">
											</i>
										</a>
									</button>
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
