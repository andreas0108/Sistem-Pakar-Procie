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
					<button type="button" href="javascript:void(0)" class="btn btn-sm btn-info float-right" id="tambahRules" data-toggle="modal" data-target="#modalRules">Tambah Rules</button>
					<div class="page-header">
						<h4 class="page-title"><?= strtoupper($title) ?></h4>
						<ul class="breadcrumbs">
							<?php $this->load->view('_parts/breadcrumb'); ?>
						</ul>
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
											<th scope="col" style="width: 30%">Jika Terdapat Jawaban</th>
											<th scope="col" style="width: 10%">Status</th>
											<th scope="col" style="width: 5%"></th>
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
													<td class="text-center"><?= $s2['status'] == 1 ? 'Enable' : 'Disable' ?></td>
													<td class="text-center">
														<div class="btn-group" role="group" aria-label="Basic example">
															<a href="#" title="ubah jawaban" data-id="<?= $s2['id'] ?>" type="button" class="btn btn-sm btn-info ubahRules" data-toggle="modal" data-target="#modalRules"><i style="color: white" class="fa fa-pen"></i></a>
															<a href="<?= base_url('dashboard/rules/hapus/') . $s2['id']; ?>" title="hapus jawaban" type="button" class="btn btn-sm btn-danger btn-remove" data-text="Pertanyaan"><i style="color: white" class="fa fa-trash"></i></a>
														</div>
													</td>
											</tr>
										<?php } ?>
									<?php $i++;
										} ?>
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

		</div>
		<!-- ./Content -->
	</div>

	<!-- JS Files   -->
	<?php $this->load->view('_parts/js'); ?>
	<?php $this->load->view('js/js-rules'); ?>
	<!-- ./JS Files -->

	<!-- Modal -->
	<div class="modal fade" id="modalRules" tabindex="-1" role="dialog" aria-labelledby="modalRulesCenter" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h3 class="modal-title" id="modalRulesTitle">Tambah Rules</h3>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<form action="<?= base_url('dashboard/jawaban') ?>" method="POST">
					<div class="modal-body">
						<div class="form-group">
							<label for="squareSelect">Jawaban</label> <small class="text-muted float-right"><i>(Jika terdapat jawaban ini)</i></small>
							<select class="form-control input-square" name="jawaban" id="jawaban" required>
								<option value="">Pilih</option>
								<?php $x = $this->db->get('jawaban')->result_array();
								foreach ($x as $x) { ?>
									<option value="<?= $x['id'] ?>"><?= $x['jawaban_content'] ?></option>
								<?php } ?>
							</select>
						</div>

						<div class="form-group">
							<label for="squareSelect">Hasil</label> <small class="text-muted float-right"><i>(Menghasilkan)</i></small>
							<select class="form-control input-square" name="komponen" id="komponen" required>
								<option value="">Pilih</option>
								<?php $x = $this->db->get('komponen')->result_array();
								foreach ($x as $x) { ?>
									<option value="<?= $x['id'] ?>"><?= $x['name'] ?></option>
								<?php } ?>
							</select>
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
