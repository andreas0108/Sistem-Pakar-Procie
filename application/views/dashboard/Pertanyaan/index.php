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
					<button type="button" href="javascript:void(0)" class="btn btn-sm btn-default float-right">Tambah Pertanyaan</button>
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
											<th scope="col" style="width:5%">#</th>
											<th scope="col" style="width:75%">Pertanyaan</th>
											<th scope="col" style="width:15%">Status</th>
											<th scope="col" style="width:5%"></th>
										</tr>
									</thead>
									<tbody>
										<?php
										// var_dump($pert);
										// die;
										foreach ($pert as $p) : ?>
											<tr>
												<td>
													<p class="card-text mb-0"><?= $p['id'] ?></p>
												</td>
												<td>
													<p class="card-text mb-0"><?= $p['pertanyaan_content'] ?></p>
												</td>
												<td class="text-center">
													<p class="card-text mb-0"><?= $p['status'] == 1 ? 'Enable' : 'Disable' ?></p>
												</td>
												<td>
													<div class="btn-group float-right" role="group" aria-label="Basic example">
														<a href="<?= base_url('dashboard/pertanyaan/ubah/') . $p['id']; ?>" title="update pertanyaan" type="button" class="btn btn-sm btn-info"><i style="color: white" class="fa fa-pen"></i></a>
														<a href="<?= base_url('dashboard/pertanyaan/tampil/') . $p['id']; ?>" title="lihat pertanyaan" type="button" class="btn btn-sm btn-success" target="_blank"><i style="color: white" class="fa fa-eye"></i></a>
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

	<!-- Modal -->
	<!-- assd -->
	<!-- ./Modal -->

	<!-- JS Files   -->
	<?php $this->load->view('_parts/js'); ?>
	<!-- ./JS Files -->
</body>

</html>
