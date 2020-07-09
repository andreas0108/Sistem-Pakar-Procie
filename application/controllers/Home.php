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
			$data['title'] = 'Dashboard - PROCIE';
			$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
			$data['desc'] = 'Selamat datang ' . $data['user']['name'] . ' di Dashboard Aplikasi Sistem Pakar ' . $this->config->item('site_name');

			$a = $this->db->select('DATE_FORMAT(tanggal, "%Y-%m-%d") tanggal, count(hasil) jumlah')
				->group_by('DATE_FORMAT(tanggal, "%Y-%m-%d") DESC')->limit(2)->get('history')->result_array();
			if ($a) {
				$b = (($a[0]['jumlah'] / $a[1]['jumlah']) - 1) * 100;
			} else {
				$b = 0;
			}
			$data['statsper'] = intval($b) . '%';
			$data['statscnt'] = count($this->db->get_where('history', ['left(id,8)' => gmdate('Ymd', time() + 7 * 3600)])->result_array());
			$data['history'] = $this->db->select('h.id, h.user_name, h.email, k.name as hasil')
				->join('komponen k', 'h.hasil = k.id')->order_by('h.id', 'DESC')->limit('4')->get('history h')->result_array();
			$data['log'] = $this->db->select('user, keterangan, tgl_data')
				->order_by('tgl_data', 'DESC')->limit('4')->get('log')->result_array();

			$this->load->view('Home/index', $data);
		} else {
			$data['title'] = 'Landing';
			$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

			// var_dump($data['user']);
			// die;

			$this->load->view('index', $data);
		}
	}

	public function konsultasi()
	{
		$data['title'] = 'Konsultasi';
		$data['desc'] = 'Procie adalah sistem untuk merekomendasikan processor yang cocok untuk anda berdasarkan beberapa pertanyaan sederhana.';

		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$this->form_validation->set_rules('username', 'Nama', 'required', ['required' => 'Silahkan isi {field} terlebih dahulu.']);

		if ($this->form_validation->run() === false) {
			$this->load->view('Home/konsultasi/index', $data);
		} else {
			$uname = $this->input->post('username');
			$umail = $this->input->post('usermail');
			$id = generateDateID('tmp_data');

			$this->session->set_userdata(['konsul_id' => $id, 'uname' => $uname, 'umail' => $umail]);
			redirect('konsultasi');
		}
	}

	public function Step()
	{
		$current_id = $this->db->select('MAX(id) as id')->get('tmp_data')->row_array();

		// var_dump($this->session->userdata('konsul_id'));
		// var_dump($current_id);
		// var_dump($_POST);
		// die;

		$this->db->insert('tmp_data', [
			'id' => $current_id['id'] + 1,
			'konsul_id' => $this->session->userdata('konsul_id'),
			'pertanyaan_id' => $this->input->post('pertanyaan_id'),
			'jawaban_id' => $this->input->post('jawaban')
		]);
		redirect('konsultasi');
	}

	public function Proses()
	{
		// buffer_last
		$current_id = $this->db->select('MAX(id) as id')->get('tmp_data')->row_array();
		$this->db->insert('tmp_data', [
			'id' => $current_id['id'] + 1,
			'konsul_id' => $this->session->userdata('konsul_id'),
			'pertanyaan_id' => $this->input->post('pertanyaan_id'),
			'jawaban_id' => $this->input->post('jawaban')
		]);

		// sikar_process
		$usid = $this->session->userdata('konsul_id');
		$data = $this->db->query("SELECT jawaban_id FROM tmp_data WHERE konsul_id = $usid")->result_array();
		$konsul = "'" . arrtostr($data, "','") . "'";

		// var_dump($konsul);

		$jumlah_data = count($data);
		// var_dump($jumlah_data);
		// die;

		$data_proses = "SELECT rules.komponen_id, komponen.name, komponen.manufacture
						FROM rules JOIN komponen ON rules.komponen_id = komponen.id
						WHERE jawaban_id IN ($konsul)
						GROUP BY komponen_id
						HAVING COUNT(DISTINCT jawaban_id) = $jumlah_data;
		";
		$tmp_hasil = $this->db->query($data_proses)->row_array();

		// var_dump($hasil);
		// die;

		$hasil = $this->db->get_where('komponen', ['id' => $tmp_hasil['komponen_id']])->row_array();
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		if ($this->session->userdata('email')) {
			$username = $data['user']['name'];
			$email = $data['user']['email'];
		} else {
			$username = $this->session->userdata('uname');
			$email = $this->session->userdata('umail');
		}

		if ($hasil) {
			logs('Konsultasi baru dengan ID : ' . getUniqueID(), null);
			$this->db->insert('history', [
				'id' => getUniqueID(),
				'user_name' => $username,
				'email' => $email,
				'manufacture' => $tmp_hasil['manufacture'],
				'hasil' => $tmp_hasil['komponen_id']
			]);
			$this->db->delete('tmp_data', ['konsul_id' => $this->session->userdata('konsul_id')]);
			redirect('konsultasi/hasil/' . $hasil['slug']);
		} else {
			$this->db->delete('tmp_data', ['konsul_id' => $this->session->userdata('konsul_id')]);
			$this->session->set_flashdata(
				'flashinf',
				'Mohon maaf, Processor yang cari untuk saat ini belum tersedia di database kami.'
			);
			redirect('konsultasi');
		}
	}

	public function hasil()
	{
		redirect('konsultasi');
	}

	public function cancel()
	{
		$this->db->delete('tmp_data', ['konsul_id' => $this->session->userdata('konsul_id')]);
		redirect('konsultasi');
	}

	public function about()
	{
		$data['title'] = 'Tentang';

		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$this->load->view('Home/about', $data);
	}
}
