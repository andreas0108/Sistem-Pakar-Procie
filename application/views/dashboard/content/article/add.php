<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1><?= $title3 ?></h1>
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
		<form action="<?= base_url('dashboard/content/add'); ?>" method="post" enctype="multipart/form-data">
			<div class="row">
				<div class="col-12">
					<div class="card">
						<div class="card-header">
							<div class="card-title">
								<h4>Tambah <?= $title3 ?></h4>
							</div>
							<div class="card-tools">
								<!-- <button type="button" class="btn btn-tool"> -->
								<a type="button" class="btn btn-tool" href="<?= base_url('dashboard/content/') ?>">
									<i class="fas fa-fw fa-arrow-left"></i>
									Back
								</a>
								<!-- </button> -->
								<button type="submit" class="btn btn-success btn-sm">
									Save
								</button>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-9">
					<!-- Default box -->
					<div class="card">
						<div class="card-body pad">
							<div class="form-group">
								<input type="text" name="title" class="form-control focus" placeholder="Title" required>
							</div>
							<div class="form-group">
								<textarea name="article-sum" id="article-sum" class="form-control"></textarea>
							</div>
						</div>
					</div>
					<!-- /.card -->
				</div>
				<div class="col-3">
					<div class="card">
						<div class="card-header">
							<b>Penulis :</b>
						</div>
						<div class="card-body">
							<div class="form-group">
								<input type="text" name="penulis" class="form-control" placeholder="Penulis" value="<?= $user['name'] ?>" style="background-color: #F8F8F8;outline-color: none;border:0;color:blue;" disabled>
								<input type="text" name="penulis_id" class="form-control" value="<?= $user['id'] ?>" required hidden>
							</div>
						</div>
					</div>
					<div class="card">
						<div class="card-header">
							<b>Media</b>
						</div>
						<div class="card-body pt-2">
							<div class="form-group">
								<label for="poster">Poster : </label>
								<div class="input-group">
									<div class="custom-file">
										<input type="file" class="custom-file-input" id="poster" name="poster">
										<label class="custom-file-label" for="poster">Pilih poster / gambar</label>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="card">
						<div class="card-body">
							<div class="form-group">
								<label for="">Ketegori :</label>
								<select class="form-control" name="kategori" required>
									<option value="0">Draft</option>
									<option value="1">Publish</option>
								</select>
							</div>
						</div>
					</div>
					<div class="card">
						<div class="card-body">
							<div class="form-group">
								<label for="">Status Publikasi :</label>
								<select class="form-control" name="status" required>
									<option value="0">Draft</option>
									<option value="1">Publish</option>
								</select>
							</div>
						</div>
					</div>
				</div>
			</div>
		</form>
	</section>
	<!-- /.content -->
</div>
<!-- /.content-wrapper -->
