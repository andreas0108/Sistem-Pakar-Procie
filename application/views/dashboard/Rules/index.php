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
							<a class="nav-link active show" data-toggle="tab" href="#pertanyaan">Pertanyaan
								<span class="count ml-1">(<?= count($rulesp) ?>)</span>
							</a>
							<a class="nav-link mr-5" data-toggle="tab" href="#hasil">Hasil
								<span class="count ml-1">(<?= count($rulesd) ?>)</span>
							</a>
							<div class="ml-auto">
								<ul class="breadcrumbs">
									<?php $this->load->view('_parts/breadcrumb'); ?>
								</ul>
							</div>
						</div>
					</div>
				</div>
				<div class="page-inner">
					<div class="tab-content mb-3" id="pills-tabContent">
						<div class="tab-pane fade show active" id="pertanyaan" role="tabpanel" aria-labelledby="pills-Rules-tab-nobd">
							<!-- <div class="page-inner"> -->
							<button type="button" href="javascript:void(0)" class="btn btn-sm btn-info float-right" id="tambahRulesP" data-toggle="modal" data-target="#modalRulesP">Tambah Rules</button>
							<div class="page-header">
								<h4 class="page-title"><?= $title ?> Pertanyaan</h4>
							</div>
							<div class="card">
								<div class="card-body">
									<div class="table-responsive">
										<table class="table table-bordered table-hover table-head-bg-primary" cellspacing="0" width="100%">
											<thead>
												<tr class="text-center">
													<th scope="col" style="width: 5%">#</th>
													<th scope="col" style="width: 40%">Jawaban</th>
													<th scope="col" style="width: 5%">ID</th>
													<th scope="col" style="width: 45%">Pertanyaan Selanjutnya</th>
													<th scope="col" style="width: 5%"></th>
												</tr>
											</thead>
											<tbody>
												<?php
												$i = 1;
												foreach ($rulesp as $r) { ?>
													<tr>
														<td class="text-center"><?= $i++ ?></td>
														<td><?= $r['jawab'] ?></td>
														<td><?= $r['pid'] ?></td>
														<td><?= $r['next_pert'] ?></td>
														<td class="text-center">
															<div class="btn-group" role="group" aria-label="Basic example">
																<a href="#" title="ubah jawaban" data-id="<?= $r['rid'] ?>" type="button" class="btn btn-sm btn-info ubahRulesP" data-toggle="modal" data-target="#modalRulesP"><i style="color: white" class="fa fa-pen"></i></a>
																<a href="<?= base_url('dashboard/rules/hapusP/') . $r['rid']; ?>" title="hapus jawaban" type="button" class="btn btn-sm btn-danger btn-remove" data-text="Pertanyaan"><i style="color: white" class="fa fa-trash"></i></a>
															</div>
														</td>
													</tr>
												<?php } ?>
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
						<div class="tab-pane fade" id="hasil" role="tabpanel" aria-labelledby="pills-Pengetahuan-tab-nobd">
							<!-- <div class="page-inner"> -->
							<button type="button" href="javascript:void(0)" class="btn btn-sm btn-info float-right tambahRules" id="tambahRules" data-toggle="modal" data-target="#modalRules">Tambah Rules</button>
							<div class="page-header">
								<h4 class="page-title"><?= $title ?> Hasil</h4>
							</div>
							<div class="card">
								<div class="card-body">
									<div class="table-responsive">
										<table class="table table-bordered table-hover table-head-bg-primary" cellspacing="0" width="100%">
											<thead>
												<tr class="text-center">
													<th scope="col" style="width: 5%">#</th>
													<th scope="col" style="width: 40%">Hasil</th>
													<th scope="col" style="width: 5%">ID</th>
													<th scope="col" style="width: 35%">Jika Terdapat Jawaban</th>
													<th scope="col" style="width: 10%"></th>
												</tr>
											</thead>
											<tbody>
												<?php
												$i = 1;
												foreach ($rulesd as $rd) { ?>
													<tr>
														<?php
														$source2 = $this->Rumo->rules($rd['komponen_id'])->result_array();
														$rowspan = count($source2);
														?>
														<td rowspan="<?= $rowspan ?>"><?= $i ?></td>
														<td rowspan="<?= $rowspan ?>"><?= $rd['name'] ?></td>
														<?php foreach ($source2 as $s2) { ?>
															<td class="text-center"><?= $s2['id'] ?></td>
															<td><?= $s2['jawaban_content'] ?></td>
															<td class="text-center">
																<div class="btn-group" role="group" aria-label="Basic example">
																	<a href="#" title="ubah jawaban" data-id="<?= $s2['id'] ?>" type="button" class="btn btn-sm btn-info ubahRules" data-toggle="modal" data-target="#modalRules"><i style="color: white" class="fa fa-pen"></i></a>
																	<a href="<?= base_url('dashboard/rules/hapus/') . $s2['id']; ?>" title="hapus jawaban" type="button" class="btn btn-sm btn-danger btn-remove" data-text="Pertanyaan"><i style="color: white" class="fa fa-trash"></i></a>
																</div>
															</td>
													</tr>
												<?php
														} ?>
											<?php $i++;
												} ?>
											</tbody>
										</table>
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

		</div>
		<!-- ./Content -->
	</div>

	<!-- JS Files   -->
	<?php $this->load->view('_parts/js'); ?>
	<?php $this->load->view('js/js-rules'); ?>
	<!-- ./JS Files -->

	<!-- Modal -->
	<div class="modal animated fadeIn" id="modalRulesP" tabindex="-1" role="dialog" aria-labelledby="modalRulesCenter" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h3 class="modal-title" id="modalRulesPTitle">Tambah Rules Pertanyaan</h3>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<form action="<?= base_url('dashboard/rules') ?>" method="POST">
					<div class="modal-body">
						<div class="form-group">
							<label for="squareSelect">Jawaban</label> <small class="text-muted float-right"><i>(Jika jawaban adalah :)</i></small>
							<select id="rulesjid" name="rulesjid" class="form-control single" style="width: 100%" required>
								<?php $x = $this->db->get('pertanyaan')->result_array();
								foreach ($x as $x) { ?>
									<optgroup label="<?= $x['pertanyaan_content'] ?>">
										<?php $y = $this->db->get_where('jawaban', ['pertanyaan_id' => $x['id']])->result_array();
										foreach ($y as $y) { ?>
											<option value="<?= $y['id'] ?>"><?= $y['jawaban_content'] ?></option>
										<?php
										} ?>
									</optgroup>
								<?php
								} ?>
							</select>
						</div>

						<div class="form-group">
							<label for="squareSelect">Pertanyaan</label> <small class="text-muted float-right"><i>(Pertanyaan selanjutnya :)</i></small>
							<select class="form-control single" name="rulespid" id="rulespid" style="width: 100%" required>
								<?php $x = $this->db->get('pertanyaan')->result_array();
								foreach ($x as $x) { ?>
									<option value="<?= $x['id'] ?>"><?= $x['pertanyaan_content'] ?></option>
								<?php
								} ?>
							</select>
						</div>

						<div class="form-group float-right">
							<input type="hidden" name="id" id="idRulesp" value="">
							<button type="reset" class="btn btn-sm btn-secondary">Reset</button>
							<button type="submit" class="btn btn-sm btn-primary">Simpan</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>

	<div class="modal animated fadeIn" id="modalRules" tabindex="-1" role="dialog" aria-labelledby="modalRulesCenter" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h3 class="modal-title" id="modalRulesTitle">Tambah Rules</h3>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<form action="<?= base_url('dashboard/rules') ?>" method="POST" novalidate>
					<div class="modal-body">
						<div class="form-group jawabans">
							<label for="squareSelect">Jawaban</label> <small class="text-muted float-right"><i>(Jika terdapat jawaban ini)</i></small>
							<select id="jawabans" name="jawabans[]" class="form-control input-square select2 multi" multiple="jawabans" style="width: 100%" required>
								<?php $x = $this->db->get('pertanyaan')->result_array();
								foreach ($x as $x) { ?>
									<optgroup label="<?= $x['pertanyaan_content'] ?>">
										<?php $y = $this->db->get_where('jawaban', ['pertanyaan_id' => $x['id']])->result_array();
										foreach ($y as $y) { ?>
											<option value="<?= $y['id'] ?>"><?= $y['jawaban_content'] ?></option>
										<?php
										} ?>
									</optgroup>
								<?php
								} ?>
							</select>
						</div>

						<div class="form-group jawaban">
							<label for="squareSelect">Jawaban</label> <small class="text-muted float-right"><i>(Jika terdapat jawaban ini)</i></small>
							<select class="form-control single" name="jawaban" id="jawaban" style="width: 100%" required>
								<?php $y = $this->db->get('jawaban')->result_array();
								foreach ($y as $y) { ?>
									<option value="<?= $y['id'] ?>"><?= $y['jawaban_content'] ?></option>
								<?php
								} ?>
							</select>
						</div>

						<div class="form-group">
							<label for="squareSelect">Hasil</label> <small class="text-muted float-right"><i>(Menghasilkan)</i></small>
							<select class="form-control single" name="komponen" id="komponen" style="width: 100%" required>
								<?php $x = $this->db->get('komponen')->result_array();
								foreach ($x as $x) { ?>
									<option value="<?= $x['id'] ?>"><?= $x['name'] ?></option>
								<?php
								} ?>
							</select>
						</div>

						<div class="form-group float-right">
							<input type="hidden" name="id" id="idRules" value="">
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