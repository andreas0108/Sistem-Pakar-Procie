<script>
	// menu side //
	$('.modalAddMenu').on('click', function() {
		$('#menuModalTitle').html('Add Menu');
		$('.modal-footer button[type=submit]').html('Add Menu');
		$('.modal-content form').attr('action', '<?= base_url('dashboard/menu'); ?>');
		$.ajax({
			success: function() {
				var blank = '';
				$('#menu').val(blank);
			}
		});
	});

	$('.modalEditMenu').on('click', function() {

		$('#menuModalTitle').html('Edit Menu');
		$('.modal-footer button[type=submit]').html('Save Menu');
		$('.modal-content form').attr('action', '<?= base_url('dashboard/menu/editMenu'); ?>');

		const idmenu = $(this).data('menuid');
		$.ajax({
			url: '<?= base_url('dashboard/menu/getMenu'); ?>',
			data: {
				id: idmenu
			},
			method: 'POST',
			dataType: 'JSON',
			success: function(data) {
				$('#idmenu').val(data[0].id);
				$('#menu').val(data[0].menu);
			}
		});
	});


	// menu side end //

	// submenu begin //																																		
	$('.subMenuAdd').on('click', function() {
		$('#addSubMenuModalTitle').html('Add New Sub Menu')
		$('.modal-footer button[type=submit]').html('Add Sub Menu');
		$('.modal-content form').attr('action', '<?= base_url('dashboard/menu/subMenu'); ?>');
		$.ajax({
			success: function() {
				var blank = '';
				$('#idsubmenu').val(blank);
				$('#submenutitle').val(blank);
				$('#menu_id').val(blank);
				$('#submenuurl').val(blank);
				$('#submenuicon').val(blank);
			}
		});
	});

	$('.subMenuEdit').on('click', function() {
		$('#addSubMenuModalTitle').html('Edit Sub Menu')
		$('.modal-footer button[type=submit]').html('Save Sub Menu');
		$('.modal-content form').attr('action', '<?= base_url('dashboard/menu/editSubMenu'); ?>');

		const idsubmenu = $(this).data('submenuid')
		console.log('id = ' + idsubmenu);
		$.ajax({
			url: '<?= base_url('dashboard/menu/getSubMenu'); ?>',
			data: {
				id: idsubmenu
			},
			method: 'POST',
			dataType: 'JSON',
			success: function(data) {
				$('#idsubmenu').val(data[0].id);
				$('#submenutitle').val(data[0].title);
				$('#menu_id').val(data[0].menu_id);
				$('#submenuurl').val(data[0].url);
				$('#submenuicon').val(data[0].icon);
			}
		});
	});
	// submenu end //
</script>
