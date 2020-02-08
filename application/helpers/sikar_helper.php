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
function logs($msg, $item)
{
	$CI = get_instance();
	if ($item != '' || null) {
		$item = "'" . $item . "'";
	} else {
		$item = '';
	}

	$log_item = count($CI->db->get('log')->result_array());

	$CI->db->order_by('tgl_data', 'DESC');
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
	$datamasuk = "'" . implode("','", $me) . "'";
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

function getUniqueID2()
{
	$CI = get_instance();
	$now = gmdate('Ymd', time() + (7 * 60 * 60));

	$CI->db->select_max('id', 'id');
	$x = $CI->db->get_where('history', ['LEFT(id,8)' => $now])->row();
	var_dump($x);
	$x = $x->id;

	// $id = sprintf(
	// 	"%04s",
	// 	intval(
	// 		substr($x['id'], 8)
	// 	) + 1
	// );
	echo generateID($now, $x);
}

function generateID($prefix = 0000, $data_source = 0)
{
	var_dump($data_source);
	// die;
	$data_source = substr($data_source, 0, 4);
	var_dump($data_source);
	$id = sprintf(
		"%04s", // mask 4 digit number
		intval($data_source) + 1
	);
	var_dump($id);
	return $prefix . $id;
}

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