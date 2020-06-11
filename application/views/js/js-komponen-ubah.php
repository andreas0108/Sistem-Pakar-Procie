<script>
	$(document).ready(function() {
		$(document).on("click", ".browse", function() {
			var file = $(this).parents().find(".file");
			file.trigger("click");
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

		$('input[type="file"]').change(function(e) {
			document.getElementById('preview').hidden = false;
			var fileName = e.target.files[0].name;
			$("#file").val(fileName);

			var reader = new FileReader();
			reader.onload = function(e) {
				// get loaded data and render thumbnail.
				document.getElementById("preview").src = e.target.result;
			};
			// read the image file as a data URL.
			reader.readAsDataURL(this.files[0]);
		});

		// TinyMCE
		tinymce.init({
			selector: '#isi',
			height: 500,

			// menu & toolbar
			plugins: [
				'print preview paste importcss searchreplace autolink autosave save directionality code visualblocks visualchars',
				'fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime',
				'advlist lists wordcount imagetools textpattern noneditable help charmap quickbars emoticons tinydrive'
			],
			// menubar: 'file edit view insert format tools table help',
			toolbar1: 'undo redo | fontselect fontsizeselect formatselect | bold italic underline strikethrough link | alignleft aligncenter alignright alignjustify | numlist bullist | outdent indent | restoredraft toc',
			menubar: false,
			statusbar: false,
			toolbar_mode: 'floating',

			// mobile
			mobile: {
				theme: 'mobile',
				plugins: 'autosave lists autolink link',
				toolbar: 'undo redo bold italic underline bullist numlist styleselect link'
			},

			// images
			image_advtab: true,
			paste_data_images: true,

			// autosave
			autosave_interval: '10s',
			autosave_prefix: 'sikar-autosave-{path}{query}-{id}-',

			// tinydrive
			tinydrive_token_provider: '<?= base_url("dashboard/article/jwten") ?>',
			tinydrive_upload_path: '/sikar/komponen'
		});
	});

	$('.inmask').inputmask();
</script>