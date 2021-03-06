<?php
defined('BASEPATH') or exit('No direct script access allowed');

// Login checker
function is_logged_in()
{
	$ci = get_instance();
	if (!$ci->session->userdata('email')) {
		$ci->session->set_flashdata(
			'flashinf',
			'Silahkan login sebagai Administrator'
		);
		redirect('login');
	}
}

// Fungsi menambahkan data logs
function logs($msg, $item = null)
{
	/**
	 *  Penggunaan : logs("pesan", "data pesan");
	 *  Penggunaan : logs("pesan", $id);
	 *  Penggunaan : logs("pesan", null);
	 */

	$CI = get_instance();
	if ($item != null) {
		$item = "'" . $item . "'";
	} else {
		$item = '';
	}

	$log_item = count($CI->db->get('log')->result_array());

	$CI->db->limit(1);
	$temp = $CI->db->get('log')->row_array();

	if ($CI->session->userdata('email')) {
		$x = $CI->db->get_where('user', ['id' => $CI->session->userdata['id']])->row_array();
		$by = $x['name'];
	} else {
		$by = 'User';
	}

	if ($log_item == 100) {
		$CI->db->delete('log', ['id' => $temp['id']]);
		$CI->db->insert('log', [
			'keterangan' => $msg . ' ' . $item,
			'user' => $by,
			'tgl_data' => time()
		]);
	} else {
		$CI->db->insert('log', [
			'keterangan' => $msg . ' ' . $item,
			'user' => $by,
			'tgl_data' => time()
		]);
	}
}

// Prototype Core Sistem Pakar //
// Tidak Digunakan dikarenakan langsung di controller //
// Hanya untuk dokumentasi //
// By ANDREAS ARDI //
function think($me)
{
	$datamasuk = "'" . arrtostr($me) . "'";
	$jumlah_data = count($me);

	$CI = get_instance();

	$x = "SELECT rules.komponen_id, komponen.name
				FROM rules JOIN komponen ON rules.komponen_id = komponen.id
				WHERE jawaban_id IN ($datamasuk)
			GROUP BY komponen_id
			  HAVING COUNT(DISTINCT jawaban_id) = $jumlah_data;
		";
	return $CI->db->query($x)->row_array();
}

// UNIQUE ID GENERATOR 
// By ANDREAS ARDI
function getUniqueID()
{
	$CI = get_instance();
	$now = gmdate('Ymd', time() + (7 * 60 * 60));

	$CI->db->select_max('id', 'id');
	$x = $CI->db->get_where('history', ['LEFT(id,8)' => $now])->row_array();

	$id = sprintf(
		"%04s",
		intval(
			substr($x['id'], 8)
		) + 1
	);
	return $now . $id;
}

function generateID($tab, $col = 'id', $prefix = null, $selector = 1)
{
	/**
	 *  $col = coloumn where you search max id
	 *  $tab = table that $col using for
	 *  $selector = the start position char to trim that $col using for
	 */
	$CI = get_instance();


	$prefix = substr($prefix, 0, $selector);
	$CI->db->select_max($col, $col);
	$data = $CI->db->get_where($tab, ['left(' . $col . ',' . $selector . ')' => $prefix])->row_array();

	$id = sprintf(
		"%02s",
		intval(
			substr($data[$col], $selector)
		) + 1
	);

	$hasil = $prefix . $id;

	return $hasil;
}

function generateDateID($tab, $col = 'id')
{
	$CI = get_instance();

	$prefix = date('Ymd', time());
	$CI->db->select_max($col, $col);
	$data = $CI->db->get_where($tab, ['left(' . $col . ',8)' => $prefix])->row_array();

	$id = sprintf(
		"%02s",
		intval(
			substr($data[$col], 8)
		) + 1
	);

	$hasil = $prefix . $id;
	return $hasil;
}
function generateUniqueID($tab, $col = 'id')
{
	$CI = get_instance();

	$prefix = date('YmdHis', (time() + 7 * 3600));
	$CI->db->select_max($col, $col);
	$data = $CI->db->get_where($tab, ['left(' . $col . ',8)' => $prefix])->row_array();

	$id = sprintf(
		"%02s",
		intval(
			substr($data[$col], 8)
		) + 1
	);

	$hasil = $prefix . $id;
	return $hasil;
}

function generateUniqueString()
{
	$date = date('Ymd', (time() + 7 * 3600));
	$rstr = strtoupper(base64_encode(random_bytes(3)));

	return $date . $rstr;
}

function arrtostr($arr, $sep = ', ', $mkp = '')
{
	$str = '';
	foreach ($arr as $val) {
		$str .= $mkp . implode($sep, $val) . $mkp;
		$str .= $sep; // add separator between sub-arrays
	}
	$str = rtrim($str, $sep); // remove last separator
	return $str;
}
