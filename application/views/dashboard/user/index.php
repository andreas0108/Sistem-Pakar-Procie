<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1>Profile Page</h1>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="#"><?= $title2 ?></a></li>
						<li class="breadcrumb-item active"><?= $title3 ?></li>
					</ol>
				</div>
			</div>
		</div><!-- /.container-fluid -->
	</section>

	<!-- Main content -->
	<section class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-3">

					<!-- <?= var_dump($jum_article) ?> -->

					<!-- Profile Image -->
					<div class="card card-primary card-outline">
						<div class="card-body box-profile">
							<div class="text-center">
								<img class="profile-user-img img-fluid img-circle" src="<?= base_url('assets/img/profile/') . $user['img']; ?>" alt="User profile picture">
							</div>

							<h3 class="profile-username text-center"><?= $user['name']; ?></h3>

							<p class="text-muted text-center">
								<?php
								if ($user['role_id'] == 1) {
									echo 'Administrator';
								} else {
									echo 'User';
								} ?>
							</p>

							<ul class="list-group list-group-unbordered mb-3">
								<li class="list-group-item">
									<b>Article Writed</b> <a class="float-right"><?= number_format($jum_article) ?></a>
								</li>
								<!-- <li class="list-group-item">
									<b></b> <a class="float-right">543</a>
								</li> -->
							</ul>
						</div>
						<!-- /.card-body -->
					</div>
					<!-- /.card -->

					<!-- About Me Box -->
					<div class="card card-primary">
						<div class="card-header">
							<h3 class="card-title">About Me</h3>
						</div>
						<!-- /.card-header -->
						<div class="card-body">
							<strong><i class="fas fa-fw fa-user-circle mr-1"></i> User ID :</strong>
							<p class="text-muted">
								<?= $user['id'] ?>
							</p>
							<hr>

							<strong><i class="fas fa-envelope mr-1"></i> Email</strong>
							<p class="text-muted"><?= $user['email']; ?></p>
							<hr>

							<strong><i class="fas fa-map-marker-alt mr-1"></i> Address</strong>
							<p class="text-muted"><?= $user['address']; ?></p>
							<hr>

							<strong><i class="fas fa-map-marker-alt mr-1"></i> Phone Number</strong>
							<p class="text-muted"><?= $user['phone_number']; ?></p>
							<hr>

							<strong><i class="far fa-calendar-alt mr-1"></i> Tanggal Registrasi</strong>

							<!-- konversi unixtime ke format global -->
							<!-- <p class="text-muted"><?= gmdate("Y-m-d H:i:s", $user['date_created']) ?></p> -->

							<!-- konversi unixtime ke format tanggal indonesia menggunakan helper tanggal-indo-->
							<p class="text-muted"><?= date_indo(gmdate("Y-m-d H:i:s", $user['date_created'])) ?></p>
						</div>
						<!-- /.card-body -->
					</div>
					<!-- /.card -->
				</div>
				<!-- /.col -->
				<div class="col-md-9">
					<div class="card">
						<div class="card-header p-2">
							<ul class="nav nav-pills">
								<li class="nav-item"><a class="nav-link active" href="#article" data-toggle="tab">Article List</a></li>
								<li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Edit Profile</a></li>
							</ul>
						</div><!-- /.card-header -->
					</div>
					<div class="tab-content">
						<div class="active tab-pane" id="article">
							<?php if ($jum_article != 0) : ?>
								<?php foreach ($lA as $n) : ?>
									<div class="card">
										<div class="row">
											<div class="col-md-2 col-sm-12">
												<div class="container-fluid">
													<div class="mt-3">
														<img class="img-thumbnail" src="<?= base_url('assets/img/article/poster/') . $n['gambar']; ?>" alt="<?= $n['judul'] ?> img">
													</div>
												</div>
											</div>
											<div class="col-md-10 col-sm-12 m-auto">
												<div class="card-body mb-0">
													<div class="">
														<div class="row">
															<div class="col-10 m-auto">
																<h5><?= $start++ . '. ' . $user['name'] ?> - <a href="#" target="_blank" rel="noopener noreferrer"><?= $n['judul'] ?></a> </h5>
															</div>
															<div class="col-2">
																<span class="float-right text-black-50 text-sm">
																	<?= mediumdate_indo($n['tgl_buat']) ?>
																</span>
																<br>
																<?php if ($n['status'] == '0') : ?>
																	<span class="float-right text-sm text-danger">Unpublished</span>
																<?php else : ?>
																	<span class="float-right text-sm text-success">Published</span>
																<?php endif ?>
															</div>
														</div>
													</div>
													<hr>
													<p class="text-justify">
														<?= substr(html_escape(preg_replace('/<+\s*\/*\s*([A-Z][A-Z0-9]*)\b[^>]*\/*\s*>+/i', '', $n['isi'])), 0, 300)  ?>
														<?php if ($n['isi'] == '' || null) : ?>
															<p class="text-sm text-info italic">Kosong</p>
														<?php else : ?>
															...
														<?php endif ?>
													</p>
													<hr>
													<div class="">
														<a href="<?= base_url('blog/read/') . $n['slug'] ?>" class="btn btn-sm btn-default">Baca Selengkapnya</a>
														<a href="<?= base_url('dashboard/content/edita/') . $n['id'] ?>" class="btn btn-sm btn-info">Ubah</a>
														<a href="<?= base_url('dashboard/content/deletea/') . $n['id'] ?>" class="btn btn-sm btn-danger float-right">Hapus</a>
													</div>
												</div>
											</div>
										</div>
									</div>
								<?php endforeach ?>
								<?= $this->pagination->create_links(); ?>
							<?php else : ?>
								<div class="alert alert-info alert-dismissible fade show">
									<h5><i class="icon fas fa-info"></i> Informasi</h5>
									Anda belum memilik artikel di webste ini.<br>
									Mulai menulis artikel <a href="<?= base_url('dashboard/content') ?>">sekarang.</a>
								</div>
							<?php endif ?>
						</div>
						<div class="tab-pane" id="settings">
							<div class="card">
								<div class="card-body">
									<form action="<?= base_url('dashboard/user/edit'); ?>" method="post" enctype="multipart/form-data">
										<div class="form-group row">
											<label for="name" class="col-sm-2 col-form-label">Name</label>
											<div class="col-sm-10">
												<input type="text" class="form-control" id="name" name="name" value="<?= $user['name'] ?>" required>
											</div>
										</div>
										<div class="form-group row">
											<label for="email" class="col-sm-2 col-form-label">Email</label>
											<div class="col-sm-10">
												<input type="text" class="form-control" id="email" name="email" value="<?= $user['email']; ?>" readonly>
											</div>
										</div>
										<div class="form-group row">
											<label for="phone" class="col-sm-2 col-form-label">Phone</label>
											<div class="col-sm-10">
												<input type="text" class="form-control" id="phone" name="phone" value="<?= $user['phone_number'] ?>" required>
											</div>
										</div>
										<div class="form-group row">
											<label for="address" class="col-sm-2 col-form-label">Address</label>
											<div class="col-sm-10">
												<input type="text" class="form-control" id="address" name="address" value="<?= $user['address'] ?>" required>
											</div>
										</div>
										<div class="form-group row">
											<label for="image" class="col-sm-2 col-form-label">File</label>
											<div class="col-sm-10">
												<div class="custom-file">
													<input type="file" class="custom-file-input" id="image" name="image">
													<label class="custom-file-label" for="image">Choose file</label>
												</div>
											</div>
										</div>
										<div class="form-group row">
											<label for="image" class="col-sm-2 col-form-label">Picture</label>
											<div class="col-sm-10">
												<div class="row">
													<div class="col-lg-3 col-md-6 col-sm-12">
														<img src="<?= base_url('assets/img/profile/') . $user['img']; ?>" class="img-thumbnail align-center align-middle">
													</div>
												</div>
											</div>
										</div>
										<div class="form-group row">
											<div class="col-12 text-right">
												<button type="submit" class="btn btn-primary">Save</button>
											</div>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- /.nav-tabs-custom -->
		</div>
		<!-- /.col -->

	</section>
</div><!-- /.container-fluid -->
