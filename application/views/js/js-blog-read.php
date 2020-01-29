<script>
	$('.image-gallery').magnificPopup({
		delegate: 'a',
		type: 'image',
		removalDelay: 300,
		gallery: {
			enabled: true,
		},
		mainClass: 'mfp-with-zoom',
		zoom: {
			enabled: true,
			duration: 300,
			easing: 'ease-in-out',
			opener: function(openerElement) {
				return openerElement.is('img') ? openerElement : openerElement.find('img');
			}
		}
	});
</script>
