<?php
defined('BASEPATH') or exit('No direct script access allowed');

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
