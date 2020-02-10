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
					<!-- Content -->
					<!-- <div class="page-inner"> -->
					<a href="<?= base_url('dashboard/komponen/tambah') ?>" class="btn btn-sm btn-info float-right">Tambah Komponen</a>
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
											<th scope="col">Manufacture</th>
											<th scope="col">Kategori</th>
											<th scope="col">Nama Komponen</th>
											<th scope="col">Deskripsi</th>
											<th scope="col">Harga</th>
											<th scope="col">Ditambahkan</th>
											<th scope="col" style="width: 5%"></th>
										</tr>
									</thead>
									<tbody>
										<?php
										$i = 1;
										foreach ($kompo as $k) : ?>
											<tr>
												<td>
													<?= $i++ ?>
												</td>
												<td>
													<p class="card-text mb-0"><?= $k['manufacture'] == 1 ? 'AMD' : 'Intel' ?></p>
												</td>
												<td>
													<p class="card-text mb-0"><?= $k['kategori'] ?></p>
												</td>
												<td>
													<p class="card-text mb-0"><?= $k['name'] ?></p>
												</td>
												<td>
													<p class="card-text mb-0"><?= limit_word_regex($k['desc'], 5) ?>...</p>
												</td>
												<td>
													<p class="card-text mb-0"><?= "Rp " . number_format($k['price'], null, null, '.'); ?></p>
												</td>
												<td style="text-align: right">
													<p class="card-text"><?= unix_indo2($k['ditambahkan'], 'tgl') ?></p>
												</td>
												<td>
													<div class="btn-group float-right" role="group" aria-label="Basic example">
														<a href="<?= base_url('dashboard/komponen/ubah/') . $k['id']; ?>" title="update komponen" type="button" class="btn btn-sm btn-info"><i style="color: white" class="fa fa-pen"></i></a>
														<a href="<?= base_url('dashboard/komponen/tampil/') . $k['slug']; ?>" title="lihat komponen" type="button" class="btn btn-sm btn-success" target="_blank"><i style="color: white" class="fa fa-eye"></i></a>
														<a href="<?= base_url('dashboard/komponen/hapus/') . $k['id']; ?>" title="hapus komponen" type="button" class="btn btn-sm btn-danger btn-remove" data-text="Komponen"><i style="color: white" class="fa fa-trash"></i></a>
													</div>
												</td>
											</tr>
										<?php endforeach ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
					<!-- ./Content -->
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
	<?php $this->load->view('js/js-komponen'); ?>
	<!-- ./JS Files -->
</body>

</html>
