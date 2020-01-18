<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="<?= base_url('assets/'); ?>plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?= base_url('assets/'); ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables -->
<script src="<?= base_url('assets/'); ?>plugins/datatables/jquery.dataTables.js"></script>
<script src="<?= base_url('assets/'); ?>plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
<!-- Sweet Alert App -->
<script src="<?= base_url('assets/'); ?>plugins/sweetalert2/sweetalert2.all.min.js"></script>
<!-- AdminLTE App -->
<script src="<?= base_url('assets/'); ?>dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?= base_url('assets/'); ?>dist/js/demo.js"></script>
<!-- Ganjuran4 Custom JS -->
<script src="<?= base_url('assets/'); ?>dist/js/sikar.js"></script>

<script>
	$(function() {
		$("#example1").DataTable();
		$('#example2').DataTable({
			"paging": false,
			"lengthChange": false,
			"searching": false,
			"ordering": true,
			"info": true,
			"autoWidth": false,
		});
		$('#example3').DataTable({
			"paging": true,
			"lengthChange": false,
			"searching": false,
			"ordering": true,
			"info": true,
			"autoWidth": false,
		});
		$("#tablekomponen").DataTable({
			"ordering": false,
		});
	});

	$('.custom-file-input').on('change', function() {
		let fileName = $(this).val().split('\\').pop();
		$(this).next('.custom-file-label').addClass("Selected").html(fileName);
	});

	$('.form-check-input').on('click', function() {
		const menuID = $(this).data('menu');
		const roleID = $(this).data('role');

		$.ajax({
			url: "<?= base_url('dashboard/home/chaccess'); ?>",
			type: 'POST',
			data: {
				menuID: menuID,
				roleID: roleID
			},
			success: function() {
				document.location.href = "<?= base_url('dashboard/home/roleconfig/'); ?>" + roleID;
			}
		});
	});
</script>
