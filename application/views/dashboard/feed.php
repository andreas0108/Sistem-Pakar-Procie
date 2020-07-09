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
									<div class="page-header">
										<h4 class="page-title"><?= $title ?></h4>
										<ul class="breadcrumbs">
											<?php $this->load->view('_parts/breadcrumb'); ?>
										</ul>
									</div>
									<div class="card">
										<div class="card-body">
											<div class="table-responsive">
												<table id="table-komponen" class="display table table-borderless table-striped table-hover table-head-bg-primary" cellspacing="0" width="100%">
													<thead>
														<tr class="text-center">
															<th scope="col" style="width:5%">#</th>
															<th scope="col" style="width:10%">Nama</th>
															<th scope="col" style="width:20%">Email</th>
															<th scope="col" style="width:55%">Feedback</th>
															<th scope="col" style="width:10%"></th>
														</tr>
													</thead>
													<tbody>
														<?php
														$i = 1;
														foreach ($feed as $f) : ?>
															<tr>
																<td>
																	<?= $i++ ?>
																</td>
																<td>
																	<p class="card-text mb-0"><?= $f['nama'] ?></p>
																</td>
																<td>
																	<p class="card-text mb-0"><?= $f['email'] ?></p>
																</td>
																<td>
																	<p class="card-text"><?= $f['isi'] ?></p>
																</td>
																<td class="text-center">
																	<a href="<?= base_url('dashboard/feedback/hapus/') . $f['id']; ?>" title="hapus feedback" type="button" class="btn btn-sm btn-danger btn-remove" data-text="Feedback"><i style="color: white" class="fa fa-trash"></i></a>
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
	<?php $this->load->view('js/js-komponen'); ?>
	<!-- ./JS Files -->
</body>

</html>