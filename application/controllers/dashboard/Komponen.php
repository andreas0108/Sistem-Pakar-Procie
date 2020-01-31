<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Komponen extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		is_logged_in();
	}

	public function index()
	{
		$data['title'] = 'Komponen';

		$data['user'] = $this->db->get_where('user', [
			'email' => $this->session->userdata('email')
		])->row_array();

		$data['kompo'] = $this->db->query('SELECT komponen.id, komponen.manufacture, komponen_kategori.name, komponen.desc, komponen.price, komponen.status, komponen.date_added as ditambahkan
					FROM komponen join komponen_kategori on komponen.kategori = komponen_kategori.id
				ORDER BY komponen.id DESC
		')->result_array();

		$this->load->view('dashboard/komponen/index', $data);
	}

	public function tambah()
	{
		$data['title'] = 'Tambah Komponen';

		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$this->form_validation->set_rules('nama', 'Nama Komponen', 'required', ['required' => '{field} wajib diisi']);
		$this->form_validation->set_rules('isi', 'Deskripsi', 'required', ['required' => '{field} wajib diisi']);
		$this->form_validation->set_rules('manuf', 'Manufaktur', 'required', ['required' => 'Silhakan pilih {field}']);
		$this->form_validation->set_rules('kate', 'Deskripsi', 'required', ['required' => 'Silhakan pilih {field}']);

		if ($this->form_validation->run() == false) {
			$this->load->view('dashboard/komponen/tambah', $data);
		} else {
			// var_dump($_FILES['image']);
			// var_dump($_POST);
			// die;

			$image = $_FILES['image']['name'];

			if ($image) {
				$config['allowed_types'] = 'jpeg|jpg|png';
				$config['max_size'] 	 = '2048';
				$config['encrypt_name']	 = TRUE;
				$config['upload_path'] 	 = './assets/img/komponen/';
				$this->load->library('upload', $config);

				if ($this->upload->do_upload('image')) {

					$this->db->insert('komponen', [
						'img' => $this->upload->data('file_name'),
						'name' => htmlspecialchars($this->input->post('nama', true)),
						'price' => htmlspecialchars(str_replace('.', '', $this->input->post('harga', true))),
						'desc' => $this->input->post('isi'),
						'status' => htmlspecialchars($this->input->post('status', true)),
						'manufacture' => htmlspecialchars($this->input->post('manuf', true)),
						'kategori' => htmlspecialchars($this->input->post('kate', true)),
						'date_added' => time()
					]);
					$this->db->insert('log', [
						'keterangan' => 'Tambah Komponen ' . htmlspecialchars($this->input->post('nama', true)),
						'tgl_data' => time()
					]);

					$this->session->set_flashdata(
						'flashmsg',
						'Komponen telah ditambahkan.'
					);
					redirect('dashboard/komponen');
				} else {
					echo $this->upload->display_errors();
				}
			} else {
				$this->db->insert('komponen', [
					'img' => '',
					'name' => htmlspecialchars($this->input->post('nama', true)),
					'price' => htmlspecialchars(str_replace('.', '', $this->input->post('harga', true))),
					'desc' => $this->input->post('isi'),
					'status' => htmlspecialchars($this->input->post('status', true)),
					'manufacture' => htmlspecialchars($this->input->post('manuf', true)),
					'kategori' => htmlspecialchars($this->input->post('kate', true)),
					'date_added' => time()
				]);

				$this->db->insert('log', [
					'keterangan' => 'Tambah Komponen ' . htmlspecialchars($this->input->post('title', true)),
					'tgl_data' => time()
				]);

				// var_dump($log);
				// var_dump($prep);
				// die;


				$this->session->set_flashdata(
					'flashmsg',
					'Komponen telah ditambahkan.'
				);
				redirect('dashboard/komponen');
			}
		}
	}

	public function ubah($id)
	{
		$data['title'] = 'Tambah Komponen';

		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$data['arti'] = $this->db->get_where();
	}

	public function hapus($id)
	{
		$prevImg = $this->db->get_where('article', ['id' => $id])->row_array();

		if ($prevImg != '' || null) {
			// menghapus file poster sesuai id
			unlink(FCPATH . 'assets/img/article/poster/' . $prevImg['gambar']);
		}
		$this->db->delete('article', ['id' => $id]);
		$this->session->set_flashdata(
			'flashmsg',
			'Artikel berhasil dihapus'
		);
		redirect('dashboard/article');
	}
}
