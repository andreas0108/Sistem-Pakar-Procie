<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Rules extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Rule_model', 'Rumo');
	}

	public function index()
	{
		is_logged_in();
		$data['title'] = 'Rules';

		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$data['rulesd'] = $this->Rumo->rulesd();

		// var_dump($data);
		// die;

		$this->load->view('dashboard/rules/index', $data);
	}

	public function tambah()
	{
		is_logged_in();
	}

	public function ubah($id)
	{
		is_logged_in();
	}

	public function tampil($slug)
	{
	}

	public function hapus($id)
	{
		is_logged_in();
	}

	public function redir()
	{
		if ($this->session->userdata('email')) {
			redirect('dashboard/komponen');
		} else {
			is_logged_in();
		}
	}
}
