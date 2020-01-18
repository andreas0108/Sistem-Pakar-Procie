<script>
	$('.btn-config-user').on('click', function() {

		$('#addUserModalTitle').html('User Details');
		$('.modal-footer button[type=submit]').hide();
		$('.modal-footer button[type=submit]').hide();
		$('#password1').hide();
		$('#password2').hide();
		$('.modal-footer button[type=button]').html('Cancel');

		const iduser = $(this).data('userid');
		$.ajax({
			url: <?= base_url('dashboard/user/getUser'); ?>,
			data: {
				id: iduser
			},
			method: 'POST',
			dataType: 'JSON',
			success: function(data) {
				$('#iduser').val(data[0].id);
				$('#name').val(data[0].name);
				$('#name').val(data[0].name);
				$('#email').val(data[0].email);
			}
		});
	});


	// menu side end //
</script>
