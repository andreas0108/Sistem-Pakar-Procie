"use strict";

// Setting Color

$(window).resize(function () {
	$(window).width();
});

$("#showTable").DataTable({
	ordering: false,
	autoWidth: false,
});

$(".useradd").on("click", function () {
	$("#addUserModalTitle").html("Add User");
	$(".modal-footer button[type=button]").html("Cancel");
	$(".modal-footer button[type=submit]").show();
	$(".modal-footer button[type=submit]").html("Add User");
	$.ajax({
		success: function () {
			var blank = "";
			$("#menu").val(blank);
		},
	});
});

$(".btn-config-user").on("click", function () {
	$("#addUserModalTitle").html("User Details");
	$(".modal-footer button[type=submit]").hide();
	$(".modal-footer button[type=submit]").hide();
	$("#password1").hide();
	$("#password2").hide();
	$(".modal-footer button[type=button]").html("Cancel");

	const iduser = $(this).data("userid");
	const burl = $(this).data("baseurl");
	// console.log(iduser + ' ' + burl);
	$.ajax({
		url: burl + "dashboard/user/getUser",
		data: {
			id: iduser,
		},
		method: "POST",
		dataicon: "JSON",
		success: function (data) {
			$("#iduser").val(data[0].id);
			$("#name").val(data[0].name);
			$("#email").val(data[0].email);
			$("#role_id").val(data[0].role_id);
		},
	});
});

// Sweet Alert Confirm
// Forgoy Password (WIP)
$(".forget_password").on("click", function (e) {
	Swal.fire({
		title: "Forget my password",
		text: "Silahkan masukan email anda",
		input: "email",
		confirmButtonText: "Reset Password",
	});
});

// Logout
$(".logout").on("click", function (e) {
	e.preventDefault();
	const href = $(this).attr("href");
	Swal.fire({
		title: "Akhiri Sesi ?",
		text: "Pilih Logout untuk mengakhiri sesi.",
		icon: "question",
		showCancelButton: true,
		confirmButtonColor: "#3085d6",
		confirmButtonText: "Logout",
		cancelButtonColor: "#d33",
		cancelButtonText: "Batal",
	}).then((result) => {
		if (result.value) {
			document.location.href = href;
		}
	});
});

// userman
$(".btn-remove-user").on("click", function (e) {
	e.preventDefault();
	const href = $(this).attr("href");
	const name = $(this).data("username");
	Swal.fire({
		title: "Peringatan !",
		text: "Anda akan mengapus user " + name + ", apakah anda yakin ?",
		icon: "warning",
		showCancelButton: true,
		confirmButtonColor: "#3085d6",
		confirmButtonText: "Hapus",
		cancelButtonColor: "#d33",
		cancelButtonText: "Batal",
	}).then((result) => {
		if (result.value) {
			document.location.href = href;
		}
	});
});

// komponen
const flashData = $(".flash-data").data("flashdata");
if (flashData) {
	Swal.fire({
		title: "Berhasil",
		text: flashData,
		icon: "success",
		timer: 3000,
	});
}

const flashError = $(".flash-err").data("flasherror");
if (flashError) {
	Swal.fire({
		title: "ERROR",
		icon: "error",
		html: flashError,
	});
}

const flashInfo = $(".flash-info").data("flashinf");
if (flashInfo) {
	Swal.fire({
		title: "Informasi",
		icon: "info",
		html: flashInfo,
	});
}

const flashForme = $(".flash-data").data("forme");
if (flashForme) {
	Swal.fire({
		title: "ERROR",
		icon: "error",
		html: flashForme,
	});
}

$(".btn-remove").on("click", function (e) {
	e.preventDefault();
	const href = $(this).attr("href");
	const isi = $(this).data("text");
	Swal.fire({
		title: "Peringatan !",
		text: isi + " akan dihapus, apakah anda yakin ?",
		icon: "warning",
		showCancelButton: true,
		confirmButtonColor: "#3085d6",
		confirmButtonText: "Hapus",
		cancelButtonColor: "#d33",
		cancelButtonText: "Batal",
	}).then((result) => {
		if (result.value) {
			document.location.href = href;
		}
	});
});

