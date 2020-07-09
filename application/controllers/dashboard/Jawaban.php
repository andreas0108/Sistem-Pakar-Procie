<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Jawaban extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		is_logged_in();
	}

	public function index()
	{
		$data['title'] = 'Daftar Jawaban';

		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$this->form_validation->set_rules('pertanyaan', 'Pertanyaan', 'required', ['required' => 'Silahkan pilih pertanyaan.']);
		$this->form_validation->set_rules('status', 'Status', 'required', ['required' => 'Silahkan pilih status jawaban.']);

		if ($this->form_validation->run() === false) {
			$this->load->view('Dashboard/Jawaban/index', $data);
		} else {
			$pid = htmlspecialchars($this->input->post('pertanyaan', true));
			$id = generateID('jawaban', 'id', $pid . 'J', 4);
			$a = htmlspecialchars($this->input->post('jawabanInput', true));
			$j = explode(',', $a);
			$sts = htmlspecialchars($this->input->post('status', true));
			$d = '';

			foreach ($j as $j) {
				$d .= '("' . $id++ . '","' . $pid . '","' . $j . '","' . $sts . '")' . ',';
			}

			// System Logs Purpose
			$id2 = generateID('jawaban', 'id', $pid . 'J', 4);
			$j2 = explode(',', $a);
			$e = '';
			foreach ($j2 as $j2) {
				$e .= $id2++ . ',';
			}

			$this->db->query('INSERT INTO jawaban (id,pertanyaan_id,jawaban_content,status) VALUES' . rtrim($d, ','));
			logs('Tambah Jawaban', rtrim($e, ','));
			$this->session->set_flashdata(
				'flashmsg',
				'Jawaban berhasil disimpan.'
			);
			redirect('Dashboard/Jawaban');
		}
	}

	public function get()
	{
		echo json_encode($this->db->get_where('jawaban', ['id' => $_POST['id']])->row_array());
	}

	public function ubah()
	{
		$this->form_validation->set_rules('jawaban', 'Jawaban', 'required', ['required' => 'Silahkan masukan jawaban.']);
		$this->form_validation->set_rules('status', 'Status', 'required', ['required' => 'Silahkan pilih status jawaban.']);
		if ($this->form_validation->run() === false) {
			$this->session->set_flashdata(
				'flasherr',
				$this->form_validation->error_array()
			);
			redirect('Dashboard/Jawaban');
		} else {
			$this->db->where('id', $this->input->post('id'));
			$this->db->update('jawaban', [
				'jawaban_content' => htmlspecialchars($this->input->post('jawaban', true)),
				'status' => htmlspecialchars($this->input->post('status', true)),
				'pertanyaan_id' => htmlspecialchars($this->input->post('pertanyaan', true))
			]);
			logs('Ubah Jawaban', $this->input->post('id'));
			$this->session->set_flashdata(
				'flashmsg',
				'Berhasil merubah jawaban.'
			);
			redirect('Dashboard/Jawaban');
		}
	}

	public function hapus($id)
	{
		logs('Hapus Jawaban', $id);
		$this->db->delete('jawaban', ['id' => $id]);
		$this->session->set_flashdata(
			'flashmsg',
			'Jawaban berhasil dihapus'
		);
		redirect('Dashboard/Jawaban');
	}
}
