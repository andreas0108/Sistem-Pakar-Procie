<script>
	$(document).ready(function() {
		$('#modalRules').modal({
			show: false,
			keyboard: false,
			backdrop: 'static'
		});

		$('#jawabans').select2({
			closeOnSelect: false,
			tagClass: 'badge-primary',
			theme: "bootstrap"
		});

		$('#jawaban').select2({
			tagClass: 'badge-primary',
			theme: "bootstrap"
		});

		$('#tambahRules').on('click', function() {
			$('#modalRulesTitle').html('Tambah Rules');
			$('.modal-content form').attr('action', '<?= base_url('dashboard/rules') ?>');
			$('.jawaban').hide();
			$('.jawabans').show();
			$.ajax({
				success: function() {
					var blank = '';
					$('#idRules').val(blank);
					$('#jawaban').val("<?= $this->input->post('jawaban') ?>");
					$('#komponen').val("<?= $this->input->post('komponen') ?>");
					$('#status').val("<?= $this->input->post('status') ?>")
				}
			})
		});

		$('.ubahRules').on('click', function() {
			$('#modalRulesTitle').html('Ubah Rules');
			$('.modal-content form').attr('action', '<?= base_url('dashboard/rules/ubah') ?>');
			$('.jawaban').show();
			$('.jawabans').hide();

			const id = $(this).data('id')
			$.ajax({
				url: '<?= base_url('dashboard/rules/get'); ?>',
				data: {
					id: id
				},
				method: 'POST',
				dataType: 'JSON',
				success: function(data) {
					$('#modalRulesTitle').html('Ubah Rules ' + data.id);
					$('#idRules').val(data.id);
					$('#jawaban').val(data.jawaban_id).trigger('change');
					$('#komponen').val(data.komponen_id);
					$('#status').val(data.status);
				}
			})
		});
	});
</script>
