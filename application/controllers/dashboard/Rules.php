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

		$this->db->select('r.id as rid, j.jawaban_content as jawab, p.id as pid, p.pertanyaan_content as next_pert');
		$this->db->join('jawaban j', 'r.jawaban_id = j.id');
		$this->db->join('pertanyaan p', 'r.next_pertanyaan = p.id');
		$this->db->order_by('r.id');
		$data['rulesp'] = $this->db->get('rulesp r')->result_array();
		$data['rulesd'] = $this->Rumo->rulesd();

		$this->form_validation->set_rules('komponen', 'Komponen', 'required', ['required' => 'Silahkan pilih komponen.']);
		$this->form_validation->set_rules('status', 'Status', 'required', ['required' => 'Silahkan pilih status pertanyaan.']);
		if ($this->form_validation->run() === false) {
			$this->load->view('Dashboard/Rules/index', $data);
		} else {
			$id = generateID('rules', 'id', 'R');
			$kid = htmlspecialchars($this->input->post('komponen', true));
			$jw = $this->input->post('jawabans', true);
			$sts = htmlspecialchars($this->input->post('status', true));
			$a = '';

			foreach ($jw as $j) {
				$a .= '("' . $id++ . '","' . $kid . '","' . $j . '","' . $sts . '")' . ',';
			}

			// var_dump($a);
			// die;

			$q = 'INSERT INTO rules (id,komponen_id,jawaban_id,status) VALUES' . rtrim($a, ',');
			$this->db->query($q);

			// $this->db->insert('rules', [
			// 	'id' => $id,
			// 	'komponen_id' => htmlspecialchars($this->input->post('komponen', true)),
			// 	'jawaban_id' => htmlspecialchars($this->input->post('jawaban', true)),
			// 	'status' => htmlspecialchars($this->input->post('status', true))
			// ]);

			logs('Tambah Rule', $id);
			$this->session->set_flashdata(
				'flashmsg',
				'Rules berhasil disimpan.'
			);
			redirect('Dashboard/Rules');
		}
	}

	public function ubah()
	{
		var_dump($_POST);
		die;
		$this->form_validation->set_rules('jawaban', 'Jawaban', 'required', ['required' => 'Silahkan pilih jawaban.']);
		$this->form_validation->set_rules('komponen', 'Komponen', 'required', ['required' => 'Silahkan pilih komponen.']);
		$this->form_validation->set_rules('status', 'Status', 'required', ['required' => 'Silahkan pilih status pertanyaan.']);
		if ($this->form_validation->run() === false) {
			$this->session->set_flashdata(
				'flasherr',
				$this->form_validation->error_array()
			);
			redirect('Dashboard/Rules');
		} else {
			// var_dump($_POST);
			// die;

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
			redirect('Dashboard/Rules');
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
		redirect('Dashboard/Rules');
	}

	// Rules Pertanyaan

	public function tambahP()
	{
		// var_dump($_POST);
		// die;

		$this->form_validation->set_rules('rulesjid', 'Jawaban', 'required', ['required' => 'Silahkan pilih jawaban.']);
		$this->form_validation->set_rules('rulespid', 'Pertanyaan', 'required', ['required' => 'Silahkan pilih status pertanyaan.']);
		if ($this->form_validation->run() === false) {
			$this->load->view('Dashboard/Rules/index');
		} else {

			$this->db->insert('rulesp', [
				'jawaban_id' => htmlspecialchars($this->input->post('rulesjid', true)),
				'next_pertanyaan' => htmlspecialchars($this->input->post('rulespid', true))
			]);


			logs('Tambah Rule Pertanyaan Baru');
			$this->session->set_flashdata(
				'flashmsg',
				'Rules berhasil disimpan.'
			);
			redirect('Dashboard/Rules');
		}
	}

	public function getP()
	{
		echo json_encode($this->db->get_where('rulesp', ['id' => $_POST['id']])->row_array());
	}

	public function ubahP()
	{
		$this->form_validation->set_rules('rulesjid', 'Jawaban', 'required', ['required' => 'Silahkan pilih jawaban.']);
		$this->form_validation->set_rules('rulespid', 'Pertanyaan', 'required', ['required' => 'Silahkan pilih status pertanyaan.']);
		if ($this->form_validation->run() === false) {
			$this->session->set_flashdata(
				'flasherr',
				$this->form_validation->error_array()
			);
			redirect('Dashboard/Rules');
		} else {
			// var_dump($_POST);
			// die;

			$this->db->where('id', $this->input->post('id'));
			$this->db->update('rulesp', [
				'jawaban_id' => htmlspecialchars($this->input->post('rulesjid', true)),
				'next_pertanyaan' => htmlspecialchars($this->input->post('rulespid', true))
			]);
			logs('Ubah Rule', $this->input->post('id'));
			$this->session->set_flashdata(
				'flashmsg',
				'Berhasil merubah rules.'
			);
			redirect('Dashboard/Rules');
		}
	}

	public function hapusP($id)
	{
		logs('Hapus Rule Pertanyaan', $id);
		$this->db->delete('rulesp', ['id' => $id]);
		$this->session->set_flashdata(
			'flashmsg',
			'Rule berhasil dihapus'
		);
		redirect('Dashboard/Rules');
	}
}