$(".btn-reset").on("click", function (e) {
	e.preventDefault();
	const href = $(this).attr("href");
	Swal.fire({
		title: "Peringatan !",
		text: "System akan di-reset, apakah anda yakin ?",
		html:
			"<i>Data yang hilang akibat proses ini<br>tidak dapat dikembalikan.<br>Pastikan anda melakukan<br>backup manual terlebih dahulu.</i>",
		icon: "warning",
		showCancelButton: true,
		confirmButtonColor: "#3085d6",
		confirmButtonText: "Proses",
		cancelButtonColor: "#d33",
		cancelButtonText: "Batal",
	}).then((result) => {
		if (result.value) {
			document.location.href = href;
		}
	});
});

var toggle_customSidebar = false,
	custom_open = 0;

if (!toggle_customSidebar) {
	var toggle = $(".custom-template .custom-toggle");

	toggle.on("click", function () {
		if (custom_open == 1) {
			$(".custom-template").removeClass("open");
			toggle.removeClass("toggled");
			custom_open = 0;
		} else {
			$(".custom-template").addClass("open");
			toggle.addClass("toggled");
			custom_open = 1;
		}
	});
	toggle_customSidebar = true;
}

function check() {
	var bte = document.getElementById("submite");
	var btp = document.getElementById("submitp");
	var bta = document.getElementById("submita");

	if (emailb.value != "") {
		bte.disabled = false;
	} else if (password1.value != "" && password2.value != "") {
		btp.disabled = false;
	} else {
		btp.disabled = true;
		bte.disabled = true;
	}

	if (emailb.value != "" && password2.value != "") {
		if (password1.value != password2.value && cpassword.value != "") {
			$("#submita").removeClass("animated fadeIn").addClass("animated fadeOut");
		} else {
			$("#submita").removeClass("animated fadeOut").addClass("animated fadeIn");
			bta.hidden = false;
		}
	} else {
		$("#submita").removeClass("animated fadeIn").addClass("animated fadeOut");
	}
}

const label = $("#dailySalesChart").data("label");
const jumlah = $("#dailySalesChart").data("jumlah");

// console.log(label);
// console.log(jumlah);

var dailySalesChart = document
	.getElementById("dailySalesChart")
	.getContext("2d");
var myDailySalesChart = new Chart(dailySalesChart, {
	type: "line",
	data: {
		labels: label,
		datasets: [
			{
				label: "Jumlah Konsultasi",
				fill: !0,
				backgroundColor: "rgba(255,255,255,0.2)",
				borderColor: "#fff",
				borderCapStyle: "butt",
				borderDash: [],
				borderDashOffset: 0,
				pointBorderColor: "#fff",
				pointBackgroundColor: "#fff",
				pointBorderWidth: 1,
				pointHoverRadius: 5,
				pointHoverBackgroundColor: "#fff",
				pointHoverBorderColor: "#fff",
				pointHoverBorderWidth: 1,
				pointRadius: 1,
				pointHitRadius: 5,
				data: jumlah,
			},
		],
	},
	options: {
		maintainAspectRatio: !1,
		legend: {
			display: !1,
		},
		animation: {
			easing: "easeInOutBack",
		},
		scales: {
			yAxes: [
				{
					display: !1,
					ticks: {
						fontColor: "rgba(0,0,0,0.5)",
						fontStyle: "bold",
						beginAtZero: !0,
						maxTicksLimit: 10,
						padding: 0,
					},
					gridLines: {
						drawTicks: !1,
						display: !1,
					},
				},
			],
			xAxes: [
				{
					display: !1,
					gridLines: {
						zeroLineColor: "transparent",
					},
					ticks: {
						padding: -20,
						fontColor: "rgba(255,255,255,0.2)",
						fontStyle: "bold",
					},
				},
			],
		},
	},
});
