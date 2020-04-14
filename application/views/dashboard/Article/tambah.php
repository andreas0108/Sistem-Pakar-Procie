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
					<div class="page-header">
						<h4 class="page-title"><?= strtoupper($title) ?></h4>
						<ul class="breadcrumbs">
							<?php $this->load->view('_parts/breadcrumb'); ?>
						</ul>
					</div>
					<!-- Content -->
					<form action="<?= base_url('dashboard/article/tambah'); ?>" method="post" enctype="multipart/form-data">
						<div class="row">
							<div class="col-9">
								<!-- Default box -->
								<div class="card">
									<div class="card-body pad">
										<div class="form-group">
											<input type="text" name="title" class="form-control focus" placeholder="Title" required>
										</div>
										<div class="form-group">
											<textarea id="isi" name="isi" class="form-control" placeholder="Start Writing"><?= $this->input->post('isi') ?></textarea>
										</div>
									</div>
								</div>
								<!-- /.card -->

							</div>
							<div class="col-3">
								<div class="card">
									<div class="card-header p-1">
										<input type="hidden" name="penulis_id" value="<?= $user['id'] ?>">
										<button type="submit" class="btn btn-info btn-block">Simpan</button>
									</div>
								</div>
								<div class="card">
									<div class="card-body p-3">
										<label for=""><b>Cover :</b></label>
										<input type="file" name="image" class="file" accept="image/*" style="visibility: hidden;position: absolute;">
										<div class="input-group my-2">
											<input type="text" name='img-prev' class="form-control" disabled placeholder="Pilih Cover" id="file">
											<div class="input-group-append">
												<button type="button" class="browse btn btn-primary">Upload</button>
											</div>
										</div>
										<center>
											<img src="https://placehold.it/300?text=Cover" id="preview" class="img-thumbnail animated fadeIn" style="object-position: center; object-fit: cover" hidden>
										</center>
									</div>
								</div>
								<div class="card">
									<div class="card-body p-1">
										<div class="form-group">
											<label for="">Status Publikasi :</label>
											<select class="form-control" name="status" required>
												<option value="0">Draft</option>
												<option value="1">Publish</option>
											</select>
										</div>
									</div>
								</div>
								<div class="card">
									<div class="card-body p-1">
										<div class="row">
											<div class="col-md-12">
												<div class="form-group">
													<label for="">Tags :</label><br>
													<input name="tags" type="text" id="tagsinput" class="form-control input-solid badge-info" value="" data-role="tagsinput" placeholder="Pisahkan tags dengan enter">
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</form>
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
	<?php $this->load->view('js/js-article-add'); ?>
	<!-- ./JS Files -->
</body>

</html>