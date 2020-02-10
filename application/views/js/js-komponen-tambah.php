<script>
	$(document).ready(function() {
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

		$('#isi').summernote({
			placeholder: 'Mulai tulis artikel.',
			fontNames: ['Arial', 'Comic Sans MS', 'Courier New', 'Helvetica', 'Times New Roman', 'Merriweather'],
			height: "200px",
			toolbar: [
				// [groupName, [list of button]]
				['fstyle', ['style', 'fontname', 'fontsize', 'paragraph']],
				['style', ['bold', 'italic', 'underline']],
				['color', ['color']],
				['para', ['ul', 'ol', 'table']],
				['insert', ['link']],
				['tools', ['undo', 'redo', 'codeview']],
				['tools2', ['fullscreen']]
			],
			callbacks: {
				onPaste: function(e) {
					var bufferText = ((e.originalEvent || e).clipboardData || window.clipboardData).getData('Text');
					e.preventDefault();
					bufferText = bufferText.replace(/\r?\n/g, '<br>');
					document.execCommand('insertHtml', true, bufferText);
				}
			}
		});
	});

	$('.inmask').inputmask();
</script>
