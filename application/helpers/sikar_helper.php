<?php
defined('BASEPATH') or exit('No direct script access allowed');

// Login checker
function is_logged_in()
{
	$ci = get_instance();
	if (!$ci->session->userdata('email')) {
		redirect('login');
	}
}

function logs($msg, $item)
{
	$CI = get_instance();

	$log_item = count($CI->db->get('log')->result_array());

	$CI->db->order_by('log.tgl_data', 'DESC');
	$CI->db->limit(1);
	$temp = $CI->db->get('log')->row_array();

	$by = $CI->db->get_where('user', ['id' => $CI->session->userdata['id']])->row_array();

	if ($log_item == 100) {
		$CI->db->delete('log', ['id' => $temp['id']]);
		$CI->db->insert('log', [
			'keterangan' => $msg . ' ' . "'" . $item . "'",
			'user' => $by['name'],
			'tgl_data' => time()
		]);
	} else {
		$CI->db->insert('log', [
			'keterangan' => $msg . ' ' . "'" . $item . "'",
			'user' => $by['name'],
			'tgl_data' => time()
		]);
	}
}

// Core Sistem Pakar
function think($me)
{
	$datamasuk = "'" . implode("','", $me) . "'";

	// var_dump($me);
	// var_dump($datamasuk);
	// die;

	$CI = get_instance();

	$x = "SELECT rules.komponen_id, komponen.name
				FROM rules JOIN komponen ON rules.komponen_id = komponen.id
				WHERE jawaban_id IN ($datamasuk)
			GROUP BY komponen_id;
			--   HAVING COUNT(DISTINCT jawaban_id) = 2;
		";
	return $CI->db->query($x)->row_array();
}
