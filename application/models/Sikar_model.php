<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Sikar_model extends CI_Model
{
	public function setsqlmode($mode, $replace_by = '')
	{
		$this->db->query("SET SESSION sql_mode=(SELECT REPLACE(@@sql_mode,'" . $mode . "', '" . $replace_by . "')) ");
	}

	// User Data
	public function data_user()
	{
		return $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
	}

	// Chart JS
	public function jsonCountHasil()
	{
		// SELECT DATE_FORMAT(tanggal, "%Y-%m-%d") tanggal, count(hasil) hasil FROM history group by DATE_FORMAT(tanggal, "%Y-%m-%d") DESC limit 5
		$x = 'SELECT COUNT(hasil) AS jumlah 
				FROM history 
			GROUP BY DATE_FORMAT(tanggal, "%Y-%m-%d") 
			ORDER BY DATE_FORMAT(tanggal, "%Y-%m-%d") DESC
			LIMIT 5;';
		return $this->db->query($x)->result_array();
	}

	public function jsonlabelHasil()
	{
		$x = 'SELECT LEFT(id,8) AS tanggal
				FROM history 
			GROUP BY DATE_FORMAT(tanggal, "%Y-%m-%d") 
			ORDER BY tanggal DESC
			LIMIT 5;';

		return $this->db->query($x)->result_array();
	}
}
