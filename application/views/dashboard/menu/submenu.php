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
		<!-- <div class="row"> -->
		<!-- vardump section -->
		<!-- <div class="col-12"> -->
		<!-- Default box -->
		<!-- <div class="card">
					<div class="card-header">
						<h3 class="card-title">Vardump</h3>
						<div class="card-tools">
							<button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
								<i class="fas fa-minus"></i></button>
						</div>
					</div>
					<div class="card-body">
						<?= var_dump($userman) ?>
					</div> -->
		<!-- /.card-body -->
		<!-- </div> -->
		<!-- /.card -->
		<!-- </div> -->
		<!-- </div> -->
		<div class="row">
			<div class="col-12">
				<!-- Default box -->
				<div class="card">
					<div class="card-header">
						<h3 class="card-title">Sub Menu List</h3>

						<div class="card-tools">
							<a href="" type="button" class="btn btn-sm btn-outline-primary subMenuAdd" data-toggle="modal" data-target="#addSubMenuModal">Add Sub Menu</a>
							<button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
								<i class="fas fa-minus"></i></button>
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
						<?= $this->session->flashdata('notif'); ?>
						<table class="table table-bordered table-hover" id="example1">
							<thead>
								<tr class="text-center">
									<th style="width: 1%">
										#
									</th>
									<th style="width: 20%">
										Title
									</th>
									<th style="width: 20%">
										Menu
									</th>
									<th style="width: 15%">
										Url
									</th>
									<th style="width: 15%">
										Icon
									</th>
									<th style="width: 5%">
										Status
									</th>
									<th style="width: 10%">
										Action
									</th>
								</tr>
							</thead>
							<tbody>
								<?php $i = 1; ?>
								<?php foreach ($subMenu as $sbmn) : ?>
									<tr>
										<td class="text-center"><?= $i; ?></td>
										<td><?= $sbmn['title'] ?></td>
										<td><?= $sbmn['menu'] ?></td>
										<td><?= $sbmn['url'] ?></td>
										<td><?= $sbmn['icon'] ?></td>
										<td class="project-state text-center">
											<?php if ($sbmn['is_active'] == '1') : ?>
												<span class="badge badge-success">Active</span>
											<?php else : ?>
												<span class="badge badge-secondary">Disable</span>
											<?php endif ?>
										</td>
										<td class="project-actions text-right">
											<a class="btn btn-info btn-sm subMenuEdit" href="#" type="button" data-toggle="modal" data-target="#addSubMenuModal" data-submenuid="<?= $sbmn['id']; ?>">
												<i class="fas fa-fw fa-cog">
												</i>
												Config
											</a>
											<a class="btn btn-danger btn-sm" href="<?= base_url('dashboard/menu/remove/') . $sbmn['id']; ?>">
												<i class="fas fa-trash">
												</i>
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
	<div class="modal fade" id="addSubMenuModal" tabindex="-1" role="dialog" aria-labelledby="addMenuModal" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="addSubMenuModalTitle">Add New Sub Menu</h5>
					<button class="close" type="button" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
				</div>
				<form action="<?= base_url('dashboard/menu/subMenu'); ?>" method="POST">
					<div class="modal-body">
						<div class="form-group">
							<input type="hidden" class="form-control" id="idsubmenu" name="idsubmenu">
						</div>
						<div class="form-group">
							<input type="text" class="form-control" id="submenutitle" name="submenutitle" placeholder="Sub Menu Title">
						</div>
						<div class="form-group">
							<select name="menu_id" id="menu_id" class="form-control">
								<option value="">Select Menu</option>
								<?php foreach ($menu as $mn) : ?>
									<option value="<?= $mn['id'] ?>"><?= $mn['menu'] ?></option>
								<?php endforeach ?>
							</select>
						</div>
						<div class="form-group">
							<input type="text" class="form-control" id="submenuurl" name="submenuurl" placeholder="Sub Menu Url">
						</div>
						<div class="form-group">
							<input type="text" class="form-control" id="submenuicon" name="submenuicon" placeholder="Sub Menu Icon">
						</div>
						<div class="form-group">
							<div class="form-check">
								<input class="form-check-input" type="checkbox" value="1" name="is_active" id="is_active" checked>
								<?php if (validation_errors()) : ?>
								<?php endif; ?>

								<label class="form-check-label" for="is_active">
									Set this submenu active.
								</label>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
						<button class="btn btn-primary" type="submit">Add Sub Menu</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<!-- /.modal-section -->
</div>
<!-- /.content-wrapper -->
