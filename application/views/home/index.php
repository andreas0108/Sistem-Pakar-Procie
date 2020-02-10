<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<!DOCTYPE html>
<html lang="en">


<head>
	<?php $this->load->view('_parts/head'); ?>
</head>

<body>
	<div class="wrapper sidebar_minimize">
		<div class="flash-data" data-flashdata="<?= $this->session->flashdata('flashmsg'); ?>"></div>
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
				<?php $this->load->view('_parts/panel-header'); ?>
				<div class="page-inner mt--5">
					<!-- <div class="page-inner"> -->
					<div class="row">
						<div class="col-md-12">
							<div class="row">
								<div class="col-sm-6 col-md-3">
									<div class="card card-stats card-primary card-round">
										<div class="card-body">
											<div class="row" title="Jumlah Pengguna yang pernah berkonsultasi">
												<div class="col-5">
													<div class="icon-big text-center">
														<i class="flaticon-graph"></i>
													</div>
												</div>
												<div class="col-7 col-stats">
													<div class="numbers">
														<p class="card-category">Jumlah Konsultasi</p>
														<h4 class="card-title"><?= count($this->db->get('history')->result_array()) ?></h4>
													</div>
												</div>
											</div>
											<hr style="border-color:white">
											<a href="<?= base_url('dashboard/history') ?>" target="_blank" rel="noopener noreferrer" style="text-decoration: none" class=" p-0">
												<div class=" row text-center">
													<div class="col" style="margin: -1rem 0 -1rem 0;">
														<p class="card-category">More Info.</p>
													</div>
												</div>
											</a>
										</div>
									</div>
								</div>
								<div class="col-sm-6 col-md-3">
									<div class="card card-stats card-info card-round">
										<div class="card-body">
											<div class="row" title="Jumlah Feedback dari Pengguna yang pernah berkonsultasi">
												<div class="col-5">
													<div class="icon-big text-center">
														<i class="flaticon-chat-8"></i>
													</div>
												</div>
												<div class="col-7 col-stats">
													<div class="numbers">
														<p class="card-category">Feedback</p>
														<h4 class="card-title"><?= count($this->db->get('feedback')->result_array()) ?></h4>
													</div>
												</div>
											</div>
											<hr style="border-color:white">
											<a href="javascript:void(0)" target="_blank" rel="noopener noreferrer" style="text-decoration: none" class=" p-0">
												<div class=" row text-center">
													<div class="col" style="margin: -1rem 0 -1rem 0;">
														<p class="card-category">More Info.</p>
													</div>
												</div>
											</a>
										</div>
									</div>
								</div>
								<div class="col-sm-6 col-md-3">
									<div class="card card-stats card-success card-round">
										<div class="card-body">
											<div class="row" title="Artikel diterbitkan : <?= count($this->db->get_where('article', ['status' => 1])->result_array()) ?>, Draft : <?= count($this->db->get_where('article', ['status' => 0])->result_array()) ?>">
												<div class="col-5">
													<div class="icon-big text-center">
														<i class="flaticon-web"></i>
													</div>
												</div>
												<div class="col-7 col-stats">
													<div class="numbers">
														<p class="card-category">Article</p>
														<h4 class="card-title"><?= count($this->db->get_where('article', ['status' => 1])->result_array()) ?></h4>
													</div>
												</div>
											</div>
											<hr style="border-color:white">
											<a href="<?= base_url('article') ?>" target="_blank" rel="noopener noreferrer" style="text-decoration: none" class=" p-0">
												<div class=" row text-center">
													<div class="col" style="margin: -1rem 0 -1rem 0;">
														<p class="card-category">More Info.</p>
													</div>
												</div>
											</a>
										</div>
									</div>
								</div>
								<div class="col-sm-6 col-md-3">
									<div class="card card-stats card-warning card-round">
										<div class="card-body">
											<div class="row" title="Tanggal terakhir update dari system. Baik komponen, rules, pertanyaan, dan jawaban">
												<div class="col-5">
													<div class="icon-big text-center">
														<i class="flaticon-database"></i>
													</div>
												</div>
												<div class="col-7 col-stats" style="color: white">
													<div class="numbers">
														<p class="card-category">Versi Database</p>
														<h4 class="card-title">
															<?php
															$this->db->order_by('tgl_data', 'DESC')->limit(1);
															$x = $this->db->get('log')->row_array();
															?>

															<?= $x == '' || null ? 'Loading Failed...' : unix_indoshort($x['tgl_data'] + (7 * 3600)) ?>
														</h4>
													</div>
												</div>
											</div>
											<hr style="border-color: white">
											<a href="<?= base_url('dashboard/log') ?>" target="_blank" rel="noopener noreferrer" style="text-decoration: none" class=" p-0">
												<div class=" row text-center">
													<div class="col" style="margin: -1rem 0 -1rem 0;">
														<p class="card-category">More Info.</p>
													</div>
												</div>
											</a>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-6 col-md-3">
									<div class="card card-stats card-black card-round">
										<div class="card-body">
											<div class="row" title="Jumlah Komponen yang ditambahkan ke system">
												<div class="col-5">
													<div class="icon-big text-center">
														<i class="flaticon-box-2"></i>
													</div>
												</div>
												<div class="col-7 col-stats">
													<div class="numbers">
														<p class="card-category">Komponen</p>
														<h4 class="card-title"><?= count($this->db->get('komponen')->result_array()) ?></h4>
													</div>
												</div>
											</div>
											<hr style="border-color:white">
											<a href="<?= base_url('dashboard/komponen') ?>" target="_blank" rel="noopener noreferrer" style="text-decoration: none" class=" p-0">
												<div class=" row text-center">
													<div class="col" style="margin: -1rem 0 -1rem 0;">
														<p class="card-category">More Info.</p>
													</div>
												</div>
											</a>
										</div>
									</div>
								</div>
								<div class="col-sm-6 col-md-3">
									<div class="card card-stats card-danger card-round">
										<div class="card-body">
											<div class="row" title="Jumlah Rules Sistem Pakar yang diatur">
												<div class="col-5">
													<div class="icon-big text-center">
														<i class="flaticon-interface-4"></i>
													</div>
												</div>
												<div class="col-7 col-stats">
													<div class="numbers">
														<p class="card-category">Rules</p>
														<h4 class="card-title">
															<?php $this->db->select('komponen_id')->group_by('komponen_id');
															$x = $this->db->get('rules')->result_array() ?>

															<?= count($x); ?>
														</h4>
													</div>
												</div>
											</div>
											<hr style="border-color:white">
											<a href="<?= base_url('dashboard/rules') ?>" target="_blank" rel="noopener noreferrer" style="text-decoration: none" class=" p-0">
												<div class=" row text-center">
													<div class="col" style="margin: -1rem 0 -1rem 0;">
														<p class="card-category">More Info.</p>
													</div>
												</div>
											</a>
										</div>
									</div>
								</div>
								<div class="col-sm-6 col-md-3">
									<div class="card card-stats card-secondary card-round">
										<div class="card-body">
											<div class="row" title="Jumlah Pertanyaan yang diatur untuk Sistem Pakar">
												<div class="col-5">
													<div class="icon-big text-center">
														<i class="flaticon-chat-3"></i>
													</div>
												</div>
												<div class="col-7 col-stats">
													<div class="numbers">
														<p class="card-category">Pertanyaan</p>
														<h4 class="card-title"><?= count($this->db->get('pertanyaan')->result_array()) ?></h4>
													</div>
												</div>
											</div>
											<hr style="border-color:white">
											<a href="<?= base_url('dashboard/pertanyaan') ?>" target="_blank" rel="noopener noreferrer" style="text-decoration: none" class=" p-0">
												<div class=" row text-center">
													<div class="col" style="margin: -1rem 0 -1rem 0;">
														<p class="card-category">More Info.</p>
													</div>
												</div>
											</a>
										</div>
									</div>
								</div>
								<div class="col-sm-6 col-md-3">
									<div class="card card-stats card-round">
										<div class="card-body">
											<div class="row" title="Jumlah Jawaban yang terdapat di dalam Sistem Pakar">
												<div class="col-5">
													<div class="icon-big text-center">
														<i class="flaticon-chat-2"></i>
													</div>
												</div>
												<div class="col-7 col-stats">
													<div class="numbers">
														<p class="card-category">Jawaban</p>
														<h4 class="card-title">
															<?php $this->db->select('pertanyaan_id')->group_by('pertanyaan_id');
															$x = $this->db->get('jawaban')->result_array() ?>

															<?= count($x); ?>
														</h4>
													</div>
												</div>
											</div>
											<hr>
											<a href="<?= base_url('dashboard/jawaban') ?>" target="_blank" rel="noopener noreferrer" style="text-decoration: none" class=" p-0">
												<div class=" row text-center">
													<div class="col" style="margin: -1rem 0 -1rem 0;">
														<p class="card-category">More Info.</p>
													</div>
												</div>
											</a>
										</div>
									</div>
								</div>
							</div>
							<hr class="mt-0 mb-2 pt-0 pb-3" style="border-color: #1572E8; border-width: 2px;">
							<div class="row">
								<div class="col-lg-6 col-md-6 col-sm-12">
									<div class="card card-primary">
										<div class="card-header">
											<div class="card-title">Statistik Pengguna</div>
											<div class="float-right">
												<h1><?= $statsper ?></h1>
											</div>
											<div class="card-category">
												<p>Konsultasi hari ini (<?= gmdate('d-m-Y', time()) ?>) : </p>
												<h4 class="mb-4"><?= $statscnt ?> konsultasi</h4>
											</div>
										</div>
										<div class="card-body pt-1 pb-0">
											<div class="pull-in">
												<canvas id="dailySalesChart" class="chartjs-render-monitor" style="display: block; height: 28vh; width: 100%;padding-top: 5px;" data-label="<?= '[' . arrtostr(array_reverse($this->Simo->jsonlabelHasil())) . ']' ?>" data-jumlah="<?= '[' . arrtostr(array_reverse($this->Simo->jsonCountHasil())) . ']' ?>"></canvas>
											</div>
										</div>
									</div>
								</div>
								<div class="col-lg-3 col-md-3 col-sm-6">
									<div class="card full-height">
										<div class="card-header">
											History
										</div>
										<div class="card-body mb-0 pb-0">
											<?php foreach ($history as $h) : ?>
												<div class="d-flex">
													<div class="flex-1">
														<small class="text-info pl-1 float-right">
															ID : <?= $h['id'] ?>
														</small>
														<h6 class="fw-bold mb-1" title="<?= $h['email'] ?>">
															<?= ucfirst($h['user_name']) ?>
														</h6>
														<span class="text-muted" title="<?= $h['hasil'] ?>">
															<b>Hasil : </b><?= substr($h['hasil'], 0, 15) ?>...
														</span>
													</div>
												</div>
												<div class="separator-dashed"></div>
											<?php endforeach ?>
										</div>
										<div class="card-footer">
											<a href="#" class="btn btn-sm btn-primary btn-fill" style="width: 100%; bottom:0px;">Lihat Log</a>
										</div>
									</div>
								</div>
								<div class="col-lg-3 col-md-3 col-sm-6">
									<div class="card full-height">
										<div class="card-header">
											System Logs
										</div>
										<div class="card-body mb-0 pb-0">
											<?php foreach ($log as $l) : ?>
												<div class="d-flex">
													<div class="flex-1">
														<small class="ml-1 float-right" title="<?= gmdate('d-M-Y H:i:s', ($l['tgl_data'] + (7 * 3600))) . ' WIB' ?>">
															<?= unix_indo2($l['tgl_data'], 'tgl') ?>
														</small>
														<h6 class="fw-bold mb-1">
															<?= ucfirst($l['user']) ?>
														</h6>
														<div class="text-muted" title="<?= $l['keterangan'] ?>">
															<span>
																<?= substr($l['keterangan'], 0, 36) ?>...
															</span>
														</div>
													</div>
												</div>
												<div class="separator-dashed"></div>
											<?php endforeach ?>
										</div>
										<div class="card-footer">
											<a href="#" class="btn btn-sm btn-primary btn-fill" style="width: 100%">Lihat Log</a>
										</div>
									</div>
								</div>
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
	<script>
		const Toast = Swal.mixin({
			toast: true,
			position: 'top-right',
			showConfirmButton: false,
			timer: 3000,
			onOpen: (toast) => {
				toast.addEventListener('mouseenter', Swal.stopTimer)
				toast.addEventListener('mouseleave', Swal.resumeTimer)
			}
		})

		Toast.fire({
			icon: 'success',
			html: '<div style="margin-left:5px; text-align:left">' +
				'<b>Berhasil</b><br>' +
				'Selamat datang <?= $user['name'] ?>' +
				'</div>',
		})
	</script>
	<!-- ./JS Files -->
</body>

</html>
