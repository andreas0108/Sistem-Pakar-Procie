<script>
	$(document).ready(function() {
		$('#modalRules').modal({
			show: false,
			keyboard: false,
			backdrop: 'static'
		});

		$('.multi').select2({
			closeOnSelect: false,
			tagClass: 'badge-primary',
			theme: "bootstrap"
		});

		$('.single').select2({
			tagClass: 'badge-primary',
			theme: "bootstrap",
			minimumResultsForSearch: Infinity
		});

		// Rules Pertanyaan
		$('#tambahRulesP').on('click', function() {
			$('#modalRulesPTitle').html('Tambah Rules Pertanyaan');
			$('.modal-content form').attr('action', '<?= base_url('dashboard/rules/tambahP') ?>');
			// $('.jawaban').hide();
			// $('.jawabans').show();
			$.ajax({
				success: function() {
					var blank = '';
					$('#idRulesp').val(blank);
					$('#rulesjid').val("<?= $this->input->post('rulesjid') ?>");
					$('#rulespid').val("<?= $this->input->post('rulespid') ?>");
				}
			})
		});

		$('.ubahRulesP').on('click', function() {
			$('#modalRulesPTitle').html('Ubah Rules Pertanyaan');
			$('.modal-content form').attr('action', '<?= base_url('dashboard/rules/ubahP') ?>');
			// $('.jawaban').show();
			// $('.jawabans').hide();

			const id = $(this).data('id')
			$.ajax({
				url: '<?= base_url('dashboard/rules/getP'); ?>',
				data: {
					id: id
				},
				method: 'POST',
				dataType: 'JSON',
				success: function(data) {
					$('#modalRulesPTitle').html('Ubah Rules Pertanyaan ' + data.jawaban_id);
					$('#idRulesp').val(data.id);
					$('#rulesjid').val(data.jawaban_id).trigger('change');
					$('#rulespid').val(data.next_pertanyaan).trigger('change');
				}
			})
		});


		// Rules Jawaban
		$('.tambahRules').on('click', function() {
			$('#modalRulesTitle').html('Tambah Rules Hasil');
			$('.modal-content form').attr('action', '<?= base_url('dashboard/rules') ?>');
			$('.jawabans').show();
			$('.jawaban').hide();
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
					$('#modalRulesTitle').html('Ubah Rules Hasil ' + data.id);
					$('#idRules').val(data.id);
					$('#jawaban').val(data.jawaban_id).trigger('change');
					$('#komponen').val(data.komponen_id).trigger('change');
					$('#status').val(data.status);
				}
			})
		});
	});
</script>