<script>
	$(document).ready(function() {
		// Summernote
		$('#article-sum').summernote({
			placeholder: 'Mulai tulis artikel.',
			fontNames: ['Arial', 'Comic Sans MS', 'Courier New', 'Helvetica', 'Times New Roman', 'Merriweather'],
			height: "450px",
			toolbar: [
				// [groupName, [list of button]]
				['fstyle', ['style', 'fontname', 'fontsize', 'paragraph']],
				['style', ['bold', 'italic', 'underline']],
				['color', ['color']],
				['para', ['ul', 'ol', 'table']],
				['insert', ['link', 'picture', 'video']],
				['tools', ['undo', 'redo', 'codeview']],
				['tools2', ['fullscreen']]
			],
			callbacks: {
				onImageUpload: function(image) {
					for (let i = 0; i < image.length; i++) {
						uploadImage(image[i]);
					}
				},
				onMediaDelete: function(target) {
					deleteImage(target[0].src);
				}
			}
		});

		function uploadImage(image) {
			let out = new FormData();
			out.append("image", image, image.name);
			$.ajax({
				data: out,
				type: "POST",
				url: "<?= base_url('dashboard/content/upload_imga') ?>",
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
				url: "<?php echo site_url('dashboard/content/delete_imga') ?>",
				cache: false,
				success: function(response) {
					console.log(response);
				}
			});
		};

		bsCustomFileInput.init();
	});
</script>
