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
							<!-- <a class="nav-link active show" data-toggle="tab" href="#article">Article
								<span class="count ml-1">(<?= count($this->db->get_where('komponen', ['status' => 1])->result_array()) ?>)</span>
							</a>
							<a class="nav-link mr-5" data-toggle="tab" href="#draft">Draft
								<span class="count ml-1">(<?= count($this->db->get_where('komponen', ['status' => 0])->result_array()) ?>)</span>
							</a> -->
						</div>
					</div>
				</div>
				<!-- <div class="page-inner"> -->
				<div class="page-inner">
					<!-- Content -->
					<div class="row">
						<div class="col-md-12">
							<div class="tab-content mb-3" id="pills-tabContent">
								<div class="tab-pane fade show active" id="article" role="tabpanel" aria-labelledby="pills-home-tab-nobd">
									<div class="mt-1 float-right">
										<a href="<?= base_url('dashboard/komponen/tambah') ?>" target="_blank" rel="noopener noreferrer"><button class="btn btn-sm btn-default" href="">Tambah Komponen</button></a>
									</div>
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