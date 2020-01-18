<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('homeBlog_model', 'hB');
		$this->load->helper('limitword');
	}

	public function index()
	{
		$data['appname'] = 'PROCIE';
		$data['title'] = ' | HOME';

		$data['lA'] = $this->hB->listAllBlogLimited(1, 1);
		$data['nK'] = $this->hB->getNewKomponen();

		$this->load->view('home/parts/Header', $data);
		$this->load->view('home/parts/Navbar', $data);
		$this->load->view('home/index', $data);
		$this->load->view('home/parts/Footer', $data);
	}

	public function procie()
	{
		$data['appname'] = 'PROCIE';
		$data['title'] = ' | LANDING';

		$this->load->view('home/parts/Header', $data);
		$this->load->view('home/parts/Navbar-p', $data);
		$this->load->view('home/Procie/index', $data);
		$this->load->view('home/parts/Footer', $data);
	}
}
