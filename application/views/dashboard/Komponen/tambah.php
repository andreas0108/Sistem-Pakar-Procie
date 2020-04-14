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
					<form action="<?= base_url('dashboard/komponen/tambah'); ?>" method="post" enctype="multipart/form-data">
						<div class="row">
							<div class="col-md-3 col-sm-12">
								<div class="card">
									<div class="card-header">
										<label for="">Gambar Komponen</label>
									</div>
									<div class="card-body p-3">
										<input type="file" name="image" class="file" accept="image/*" style="visibility: hidden;position: absolute;">
										<div class="input-group my-2">
											<input type="text" name='img-prev' class="form-control" disabled placeholder="[Nama File]" id="file">
											<div class="input-group-append">
												<button type="button" class="browse btn btn-primary"><i class="fa fa-folder-open mr-1"></i> Cari</button>
											</div>
										</div>
										<center>
											<img src="https://placehold.it/400?text=Gambar+Komponen" id="preview" class="img-fluid img-thumbnail animated fadeIn" style="object-position: center; object-fit: cover">
										</center>
									</div>
								</div>
							</div>
							<div class="col-md-9 col-sm-12">
								<!-- Default box -->
								<div class="card">
									<div class="card-body pad">
										<div class="row">
											<div class="col-md-8 col-sm-12">
												<div class="form-group">
													<label for="nama">Nama</label>
													<input type="text" name="nama" class="form-control focus" placeholder="[merk] [seri] [versi]" required>
												</div>
											</div>
											<div class="col-md-4 col-sm-12">
												<div class="form-group">
													<label for="harga">Harga</label>
													<div class="input-group">
														<div class="input-group-prepend">
															<span class="input-group-text" id="basic-addon1">Rp</span>
														</div>
														<input type="text" class="form-control text-left inmask" name="harga" data-mask="000.000.000.000" data-mask-reverse="true">
													</div>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col">
												<div class="form-group mb-0 pb-0">
													<label for="isi">Deskripsi</label>
													<textarea name="isi" id="isi" class="form-control" placeholder="Deskripsi" style="height: 100px;" required></textarea>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="card">
									<div class="card-header ml-2">
										Spesifikasi Teknis
									</div>
									<div class="card-body">
										<div class="row">
											<div class="col-md-6 col-sm-12">
												<div class="form-group">
													<label for="">Manufacture :</label>
													<select class="form-control" name="manuf" required>
														<option value="">Pilih</option>
														<option value="1">AMD</option>
														<option value="2">Intel</option>
													</select>
												</div>
												<div class="row">
													<div class="col-md-6 col-sm-12">
														<div class="form-group">
															<label for="spek_core"># Core</label>
															<input type="number" name="spek_core" class="form-control inmask" data-mask="00" data-mask-reverse="true" placeholder="Jumlah Core">
														</div>
													</div>
													<div class="col-md-6 col-sm-12">
														<div class="form-group">
															<label for="spek_thread"># Thread</label>
															<input type="number" name="spek_thread" class="form-control inmask" data-mask="00" data-mask-reverse="true" placeholder="Jumlah Thread">
														</div>
													</div>
												</div>
											</div>
											<div class="col-md-6 col-sm-12">
												<div class="form-group">
													<label for="">Kategori :</label>
													<select class="form-control" name="kate" required>
														<option value="">Pilih</option>
														<?php foreach ($this->db->get('komponen_kategori')->result_array() as $kt) {
															echo '<option value="' . $kt['id'] . '">' . $kt['name'] . '</option>';
														} ?>
													</select>
												</div>
												<div class="row">
													<div class="col-md-6 col-sm-12">
														<div class="form-group">
															<label for="spek_basec">Base Clock</label>
															<div class="input-group">
																<input type="text" name="spek_basec" class="form-control inmask" data-mask="00,0" data-mask-reverse="true" placeholder="Base Clock">
																<div class="input-group-append">
																	<span class="input-group-text">GHz</span>
																</div>
															</div>
														</div>
													</div>
													<div class="col-md-6 col-sm-12">
														<div class="form-group">
															<label for="spek_boostc">Boost Clock</label>
															<div class="input-group">
																<input type="text" name="spek_boostc" class="form-control inmask" data-mask="00,0" data-mask-reverse="true" placeholder="Boost Clock">
																<div class="input-group-append">
																	<span class="input-group-text">GHz</span>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col">
												<div class="form-group float-right">
													<button type="submit" class="btn btn-primary btn-block">Simpan</button>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="card">

								</div>
								<div class="card">
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
	<?php $this->load->view('js/js-komponen-tambah'); ?>
	<!-- ./JS Files -->
</body>

</html>