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
					<button type="button" href="javascript:void(0)" class="btn btn-sm btn-default float-right">Tambah Jawaban</button>
					<div class="page-header">
						<h4 class="page-title"><?= strtoupper($title) ?></h4>
						<ul class="breadcrumbs">
							<?php $this->load->view('_parts/breadcrumb'); ?>
						</ul>
					</div>
					<div class="card">
						<div class="card-body">
							<div class="table-responsive">
								<table class="table table-bordered table-striped table-head-bg-primary" cellspacing="0" width="100%">
									<thead>
										<tr class="text-center">
											<th scope="col" style="width: 5%">#</th>
											<th scope="col" style="width: 45%">Hasil / Komponen</th>
											<th colspan="2" scope="col" style="width: 40%">ID / Jawaban</th>
											<th scope="col" style="width: 5%">Status</th>
										</tr>
									</thead>
									<tbody>
										<?php
										$i = 1;
										foreach ($rulesd as $rd) { ?>
											<tr>
												<?php
												$source2 = $this->Rumo->rules($rd['komponen_id']);
												$rowspan = $source2->num_rows();
												$source3 = $source2->result_array();
												// var_dump($source3);
												?>
												<td rowspan="<?= $rowspan ?>"><?= $i++ ?></td>
												<td rowspan="<?= $rowspan ?>"><?= $rd['name'] ?></td>
												<?php foreach ($source3 as $s3) { ?>
													<td class="text-center"><?= $s3['jawaban_id'] ?></td>
													<td class="text-center"><?= $s3['jawaban_content'] ?></td>
													<td class="text-center"><?= $s3['status'] ?></td>
											</tr>
										<?php } ?>
										<!-- <td rowspan="<?= $rowspan ?>"><?= $r3['name'] ?></td> -->
									<?php } ?>
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
	<!-- ./JS Files -->
</body>

</html>

<!-- 