<div class="container">
	<!-- Begin 403 Page Content -->
	<div class="container-fluid" class="d-flex flex-column">

		<!-- 404 Error Text -->
		<div class="text-center mx-auto" style="margin: 25vh">
			<div class="error" data-text="403" style="margin: 0 auto 0 auto">403</div>
			<p class=" lead text-gray-800 mb-5">Access Forbidden</p>
			<p class="text-gray-500 mb-0">You don't have any authorization to access this page!</p>
			<a href="<?= base_url('dashboard/user') ?>">&larr; Back to Dashboard</a>
			<?= var_dump('userAccess') ?>
		</div>

	</div>
</div>
<!-- End of Main Content -->
