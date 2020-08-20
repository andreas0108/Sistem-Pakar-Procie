<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();

		$this->load->helper('sikar');
		$this->load->model('Sikar_model', 'Simo');
		$this->Simo->setsqlmode('ONLY_FULL_GROUP_BY', '');
	}

	public function redirect()
	{
		if ($this->session->userdata('email')) {
			redirect();
		} else {
			redirect('login');
		}
	}

	public function index()
	{
		if ($this->session->userdata('email')) {
			$data['user'] = $this->Simo->data_user();
			$data['title'] = 'Dashboard - PROCIE';
			$data['desc'] = 'Selamat datang ' . $data['user']['name'] . ' di Dashboard Aplikasi Sistem Pakar ' . $this->config->item('site_name');

			$a = $this->db->select('DATE_FORMAT(tanggal, "%Y-%m-%d") tanggal, count(hasil) jumlah')
				->group_by('DATE_FORMAT(tanggal, "%Y-%m-%d") DESC')->limit(2)->get('history')->result_array();
			if ($a) {
				$b = (($a[0]['jumlah'] / $a[1]['jumlah']) - 1) * 100;
			} else {
				$b = 0;
			}
			$data['statsper'] = intval($b) . '%';
			$data['statscnt'] = count($this->db->get_where('history', ['left(konsul_id,8)' => gmdate('Ymd', time())])->result_array());
			$data['history'] = $this->db->select('h.id, h.konsul_id, h.user_name, h.email, k.name as hasil, h.tanggal')
				->join('komponen k', 'h.hasil = k.id')->order_by('h.tanggal', 'DESC')->limit('4')->get('history h')->result_array();
			$data['log'] = $this->db->select('user, keterangan, tgl_data')
				->order_by('tgl_data', 'DESC')->limit('4')->get('log')->result_array();

			$this->load->view('Home/index', $data);
		} else {
			$data['title'] = 'PROCIE';
			$data['user'] = $this->Simo->data_user();

			$this->load->view('index', $data);
		}
	}

	public function konsultasi()
	{
		$data['user'] = $this->Simo->data_user();
		$data['title'] = 'Konsultasi';
		$data['desc'] = 'Procie adalah sistem untuk merekomendasikan processor yang cocok untuk anda berdasarkan beberapa pertanyaan sederhana.';

		$this->form_validation->set_rules('username', 'Nama', 'required');

		if ($this->form_validation->run() === false) {
			$this->load->view('Home/konsultasi/index', $data);
		} else {
			$this->Simo->setUserdata();
			redirect('konsultasi');
		}
	}

	public function Step()
	{
		// buffer
		$this->Simo->step_data();
		redirect('konsultasi');
	}

	public function Proses()
	{
		// buffer_last
		$this->Simo->step_data();

		// sikar_process
		$usid = $this->session->userdata('konsul_id');
		$konsul = $this->Simo->get_konsul_data_byID($usid);
		$tmp_hasil = $this->Simo->proses_data($konsul['data'], $konsul['jumlah']);

		// merge jawaban jika jawaban lebih dari 1 ke dalam 1 array
		$hasil = [];
		foreach ($tmp_hasil as $th) {
			$hasil[] = $this->Simo->merge_data($th['komponen_id']);
		}

		// Set data hasil konsultasi ke data temporary selama 60 detik
		$this->session->set_tempdata(['hasil' => $hasil], NULL, 60);

		$data['user'] = $this->Simo->data_user();
		if ($this->session->userdata('email')) {
			$username = $data['user']['name'];
			$email = $data['user']['email'];
		} else {
			$username = $this->session->userdata('uname');
			$email = $this->session->userdata('umail');
		}

		if ($hasil) {
			// jika konsultasi berhasil
			// simpan data konsultasi
			logs('Konsultasi baru dengan ID : ' . $usid, null);
			$this->db->delete('tmp_data', ['konsul_id' => $usid]);
			foreach ($tmp_hasil as $th) {
				$this->db->insert('history', [
					'konsul_id' => $usid,
					'user_name' => $username,
					'email' => $email,
					'manufacture' => $th['manufacture'],
					'hasil' => $th['komponen_id']
				]);
			}
			redirect('konsultasi/hasil');
		} else {
			// jika gagal
			$this->db->delete('tmp_data', ['konsul_id' => $this->session->userdata('konsul_id')]);
			$this->session->set_flashdata(
				'flashinf',
				'Mohon maaf, Processor yang anda inginkan untuk saat ini belum tersedia di database kami.'
			);
			redirect('konsultasi');
		}
	}

	public function hasil()
	{
		$data['title'] = 'Hasil Konsultasi';
		$data['user'] = $this->Simo->data_user();
		// ambil data dari data temporary, kirim ke view
		$data['kompo'] = $this->session->tempdata('hasil');

		// jika data masih berada di temporary
		if ($data['kompo']) {
			$this->load->view('Home/konsultasi/hasil', $data);
		} else {
			redirect('konsultasi');
		}
	}

	public function cancel()
	{
		$this->db->delete('tmp_data', ['konsul_id' => $this->session->userdata('konsul_id')]);
		redirect('konsultasi');
	}

	public function about()
	{
		$data['title'] = 'Tentang';
		$data['user'] = $this->Simo->data_user();

		$this->load->view('Home/about', $data);
	}
}
