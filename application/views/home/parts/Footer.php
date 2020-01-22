</body>
<!-- Contact Section -->
<section class="contact-section bg-black">
	<div class="social d-flex justify-content-center">
		<a href="https://twitter.com/andreasardinp" class="mx-2">
			<i class="fab fa-twitter"></i>
		</a>
		<a href="https://instagram.com/andreasardinp" class="mx-2">
			<i class="fab fa-instagram"></i>
		</a>
		<a href="https://github.com/andreas0108" class="mx-2">
			<i class="fab fa-github"></i>
		</a>
	</div>
</section>
<!-- Footer -->
<footer class="bg-black small text-center text-white-50">
	<div class="container">
		<p class="mb-0">Copyright &copy; <?= $appname ?></a> 2019</p>
		<p class="mb-0">The use of the <a href="https://www.intel.com">Intel</a> & <a href="https://www.amd.com">AMD</a> logo in both names and brands is the property of their respective owners.</p>
		<p class="text-info"><a href="<?= base_url('login') ?>" target="_blank" rel="noopener noreferrer">(Login)</a></p>
	</div>
</footer>

<!-- Bootstrap core JavaScript -->
<script src="<?= base_url() ?>assets/front/vendor/jquery/jquery.min.js"></script>
<script src="<?= base_url() ?>assets/front/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Plugin JavaScript -->
<script src="<?= base_url() ?>assets/front/vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for this template -->
<script src="<?= base_url() ?>assets/front/js/grayscale.min.js"></script>
<!-- Include SmartWizard JavaScript source -->
<script type="text/javascript" src="<?= base_url() ?>assets/front/vendor/SmartWizard/dist/js/jquery.smartWizard.min.js"></script>
<!-- Include jQuery Validator plugin -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/1000hz-bootstrap-validator/0.11.5/validator.min.js"></script>

<script type="text/javascript">
	$(document).ready(function() {

		// Toolbar extra buttons
		var btnCancel = $('<button></button>').text('Reset')
			.addClass('btn btn-danger')
			.on('click', function() {
				$('#smartwizard').smartWizard("reset");
			});

		// Smart Wizard
		$('#smartwizard').smartWizard({
			selected: 0,
			theme: 'default',
			transitionEffect: 'slide',
			toolbarSettings: {
				toolbarPosition: 'bottom',
				toolbarExtraButtons: [btnCancel]
			},
			anchorSettings: {
				markDoneStep: true, // add done css
				markAllPreviousStepsAsDone: false, // When a step selected by url hash, all previous steps are marked done
				removeDoneStepOnNavigateBack: false, // While navigate back done step after active step will be cleared
				enableAnchorOnDoneStep: true // Enable/Disable the done steps navigation
			},
			lang: { // Language variables
				next: 'Selanjutnya',
				previous: 'Sebelumnya'
			},
		});

		$("#smartwizard").on("leaveStep", function(e, anchorObject, stepNumber, stepDirection) {
			var elmForm = $("#form-step-" + stepNumber);
			// stepDirection === 'forward' :- this condition allows to do the form validation
			// only on forward navigation, that makes easy navigation on backwards still do the validation when going next
			if (stepDirection === 'forward' && elmForm) {
				elmForm.validator('validate');
				var elmErr = elmForm.children('.has-error');
				if (elmErr && elmErr.length > 0) {
					// Form validation failed
					return false;
				}
			}
			return true;
		});

	});
</script>

</html>
