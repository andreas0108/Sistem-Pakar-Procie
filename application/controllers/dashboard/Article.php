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
					$gambar = $this->upload->data('file_name');
				} else {
					$this->session->set_flashdata(
						'flasherr',
						$this->upload->display_errors()
					);
				}
			} else {
				$gambar = '';
			}
			$this->db->insert('article', [
				'judul' => htmlspecialchars($this->input->post('title', true)),
				'slug' => htmlspecialchars(slug($this->input->post('title', true))),
				'gambar' => $gambar,
				'isi' => $this->input->post('isi'),
				'status' => htmlspecialchars($this->input->post('status', true)),
				'penulis_id' => htmlspecialchars($this->input->post('penulis_id', true)),
				'tags' => htmlspecialchars($this->input->post('tags', true)),
				'tgl_buat' => time()
			]);
			logs('Tambah Artikel', htmlspecialchars($this->input->post('title', true)));
			$this->session->set_flashdata(
				'flashmsg',
				'Artikel telah ditambahkan.'
			);
			redirect('dashboard/article');
		}
	}

	public function ubah($id)
	{
		$data['title'] = 'Ubah Article';

		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		// get data artikel
		$this->db->select('article.*, user.name as penulis');
		$this->db->join('user', 'article.penulis_id = user.id');
		$data['arti'] = $this->db->get_where('article', ['article.id' => $id])->row_array();

		$this->form_validation->set_rules('title', 'Judul', 'required', [
			'required' => '{field} wajib diisi'
		]);

		$this->form_validation->set_rules('isi', 'Konten', 'required', [
			'required' => '{field} wajib diisi'
		]);

		if ($this->form_validation->run() === false) {
			$this->load->view('Dashboard/Article/ubah', $data);
		} else {

			$image = $_FILES['image']['name'];

			if ($image) {
				$config['allowed_types'] = 'jpeg|jpg|png';
				$config['max_size'] 	 = '1536';
				$config['encrypt_name']	 = TRUE;
				$config['upload_path'] 	 = './assets/img/article/poster/';
				$this->load->library('upload', $config);

				if ($this->upload->do_upload('image')) {
					$prevImg = $data['arti']['gambar'];
					if ($prevImg != '' || null) {
						unlink(FCPATH . 'assets/article/poster/' . $prevImg);
					}
					$this->db->set('gambar', $this->upload->data('file_name'));
				} else {
					$this->session->set_flashdata(
						'flasherr',
						$this->upload->display_errors()
					);
				}
			}

			$this->db->set('judul', htmlspecialchars($this->input->post('title', true)));
			$this->db->set('slug', htmlspecialchars(slug($this->input->post('title', true))));
			$this->db->set('isi', $this->input->post('isi'));
			$this->db->set('status', htmlspecialchars($this->input->post('status', true)));
			$this->db->set('penulis_id', htmlspecialchars($this->input->post('penulis_id', true)));
			$this->db->set('tags', htmlspecialchars($this->input->post('tags', true)));
			$this->db->where('id', htmlspecialchars($this->input->post('id', true)));
			$this->db->update('article');

			logs('Update Artikel', htmlspecialchars($this->input->post('title', true)));

			$this->session->set_flashdata(
				'flashmsg',
				'Artikel berhasil dirubah.'
			);
			redirect('dashboard/article');
		}
	}


	public function hapus($id)
	{
		$prevImg = $this->db->get_where('article', ['id' => $id])->row_array();
		logs('Hapus Artikel', $prevImg['judul']);

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

	public function hapus_semua()
	{
		logs('Hapus Semua Artikel', null);
		$this->db->truncate('article');
		$this->session->set_flashdata(
			'flashmsg',
			'Semua Artikel berhasil dihapus'
		);
		redirect('dashboard/article');
	}

	public function redir()
	{
		redirect('dashboard/article');
	}
}
