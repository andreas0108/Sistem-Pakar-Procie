<script>
	$(document).ready(function() {
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
			selector: 'textarea#isi',
			height: 500,
			plugins: [
				"advlist autolink lists link image charmap print preview anchor",
				"searchreplace visualblocks code fullscreen",
				"insertdatetime media table paste imagetools wordcount"
			],
			toolbar: "undo redo | styleselect | bold italic underline| alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image insertfile",
			// plugins: [
			// 	"advlist autolink lists link image charmap print preview hr anchor pagebreak",
			// 	"searchreplace wordcount visualblocks visualchars code fullscreen",
			// 	"insertdatetime nonbreaking save table contextmenu directionality",
			// 	"emoticons template paste textcolor colorpicker textpattern"
			// ],
			// toolbar: "insertfile undo redo | styleselect | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image responsivefilemanager",
			toolbar_mode: 'floating',
			tinycomments_mode: 'embedded',
			tinycomments_author: 'Author name',
			image_advtab: true,
			images_upload_url: "<?= base_url("dashboard/article/tinymce_upload") ?>",
			file_picker_types: 'image',
			paste_data_images: true,
			relative_urls: false,
			remove_script_host: false,
			file_picker_callback: function(cb, value, meta) {
				var input = document.createElement('input');
				input.setAttribute('type', 'file');
				input.setAttribute('accept', 'image/*');
				input.onchange = function() {
					var file = this.files[0];
					var reader = new FileReader();
					reader.readAsDataURL(file);
					reader.onload = function() {
						var id = 'post-image-' + (new Date()).getTime();
						var blobCache = tinymce.activeEditor.editorUpload.blobCache;
						var blobInfo = blobCache.create(id, file, reader.result);
						blobCache.add(blobInfo);
						cb(blobInfo.blobUri(), {
							title: file.name
						});
					};
				};
				input.click();
			}
		});


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
				},
				onPaste: function(e) {
					var bufferText = ((e.originalEvent || e).clipboardData || window.clipboardData).getData('Text');
					e.preventDefault();
					bufferText = bufferText.replace(/\r?\n/g, '<br>');
					document.execCommand('insertHtml', true, bufferText);
				}
			}
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