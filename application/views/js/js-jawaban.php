<script>
	$(document).ready(function() {
		$('.single').select2({
			tagClass: 'badge-primary',
			theme: "bootstrap",
			minimumResultsForSearch: Infinity
		});

		$('#modalJawaban').modal({
			show: false,
			keyboard: false,
			backdrop: 'static'
		});

		$('.btnReset').on('clikc', function() {
			var blank = '';
			$('#jawabanInput').html('');
		});

		$('#tambahJawaban').on('click', function() {
			$('#modalJawabanTitle').html('Tambah Jawaban');
			$('.modal-content form').attr('action', '<?= base_url('dashboard/jawaban') ?>');
			$('.jawaban').hide();
			$('.jawabanInput').show();

			$.ajax({
				success: function() {
					var blank = '';
					$('#idJawaban').val(blank);
					$('#pertanyaan').val("<?= $this->input->post('pertanyaan') ?>");
					$('#jawabanInput').val("<?= $this->input->post('jawaban') ?>");
					$('#status').val("<?= $this->input->post('status') ?>")
				}
			})
		});

		$('.ubahJawaban').on('click', function() {
			$('#modalJawabanTitle').html('Ubah Jawaban');
			$('.modal-content form').attr('action', '<?= base_url('dashboard/jawaban/ubah') ?>');
			$('.jawaban').show();
			$('.jawabanInput').hide();

			const id = $(this).data('id')
			console.log(id)
			$.ajax({
				url: '<?= base_url('dashboard/jawaban/get'); ?>',
				data: {
					id: id
				},
				method: 'POST',
				dataType: 'JSON',
				success: function(data) {
					$('#modalJawabanTitle').html('Ubah Jawaban ' + data.id);
					$('#idJawaban').val(data.id);
					$('#jawaban').val(data.jawaban_content);
					$('#status').val(data.status);
					$('#pertanyaan').val(data.pertanyaan_id);
				}
			})
		});

		$('#jawabanInput').tagsinput({
			tagClass: 'badge-primary'
		});
	});
</script>