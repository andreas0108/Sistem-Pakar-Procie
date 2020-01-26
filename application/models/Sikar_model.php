<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Sikar_model extends CI_Model
{
	// komponen side
	public function getKomponenList()
	{
		$x = "SELECT komponen.id, komponen.manufacture, komponen.name, komponen_kategori.name as kategori, komponen.desc, komponen.price, komponen.status
		 		FROM komponen JOIN komponen_kategori
			   	  ON komponen.kategori = komponen_kategori.id
			ORDER BY komponen.price ASC";

		return $this->db->query($x)->result_array();
	}

	public function getKomponenListByID($id)
	{
		$x = "SELECT * FROM komponen WHERE komponen.id = $id";

		return $this->db->query($x)->result_array();
	}

	// Rules side
	public function getRules()
	{
		$x = "SELECT `rules`.`komponen_id` as kom, `komponen`.`name` as parts, `jawaban`.`jawaban_content` as jawaban, `rules`.`status` FROM rules 
				JOIN komponen ON rules.komponen_id = komponen.id
				JOIN jawaban ON rules.jawaban_id = jawaban.id
		";

		return $this->db->query($x)->result_array();
	}

	public function getRulesGrouped()
	{
		return $this->db->query(
			"SELECT `rules`.`komponen_id`,`komponen`.`name` as parts,`rules`.`status`
				FROM rules JOIN komponen 
				  ON rules.komponen_id = komponen.id
			GROUP BY rules.komponen_id"
		)->result_array();
	}
}
