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
		$data['title'] = 'Jawaban';

		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$this->form_validation->set_rules('pertanyaan', 'Pertanyaan', 'required', ['required' => 'Silahkan pilih pertanyaan.']);
		$this->form_validation->set_rules('status', 'Status', 'required', ['required' => 'Silahkan pilih status jawaban.']);

		if ($this->form_validation->run() === false) {
			$this->load->view('dashboard/jawaban/index', $data);
		} else {
			$id = generateID('id', 'jawaban', 1);
			$ids = generateID('id', 'jawaban', 1);
			$pid = htmlspecialchars($this->input->post('pertanyaan', true));
			$a = htmlspecialchars($this->input->post('jawabanInput', true));
			$jct = explode(',', $a);
			$sts = htmlspecialchars($this->input->post('status', true));

			$d = '';
			foreach ($jct as $j) {
				$d .= '("' . 'J' . $id++ . '","' . $pid . '","' . $j . '","' . $sts . '")' . ',';
			}

			$this->db->query('INSERT INTO jawaban (id,pertanyaan_id,jawaban_content,status) VALUES' . rtrim($d, ','));

			if (count($jct) == 1) {
				$x = 'J' . $ids;
			} else {
				$x = 'J' . $ids . '-' . 'J' . ($ids + count($jct) - 1);
			}
			logs('Tambah Jawaban', $x);
			$this->session->set_flashdata(
				'flashmsg',
				'Jawaban berhasil disimpan.'
			);
			redirect('dashboard/jawaban');
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
			redirect('dashboard/jawaban');
		} else {
			// var_dump($_POST);
			// die;

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
			redirect('dashboard/jawaban');
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
		redirect('dashboard/jawaban');
	}
}
