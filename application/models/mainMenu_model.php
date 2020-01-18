<?php
defined('BASEPATH') or exit('No direct script access allowed');

class mainMenu_model extends CI_Model
{
	public function getMenu()
	{
		return $this->db->get('user_menu')->result_array();
	}

	public function addMenu()
	{
		return $this->db->insert('user_menu', ['menu' => $this->input->post('menu')]);
	}

	public function editMenu()
	{
		$menu = $this->input->post('menu');

		$this->db->set('menu', $menu);
		$this->db->where('');
		return $this->db->update('user_menu');
	}

	public function delete($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('menu');
	}
}
