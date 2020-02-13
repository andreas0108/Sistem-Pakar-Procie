<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<!DOCTYPE html>
<html lang="en">


<head>
	<?php $this->load->view('_parts/head'); ?>
</head>

<body>
	<div class="flash-data" data-flashdata="<?= $this->session->flashdata('flashmsg'); ?>"></div>
	<div class="flash-err" data-flasherror="<?= $this->session->flashdata('flasherr'); ?>"></div>
	<div class="wrapper sidebar_minimize">
		<!-- Header -->
		<div class="main-header">
			<!-- Logo -->
			<div class="logo-header" data-background-color="white">
				<?php $this->load->view('_parts/header'); ?>
			</div>
			<!-- ./Logo -->

			<!-- Navbar -->
			<nav class="navbar navbar-header navbar-expand-lg" data-background-color="blue2">
				<?php $this->load->view('_parts/navbar'); ?>
			</nav>
			<!-- ./Navbar -->
		</div>
		<!-- Sidebar -->
		<div class="sidebar sidebar-style-2">
			<?php $this->load->view('_parts/sidebar'); ?>
		</div>
		<!-- ./Sidebar -->

		<!-- Content -->
		<div class="main-panel">
			<!-- Main Container -->

			<div class="container">
				<div class="page-inner">
					<!-- <div class="page-inner"> -->
					<button href="javascript:void(0)" class="btn btn-sm btn-info float-right" id="tambahPertanyaan" data-toggle="modal" data-target="#modalPertanyaan">Tambah Pertanyaan</button>
					<div class="page-header">
						<h4 class="page-title"><?= strtoupper($title) ?></h4>
						<ul class="breadcrumbs">
							<?php $this->load->view('_parts/breadcrumb'); ?>
						</ul>
					</div>
					<div class="card">
						<div class="card-body">
							<div class="table-responsive">
								<table id="table-komponen" class="display table table-striped table-hover table-head-bg-primary" cellspacing="0" width="100%">
									<thead>
										<tr class="text-center">
											<th scope="col" style="width:10%">ID</th>
											<th scope="col" style="width:70%">Pertanyaan</th>
											<th scope="col" style="width:15%">Status</th>
											<th scope="col" style="width:5%"></th>
										</tr>
									</thead>
									<tbody>
										<?php foreach ($pert as $p) : ?>
											<tr>
												<td>
													<p class="card-text mb-0 text-center"><?= $p['id'] ?></p>
												</td>
												<td>
													<p class="card-text mb-0"><?= $p['pertanyaan_content'] ?></p>
												</td>
												<td class="text-center">
													<p class="card-text mb-0"><?= $p['status'] == 1 ? 'Enable' : 'Disable' ?></p>
												</td>
												<td>
													<div class="btn-group float-right" role="group" aria-label="Basic example">
														<a href="#" title="ubah pertanyaan" data-pertid="<?= $p['id'] ?>" type="button" class="btn btn-sm btn-info ubahPertanyaan" data-toggle="modal" data-target="#modalPertanyaan"><i style="color: white" class="fa fa-pen"></i></a>
														<a href="<?= base_url('dashboard/pertanyaan/hapus/') . $p['id']; ?>" title="hapus pertanyaan" type="button" class="btn btn-sm btn-danger btn-remove" data-text="Pertanyaan"><i style="color: white" class="fa fa-trash"></i></a>
													</div>
												</td>
											</tr>
										<?php endforeach ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- ./Main Container -->

			<!-- Footer -->
			<footer class="footer">
				<?php $this->load->view('_parts/footer'); ?>
			</footer>
			<!-- ./Footer -->

			<!-- Optional -->

			<!-- ./Optional -->

		</div>
		<!-- ./Content -->
	</div>

	<!-- JS Files   -->
	<?php $this->load->view('_parts/js'); ?>
	<?php $this->load->view('js/js-pertanyaan'); ?>
	<!-- ./JS Files -->

	<!-- Modal -->
	<div class="modal fade" id="modalPertanyaan" tabindex="-1" role="dialog" aria-labelledby="modalPertanyaanCenter" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h3 class="modal-title" id="modalPertanyaanTitle">Tambah Pertanyaan</h3>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<form action="<?= base_url('dashboard/pertanyaan') ?>" method="POST">
					<div class="modal-body">
						<div class="form-group">
							<label for="squareInput">Pertanyaan</label>
							<input type="text" name="pertanyaan" id="pertanyaan" class="form-control input-square" required>
						</div>

						<div class="form-group">
							<label for="squareSelect">Status</label>
							<select class="form-control input-square" name="status" id="status" required>
								<option value="">Pilih</option>
								<option value="0">Disable</option>
								<option value="1">Enable</option>
							</select>
						</div>
						<div class="form-group float-right">
							<input type="hidden" name="id" id="idPertanyaan" value="">
							<button type="reset" class="btn btn-sm btn-secondary">Reset</button>
							<button type="submit" class="btn btn-sm btn-primary">Simpan</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
	<!-- ./Modal -->

</body>

</html>
