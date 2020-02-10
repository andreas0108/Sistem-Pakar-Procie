<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Rules extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Rule_model', 'Rumo');
		is_logged_in();
	}

	public function index()
	{
		$data['title'] = 'Rules';

		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$data['rulesd'] = $this->Rumo->rulesd();

		$this->form_validation->set_rules('jawaban', 'Jawaban', 'required', ['required' => 'Silahkan pilih jawaban.']);
		$this->form_validation->set_rules('komponen', 'Komponen', 'required', ['required' => 'Silahkan pilih komponen.']);
		$this->form_validation->set_rules('status', 'Status', 'required', ['required' => 'Silahkan pilih status pertanyaan.']);
		if ($this->form_validation->run() === false) {
			$this->load->view('dashboard/rules/index', $data);
		} else {
			$id = 'R' . generateID('id', 'rules', 1);
			$this->db->insert('rules', [
				'id' => $id,
				'komponen_id' => htmlspecialchars($this->input->post('komponen', true)),
				'jawaban_id' => htmlspecialchars($this->input->post('jawaban', true)),
				'status' => htmlspecialchars($this->input->post('status', true))
			]);
			logs('Tambah Rule', $id);
			$this->session->set_flashdata(
				'flashmsg',
				'Rules berhasil disimpan.'
			);
			redirect('dashboard/rules');
		}
	}

	public function ubah()
	{
		$this->form_validation->set_rules('jawaban', 'Jawaban', 'required', ['required' => 'Silahkan pilih jawaban.']);
		$this->form_validation->set_rules('komponen', 'Komponen', 'required', ['required' => 'Silahkan pilih komponen.']);
		$this->form_validation->set_rules('status', 'Status', 'required', ['required' => 'Silahkan pilih status pertanyaan.']);
		if ($this->form_validation->run() === false) {
			$this->session->set_flashdata(
				'flasherr',
				$this->form_validation->error_array()
			);
			redirect('dashboard/rules');
		} else {
			$this->db->where('id', $this->input->post('id'));
			$this->db->update('rules', [
				'komponen_id' => htmlspecialchars($this->input->post('komponen', true)),
				'jawaban_id' => htmlspecialchars($this->input->post('jawaban', true)),
				'status' => htmlspecialchars($this->input->post('status', true))
			]);
			logs('Ubah Rule', $this->input->post('id'));
			$this->session->set_flashdata(
				'flashmsg',
				'Berhasil merubah rules.'
			);
			redirect('dashboard/rules');
		}
	}

	public function get()
	{
		echo json_encode($this->db->get_where('rules', ['id' => $_POST['id']])->row_array());
	}

	public function hapus($id)
	{
		logs('Hapus Rule', $id);
		$this->db->delete('rules', ['id' => $id]);
		$this->session->set_flashdata(
			'flashmsg',
			'Rule berhasil dihapus'
		);
		redirect('dashboard/pertanyaan');
	}
}
