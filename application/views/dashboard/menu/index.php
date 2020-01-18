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
		<div class="row">
			<div class="col-12">
				<!-- Default box -->
				<div class="card">
					<div class="card-header">
						<h3 class="card-title">Menu List</h3>

						<div class="card-tools">
							<a href="" type="button" class="btn btn-sm btn-outline-primary modalAddMenu" data-toggle="modal" data-target="#addMenuModal">Add Menu</a>
							<button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
								<i class="fas fa-minus"></i></button>
						</div>
					</div>
					<div class="card-body">
						<?= form_error(
							'menu',
							'<div class="alert alert-warning alert-dismissible fade show" role="alert">',
							'<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    		<span aria-hidden="true">&times;</span></button></div>'
						); ?>

						<?= $this->session->flashdata('notif'); ?>
						<table class="table table-bordered table-hover" id="example3">
							<thead>
								<tr>
									<th style="width: 1%">
										#
									</th>
									<th style="width: 75%">
										Role Name
									</th>
									<th style="width: 5%" class="text-center">
										Status
									</th>
									<th style="width: 15%">
									</th>
								</tr>
							</thead>
							<tbody>
								<?php $i = 1; ?>
								<?php foreach ($mainMenu as $mn) : ?>
									<tr>
										<td>
											<?= $i; ?>
										</td>
										<td>
											<?= $mn['menu']; ?>
										</td>
										<td class="project-state text-center">
											<?php if ($mn['is_active'] == 1) : ?>
												<span class="badge badge-success">Active</span>
											<?php else : ?>
												<span class="badge badge-danger">Disable</span>
											<?php endif ?>
										</td>
										<td class="project-actions text-right">
											<a href="#" type="submit" data-toggle="modal" data-target="#addMenuModal" class="btn btn-sm btn-info modalEditMenu" data-menuid="<?= $mn['id']; ?>">
												<i class="fas fa-fw fa-pencil-alt"></i>
												Edit
											</a>
											<a class="btn btn-danger btn-sm" type="button" href="<?= base_url('dashboard/menu/delete/') . $mn['id']; ?>">
												<i class="fas fa-trash"></i>
												Delete
											</a>
										</td>
									</tr>
									<?php $i++; ?>
								<?php endforeach ?>
							</tbody>
						</table>
					</div>
					<!-- /.card-body -->
				</div>
				<!-- /.card -->
			</div>
		</div>
	</section>
	<!-- /.content -->
	<!-- modal-section -->
	<div class="modal fade" id="addMenuModal" tabindex="-1" role="dialog" aria-labelledby="addMenuModal" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="menuModalTitle">Add New Menu</h5>
					<button class="close" type="button" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
				</div>
				<form action="<?= base_url('dashboard/menu'); ?>" method="POST">
					<div class="modal-body">
						<div class="form-group">
							<input type="hidden" class="form-control" id="idmenu" name="idmenu">
						</div>
						<div class="form-group">
							<input type="text" class="form-control" id="menu" name="menu" placeholder="Menu name" value="">
						</div>
						<div class="form-group mt-2">
							<div class="form-check">
								<input class="form-check-input" type="checkbox" value="1" name="is_active" id="is_active" checked>
								<label class="form-check-label" for="is_active">
									Set this menu active.
								</label>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
						<button class="btn btn-primary" type="submit">Add Menu</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<!-- /.modal-section -->
</div>
<!-- /.content-wrapper -->
