<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();

		$this->load->helper('sikar');
		$this->load->model('');
	}

	public function index()
	{
		if ($this->session->userdata('email')) {
			$data['title'] = 'Dashboard';
			$data['user'] = $this->db->get_where('user', [
				'email' => $this->session->userdata('email')
			])->row_array();
			$data['desc'] = 'Procie is a tools to recommend you the best and suitable processor for you based on your answer from my simple question.';

			$this->load->view('Home/index', $data);
		} else {
			$data['title'] = 'Landing';
			$data['user'] = $this->db->get_where('user', [
				'email' => $this->session->userdata('email')
			])->row_array();

			// var_dump($data['user']);
			// die;

			$this->load->view('index', $data);
		}
	}

	// public function dashboard()
	// {
	// }

	public function konsultasi()
	{
		$data['title'] = 'Konsultasi';
		$data['desc'] = 'Procie is a tools to recommend you the best and suitable processor for you based on your answer from my simple question.';

		$data['user'] = $this->db->get_where('user', [
			'email' => $this->session->userdata('email')
		])->row_array();
		// var_dump($data['user']);
		// die;

		$this->load->view('Home/konsultasi', $data);
	}

	public function Hasil()
	{
		$x = think($_POST);

		$data['hasil'] = $this->db->get_where('komponen', ['id' => $x['komponen_id']])->row_array();

		// var_dump($x);
		// var_dump($_POST);
		// var_dump($data);
		// die;

		$data['title'] = 'Rekomendasi';
		$data['desc'] = 'Procie is a tools to recommend you the best and suitable processor for you based on your answer from my simple question.';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		if ($data['hasil'] != '') {
			$this->load->view('Home/hasil', $data);
		} else {
			$this->session->set_flashdata(
				'flashinf',
				'Maaf untuk saat ini, data belum ada.'
			);
			redirect('konsultasi');
		}
	}

	public function about()
	{
		$data['title'] = 'About';

		$data['user'] = $this->db->get_where('user', [
			'email' => $this->session->userdata('email')
		])->row_array();
		// var_dump($data['user']);
		// die;

		$this->load->view('Home/index2', $data);
	}
}
