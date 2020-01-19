<!-- JS Side -->
<script>
	$('#add<?= $title3 ?>').on('click', function() {
		$('#modal<?= $title3 ?>Title').html('Tambah <?= $title3 ?>');
		$('.modal-content form').attr('action', '<?= base_url('dashboard/sikar/jawaban'); ?>');
		$.ajax({
			success: function() {
				var blank = '';
				$('#jwid').val(blank);
				$('#jawab').val("<?= $this->input->post('jawab') ?>");
				$('#status').val("<?= $this->input->post('status') ?>");
			}
		});
	});

	$('.ubah<?= $title3 ?>').on('click', function() {
		$('#modal<?= $title3 ?>Title').html('Ubah <?= $title3 ?>');
		$('.modal-content form').attr('action', '<?= base_url('dashboard/sikar/updateJ'); ?>');

		const jwid = $(this).data('jwid')
		$.ajax({
			url: '<?= base_url('dashboard/sikar/getJ'); ?>',
			data: {
				id: jwid
			},
			method: 'POST',
			dataType: 'JSON',
			success: function(data) {
				$('#jwid').val(data[0].id);
				$('#jawab').val(data[0].jawaban_content);
				$('#status').val(data[0].status);
			}
		});
	})
</script>
<!-- ./JS Side -->

<!-- Modal Side -->
<div class="modal fade" id="modal<?= $title3 ?>" tabindex="-1" role="dialog" aria-labelledby="modal<?= $title3 ?>" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal<?= $title3 ?>Title">Tambah <?= $title3 ?></h5>
				<button class="close" type="button" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true"><i class="fas fa-fw fa-window-close" style="color: black"></i></span>
				</button>
			</div>
			<form action="<?= base_url('dashboard/sikar/jawaban'); ?>" method="POST">
				<div class="modal-body">
					<div class="form-group">
						<input type="hidden" class="form-control" id="jwid" name="jwid">
					</div>
					<div class="form-group">
						<input type="text" class="form-control" id="jawab" name="jawab" placeholder="<?= $title3 ?>" required>
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
