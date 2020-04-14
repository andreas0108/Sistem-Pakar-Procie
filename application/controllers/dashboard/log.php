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

	public function reset()
	{
		$this->db->truncate('komponen');
		$this->db->truncate('pertanyaan');
		$this->db->truncate('jawaban');
		$this->db->truncate('rules');
		$this->db->truncate('rulesp');
		$this->db->truncate('history');
		$this->db->truncate('log');

		logs('Reset System');
		$this->session->set_flashdata(
			'flashmsg',
			'Berhasil.'
		);
		redirect('dashboard');
	}
}
