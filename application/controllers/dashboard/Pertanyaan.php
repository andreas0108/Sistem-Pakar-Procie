<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pertanyaan extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		is_logged_in();
		$data['title'] = 'Pertanyaan';

		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$data['pert'] = $this->db->get('pertanyaan')->result_array();

		// var_dump($x);
		// die;


		$this->load->view('dashboard/pertanyaan/index', $data);
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
