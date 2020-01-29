<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

if (!function_exists('unix_indo2')) {
	/** 
	 * Konversi UNIX Time stamp ke Tanggal Indonesia
	 * 
	 * 
	 * Format :
	 * Single Digit :
	 * "d" (detik) = 30
	 * "m" (menit) = 20
	 * "j" (jam)   = 10
	 * 
	 * "h" (hari)    = Selasa
	 * "t" (tanggal) = 10
	 * "b" (bulan)   = 12
	 * "T" (Tahun)   = 2019
	 * 
	 * Kombinasi
	 * "jm"  = 10:20
	 * "jam" = 10:20:30
	 * 
	 * "tgl"  = 10 Desember 2019
	 * "htg"  = Selasa, 10 Desember 2019
	 * "htj"  = Selasa, 10 Desember 2019 10:20
	 * "htjs" = Selasa, 10 Desember 2019 10:20:30
	 */

	function unix_indo2($tgl, $format)
	{
		switch ($format) {
				// Single Digit
			case "d":
				return gmdate("s", $tgl);
				break;

			case "m":
				return gmdate("i", $tgl);
				break;

			case "j":
				return gmdate("H", $tgl);
				break;

			case "h":
				return hari(gmdate("l", $tgl));
				break;

			case "t":
				return gmdate("n", $tgl);
				break;

			case "b":
				return bulan(gmdate("m", $tgl));
				break;

			case "T":
				return gmdate("Y", $tgl);
				break;

				// Kombinasi
			case "jm":
				return gmdate("H:i", $tgl);
				break;

			case "jam":
				return gmdate("H:i:s", $tgl);
				break;

			case "tgl":
				$x = explode("-", gmdate("n-m-Y", $tgl));
				return $x[0] . ' ' . bulan($x[1]) . ' ' . $x[2];
				break;

			case "htg":
				$a = hari(gmdate("l", $tgl));
				$x = explode("-", gmdate("n-m-Y", $tgl));
				$b = $x[0] . ' ' . bulan($x[1]) . ' ' . $x[2];
				return $a . ', ' . $b;
				break;

			case "htjs":
				$a = hari(gmdate("l", $tgl));
				$x = explode("-", gmdate("n-m-Y", $tgl));
				$b = $x[0] . ' ' . bulan($x[1]) . ' ' . $x[2];
				$c = gmdate("H:i:s", $tgl);
				return $a . ', ' . $b . ' ' . $c;
				break;
		}
	}
}

if (!function_exists('unix_indo')) {
	function unix_indo($tgl)
	{
		$catch = gmdate("n-m-Y", $tgl);
		$tgl = explode("-", $catch);

		return $tgl[0] . ' ' . bulan($tgl[1]) . ' ' . $tgl[2];
	}
}

if (!function_exists('unix_namahari')) {
	function unix_indohari($tgl)
	{
		$tggl = unix_indo($tgl);

		return hari(gmdate("l", $tgl)) . ', ' . $tggl;
	}
}

if (!function_exists('unix_harijam')) {
	function unix_harijam($tgl)
	{
		return gmdate("H:i:s", $tgl);
	}
}

if (!function_exists('tgl_indo')) {
	function date_indo($tgl)
	{
		$ubah = gmdate($tgl, time() + 60 * 60 * 8);
		$pisah = explode(" ", $ubah);
		$pecah = explode("-", $pisah[0]);
		$jam = $pisah[1];
		$tanggal = $pecah[2];
		$bulan = bulan($pecah[1]);
		$tahun = $pecah[0];
		return $tanggal . ' ' . $bulan . ' ' . $tahun;
	}
}

//Format Shortdate + jam
if (!function_exists('tgl_indo_jam')) {
	function date_indo_jam($tgl)
	{
		$ubah = gmdate($tgl, time() + 60 * 60 * 8);
		$pisah = explode(" ", $ubah);
		$pecah = explode("-", $pisah[0]);
		$jam = $pisah[1];
		$tanggal = $pecah[2];
		$bulan = bulan($pecah[1]);
		$tahun = $pecah[0];
		return $jam . ' ' . $tanggal . ' ' . $bulan . ' ' . $tahun;
	}
}

