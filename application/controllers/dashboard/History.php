<?php
defined('BASEPATH') or exit('No direct script access allowed');

class History extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		is_logged_in();

		$this->load->model('Sikar_model', 'Simo');
		$this->Simo->setsqlmode('ONLY_FULL_GROUP_BY', '');

		$this->load->model('History_model', 'Himo');
	}

	public function index()
	{
		$data['title'] = 'Riwayat Konsultasi';
		$data['user'] = $this->Simo->data_user();

		$data['history'] = $this->Himo->History_List();

		$this->load->view('Dashboard/history', $data);
	}

	public function statistik()
	{
		// die;
		$data['title'] = 'Statistik Komponen';
		$data['user'] = $this->Simo->data_user();

		// amd processor stats
		$data['amd']['stats'] = arrtostr($this->Himo->amd_stats());

		// amd processor data
		$data['amd']['data'] = $this->Himo->amd_data();

		// intel processor stats
		$data['intel']['stats'] = arrtostr($this->Himo->intel_stats());

		// intel processor data
		$data['intel']['data'] = $this->Himo->intel_data();

		$data['label'] = arrtostr($this->Himo->statistic_label(), ', ', '"');
		$this->load->view('Dashboard/stats', $data);
	}
}
