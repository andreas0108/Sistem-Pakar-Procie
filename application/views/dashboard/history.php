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
				<!-- <div class="page-inner"> -->
				<div class="page-inner">
					<!-- Content -->
					<div class="row">
						<div class="col-md-12">
							<div class="tab-content mb-3" id="pills-tabContent">
								<div class="tab-pane fade show active" id="article" role="tabpanel" aria-labelledby="pills-home-tab-nobd">
									<a href="<?= base_url('Dashboard/History/statistik') ?>" class="btn btn-sm btn-primary float-right"><i class="fas fa-chart-area mr-1"></i> Statistik</a>
									<div class="page-header">
										<h4 class="page-title"><?= $title ?></h4>
										<ul class="breadcrumbs">
											<?php $this->load->view('_parts/breadcrumb'); ?>
										</ul>
									</div>
									<div class="card">
										<div class="card-body">
											<div class="table-responsive">
												<table id="table-komponen" class="display table table-bordered table-striped table-hover table-head-bg-primary" cellspacing="0" width="100%">
													<thead>
														<tr class="text-center">
															<th scope="col" style="width:15%">ID</th>
															<th scope="col" style="width:15%">Pengguna</th>
															<th scope="col" style="width:15%">Email</th>
															<th scope="col" style="width:40%">Hasil</th>
															<th scope="col" style="width:15%">Tanggal Data</th>
														</tr>
													</thead>
													<tbody>
														<?php
														$i = 1;
														foreach ($history as $h) : ?>
															<tr>
																<td>
																	<p class="card-text mb-0"><?= $h['id'] ?></p>
																</td>
																<td>
																	<p class="card-text mb-0"><?= $h['user_name'] ?></p>
																</td>
																<td>
																	<p class="card-text mb-0"><?= $h['email'] ?></p>
																</td>
																<td>
																	<p class="card-text mb-0"><?= $h['hasil'] ?></p>
																</td>
																<td>
																	<p class="card-text mb-0">
																		<?php
																		$tmp = strtotime(substr($h['id'], 0, 4) . '/' . substr($h['id'], 4, 2) . '/' . substr($h['id'], 6, 2));
																		echo unix_indo2($tmp, 'htg');
																		?>
																	</p>
																</td>
															</tr>
														<?php endforeach ?>
													</tbody>
												</table>
											</div>
										</div>
									</div>
								</div>
								<!-- <div class="tab-pane fade" id="draft" role="tabpanel" aria-labelledby="pills-profile-tab-nobd">
									<div class="page-header">
										<h4 class="page-title">Draft List</h4>
									</div>
									<div class="card">
										<div class="card-body">
											<div class="table-responsive">
												<table id="table-articled" class="display table table-striped table-hover table-head-bg-primary" cellspacing="0" width="100%">
													<thead>
														<tr class="text-center">
															<th scope="col" style="width:5%">#</th>
															<th scope="col">Article</th>
															<th scope="col" style="width:25%">Tanggal Terbit</th>
															<th scope="col" style="width:5%"></th>
														</tr>
													</thead>
													<tbody>
														<?php
														$i = 1;
														foreach ($artid as $a) : ?>
															<tr>
																<td>
																	<?= $i++ ?>
																</td>
																<td>
																	<p class="card-text mb-0"><?= $a['judul'] ?></p>
																	<small class="card-subtitle text-muted mb-1">Penulis : <?= $a['penulis'] ?></h6>
																</td>
																<td style="text-align: right">
																	<p class="card-text"><?= unix_indo2($a['tgl_buat'], 'tgl') ?></p>
																</td>
																<td>
																	<div class="btn-group float-right" role="group" aria-label="Basic example">
																		<a href="javascript:void(0)" title="ubah artikel" type="button" class="btn btn-sm btn-info"><i style="color: white" class="fa fa-pen"></i></a>
																		<a href="<?= base_url('dashboard/article/hapus/') . $a['id']; ?>" title="hapus artikel" type="button" class="btn btn-sm btn-danger btn-remove" data-text="Artikel"><i style="color: white" class="fa fa-trash"></i></a>
																	</div>
																</td>
															</tr>
														<?php endforeach ?>
													</tbody>
												</table>
											</div>
										</div>
									</div>
								</div> -->
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