<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pertanyaan extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		is_logged_in();
	}

	public function index()
	{
		$data['title'] = 'Pertanyaan';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$data['pert'] = $this->db->get('pertanyaan')->result_array();

		$this->form_validation->set_rules('pertanyaan', 'Pertanyaan', 'required', ['required' => 'Silahkan masukan pertanyaan.']);
		$this->form_validation->set_rules('status', 'Status', 'required', ['required' => 'Silahkan pilih status pertanyaan.']);
		if ($this->form_validation->run() === false) {
			$this->load->view('dashboard/pertanyaan/index', $data);
		} else {
			$id = 'P' . generateID('id', 'pertanyaan', 1);
			$this->db->insert('pertanyaan', [
				'id' => $id,
				'pertanyaan_content' => htmlspecialchars($this->input->post('pertanyaan', true)),
				'status' => htmlspecialchars($this->input->post('status', true))
			]);
			logs('Tambah Pertanyaan', $id);
			$this->session->set_flashdata(
				'flashmsg',
				'Pertanyaan berhasil disimpan.'
			);
			redirect('dashboard/pertanyaan');
		}
	}

	public function get()
	{
		echo json_encode($this->db->get_where('pertanyaan', ['id' => $_POST['id']])->row_array());
	}

	public function ubah()
	{
		$this->form_validation->set_rules('pertanyaan', 'Pertanyaan', 'required', ['required' => 'Silahkan masukan pertanyaan.']);
		$this->form_validation->set_rules('status', 'Status', 'required', ['required' => 'Silahkan pilih status pertanyaan.']);
		if ($this->form_validation->run() === false) {
			$this->session->set_flashdata(
				'flasherr',
				$this->form_validation->error_array()
			);
			redirect('dashboard/pertanyaan');
		} else {
			$this->db->where('id', $this->input->post('id'));
			$this->db->update('pertanyaan', [
				'pertanyaan_content' => htmlspecialchars($this->input->post('pertanyaan', true)),
				'status' => htmlspecialchars($this->input->post('status', true))
			]);
			logs('Ubah Pertanyaan', $this->input->post('id'));
			$this->session->set_flashdata(
				'flashmsg',
				'Berhasil merubah pertanyaan.'
			);
			redirect('dashboard/pertanyaan');
		}
	}

	public function hapus($id)
	{
		logs('Hapus Pertanyaan', $id);
		$this->db->delete('pertanyaan', ['id' => $id]);
		$this->session->set_flashdata(
			'flashmsg',
			'Pertanyaan berhasil dihapus'
		);
		redirect('dashboard/pertanyaan');
	}
}
