<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Rule_model extends CI_Model
{
	// Chart JS
	public function rules($id)
	{
		$this->db->select('rules.*, komponen.name, jawaban.jawaban_content');
		$this->db->join('komponen', 'rules.komponen_id = komponen.id');
		$this->db->join('jawaban', 'rules.jawaban_id = jawaban.id');
		return $this->db->get_where('rules', ['komponen_id' => $id]);
	}

	public function rulesd()
	{
		$this->db->select('DISTINCT(komponen_id), komponen.name');
		$this->db->join('komponen', 'rules.komponen_id = komponen.id');
		return $this->db->get('rules')->result_array();
	}
}
