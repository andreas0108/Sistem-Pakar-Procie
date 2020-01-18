<!-- JS Side -->
<script>
	$('.addKomponen').on('click', function() {
		$('#modalKomponenTitle').html('Tambah Komponen');
		$.ajax({
			success: function() {
				var blank = '';
				$('#idkomponen').val(blank);
				$('#kname').val("<?= $this->input->post('kname') ?>");
				$('#manuf').val("<?= $this->input->post('manuf') ?>");
				$('#desc').val("<?= $this->input->post('desc') ?>");
				$('#kate').val("<?= $this->input->post('kate') ?>");
				$('#price').val("<?= $this->input->post('price') ?>");
				$('#status').val("<?= $this->input->post('status') ?>");
			}
		});
	});

	$('.ubahKomponen').on('click', function() {
		$('#modalKomponenTitle').html('Ubah Komponen');
		$('.modal-content form').attr('action', '<?= base_url('dashboard/sikar/updateK'); ?>');

		const komid = $(this).data('komponenid')
		$.ajax({
			url: '<?= base_url('dashboard/sikar/getK'); ?>',
			data: {
				id: komid
			},
			method: 'POST',
			dataType: 'JSON',
			success: function(data) {
				$('#idkomponen').val(data[0].id);
				$('#kname').val(data[0].name);
				$('#manuf').val(data[0].manufacture);
				$('#desc').val(data[0].desc);
				$('#kate').val(data[0].kategori);
				$('#price').val(data[0].price);
				$('#status').val(data[0].status);
			}
		});
	})
</script>
<!-- ./JS Side -->

<!-- Modal Side -->
<div class="modal fade" id="modalKomponen" tabindex="-1" role="dialog" aria-labelledby="modalKomponen" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modalKomponenTitle">Tambah Komponen</h5>
				<button class="close" type="button" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true"><i class="fas fa-fw fa-window-close" style="color: black"></i></span>
				</button>
			</div>
			<form action="<?= base_url('dashboard/sikar/komponen'); ?>" method="POST">
				<div class="modal-body">
					<div class="form-group">
						<input type="hidden" class="form-control" id="idkomponen" name="idkomponen">
					</div>
					<div class="form-group">
						<input type="text" class="form-control" id="kname" name="kname" placeholder="Nama Komponen" required>
					</div>
					<div class="form-group">
						<select name="manuf" id="manuf" class="form-control" required>
							<option value="">Manufacturer</option>
							<option value="1">AMD</option>
							<option value="2">Intel</option>
						</select>
					</div>
					<div class="form-group">
						<textarea class="form-control" rows="3" id="desc" name="desc" placeholder="Deskripsi"></textarea>
					</div>
					<div class="form-group">
						<select name="kate" id="kate" class="form-control" required>
							<option value="">Ketegori</option>
							<?php foreach ($katlist as $kl) : ?>
								<option value="<?= $kl['id'] ?>"><?= $kl['name'] ?></option>
							<?php endforeach ?>
						</select>
					</div>
					<div class="form-group">
						<div class="input-group">
							<div class="input-group-prepend">
								<span class="input-group-text">Rp. </span>
							</div>
							<input type="number" class="form-control" id="price" name="price" placeholder="800000">
						</div>
					</div>
					<div class="form-group">
						<select name="status" id="status" class="form-control" required>
							<option value="">Status</option>
							<option value="0">Not Integrated</option>
							<option value="1">Integrated</option>
						</select>
					</div>
				</div>
				<div class="modal-footer">
					<button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
					<button class="btn btn-primary" type="submit">Simpan</button>
				</div>
			</form>
		</div>
	</div>
</div>
<!-- /.modal-section -->
