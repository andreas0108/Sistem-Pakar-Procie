<script>
	$("#login-form").validate({
		rules: {
			confirmpassword: {
				equalTo: "#password"
			}
		},
		highlight: function(element) {
			$(element).closest('.form-group').removeClass('has-success').addClass('has-error');
		},
		success: function(element) {
			$(element).closest('.form-group').removeClass('has-error').addClass('has-success');
		},
	});
</script>
