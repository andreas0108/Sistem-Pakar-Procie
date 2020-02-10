<script>
	$('#tambahRules').on('click', function() {
		$('#modalRulesTitle').html('Tambah Rules');
		$('.modal-content form').attr('action', '<?= base_url('dashboard/rules') ?>');
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

		const id = $(this).data('id')
		console.log(id)
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
				$('#jawaban').val(data.jawaban_id);
				$('#komponen').val(data.komponen_id);
				$('#status').val(data.status);
			}
		})
	});
</script>
