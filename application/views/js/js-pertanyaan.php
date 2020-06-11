<script>
	$(document).ready(function() {
		$('.single').select2({
			tagClass: 'badge-primary',
			theme: "bootstrap",
			minimumResultsForSearch: Infinity
		});

		$('#tambahPertanyaan').on('click', function() {
			$('#modalPertanyaanTitle').html('Tambah Pertanyaan');
			$('.modal-content form').attr('action', '<?= base_url('dashboard/pertanyaan') ?>');
			$.ajax({
				success: function() {
					var blank = '';
					$('#idPertanyaan').val(blank);
					$('#pertanyaan').val("<?= $this->input->post('pertanyaan') ?>");
					$('#status').val("<?= $this->input->post('status') ?>")
				}
			})
		});

		$('.ubahPertanyaan').on('click', function() {
			$('#modalPertanyaanTitle').html('Ubah Pertanyaan');
			$('.modal-content form').attr('action', '<?= base_url('dashboard/pertanyaan/ubah') ?>');

			const ptid = $(this).data('pertid')
			// console.log(ptid)
			$.ajax({
				url: '<?= base_url('dashboard/pertanyaan/get'); ?>',
				data: {
					id: ptid
				},
				method: 'POST',
				dataType: 'JSON',
				success: function(data) {
					$('#modalPertanyaanTitle').html('Ubah Pertanyaan ' + data.id);
					$('#idPertanyaan').val(data.id);
					$('#pertanyaan').val(data.pertanyaan_content);
					$('#status').val(data.status);
				}
			})
		});
	});
</script>