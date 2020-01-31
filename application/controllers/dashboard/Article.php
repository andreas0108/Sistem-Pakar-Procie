<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Article extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		is_logged_in();
	}

	public function index()
	{
		$data['title'] = 'Article';

		$data['user'] = $this->db->get_where('user', [
			'email' => $this->session->userdata('email')
		])->row_array();

		// Published list
		$this->db->select('article.*, user.name as penulis');
		$this->db->join('user', 'article.penulis_id = user.id');
		$this->db->order_by('article.tgl_buat', 'DESC');
		$data['artip'] = $this->db->get_where('article', ['article.status' => 1])->result_array();

		// Draft list
		$this->db->select('article.*, user.name as penulis');
		$this->db->join('user', 'article.penulis_id = user.id');
		$this->db->order_by('article.tgl_buat', 'DESC');
		$data['artid'] = $this->db->get_where('article', ['article.status' => 0])->result_array();

		$this->load->view('dashboard/article/index', $data);
	}

	public function tambah()
	{
		$data['title'] = 'Tambah Article';

		$data['user'] = $this->db->get_where('user', [
			'email' => $this->session->userdata('email')
		])->row_array();

		$this->form_validation->set_rules('title', 'Judul', 'required', [
			'required' => '{field} wajib diisi'
		]);

		$this->form_validation->set_rules('isi', 'Konten', 'required', [
			'required' => '{field} wajib diisi'
		]);

		if ($this->form_validation->run() == false) {
			$this->load->view('dashboard/article/tambah', $data);
		} else {
			$image = $_FILES['image']['name'];

			if ($image) {
				$config['allowed_types'] = 'jpeg|jpg|png';
				$config['max_size'] 	 = '1536';
				$config['encrypt_name']	 = TRUE;
				$config['upload_path'] 	 = './assets/img/article/poster/';
				$this->load->library('upload', $config);

				if ($this->upload->do_upload('image')) {

					$this->db->insert('article', [
						'judul' => htmlspecialchars($this->input->post('title', true)),
						'slug' => htmlspecialchars(slug($this->input->post('title', true))),
						'gambar' => $this->upload->data('file_name'),
						'isi' => $this->input->post('isi'),
						'status' => htmlspecialchars($this->input->post('status', true)),
						'penulis_id' => htmlspecialchars($this->input->post('penulis_id', true)),
						'tags' => htmlspecialchars($this->input->post('tags', true)),
						'tgl_buat' => time()
					]);

					logs('Tambah artikel', htmlspecialchars($this->input->post('title', true)));

					$this->session->set_flashdata(
						'flashmsg',
						'Artikel telah ditambahkan.'
					);
					redirect('dashboard/article');
				} else {
					echo $this->upload->display_errors();
				}
			} else {
				$this->db->insert('article', [
					'judul' => htmlspecialchars($this->input->post('title', true)),
					'slug' => htmlspecialchars(slug($this->input->post('title', true))),
					'gambar' => '',
					'isi' => $this->input->post('isi'),
					'status' => htmlspecialchars($this->input->post('status', true)),
					'penulis_id' => htmlspecialchars($this->input->post('penulis_id', true)),
					'tags' => htmlspecialchars($this->input->post('tags', true)),
					'tgl_buat' => time()
				]);

				$this->session->set_flashdata(
					'flashmsg',
					'Artikel telah ditambahkan.'
				);
				redirect('dashboard/article');
			}
		}
	}

	public function ubah($id)
	{
		$data['title'] = 'Tambah Komponen';

		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		// get data artikel
		$this->db->select('article.*, user.name as penulis');
		$this->db->join('user', 'article.penulis_id = user.id');
		$data['arti'] = $this->db->get_where('article', ['article.id' => $id])->row_array();

		// var_dump($data);
		// die;

		$this->form_validation->set_rules('title', 'Judul', 'required', [
			'required' => '{field} wajib diisi'
		]);

		$this->form_validation->set_rules('isi', 'Konten', 'required', [
			'required' => '{field} wajib diisi'
		]);

		if ($this->form_validation->run() === false) {
			$this->load->view('Dashboard/Article/ubah', $data);
		} else {
			// var_dump($_POST);
			// die;

			$image = $_FILES['image']['name'];

			if ($image) {
				$config['allowed_types'] = 'jpeg|jpg|png';
				$config['max_size'] 	 = '1536';
				$config['encrypt_name']	 = TRUE;
				$config['upload_path'] 	 = './assets/img/article/poster/';
				$this->load->library('upload', $config);

				if ($this->upload->do_upload('image')) {

					$this->db->set([
						'judul' => htmlspecialchars($this->input->post('title', true)),
						'slug' => htmlspecialchars(slug($this->input->post('title', true))),
						'gambar' => $this->upload->data('file_name'),
						'isi' => $this->input->post('isi'),
						'status' => htmlspecialchars($this->input->post('status', true)),
						'penulis_id' => htmlspecialchars($this->input->post('penulis_id', true)),
						'tags' => htmlspecialchars($this->input->post('tags', true))
					]);
					$this->db->where('id', htmlspecialchars($this->input->post('id', true)));
					$this->db->update('article');

					logs('Ubah Artikel', htmlspecialchars($this->input->post('title', true)));

					$this->session->set_flashdata(
						'flashmsg',
						'Artikel berhasil dirubah.'
					);
					redirect('dashboard/article');
				} else {
					echo $this->upload->display_errors();
				}
			} else {
				$this->db->set([
					'judul' => htmlspecialchars($this->input->post('title', true)),
					'slug' => htmlspecialchars(slug($this->input->post('title', true))),
					'gambar' => '',
					'isi' => $this->input->post('isi'),
					'status' => htmlspecialchars($this->input->post('status', true)),
					'penulis_id' => htmlspecialchars($this->input->post('penulis_id', true)),
					'tags' => htmlspecialchars($this->input->post('tags', true))
				]);
				$this->db->where('id', htmlspecialchars($this->input->post('id', true)));
				$this->db->update('article');

				logs('Ubah Artikel', htmlspecialchars($this->input->post('title', true)));

				$this->session->set_flashdata(
					'flashmsg',
					'Artikel berhasil dirubah.'
				);
				redirect('dashboard/article');
			}
		}


		// var_dump($data);
		// die;
	}

	public function hapus($id)
	{
		$prevImg = $this->db->get_where('article', ['id' => $id])->row_array();

		if ($prevImg != '' || null) {
			// menghapus file poster sesuai id
			unlink(FCPATH . 'assets/img/article/poster/' . $prevImg['gambar']);
		}
		$this->db->delete('article', array('id' => $id));
		$this->session->set_flashdata(
			'flashmsg',
			'Artikel berhasil dihapus'
		);
		redirect('dashboard/article');
	}
}
