<?php
defined('BASEPATH') or exit('No direct script access allowed');

class History extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		is_logged_in();
	}

	public function index()
	{
		$data['title'] = 'Riwayat Konsultasi';

		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		// History list
		$this->db->select('h.id, h.user_name, h.email, k.name as hasil');
		$this->db->join('komponen k', 'h.hasil = k.id');
		$this->db->order_by('id', 'DESC');
		$data['history'] = $this->db->get('history h')->result_array();

		$this->load->view('Dashboard/history', $data);
	}
}
