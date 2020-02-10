<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Sikar_model extends CI_Model
{
	// Chart JS
	public function jsonCountHasil()
	{
		$x = "SELECT COUNT(LEFT(id,8)) AS jumlah 
				FROM history 
			GROUP BY LEFT(id,8) 
			ORDER BY LEFT(id,8) DESC
			LIMIT 5;";
		return $this->db->query($x)->result_array();
	}

	public function jsonlabelHasil()
	{
		$x = "SELECT LEFT(id,8) AS tanggal
				FROM history 
			GROUP BY tanggal 
			ORDER BY tanggal DESC
			LIMIT 5;";

		return $this->db->query($x)->result_array();
	}
}
