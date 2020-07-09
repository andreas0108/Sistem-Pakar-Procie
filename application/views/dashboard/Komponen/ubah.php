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
						<h4 class="page-title"><?= $title ?></h4>
						<ul class="breadcrumbs">
							<?php $this->load->view('_parts/breadcrumb'); ?>
						</ul>
					</div>
					<!-- Content -->
					<form method="post" enctype="multipart/form-data">
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
											<img src="<?= $kompo['img'] != '' ? base_url('assets/img/komponen/') . $kompo['img'] : 'https://placehold.it/300?text=Gambar+Komponen' ?>" id="preview" class="img-thumbnail animated fadeIn" style="object-position: center; object-fit: cover">
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
													<input type="text" name="nama" class="form-control focus" placeholder="[merk] [seri] [versi]" value="<?= $kompo['name'] ?>" required>
												</div>
											</div>
											<div class="col-md-4 col-sm-12">
												<div class="form-group">
													<label for="harga">Harga</label>
													<div class="input-group">
														<div class="input-group-prepend">
															<span class="input-group-text" id="basic-addon1">Rp</span>
														</div>
														<input type="text" class="form-control text-left" id="harga" name="harga" data-mask="000.000.000.000" data-mask-reverse="true" value="<?= $kompo['price'] ?>">
													</div>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col">
												<div class="form-group mb-0 pb-0">
													<label for="isi">Deskripsi</label>
													<textarea name="isi" id="isi" class="form-control" placeholder="Deskripsi" style="height: 100px;" required><?= $kompo['desc'] ?></textarea>
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
											<div class="col">
												<div class="form-group">
													<label for="">Kategori :</label>
													<select class="form-control single" name="kate" style="width: 100%" required>
														<option value="">Pilih</option>
														<?php foreach ($this->db->get('komponen_kategori')->result_array() as $kt) {
															if ($kt['id'] == $kompo['kategori']) {
																echo '<option selected value="' . $kt['id'] . '">' . ucfirst(strtolower($kt['name'])) . '</option>';
															} else {
																echo '<option value="' . $kt['id'] . '">' . ucfirst(strtolower($kt['name'])) . '</option>';
															}
														} ?>
													</select>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col">
												<div class="form-group">
													<label for="">Manufacture :</label>
													<select class="form-control single" name="manuf" style="width: 100%" required>
														<option value="">Pilih</option>
														<?php if ($kompo['manufacture'] == 1) : ?>
															<option selected value="1">AMD</option>
															<option value="2">Intel</option>
														<?php else : ?>
															<option value="1">AMD</option>
															<option selected value="2">Intel</option>
														<?php endif ?>
													</select>
												</div>
											</div>
											<div class="col">
												<div class="form-group">
													<label for="socket">Socket</label>
													<input type="text" name="socket" class="form-control" placeholder="Jumlah Core" value="<?= $kompo['socket'] ?>">
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-6 col-sm-12">
												<div class="row">
													<div class="col-md-6 col-sm-12">
														<div class="form-group">
															<label for="core"># Core</label>
															<input type="number" name="core" class="form-control inmask" data-mask="00" data-mask-reverse="true" placeholder="Jumlah Core" value="<?= $kompo['core'] ?>">
														</div>
													</div>
													<div class="col-md-6 col-sm-12">
														<div class="form-group">
															<label for="thread"># Thread</label>
															<input type="number" name="thread" class="form-control inmask" data-mask="00" data-mask-reverse="true" placeholder="Jumlah Thread" value="<?= $kompo['thread'] ?>">
														</div>
													</div>
												</div>
											</div>
											<div class="col-md-6 col-sm-12">
												<div class="row">
													<div class="col-md-6 col-sm-12">
														<div class="form-group">
															<label for="base">Base Clock</label>
															<div class="input-group">
																<input type="text" name="base" class="form-control inmask" data-mask="00,0" data-mask-reverse="true" placeholder="Base Clock" value="<?= $kompo['base']; ?>">
																<div class="input-group-append">
																	<span class="input-group-text">GHz</span>
																</div>
															</div>
														</div>
													</div>
													<div class="col-md-6 col-sm-12">
														<div class="form-group">
															<label for="boost">Boost Clock</label>
															<div class="input-group">
																<input type="text" name="boost" class="form-control inmask" data-mask="00,0" data-mask-reverse="true" placeholder="Boost Clock" value="<?= $kompo['boost']; ?>">
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
												<div class="form-group">
													<label for="ref">Referensi</label>
													<input type="text" name="ref" class="form-control" placeholder="https://www.techpowerup.com/cpu-specs/core-i7-10700k.c2215" value="<?= $kompo['referensi']; ?>">
													<p class="ml-3 font-italic text-right text-muted">* Link untuk referensi / informasi lebih lengkap, bisa menggunakan Tech Powerup atau yang lain.</p>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col">
												<div class="form-group">
													<label for="">Link Pembelian</label>
													<div class="row">
														<div class="col">
															<small class="text-success">Link Pencarian via Tokopedia :</small>
															<input type="text" name="link1" id="link1" class="form-control" placeholder="https://www.tokopedia.com/search?q=intel+i7+10700k" value="<?= $kompo['link1']; ?>">
														</div>
														<div class="col">
															<small class="text-danger">Link Pencarian via Buka Lapak :</small>
															<input type="text" name="link2" id="link1" class="form-control" placeholder="https://www.bukalapak.com/products?search%5Bkeywords%5D=intel%20i7%2010700k" value="<?= $kompo['link2']; ?>">
														</div>
														<div class="col">
															<small class="text-warning">Link Pencarian via Shopee :</small>
															<input type="text" name="link3" id="link1" class="form-control" placeholder="https://shopee.co.id/search?keyword=intel%20i7%2010700k" value="<?= $kompo['link3']; ?>">
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
	<?php $this->load->view('js/js-komponen-ubah'); ?>
	<!-- ./JS Files -->
</body>

</html>