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
					<button type="button" href="javascript:void(0)" class="btn btn-sm btn-info float-right" id="tambahJawaban" data-toggle="modal" data-target="#modalJawaban"><i class="fas fa-fw fa-plus-circle mr-1"></i>Tambah Jawaban</button>
					<div class="page-header">
						<h4 class="page-title"><?= $title ?></h4>
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
											<th scope="col" style="width: 5%">ID</th>
											<th scope="col" style="width: 35%">Pertanyaan</th>
											<th scope="col" style="width: 5%">ID</th>
											<th scope="col" style="width: 35%">Jawaban</th>
											<th scope="col" style="width: 10%">Status</th>
											<th scope="col" style="width: 5%"></th>
										</tr>
									</thead>
									<tbody>
										<?php
										$i = 1;
										$this->db->select('DISTINCT(jawaban.pertanyaan_id) as id, pertanyaan.pertanyaan_content');
										$this->db->join('pertanyaan', 'jawaban.pertanyaan_id = pertanyaan.id')->order_by('jawaban.pertanyaan_id');
										$source1 = $this->db->get('jawaban')->result_array();
										foreach ($source1 as $s1) : ?>
											<tr>
												<?php
												$pid = $s1['id'];
												$source2 = $this->db->get_where('jawaban', ['pertanyaan_id' => $pid])->result_array();
												$rowspan = count($source2);
												?>
												<td rowspan="<?= $rowspan ?>" class="text-center"><?= $i++ ?></td>
												<td rowspan="<?= $rowspan ?>" class="text-center"><?= $s1['id'] ?></td>
												<td rowspan="<?= $rowspan ?>"><?= $s1['pertanyaan_content'] ?></td>
												<?php foreach ($source2 as $s2) : ?>
													<td class="text-center"><?= $s2['id'] ?></td>
													<td><?= $s2['jawaban_content'] ?></td>
													<td class="text-center"><?= $s2['status'] == 1 ? 'Enable' : 'Disable' ?></td>
													<td>
														<div class="btn-group" role="group" aria-label="Basic example">
															<a href="#" title="ubah jawaban" data-id="<?= $s2['id'] ?>" type="button" class="btn btn-sm btn-info ubahJawaban" data-toggle="modal" data-target="#modalJawaban"><i style="color: white" class="fa fa-pen"></i></a>
															<a href="<?= base_url('dashboard/jawaban/hapus/') . $s2['id']; ?>" title="hapus jawaban" type="button" class="btn btn-sm btn-danger btn-remove" data-text="Jawaban"><i style="color: white" class="fa fa-trash"></i></a>
														</div>
													</td>
											</tr>
										<?php endforeach ?>
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
	<?php $this->load->view('js/js-jawaban'); ?>
	<!-- ./JS Files -->

	<!-- Modal -->
	<div class="modal fade" id="modalJawaban" tabindex="-1" role="dialog" aria-labelledby="modalJawabanCenter" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h3 class="modal-title" id="modalJawabanTitle">Tambah Jawaban</h3>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<form action="<?= base_url('dashboard/jawaban') ?>" method="POST">
					<div class="modal-body">
						<div class="form-group">
							<label for="squareSelect">Pertanyaan</label>
							<select class="form-control single" name="pertanyaan" id="pertanyaan" style="width: 100%" required>
								<?php $x = $this->db->get('pertanyaan')->result_array();
								foreach ($x as $x) { ?>
									<option value="<?= $x['id'] ?>"><?= $x['pertanyaan_content'] ?></option>
								<?php } ?>
							</select>
						</div>

						<div class="form-group jawaban">
							<label for="squareInput">Jawaban</label>
							<input type="text" name="jawaban" id="jawaban" class="form-control input-square">
						</div>

						<div class="form-group jawabanInput">
							<label for="squareInput">Jawaban</label><br>
							<input type="text" name="jawabanInput" id="jawabanInput" class="form-control input-square" data-role="jawabanInput" placeholder="Pisahkan dengan enter">
						</div>

						<div class="form-group">
							<label for="squareSelect">Status</label>
							<select class="form-control single" name="status" id="status" style="width: 100%" required>
								<option value="1">Enable</option>
								<option value="0">Disable</option>
							</select>
						</div>

						<div class="form-group float-right">
							<input type="hidden" name="id" id="idJawaban" value="">
							<button type="reset" class="btn btn-sm btn-secondary btnReset" id="btnReset">Reset</button>
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