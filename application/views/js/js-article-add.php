<script>
	$(document).ready(function() {
		$('.single').select2({
			tagClass: 'badge-primary',
			theme: "bootstrap",
			minimumResultsForSearch: Infinity
		});

		$('#tagsinput').tagsinput({
			tagClass: 'badge-info'
		});

		$(document).on("click", ".browse", function() {
			var file = $(this).parents().find(".file");
			file.trigger("click");
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
			menubar: 'file edit view insert format tools table help',
			toolbar1: 'fontselect fontsizeselect formatselect | bold italic underline strikethrough | alignleft aligncenter alignright alignjustify | outdent indent | restoredraft toc',
			toolbar2: 'undo redo | insertfile image media link | numlist bullist | forecolor backcolor removeformat | pagebreak | charmap emoticons | fullscreen preview save print | code | codesample | anchor',
			statusbar: false,
			toolbar_mode: 'floating',

			// mobile
			mobile: {
				theme: 'mobile',
				plugins: 'autosave lists autolink image tinydrive link',
				toolbar: 'undo redo bold italic underline bullist numlist styleselect insertfile image link'
			},

			// images
			image_advtab: true,
			paste_data_images: true,

			// autosave
			autosave_interval: '10s',
			autosave_prefix: 'sikar-autosave-{path}{query}-{id}-',

			// tinydrive

			tinydrive_token_provider: '<?= base_url("dashboard/article/jwten") ?>',
			tinydrive_upload_path: '/sikar/article'

			// images_upload_url: "<?= base_url("dashboard/article/tinymce_upload") ?>",
			// file_picker_types: 'image',
			// paste_data_images: true,
			// relative_urls: false,
			// remove_script_host: false,
			// file_picker_callback: function(cb, value, meta) {
			// 	var input = document.createElement('input');
			// 	input.setAttribute('type', 'file');
			// 	input.setAttribute('accept', 'image/*');
			// 	input.onchange = function() {
			// 		var file = this.files[0];
			// 		var reader = new FileReader();
			// 		reader.readAsDataURL(file);
			// 		reader.onload = function() {
			// 			var id = 'IMG' + (new Date()).getTime();
			// 			var blobCache = tinymce.activeEditor.editorUpload.blobCache;
			// 			var blobInfo = blobCache.create(id, file, reader.result);
			// 			blobCache.add(blobInfo);
			// 			cb(blobInfo.blobUri(), {
			// 				title: file.name
			// 			});
			// 		};
			// 	};
			// 	input.click();
			// },
		});

		function uploadImage(image) {
			let out = new FormData();
			out.append("image", image, image.name);
			$.ajax({
				data: out,
				type: "POST",
				url: "<?= base_url('dashboard/article/upload_imga') ?>",
				cache: false,
				contentType: false,
				processData: false,
				success: function(img) {
					$('#article-sum').summernote("insertImage", img);
				},
				error: function(jqXHR, textStatus, errorThrown) {
					console.error(textStatus + " " + errorThrown);
				}
			});
		};

		function deleteImage(src) {
			$.ajax({
				data: {
					src: src
				},
				type: "POST",
				url: "<?php echo site_url('dashboard/article/delete_imga') ?>",
				cache: false,
				success: function(response) {
					console.log(response);
				}
			});
		};
	});
</script>