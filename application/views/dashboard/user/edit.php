<!-- Begin Page Content -->
<div class="container-fluid">
	<div class="row">
		<div class="col-lg">

			<div class="card border-primary mb-3">
				<div class="align-middle text-white bg-primary card-header">
					<h5><?= $title3 ?></h5>
				</div>
				<div class="card-body table-responsive">
					<!-- <?= $this->session->flashdata('notif'); ?> -->

					<form action="<?= base_url('dashboard/user/edit'); ?>" method="post" enctype="multipart/form-data">
						<div class="form-group row">
							<label for="email" class="col-sm-2 col-form-label">Email</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" id="email" name="email" value="<?= $user['email']; ?>" readonly>
							</div>
						</div>
						<div class=" form-group row">
							<label for="name" class="col-sm-2 col-form-label">Full Name</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" id="name" name="name" value="<?= $user['name'] ?>">
								<?= form_error('name', '<small class="text-danger pl-0" role="alert">', '</small>') ?>
							</div>
						</div>
						<div class="form-group row">
							<div class="col-sm-2">Picture</div>
							<div class="col-sm-10">
								<div class="row">
									<div class="col-lg-3 col-md-6 col-sm-12">
										<img src="<?= base_url('assets/img/profile/') . $user['img']; ?>" class="img-thumbnail align-center align-middle">
									</div>
									<div class="col-lg-9 col-md-6 col-sm-12">
										<div class="custom-file">
											<input type="file" class="custom-file-input" id="image" name="image">
											<label class="custom-file-label" for="image">Choose file</label>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="form-group row justify-content-end">
							<div class="col-sm-10">
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
<!-- End of Main Content -->
