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

function _check($s1, $s2)
{
	$CI = get_instance();
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

// Core Sistem Pakar
// By ANDREAS ARDI
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

function generateID($prefix, $col, $tab, $selector = 1)
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

// function generateID($prefix = 0000, $data_source = 0)
// {
// 	// var_dump($data_source);
// 	// die;
// 	$data_source = substr($data_source, 0, 4);
// 	// var_dump($data_source);
// 	$id = sprintf(
// 		"%04s", // mask 4 digit number
// 		intval($data_source) + 1
// 	);
// 	// var_dump($id);
// 	return $prefix . $id;
// }

function arrtostr($arr, $sep = ', ')
{
	$str = '';
	foreach ($arr as $val) {
		$str .= implode($sep, $val);
		$str .= $sep; // add separator between sub-arrays
	}
	$str = rtrim($str, $sep); // remove last separator
	return $str;
}
