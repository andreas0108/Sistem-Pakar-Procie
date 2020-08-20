<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

if (!function_exists('unix_indo')) {
	function unix_indo($tgl)
	{
		$x = explode("-", gmdate("d-m-Y", $tgl));
		return $x[0] . ' ' . bulan($x[1]) . ' ' . $x[2];
	}
}

if (!function_exists('unix_indoshort')) {
	function unix_indoshort($tgl)
	{
		$x = explode("-", gmdate("d-m-Y", $tgl));
		return $x[0] . '-' . medium_bulan($x[1]) . '-' . $x[2];
	}
}

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
	 * "tjs"  = 10 Desember 2019 10:20:30
	 * "htg"  = Selasa, 10 Desember 2019
	 * "htj"  = Selasa, 10 Desember 2019 10:20
	 * "htjs" = Selasa, 10 Desember 2019 10:20:30
	 */

	function unix_indo2($tgl, $format, $gmt7 = true)
	{
		if ($gmt7 == true) {
			$tgl = $tgl + (7 * 60 * 60);
		} else {
			$tgl = $tgl;
		}

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
				$x = explode("-", gmdate("d-m-Y", $tgl));
				return $x[0] . ' ' . bulan($x[1]) . ' ' . $x[2];
				break;

			case "tjs":
				$x = explode("-", gmdate("d-m-Y", $tgl));
				$b = $x[0] . ' ' . bulan($x[1]) . ' ' . $x[2];
				$c = gmdate("H:i:s", $tgl);
				return  $b . ' ' . $c;
				break;

			case "htg":
				$a = hari(gmdate("l", $tgl));
				$x = explode("-", gmdate("d-m-Y", $tgl));
				$b = $x[0] . ' ' . bulan($x[1]) . ' ' . $x[2];
				return $a . ', ' . $b;
				break;


			case "htjs":
				$a = hari(gmdate("l", $tgl));
				$x = explode("-", gmdate("d-m-Y", $tgl));
				$b = $x[0] . ' ' . bulan($x[1]) . ' ' . $x[2];
				$c = gmdate("H:i:s", $tgl);
				return $a . ', ' . $b . ' ' . $c;
				break;
		}
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

if (!function_exists('short_bulan')) { //tgl/bln/tahun
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


if (!function_exists('medium_bulan')) { // tgl-bln-thn
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
