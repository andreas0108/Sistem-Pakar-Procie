<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Sikar extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		is_logged_in();

		$this->load->helper('tanggal-indo');
		$this->load->model('Sikar_model', 'Simo');
	}

	public function index()
	{
		$data['title'] = 'ERROR 403';
		$data['title3'] = 'File Access Forbidden';

		echo '<center> <p>Error 403 | File Access Forbidden</p>';
		echo '<a href="/">Back</a>  </center>';

		$this->load->view('dashboard/parts/header', $data);
	}

	// Komponen SIde //
	public function komponen()
	{
		$data['title'] = $this->config->item('site_name');
		$data['title2'] = 'Content';
		$data['title3'] = 'Komponen';

		// user data for session
		$data['user'] = $this->db->get_where('user', [
			'email' => $this->session->userdata('email')
		])->row_array();

		$data['komponen'] = $this->Simo->getKomponenList();
		$data['katlist'] = $this->db->get('komponen_kategori')->result_array();

		$this->form_validation->set_rules('manuf', 'Manufacture', 'required', ['required' => 'Silahkan pilih manufacture komponen!.']);
		$this->form_validation->set_rules('kname', 'Nama Komponen', 'required', ['required' => 'Silahkan isi nama komponen!.']);
		$this->form_validation->set_rules('kate', 'Kategori', 'required', ['required' => 'Silahkan pilih kategori komponen!.']);
		$this->form_validation->set_rules('status', 'Status', 'required', ['required' => 'Silahkan pilih status komponen!.']);

		if ($this->form_validation->run() == false) {
			$this->load->view('dashboard/parts/header', $data);
			$this->load->view('dashboard/parts/sidebar', $data);
			$this->load->view('dashboard/parts/navbar', $data);
			$this->load->view('dashboard/sikar/komponen', $data);
			$this->load->view('dashboard/parts/javascript');
			$this->load->view('dashboard/sikar/js-komp');
			$this->load->view('dashboard/parts/modal');
			$this->load->view('dashboard/parts/footer');
		} else {
			$x = [
				'manufacture' => htmlspecialchars($this->input->post('manuf', true)),
				'name' => htmlspecialchars($this->input->post('kname', true)),
				'kategori' => htmlspecialchars($this->input->post('kate', true)),
				'desc' => htmlspecialchars($this->input->post('desc', true)),
				'price' => htmlspecialchars($this->input->post('price', true)),
				'status' => htmlspecialchars($this->input->post('status', true)),
				'date_added' => time()
			];

			$this->db->insert('komponen', $x);

			$this->session->set_flashdata(
				'flashmsg',
				'Komponen berhasil ditambahkan'
			);
			redirect('dashboard/sikar/komponen');
		}
	}

	public function getK()
	{
		echo json_encode($this->Simo->getKomponenListByID($_POST['id']));
	}

	public function updateK()
	{
		$data['title'] = $this->config->item('site_name');
		$data['title2'] = 'Content';
		$data['title3'] = 'Komponen';

		// user data for session
		$data['user'] = $this->db->get_where('user', [
			'email' => $this->session->userdata('email')
		])->row_array();

		$data['komponen'] = $this->Simo->getKomponenList();
		$data['katlist'] = $this->db->get('komponen_kategori')->result_array();

		$this->form_validation->set_rules('manuf', 'Manufacture', 'required', ['required' => 'Silahkan pilih manufacture komponen!.']);
		$this->form_validation->set_rules('kname', 'Nama Komponen', 'required', ['required' => 'Silahkan isi nama komponen!.']);
		$this->form_validation->set_rules('kate', 'Kategori', 'required', ['required' => 'Silahkan pilih kategori komponen!.']);
		$this->form_validation->set_rules('status', 'Status', 'required', ['required' => 'Silahkan pilih status komponen!.']);

		if ($this->form_validation->run() == false) {
			$this->load->view('dashboard/parts/header', $data);
			$this->load->view('dashboard/parts/sidebar', $data);
			$this->load->view('dashboard/parts/navbar', $data);
			$this->load->view('dashboard/sikar/komponen', $data);
			$this->load->view('dashboard/parts/javascript');
			$this->load->view('dashboard/sikar/js-komp');
			$this->load->view('dashboard/parts/modal');
			$this->load->view('dashboard/parts/footer');
		} else {
			$this->db->where('id', $this->input->post('idkomponen'));
			$this->db->update('komponen', [
				'manufacture' => htmlspecialchars($this->input->post('manuf', true)),
				'name' => htmlspecialchars($this->input->post('kname', true)),
				'kategori' => htmlspecialchars($this->input->post('kate', true)),
				'desc' => htmlspecialchars($this->input->post('desc', true)),
				'price' => htmlspecialchars($this->input->post('price', true)),
				'status' => htmlspecialchars($this->input->post('status', true))
			]);

			$this->session->set_flashdata(
				'flashmsg',
				'Berhasil merubah data komponen'
			);
			redirect('dashboard/sikar/komponen');
		}
	}

	public function deleteK($id)
	{
		$this->db->delete('komponen', ['id' => $id]);
		$this->session->set_flashdata(
			'flashmsg',
			'Komponen berhasil dihapus'
		);
		redirect('dashboard/sikar/komponen');
	}

	// ./Komponen Side //

	// Pertanyaan Side //
	public function pertanyaan()
	{
		$data['title'] = $this->config->item('site_name');
		$data['title2'] = 'Content';
		$data['title3'] = 'Pertanyaan';

		// user data for session
		$data['user'] = $this->db->get_where('user', [
			'email' => $this->session->userdata('email')
		])->row_array();

		$data['pert'] = $this->db->get('pertanyaan')->result_array();
		// var_dump(
		// );
		// die;

		$x = intval($this->db->count_all('pertanyaan'));
		$nextid = $x + 1;

		$this->form_validation->set_rules('pert', 'Pertanyaan', 'required', ['required' => 'Silahkan masukan pertanyaan.']);
		$this->form_validation->set_rules('status', 'Status', 'required', ['required' => 'Silahkan pilih status pertanyaan.']);

		if ($this->form_validation->run() == false) {
			$this->load->view('dashboard/parts/header', $data);
			$this->load->view('dashboard/parts/sidebar', $data);
			$this->load->view('dashboard/parts/navbar', $data);
			$this->load->view('dashboard/sikar/pertanyaan', $data);
			$this->load->view('dashboard/parts/javascript');
			$this->load->view('dashboard/sikar/js-pert');
			$this->load->view('dashboard/parts/modal');
			$this->load->view('dashboard/parts/footer');
		} else {

			$this->db->insert('pertanyaan', [
				'id' => 'P' . $nextid,
				'pertanyaan_content' => htmlspecialchars($this->input->post('pert', true)),
				'status' => htmlspecialchars($this->input->post('status', true))
			]);

			$this->session->set_flashdata(
				'flashmsg',
				'Pertanyaan baru berhasil ditambahkan.'
			);
			redirect('dashboard/sikar/pertanyaan');
		}
	}

	public function getP()
	{
		echo json_encode($this->db->get_where('pertanyaan', ['id' => $_POST['id']])->result_array());
	}

	public function updateP()
	{
		$data['title'] = $this->config->item('site_name');
		$data['title2'] = 'Content';
		$data['title3'] = 'Pertanyaan';

		// user data for session
		$data['user'] = $this->db->get_where('user', [
			'email' => $this->session->userdata('email')
		])->row_array();

		$data['pert'] = $this->db->get('pertanyaan')->result_array();

		$this->form_validation->set_rules('pert', 'Pertanyaan', 'required', ['required' => 'Silahkan masukan pertanyaan.']);
		$this->form_validation->set_rules('status', 'Status', 'required', ['required' => 'Silahkan pilih status pertanyaan.']);

		if ($this->form_validation->run() == false) {
			$this->load->view('dashboard/parts/header', $data);
			$this->load->view('dashboard/parts/sidebar', $data);
			$this->load->view('dashboard/parts/navbar', $data);
			$this->load->view('dashboard/sikar/pertanyaan', $data);
			$this->load->view('dashboard/parts/javascript');
			$this->load->view('dashboard/sikar/js-pert');
			$this->load->view('dashboard/parts/modal');
			$this->load->view('dashboard/parts/footer');
		} else {
			// var_dump($_POST);
			// die;
			$this->db->where('id', $this->input->post('idpt'));
			$this->db->update('pertanyaan', [
				'pertanyaan_content' => htmlspecialchars($this->input->post('pert', true)),
				'status' => htmlspecialchars($this->input->post('status', true))
			]);

			$this->session->set_flashdata(
				'flashmsg',
				'Berhasil merubah pertanyaan.'
			);
			redirect('dashboard/sikar/pertanyaan');
		}
	}

	public function deleteP($id)
	{
		$this->db->delete('pertanyaan', ['id' => $id]);
		$this->session->set_flashdata(
			'flashmsg',
			'Pertanyaan berhasil dihapus'
		);
		redirect('dashboard/sikar/pertanyaan');
	}

	// ./Komponen Side //

	// Jawaban Side //
	public function jawaban()
	{
		$data['title'] = $this->config->item('site_name');
		$data['title2'] = 'Content';
		$data['title3'] = 'Jawaban';

		// user data for session
		$data['user'] = $this->db->get_where('user', [
			'email' => $this->session->userdata('email')
		])->row_array();

		$data['jawab'] = $this->db->get('jawaban')->result_array();

		$x = intval($this->db->count_all('jawaban'));
		$nextid = $x + 1;

		$this->form_validation->set_rules('jawab', 'Jawaban', 'required', ['required' => 'Silahkan masukan jawaban.']);
		$this->form_validation->set_rules('status', 'Status', 'required', ['required' => 'Silahkan pilih status jawaban.']);

		if ($this->form_validation->run() == false) {
			$this->load->view('dashboard/parts/header', $data);
			$this->load->view('dashboard/parts/sidebar', $data);
			$this->load->view('dashboard/parts/navbar', $data);
			$this->load->view('dashboard/sikar/jawaban', $data);
			$this->load->view('dashboard/parts/javascript');
			$this->load->view('dashboard/sikar/js-jawab', $data);
			$this->load->view('dashboard/parts/modal');
			$this->load->view('dashboard/parts/footer');
		} else {

			$this->db->insert('jawaban', [
				'id' => 'J' . $nextid,
				'jawaban_content' => htmlspecialchars($this->input->post('jawab', true)),
				'status' => htmlspecialchars($this->input->post('status', true))
			]);

			$this->session->set_flashdata(
				'flashmsg',
				'Jawaban baru berhasil ditambahkan.'
			);
			redirect('dashboard/sikar/jawaban');
		}
	}

	public function getJ()
	{
		echo json_encode($this->db->get_where('jawaban', ['id' => $_POST['id']])->result_array());
	}

	public function updateJ()
	{
		$data['title'] = $this->config->item('site_name');
		$data['title2'] = 'Content';
		$data['title3'] = 'Jawaban';

		// user data for session
		$data['user'] = $this->db->get_where('user', [
			'email' => $this->session->userdata('email')
		])->row_array();

		$data['jawab'] = $this->db->get('jawaban')->result_array();

		$this->form_validation->set_rules('jawab', 'Jawaban', 'required', ['required' => 'Silahkan masukan jawaban.']);
		$this->form_validation->set_rules('status', 'Status', 'required', ['required' => 'Silahkan pilih status jawaban.']);

		if ($this->form_validation->run() == false) {
			$this->load->view('dashboard/parts/header', $data);
			$this->load->view('dashboard/parts/sidebar', $data);
			$this->load->view('dashboard/parts/navbar', $data);
			$this->load->view('dashboard/sikar/nawaban', $data);
			$this->load->view('dashboard/parts/javascript');
			$this->load->view('dashboard/sikar/js-pert', $data);
			$this->load->view('dashboard/parts/modal');
			$this->load->view('dashboard/parts/footer');
		} else {
			// var_dump($_POST);
			// die;
			$this->db->where('id', $this->input->post('jwid'));
			$this->db->update('jawaban', [
				'jawaban_content' => htmlspecialchars($this->input->post('jawab', true)),
				'status' => htmlspecialchars($this->input->post('status', true))
			]);

			$this->session->set_flashdata(
				'flashmsg',
				'Berhasil merubah jawaban.'
			);
			redirect('dashboard/sikar/jawaban');
		}
	}

	public function deleteJ($id)
	{
		$this->db->delete('jawaban', ['id' => $id]);
		$this->session->set_flashdata(
			'flashmsg',
			'Jawaban berhasil dihapus'
		);
		redirect('dashboard/sikar/jawaban');
	}

	// ./Jawaban Side //

}
