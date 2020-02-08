<?php
defined('BASEPATH') or exit('No direct script access allowed');

class log extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		is_logged_in();
	}

	public function index()
	{
		$data['title'] = 'System Log';

		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		// Published list
		$this->db->order_by('tgl_data', 'DESC');
		$data['log'] = $this->db->get('log')->result_array();

		$this->load->view('dashboard/log', $data);
	}
}
