<!-- JS Side -->
<script>
	$('#addPertanyaan').on('click', function() {
		$('#modalPertanyaanTitle').html('Tambah Pertanyaan');
		$.ajax({
			success: function() {
				var blank = '';
				$('#idkomponen').val(blank);
				$('#pert').val("<?= $this->input->post('pert') ?>");
				$('#status').val("<?= $this->input->post('status') ?>");
			}
		});
	});

	$('.ubahPertanyaan').on('click', function() {
		$('#modalPertanyaanTitle').html('Ubah Pertanyaan');
		$('.modal-content form').attr('action', '<?= base_url('dashboard/sikar/updateP'); ?>');

		const ptid = $(this).data('pertid')
		// console.log(ptid)
		$.ajax({
			url: '<?= base_url('dashboard/sikar/getP'); ?>',
			data: {
				id: ptid
			},
			method: 'POST',
			dataType: 'JSON',
			success: function(data) {
				$('#idpt').val(data[0].id);
				$('#pert').val(data[0].pertanyaan_content);
				$('#status').val(data[0].status);
			}
		});
	})
</script>
<!-- ./JS Side -->

<!-- Modal Side -->
<div class="modal fade" id="modalPertanyaan" tabindex="-1" role="dialog" aria-labelledby="modalPertanyaan" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modalPertanyaanTitle">Tambah Pertanyaan</h5>
				<button class="close" type="button" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true"><i class="fas fa-fw fa-window-close" style="color: black"></i></span>
				</button>
			</div>
			<form action="<?= base_url('dashboard/sikar/pertanyaan'); ?>" method="POST">
				<div class="modal-body">
					<div class="form-group">
						<input type="hidden" class="form-control" id="idpt" name="idpt">
					</div>
					<div class="form-group">
						<input type="text" class="form-control" id="pert" name="pert" placeholder="Pertanyaan" required>
					</div>
					<div class="form-group">
						<select name="status" id="status" class="form-control" required>
							<option value="">Status</option>
							<option value="0">Disable</option>
							<option value="1">Enable</option>
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
