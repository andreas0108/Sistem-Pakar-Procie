<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();

		$this->load->helper('sikar');
		$this->load->model('Sikar_model', 'Simo');
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
			$data['title'] = 'Dashboard - PROCIE';
			$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
			$data['desc'] = 'Selamat datang ' . $data['user']['name'] . ' di Dashboard Aplikasi Sistem Pakar ' . $this->config->item('site_name');

			$a = $this->db->query("SELECT COUNT(LEFT(id,8)) AS jumlah 
									FROM history GROUP BY LEFT(id,8) 
									ORDER BY id DESC 
									LIMIT 2;
									")->result_array();
			$b = (($a[0]['jumlah'] / $a[1]['jumlah']) - 1) * 100;
			$data['statsper'] = intval($b) . '%';
			$data['statscnt'] = count($this->db->get_where('history', ['left(id,8)' => gmdate('Ymd', time() + 7 * 3600)])->result_array());
			$data['history'] = $this->db->select('h.id, h.user_name, h.email, k.name as hasil')->join('komponen k', 'h.hasil = k.id')->order_by('h.id', 'DESC')->limit('4')->get('history h')->result_array();
			$data['log'] = $this->db->select('keterangan, tgl_data')->order_by('tgl_data', 'DESC')->limit('4')->get('log')->result_array();

			// var_dump($data['history']);
			// var_dump($data['log']);

			$this->load->view('Home/index', $data);
		} else {
			$data['title'] = 'Landing';
			$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

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

		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$this->form_validation->set_rules('username', 'Nama', 'required', ['required' => 'Silahkan isi {field} terlebih dahulu.']);

		if ($this->form_validation->run() === false) {
			$this->load->view('Home/konsultasi', $data);
		} else {
			$uname = $this->input->post('username');
			$umail = $this->input->post('usermail');

			$this->session->set_userdata(['uname' => $uname, 'umail' => $umail]);
			$this->session->set_userdata(['uname' => $uname, 'umail' => $umail]);
			redirect('konsultasi');
		}
	}

	public function Proses()
	{
		$x = think($_POST);
		$data = $this->db->get_where('komponen', ['id' => $x['komponen_id']])->row_array();
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		if ($this->session->userdata('email')) {
			$username = $data['user']['name'];
			$email = $data['user']['email'];
		} else {
			$username = $this->session->userdata('uname');
			$email = $this->session->userdata('umail');
		}

		if ($data != '' || 0 || null) {
			logs('Konsultasi baru dengan ID : ' . getUniqueID(), null);
			$this->db->insert('history', [
				'id' => getUniqueID(),
				'user_name' => $username,
				'email' => $email,
				'hasil' => $x['komponen_id']
			]);
			redirect('konsultasi/hasil/' . $data['slug']);
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

		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$this->load->view('Home/about', $data);
	}
}
