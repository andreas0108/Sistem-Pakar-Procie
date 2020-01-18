<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	// Admin Side //
	public function index()
	{
		$data['title'] = 'CI-App';
		$data['title2'] = 'Home';
		$data['title3'] = 'Home';
		$data['user'] = $this->db->get_where('user', [
			'email' => $this->session->userdata('email')
		])->row_array();

		// $this->load->view('dashboard/parts/header', $data);
		// $this->load->view('dashboard/parts/sidebar', $data);
		// $this->load->view('dashboard/parts/navbar', $data);
		$this->load->view('home/index', $data);
		// $this->load->view('dashboard/parts/modal');
		// $this->load->view('dashboard/parts/javascript');
		// $this->load->view('dashboard/parts/footer');
	}

	// End Admin //
}
