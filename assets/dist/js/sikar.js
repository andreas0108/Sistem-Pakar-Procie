$('.useradd').on('click', function () {
	$('#addUserModalTitle').html('Add User');
	$('.modal-footer button[type=button]').html('Cancel');
	$('.modal-footer button[type=submit]').show();
	$('.modal-footer button[type=submit]').html('Add User');
	$.ajax({
		success: function () {
			var blank = '';
			$('#menu').val(blank);
		}
	});
})

$('.btn-config-user').on('click', function () {

	$('#addUserModalTitle').html('User Details');
	$('.modal-footer button[type=submit]').hide();
	$('.modal-footer button[type=submit]').hide();
	$('#password1').hide();
	$('#password2').hide();
	$('.modal-footer button[type=button]').html('Cancel');

	const iduser = $(this).data('userid');
	const burl = $(this).data('baseurl');
	// console.log(iduser + ' ' + burl);
	$.ajax({
		url: burl + 'dashboard/user/getUser',
		data: {
			id: iduser
		},
		method: 'POST',
		dataType: 'JSON',
		success: function (data) {
			$('#iduser').val(data[0].id);
			$('#name').val(data[0].name);
			$('#email').val(data[0].email);
			$('#role_id').val(data[0].role_id);
		}
	});
});

// Sweet Alert Confirm
// Forgoy Password (WIP)
$('.forget_password').on('click', function (e) {
	Swal.fire({
		title: 'Forget my password',
		text: 'Silahkan masukan email anda',
		input: 'email',
		confirmButtonText: 'Reset Password'
	})
})

// Logout
$('.logout').on('click', function (e) {
	e.preventDefault();
	const href = $(this).attr('href');
	Swal.fire({
		title: 'Ready to Leave ?',
		text: 'Select "Logout" below if you are ready to end your current session.',
		type: 'question',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		confirmButtonText: 'Logout',
		cancelButtonColor: '#d33',
	}).then((result) => {
		if (result.value) {
			document.location.href = href;
		}
	});
})

// userman
$('.btn-remove-user').on('click', function (e) {
	e.preventDefault();
	const href = $(this).attr('href');
	const name = $(this).data('username');
	Swal.fire({
		title: 'Peringatan !',
		text: "Anda akan mengapus user " + name + ", apakah anda yakin ?",
		type: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		confirmButtonText: 'Hapus',
		cancelButtonColor: '#d33',
		cancelButtonText: 'Batal'
	}).then((result) => {
		if (result.value) {
			document.location.href = href;
		}
	});
})

// artikel
$('.btn-hapus-artikel').on('click', function (e) {
	e.preventDefault();
	const href = $(this).attr('href');
	Swal.fire({
		title: 'Peringatan !',
		text: "Artikel akan dihapus, apakah anda yakin ?",
		type: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		confirmButtonText: 'Hapus',
		cancelButtonColor: '#d33',
		cancelButtonText: 'Batal'
	}).then((result) => {
		if (result.value) {
			document.location.href = href;
		}
	});
})

// komponen
const flashData = $('.flash-data').data('flashdata');
if (flashData) {
	Swal.fire({
		title: 'Berhasil',
		text: flashData,
		type: 'success',
		timer: 3000
	})
}


$('.btn-remove').on('click', function (e) {
	e.preventDefault();
	const href = $(this).attr('href');
	const isi = $(this).data('text');
	Swal.fire({
		title: 'Peringatan !',
		text: isi + " akan dihapus, apakah anda yakin ?",
		type: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		confirmButtonText: 'Hapus',
		cancelButtonColor: '#d33',
		cancelButtonText: 'Batal'
	}).then((result) => {
		if (result.value) {
			document.location.href = href;
		}
	});
})
