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
				<div class="page-navs bg-white">
					<div class="nav-scroller">
						<div class="nav nav-tabs nav-line nav-color-primary d-flex align-items-center justify-contents-center w-100">
							<a class="nav-link active show" data-toggle="tab" href="#article">Artikel
								<span class="count ml-1">(<?= count($artip) ?>)</span>
							</a>
							<a class="nav-link mr-5" data-toggle="tab" href="#draft">Draft
								<span class="count ml-1">(<?= count($artid) ?>)</span>
							</a>
							<div class="ml-auto">
								<ul class="breadcrumbs">
									<?php $this->load->view('_parts/breadcrumb'); ?>
								</ul>
							</div>
						</div>
					</div>
				</div>
				<!-- <div class="page-inner"> -->
				<div class="page-inner">
					<!-- Content -->
					<div class="row">
						<div class="col-md-12">
							<div class="tab-content mb-3" id="pills-tabContent">
								<div class="tab-pane fade show active" id="article" role="tabpanel" aria-labelledby="pills-article-tab-nobd">
									<div class="float-right">
										<a type="button" href="<?= base_url('Dashboard/Article/hapus_semua') ?>" class="btn btn-sm btn-danger btn-remove" data-text="Semua artikel"><i class="fas fa-fw fa-trash mr-1"></i>Hapus Semua</a>
										<a href="<?= base_url('Dashboard/Article/tambah') ?>" target="_blank" rel="noopener noreferrer"><button class="btn btn-sm btn-info" href=""><i class="fas fa-fw fa-plus-circle mr-1"></i>Tambah Artikel</button></a>
									</div>
									<div class="page-header">
										<h4 class="page-title">Daftar Artikel</h4>
									</div>
									<div class="card">
										<div class="card-body">
											<div class="table-responsive">
												<table id="table-articlep" class="display table table-striped table-hover table-head-bg-primary" cellspacing="0" width="100%">
													<thead>
														<tr class="text-center">
															<th scope="col" style="width:5%">#</th>
															<th scope="col">Judul Artikel</th>
															<th scope="col" style="width: 25%">Tanggal Terbit</th>
															<th scope="col" style="width: 5%"></th>
														</tr>
													</thead>
													<tbody>
														<?php
														$i = 1;
														foreach ($artip as $a) : ?>
															<tr>
																<td>
																	<?= $i++ ?>
																</td>
																<td>
																	<p class="card-text mb-0"><a href="<?= base_url('blog/read/') . $a['slug'] ?>" target="_blank" rel="noopener noreferrer"><?= $a['judul'] ?></a></p>
																	<small class="card-subtitle text-muted mb-1">Penulis : <?= $a['penulis'] ?></h6>
																</td>
																<td style="text-align: right">
																	<p class="card-text"><?= unix_indo2($a['tgl_buat'], 'tgl') ?></p>
																</td>
																<td>
																	<div class="btn-group float-right" role="group" aria-label="Basic example">
																		<a href="<?= base_url('Dashboard/Article/ubah/') . $a['id']; ?>" title="ubah artikel" type="button" class="btn btn-sm btn-info"><i style="color: white" class="fa fa-pen"></i></a>
																		<a href="<?= base_url('Dashboard/Article/hapus/') . $a['id']; ?>" title="hapus artikel" type="button" class="btn btn-sm btn-danger btn-remove" data-text="Artikel"><i style="color: white" class="fa fa-trash"></i></a>
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
								<div class="tab-pane fade" id="draft" role="tabpanel" aria-labelledby="pills-draft-tab-nobd">
									<div class="page-header">
										<h4 class="page-title">Daftar Draft Artikel</h4>
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
																		<a href="<?= base_url('Dashboard/Article/ubah/') . $a['id']; ?>" title="ubah artikel" type="button" class="btn btn-sm btn-info"><i style="color: white" class="fa fa-pen"></i></a>
																		<a href="<?= base_url('Dashboard/Article/hapus/') . $a['id']; ?>" title="hapus artikel" type="button" class="btn btn-sm btn-danger btn-remove" data-text="Artikel"><i style="color: white" class="fa fa-trash"></i></a>
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
	<?php $this->load->view('js/js-article'); ?>
	<!-- ./JS Files -->
</body>

</html>