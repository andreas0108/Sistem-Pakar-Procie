<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();

		$this->load->model('');
	}

	public function index()
	{
		$data['title'] = 'Home';
		$data['user'] = $this->db->get_where('user', [
			'email' => $this->session->userdata('email')
		])->row_array();

		// var_dump($data['user']);
		// die;

		$this->load->view('index', $data);
	}

	public function dashboard()
	{
		$data['title'] = 'Dashboard';
		$data['user'] = $this->db->get_where('user', [
			'email' => $this->session->userdata('email')
		])->row_array();
		$data['desc'] = 'Procie is a tools to recommend you the best and suitable processor for you based on your answer from my simple question.';

		$this->load->view('Home/index', $data);
	}

	public function konsultasi()
	{
		$data['title'] = 'Konsultasi';
		$data['desc'] = 'Procie is a tools to recommend you the best and suitable processor for you based on your answer from my simple question.';

		$data['user'] = $this->db->get_where('user', [
			'email' => $this->session->userdata('email')
		])->row_array();
		// var_dump($data['user']);
		// die;

		$this->load->view('Home/index', $data);
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