//Long date indo Format
if (!function_exists('longdate_indo')) {
	function longdate_indo($tanggal)
	{
		$ubah = gmdate($tanggal, time() + 60 * 60 * 8);
		$pisah = explode(" ", $ubah);
		$pecah = explode("-", $pisah[0]);
		$jam = $pisah[1];
		$tgl = $pecah[2];
		$bln = $pecah[1];
		$thn = $pecah[0];
		$bulan = bulan($pecah[1]);

		$nama = date("l", mktime(0, 0, 0, $bln, $tgl, $thn));
		$nama_hari = "";
		if ($nama == "Sunday") {
			$nama_hari = "Minggu";
		} else if ($nama == "Monday") {
			$nama_hari = "Senin";
		} else if ($nama == "Tuesday") {
			$nama_hari = "Selasa";
		} else if ($nama == "Wednesday") {
			$nama_hari = "Rabu";
		} else if ($nama == "Thursday") {
			$nama_hari = "Kamis";
		} else if ($nama == "Friday") {
			$nama_hari = "Jumat";
		} else if ($nama == "Saturday") {
			$nama_hari = "Sabtu";
		}
		return $nama_hari . ', ' . $tgl . ' ' . $bulan . ' ' . $thn . ' ' . $jam . ' WIB';
	}
}

if (!function_exists('hari')) {
	function hari($hri)
	{
		switch ($hri) {
			case "Sunday":
				return "Minggu";
				break;
			case "Monday":
				return "Senin";
				break;
			case "Tuesday":
				return "Selasa";
				break;
			case "Wednesday":
				return "Rabu";
				break;
			case "Thursday":
				return "Kamis";
				break;
			case "Friday":
				return "Jumat";
				break;
			case "Saturday":
				return "Sabtu";
				break;
		}
	}
}


if (!function_exists('bulan')) {
	function bulan($bln)
	{
		switch ($bln) {
			case 1:
				return "Januari";
				break;
			case 2:
				return "Februari";
				break;
			case 3:
				return "Maret";
				break;
			case 4:
				return "April";
				break;
			case 5:
				return "Mei";
				break;
			case 6:
				return "Juni";
				break;
			case 7:
				return "Juli";
				break;
			case 8:
				return "Agustus";
				break;
			case 9:
				return "September";
				break;
			case 10:
				return "Oktober";
				break;
			case 11:
				return "November";
				break;
			case 12:
				return "Desember";
				break;
		}
	}
}

//Format Shortdate
if (!function_exists('shortdate_indo')) {
	function shortdate_indo($tgl)
	{
		$ubah = gmdate($tgl, time() + 60 * 60 * 8);
		$pisah = explode(" ", $ubah);
		$pecah = explode("-", $pisah[0]);
		$jam = $pisah[1];
		$tanggal = $pecah[2];
		$bulan = short_bulan($pecah[1]);
		$tahun = $pecah[0];
		return $tanggal . '/' . $bulan . '/' . $tahun;
	}
}

if (!function_exists('short_bulan')) {
	function short_bulan($bln)
	{
		switch ($bln) {
			case 1:
				return "01";
				break;
			case 2:
				return "02";
				break;
			case 3:
				return "03";
				break;
			case 4:
				return "04";
				break;
			case 5:
				return "05";
				break;
			case 6:
				return "06";
				break;
			case 7:
				return "07";
				break;
			case 8:
				return "08";
				break;
			case 9:
				return "09";
				break;
			case 10:
				return "10";
				break;
			case 11:
				return "11";
				break;
			case 12:
				return "12";
				break;
		}
	}
}

//Format Medium date
if (!function_exists('mediumdate_indo')) {
	function mediumdate_indo($tgl)
	{
		$ubah = gmdate($tgl, time() + 60 * 60 * 8);
		$pisah = explode(" ", $ubah);
		$pecah = explode("-", $pisah[0]);
		$jam = $pisah[1];
		$tanggal = $pecah[2];
		$bulan = medium_bulan($pecah[1]);
		$tahun = $pecah[0];
		return $tanggal . '-' . $bulan . '-' . $tahun;
	}
}

if (!function_exists('medium_bulan')) {
	function medium_bulan($bln)
	{
		switch ($bln) {
			case 1:
				return "Jan";
				break;
			case 2:
				return "Feb";
				break;
			case 3:
				return "Mar";
				break;
			case 4:
				return "Apr";
				break;
			case 5:
				return "Mei";
				break;
			case 6:
				return "Jun";
				break;
			case 7:
				return "Jul";
				break;
			case 8:
				return "Ags";
				break;
			case 9:
				return "Sep";
				break;
			case 10:
				return "Okt";
				break;
			case 11:
				return "Nov";
				break;
			case 12:
				return "Des";
				break;
		}
	}
}
